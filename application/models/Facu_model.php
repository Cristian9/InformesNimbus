<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Facu_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function index($id) {
        if ($id == "1") {
            $chk = " where (fa.id not like 'F%' and fa.id <> 'P2') ";
        } else {
            $chk = " where (fa.id like 'F%' or fa.id = 'P2') ";
        }
        switch ($_SESSION['rol']) {
            case 1:
            case 2:
                $sql = "select fa.id, fa.description from n_faculty fa " . $chk . " order by fa.id";
                break;
            case 4:
                foreach ($_SESSION['faculty_id'] as $value) {
                    $in .= "'" . $value . "',";
                }
                $in = substr($in, 0, -1);
                $sql = "select * from n_faculty fa " . $chk . " and fa.id in (" . $in . ") order by fa.id, fa.description";
                break;
        }
        //echo $sql;
        $query = $this->db->query($sql);
        return $query->result();
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

    function listar($ciudad, $prg, $facu, $herramienta, $del, $al) {
        $estadisticas = array();
        $sql_ciudad = ($ciudad[0] == "1") ?
                " and faculty not in ('F3', 'F4', 'F5') " :
                " and faculty in ('F3', 'F4', 'F5') ";


        $sql_facu = ($facu != '0') ? " and faculty in ('" . $facu . "') " : "";

        if ($_SESSION['rol'] == 4) {
            if ($facu == '0') {
                foreach ($_SESSION['faculty_id'] as $value) {
                    $in .= "'" . $value . "',";
                }
                $in = substr($in, 0, -1);
                $sql_facu = " and faculty in (" . $in . ") ";
            }
        }

        $sql = "select category, f.description as facultad, c.description, "
                . "n.nbr_users, n.section_code, n.course_code, if(n.turno=1, 'mañana', "
                . "if(n.turno=2,'tarde', 'noche')) as turno, n.course_title, "
                . "n.coach, n.lastname, n.firstname";

        $sql_from = " from n_report_detail n, n_faculty f, n_programs c "
                . "where f.id = faculty and c.program_id = program and "
                . "f.id = c.faculty_id and week "
                . "between '" . $del . "' and '" . $al . "' and course_title not in ('INGLES I', 'INGLES II', 'INGLES III') "
                . $sql_ciudad . $sql_facu . " and category = '" . $prg
                . "' GROUP BY section_code";

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
            foreach ($query[$e] as $key => $v) {
                $estadisticas['estadisticas'][$e][] = $v;
            }
        }
        return $estadisticas;
    }

    function data_graficar($ciudad, $herramienta, $programa, $facultad, $desde, $hasta) {
        $sql_ciudad = ($ciudad[0] == "1") ?
                " and faculty not in ('F3', 'F4', 'F5') " :
                " and faculty in ('F3', 'F4', 'F5') ";

        $where_facultad = ($facultad != '0') ? " and faculty = '" . $facultad . "' " : "";

        if ($_SESSION['rol'] == 4) {
            if ($facultad == '0') {
                foreach ($_SESSION['faculty_id'] as $value) {
                    $in .= "'" . $value . "',";
                }
                $in = substr($in, 0, -1);
                $where_facultad = " and faculty in (" . $in . ") ";
            }
        }

        $query_facultades = "select faculty, f.description from n_faculty f, n_report_detail 
            where f.id = faculty and category = '" . $programa . "' " . $where_facultad . " group by faculty";

        $sql_facultades = $this->db->query($query_facultades)->result('array');

        if (!empty($herramienta)) {
            for ($i = 0; $i < count($herramienta); $i++) {
                $sql_herramientas = "";
                $sql_totales = "";
                $sql_totales = "select ";
                $sql_herramientas = "select ";

                foreach ($sql_facultades as $value) {
                    $sql_totales .= "(select count(distinct(section_code)) from n_report_detail 
                        where course_title not in ('INGLES I', 'INGLES II', 'INGLES III') and 
                        category = '" . $programa . "' and faculty = '" . $value['faculty'] . "' 
                        and week between '" . $desde . "' and '" . $hasta . "' 
                        GROUP BY faculty) as '" . substr($value['description'], 0, 10) . "',";

                    $sql_herramientas .= "(select count(distinct(section_code)) from n_report_detail 
                        where " . $herramienta[$i] . " <> 0 and course_title not in ('INGLES I', 'INGLES II', 'INGLES III') 
                        and faculty = '" . $value['faculty'] . "' and category = '" . $programa . "' and week 
                        between '" . $desde . "' and '" . $hasta . "' group by faculty) as '" . substr($value['description'], 0, 10) . "',";
                }

                $sql_herramientas = substr($sql_herramientas, 0, -1);

                $data_para_graficos[$herramienta[$i]] = $this->db->query($sql_herramientas)->result('array');
            }
            $sql_totales = substr($sql_totales, 0, -1);
            $data_para_graficos['Totales'] = $this->db->query($sql_totales)->result('array');
            return $data_para_graficos;
        }
    }

}
