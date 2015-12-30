<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Curso_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getPeriodos($category) {
        $sql = "select np.period as id, pr.periodo as description "
                . "from n_period_category np, n_period pr where "
                . "np.period = pr.id and np.category_id = '" . $category . "'";
        return $this->db->query($sql)->result('array');
    }

    function getWeeks($periodo, $category) {
        $sql = "select weeks from n_period_category where "
                . "period = '" . $periodo . "' and category_id = '" . $category . "'";
        return $this->db->query($sql)->result('array');
    }

    function index($curso_id) {
        $periodo = substr($curso_id, 1, 3);
        switch ($_SESSION['rol']) {
            case 1:
            case 2:
                $sql = "select distinct(course_code) as id, course_title "
                        . " as description from n_report_detail where category = '" . $curso_id . "'";
                break;
            case 3:
                foreach ($_SESSION['area_id'] as $value) {
                    $in .= "'" . $value . "',";
                }
                $in = substr($in, 0, -1);
                $sql = "select distinct(a.course_code) as id, n.course_title as description from " .
                        " n_report_detail n, n_course_areas a where a.course_code = " .
                        "n.course_code and a.area_id in (" . $in . ") and a.period = '" . $periodo . "' " .
                        "and n.category = '" . $curso_id . "' order by a.course_code asc";
                break;
            case 4:
                foreach ($_SESSION['faculty_id'] as $value) {
                    $in .= "'" . $value . "',";
                }
                $in = substr($in, 0, -1);
                $sql = "select distinct(course_code) as id, course_title " .
                        " as description from n_report_detail where faculty in (" . $in . ") " .
                        " and category = '" . $curso_id . "' order by course_code asc";
                break;
            case 5:
                foreach ($_SESSION['program_id'] as $value) {
                    $in .= "'" . $value . "',";
                }
                $in = substr($in, 0, -1);
                $sql = $sql = "select distinct(course_code) as id, course_title " .
                        " as description from n_report_detail where program in (" . $in . ") " .
                        " and category = '" . $curso_id . "' order by course_code asc";
                break;
            case 6:
                if (is_array($_SESSION['course_id'])) {
                    foreach ($_SESSION['course_id'] as $value) {
                        $in .= "'" . substr($value, 4, 4) . "',";
                    }
                    $in = substr($in, 0, -1);
                } else {
                    $in = "'" . substr($_SESSION['course_id'], 4, 4) . "'";
                }

                $sql = "select distinct(course_code) as id, course_title " .
                        " as description from n_report_detail where course_code in (" . $in . ") " .
                        " and category = '" . $curso_id . "' order by course_code asc";
                break;
        }
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_category() {
        $by_category = "";
        $sql_filtro = "";

        if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
            $by_category = "";
            $sql_filtro = "";
        } else {
            foreach ($_SESSION['category'] as $value) {
                $by_category .= "'" . $value['category_id'] . "',";
            }
            $by_category = substr($by_category, 0, -1);
            $sql_filtro = " where id in (" . $by_category . ")";
        }

        $sql_category = "select id, category from n_category " . $sql_filtro;

        return $this->db->query($sql_category)->result('array');
    }

    function listar($categoria, $herramienta, $curso, $del, $al) {
        $estadisticas = array();
        $periodo = substr($categoria, 1, 3);
        $sql_curso = ($curso != '0') ? " and course_code = '" . $curso . "' " : "";

        $sql_rol = "";

        switch ($_SESSION['rol']) {
            case 3:
                foreach ($_SESSION['area_id'] as $value) {
                    $in .= "'" . $value . "',";
                }
                $in = substr($in, 0, -1);

                if ($sql_curso == '') {
                    $sql_rol = " and course_code in (select course_code from "
                            . "n_course_areas where area_id in (" . $in . ") and course_code = course_code and period = '" . $periodo . "')";
                }
                break;
            case 4:
                foreach ($_SESSION['faculty_id'] as $value) {
                    $in .= "'" . $value . "',";
                }
                $in = substr($in, 0, -1);
                $sql_rol = " and faculty in (" . $in . ")";
                break;
            case 5:
                foreach ($_SESSION['program_id'] as $value) {
                    $in .= "'" . $value . "',";
                }
                $in = substr($in, 0, -1);
                $sql_rol = " and program in (" . $in . ")";
                break;
            case 6:
                if ($curso == '0') {
                    if (is_array($_SESSION['course_id'])) {
                        foreach ($_SESSION['course_id'] as $value) {
                            $in .= "'" . substr($value, 4, 4) . "',";
                        }
                        $in = substr($in, 0, -1);
                        $sql_curso = " and course_code in (" . $in . ")";
                    } else {
                        $sql_curso = " and course_code in ('" . substr($_SESSION['course_id'], 4, 4) . "')";
                    }
                }
                break;
        }

        $sql = "select category, f.description as facultad, c.description, "
                . "n.nbr_users, n.section_code, n.course_code, if(n.turno=1, 'mañana', "
                . "if(n.turno=2,'tarde', 'noche')) as turno, n.course_title, "
                . "n.coach, n.lastname, n.firstname";

        $sql_from = " from n_report_detail n, n_faculty f, n_programs c "
                . "where f.id = faculty and c.program_id = program and "
                . "f.id = c.faculty_id and week "
                . "between '" . $del . "' and '" . $al . "' "
                . $sql_curso . " and category = '" . $categoria
                . "' " . $sql_rol . " GROUP BY section_code";

        if (!empty($herramienta)) {
            $sql_columns = ", ";
            for ($i = 0; $i < count($herramienta); $i++) {
                $sql_columns .= "SUM(" . $herramienta[$i] . ") AS " . $herramienta[$i] . ", ";
            }

            $sql_columns = substr($sql_columns, 0, -2);
        } else {
            $sql_columns = "";
        }
        //echo $sql . $sql_columns . $sql_from;
        $query = $this->db->query($sql . $sql_columns . $sql_from)->result('array');
        for ($e = 0; $e < count($query); $e++) {
            foreach ($query[$e] as $v) {
                $estadisticas['estadisticas'][$e][] = $v;
            }
        }
        return $estadisticas;
    }

}
