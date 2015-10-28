<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Curso_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getPeriodo(){
        $sql = "select * from n_period order by id desc";
        return $this->db->query($sql)->result('array');
    }

    function index($curso_id) {

        switch ($_SESSION['rol']) {
            case 1:
                $sql = "select code as id, title as description from course where category_code = '" . $curso_id . "' order by title asc";
                break;
            case 3:
                foreach ($_SESSION['area_id'] as $value) {
                    $in .= "'" . $value . "',";
                }
                $in = substr($in, 0, -1);
                $sql = "select code as id, title as description from course where substr(visual_code, 5, 4)" 
                    . " in (select course_code from n_course_areas where " 
                    . " area_id in (" . $in . ")) and category_code = '".$curso_id."'";
                break;
            case 4:
                foreach ($_SESSION['faculty_id'] as $value) {
                    $in .= "'" . $value . "',";
                }
                $in = substr($in, 0, -1);
                $sql = "select code as id, title as description from course, session s where " 
                    . "substr(s.name, 9, 4) = substr(visual_code, 5, 4) " 
                    . "and substr(s.name, 5, 2) in (" . $in . ") and category_code = '".$curso_id
                    . "' GROUP BY visual_code";
                break;
            case 5:
                foreach ($_SESSION['program_id'] as $value) {
                    $in .= "'" . $value . "',";
                }
                $in = substr($in, 0, -1);
                $sql = "select code as id, title as description from course, session s where " 
                    . "substr(s.name, 9, 4) = substr(visual_code, 5, 4) " 
                    . "and substr(s.name, 7, 2) in (" . $in . ") and category_code = '".$curso_id
                    ."' GROUP BY visual_code";
                break;
            case 6:
                foreach ($_SESSION['course_id'] as $value) {
                    $in .= "'" . substr($value, 4, 4) . "',";
                }
                $in = substr($in, 0, -1);
                $sql = "select code as id, title as description from course " 
                    . "where substr(code, 5, 4) in (" . $in . ") and category_code = '".$curso_id."'";
                break;
        }

        $query = $this->db->query($sql);
        return $query->result();
    }

    function listar($categoria, $herramienta, $curso, $del, $al) {
        $estadisticas = array();
        $curso = substr($curso, 4, 4);

        $sql_curso = ($curso != '0') ? " and course_code = '" . $curso . "' " : "";

        $sql_rol = "";

        switch ($_SESSION['rol']) {
            case 3:
                foreach ($_SESSION['area_id'] as $value) {
                    $in .= "'" . $value . "',";
                }
                $in = substr($in, 0, -1);
                $sql_rol = " and course_code in (select course_code from " 
                    . "n_course_areas where area_id in (".$in.") and course_code = course_code)";
                break;
            case 4:
                foreach ($_SESSION['faculty_id'] as $value) {
                    $in .= "'" . $value . "',";
                }
                $in = substr($in, 0, -1);
                $sql_rol = " and faculty in (".$in.")";
                break;
            case 5:
                foreach ($_SESSION['program_id'] as $value) {
                    $in .= "'" . $value . "',";
                }
                $in = substr($in, 0, -1);
                $sql_rol = " and program in (".$in.")";
                break;
            case 6:
                if($curso == '0'){
                    foreach ($_SESSION['course_id'] as $value) {
                        $in .= "'" . substr($value, 4, 4) . "',";
                    }
                    $in = substr($in, 0, -1);
                    $sql_curso = " and course_code in (" . $in . ")";
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
                . "' ".$sql_rol." GROUP BY section_code";

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
