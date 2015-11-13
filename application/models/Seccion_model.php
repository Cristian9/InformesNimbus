<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Seccion_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function index($fid, $id) {
        if ($fid == "1") {
            $chk = " and substr(name, 5, 2) not in ('F3', 'F4', 'F5') order by name asc";
        } else {
            $chk = " and substr(name, 5, 2) in ('F3', 'F4', 'F5') order by name asc";
        }

        switch ($_SESSION['rol']) {
            case 1:
            case 2:
                $sql = "select id, name from session where name like '" . $id . "%'" . $chk;
                break;
            case 4:
                foreach ($_SESSION['faculty_id'] as $value) {
                    $in .= "'" . $value . "',";
                }
                $in = substr($in, 0, -1);
                $sql = "select id, name from session where substr(name, 5, 2) in (".$in.") and name like '".$id."%'".$chk;
                break;
            case 5:
                foreach ($_SESSION['program_id'] as $value) {
                    $in .= "'" . $value . "',";
                }
                $in = substr($in, 0, -1);
                $sql = "select id, name from session where substr(name, 7, 2) in (".$in.") and name like '".$id."%'".$chk;
                break;
            case 6:
                foreach ($_SESSION['course_id'] as $value) {
                    $in .= "'" . substr($value, 4, 4) . "',";
                }
                $in = substr($in, 0, -1);
                $sql = "select id, name from session where substr(name, 9, 4) in (".$in.") " 
                    . " and substr(name, 2, 3) = '".substr($id, 1, 3)."'";
                break;
        }

        $query = $this->db->query($sql);
        return $query->result();
    }

    function getPeriodo(){
        $sql = "select * from n_period order by id desc";
        return $this->db->query($sql)->result('array');
    }

    function listar($ciudad, $prg, $seccion, $herramienta, $del, $al) {
        $estadisticas = array();
        $sql_ciudad = ($ciudad[0] == "1") ?
                " and faculty not in ('F3', 'F4', 'F5') " :
                " and faculty in ('F3', 'F4', 'F5') ";

        $sql_carrera = ($seccion != '0') ? " and section_code = '" . $seccion . "' " : "";
        $periodo = substr($prg, 1, 3);

        $sql_rol = "";

        switch ($_SESSION['rol']) {
            case 3:
                foreach ($_SESSION['area_id'] as $value) {
                    $in .= "'" . $value . "',";
                }
                $in = substr($in, 0, -1);
                $sql_rol = " and course_code in (select course_code from " 
                    . "n_course_areas where area_id in (".$in.") and course_code = course_code and period = '".$periodo."')";
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
        }

        $sql = "select category, f.description as facultad, c.description, "
                . "n.nbr_users, n.section_code, n.course_code, if(n.turno=1, 'mañana', "
                . "if(n.turno=2,'tarde', 'noche')) as turno, n.course_title, "
                . "n.coach, n.lastname, n.firstname";

        $sql_from = " from n_report_detail n, n_faculty f, n_programs c "
                . "where f.id = faculty and c.program_id = program and "
                . "f.id = c.faculty_id and week "
                . "between '" . $del . "' and '" . $al . "' "
                . $sql_ciudad . $sql_carrera . " and category = '" . $prg
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
