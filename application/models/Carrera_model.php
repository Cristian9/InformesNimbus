<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Carrera_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getEscuelas($id, $facultad, $prg) {
        if ($id == "1") {
            $chk = " and n.faculty not in ('F3','F4','F5')";
        } else {
            $chk = " and n.faculty in ('F3','F4','F5')";
        }
        
        if($facultad == '0'){
            foreach ($_SESSION['faculty_id'] as $value) {
                $in .= "'" . $value . "',";
            }
            $in = substr($in, 0, -1);
            $sql_faculty = " and n.faculty in (".$in.")";
        }else{
            $sql_faculty = " and n.faculty = '" . $facultad . "'";
        }

        $sql = "select n.program as id, c.description from " .
                "n_report_detail n, n_programs c where n.program = c.program_id and n.category = '" . $prg . "'" .
                $chk . $sql_faculty . " GROUP BY n.program";

        $query = $this->db->query($sql);
        return $query->result();
    }

    function getPeriodo(){
        $sql = "select * from n_period order by id desc";
        return $this->db->query($sql)->result('array');
    }

    function index($id) {
        if ($id == "1") {
            $chk = " where (fa.id not like 'F%' and fa.id <> 'P2')";
        } else {
            $chk = " where (fa.id like 'F%' or fa.id = 'P2')";
        }

        switch ($_SESSION['rol']) {
            case 1:
            case 2:
                $sql = "select fa.id, fa.description from n_faculty fa ".$chk." order by fa.id";
                break;
            case 4:
                foreach ($_SESSION['faculty_id'] as $value) {
                    $in .= "'" . $value . "',";
                }
                $in = substr($in, 0, -1);
                $sql = "select * from n_faculty fa " . $chk . " and fa.id in (" . $in . ") order by fa.id, fa.description";
                break;
            case 5:
                foreach ($_SESSION['program_id'] as $value) {
                    $in .= "'" . $value . "',";
                }
                $in = substr($in, 0, -1);
                $sql = "select program_id as id, description from n_programs where program_id " 
                    . "in (" . $in . ") and faculty_id = '" . $_SESSION['faculty_id'][0] . "'";
                break;
        }

        $query = $this->db->query($sql);
        return $query->result();
    }

    function listar($ciudad, $prg, $carrera, $facultad, $herramienta, $del, $al) {
        $estadisticas = array();

        $sql_ciudad = ($ciudad[0] == "1") ?
                " and faculty not in ('F3', 'F4', 'F5') " :
                " and faculty in ('F3', 'F4', 'F5') ";

        $n_faculty = ($facultad != "0") ? " and faculty = '" . $facultad . "'" : "";
        

        if($_SESSION['rol'] == 4){
            if($facultad == '0'){
                foreach ($_SESSION['faculty_id'] as $value) {
                    $in .= "'".$value."',";
                }
                $in = substr($in, 0, -1);
                $n_faculty = " and faculty in (" . $in . ") ";
            }
        }

        $sql_carrera = ($carrera != '0') ? " and program = '" . $carrera . "' " : "";

        if($_SESSION['rol'] == 5){
            if($carrera == '0'){
                foreach ($_SESSION['program_id'] as $value) {
                    $in .= "'".$value."',";
                }
                $in = substr($in, 0, -1);
                $sql_carrera = " and program in (" . $in . ") and faculty = '".$_SESSION['faculty_id'][0]."'";
            }

            $n_faculty = ($carrera != "0") ? " and faculty = '" . $_SESSION['faculty_id'][0] . "'" : "";

        }

        $sql = "select category, f.description as facultad, c.description, "
                . "n.nbr_users, n.section_code, n.course_code, if(n.turno=1, 'mañana', "
                . "if(n.turno=2,'tarde', 'noche')) as turno, n.course_title, "
                . "n.coach, n.lastname, n.firstname";

        $sql_from = " from n_report_detail n, n_faculty f, n_programs c "
                . "where f.id = faculty and c.program_id = program and "
                . "f.id = c.faculty_id and week "
                . "between '" . $del . "' and '" . $al . "' "
                . $sql_ciudad . $sql_carrera . $n_faculty
                . " and category = '" . $prg
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
            foreach ($query[$e] as $v) {
                $estadisticas['estadisticas'][$e][] = $v;
            }
        }
        return $estadisticas;
    }

    function graficar($ciudad, $herramienta, $programa, $carrera, $facultad, $desde, $hasta) {
        $sql_ciudad = ($ciudad[0] == "1") ?
                " and faculty not in ('F3', 'F4', 'F5') " :
                " and faculty in ('F3', 'F4', 'F5') ";

        $n_faculty = ($facultad != "0") ? " and faculty = '" . $facultad . "'" : "";

        if($_SESSION['rol'] == 4){
            if($facultad == '0'){
                foreach ($_SESSION['faculty_id'] as $value) {
                    $in .= "'".$value."',";
                }
                $in = substr($in, 0, -1);
                $n_faculty = " and faculty in (" . $in . ") ";
            }
        }

        $where_carrera = ($carrera != '0') ? " and c.program_id = '" . $carrera . "' " : "";

        if($_SESSION['rol'] == 5){
            if($carrera == '0'){
                foreach ($_SESSION['program_id'] as $value) {
                    $in .= "'".$value."',";
                }
                $in = substr($in, 0, -1);
                $where_carrera = " and c.program_id in (" . $in . ") and c.faculty_id = '".$_SESSION['faculty_id'][0]."' ";
            }else{
                $where_carrera = " and c.program_id = '" . $carrera . "' and c.faculty_id = '".$_SESSION['faculty_id'][0]."' ";
            } 
        }

        $sql_carreras = "select n.program, c.description from n_report_detail n, " .
                "n_programs c where n.program = c.program_id and n.faculty = c.faculty_id and n.category = '" . $programa . "' " .
                $sql_ciudad . $n_faculty . $where_carrera . " GROUP BY n.program";
        //echo $sql_carreras;
        $datos_carreras = $this->db->query($sql_carreras)->result('array');

        if (!empty($herramienta)) {
            for ($i = 0; $i < count($herramienta); $i++) {
                $sql_totales = "select ";
                $sql_herramientas = "select ";
                foreach ($datos_carreras as $v) {

                    $sql_totales .= "(select count(distinct(section_code)) from n_report_detail" .
                            " where course_title not in ('INGLES I', 'INGLES II', 'INGLES III') " .
                            $sql_ciudad . " and category = '" . $programa . "' " .
                            $n_faculty . " and program = '" . $v['program'] . "' GROUP BY program) as '" . $v['description'] . "', ";

                    $sql_herramientas .= "ifnull((select count(distinct(section_code)) from n_report_detail where " .
                            $herramienta[$i] . " <> 0 and course_title not in ('INGLES I', 'INGLES II', 'INGLES III') " .
                            $sql_ciudad . "and category = '" . $programa . "' " .
                            $n_faculty . " and program = '" . $v['program'] . "' GROUP BY program), 0) as '" . $v['description'] . "', ";
                }

                $sql_herramientas = substr($sql_herramientas, 0, -2);

                $datos_para_graficar[$herramienta[$i]] = $this->db->query($sql_herramientas)->result('array');
            }

            $sql_totales = substr($sql_totales, 0, -2);

            $datos_para_graficar['Totales'] = $this->db->query($sql_totales)->result('array');

            return $datos_para_graficar;
        }
    }

}
