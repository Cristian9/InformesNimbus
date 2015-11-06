<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Area_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){
            $sql = "select id, description from n_areas order by id";
        }else{
            $sql = "select ar.id, ar.description from n_areas ar, n_assignment a, ".
                "n_users u where ar.id = a.area_id and a.user_id = u.id and u.username = '".$_SESSION['usuario']."'";
        }
        
        $query = $this->db->query($sql);
        return $query->result('array');
    }

    function getPeriodo(){
        $sql = "select * from n_period order by id desc";
        return $this->db->query($sql)->result('array');
    }

    function listar($ciudad, $area, $herramienta, $prg, $del, $al) {
        $estadisticas = array();
        $sql_ciudad = ($ciudad[0] == "1") ?
                " and n.faculty not in ('F3', 'F4', 'F5') " :
                " and n.faculty in ('F3', 'F4', 'F5') ";

        $sql_area = ($area != '0') ? " and n.course_code =
                    (select course_code 
                    from n_course_areas 
                    where area_id in ('" . $area . "') and course_code = n.course_code)" : "";
        
        if($_SESSION['rol'] == 3){
            if($area == '0'){
                foreach ($_SESSION['area_id'] as $value) {
                    $in .= "'".$value."',";
                }
                $in = substr($in, 0, -1);
                $sql_area = " and n.course_code =
                    (select course_code 
                    from n_course_areas 
                    where area_id in (" . $in . ") and course_code = n.course_code)";
            }
        }

        $sql = "select n.category, f.description as facultad, c.description, "
                . "n.nbr_users, n.section_code, n.course_code, if(n.turno=1, 'mañana', "
                . "if(n.turno=2,'tarde', 'noche')) as turno, n.course_title, "
                . "n.coach, n.lastname, n.firstname";

        $sql_from = " from n_report_detail n, n_faculty f, n_programs c "
                . "where f.id = faculty and c.program_id = program and "
                . "f.id = c.faculty_id and week between '" . $del 
                . "' and '" . $al . "' " . $sql_ciudad . $sql_area 
                . " and n.category = '" . $prg . "' GROUP BY n.section_code";

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

    function data_graficar($ciudad, $programa, $area, $desde, $hasta, $herramienta) {
        $sql_ciudad = ($ciudad[0] == "1") ?
                " where faculty not in ('F3', 'F4', 'F5') " :
                " where faculty in ('F3', 'F4', 'F5') ";

        $where_area = ($area == '0') ? "" : " where id = '" . $area . "'";
        
        if($_SESSION['rol'] == 3){
            if($area == '0'){
                foreach ($_SESSION['area_id'] as $value) {
                    $in .= "'".$value."',";
                }
                $in = substr($in, 0, -1);
                $where_area = " where id in (" . $in . ")";
            }
        }

        $data_areas = $this->db->query("select * from n_areas " . $where_area . " order by id, description")->result('array');

        if (!empty($herramienta)) {
            for ($i = 0; $i < count($herramienta); $i++) {
                $sql_herramientas = "";
                $sql_totales = "";
                $sql_herramientas = "select ";
                $sql_totales = "select ";
                foreach ($data_areas as $v) {
                    $sql_totales .= "(select count(distinct(section_code)) from n_report_detail " .
                            $sql_ciudad . " and course_title not in ('INGLES I', 'INGLES II', 'INGLES III') "
                            . "and category = '" . $programa . "' and  course_code in "
                            . "(select course_code from n_course_areas where area_id = '" . $v['id'] . "') "
                            . "and week between '" . $desde . "' and '" . $hasta . "' "
                            . "ORDER BY course_title asc) " . $v['description'] . ",";

                    $sql_herramientas .= "(select count(distinct(section_code)) "
                            . "from n_report_detail " . $sql_ciudad
                            . "and " . $herramienta[$i] . " <> 0 and course_code in (select course_code "
                            . "from n_course_areas where area_id = '" . $v['id'] . "') and course_title not in "
                            . "('INGLES I', 'INGLES II', 'INGLES III') and category = '" . $programa . "' "
                            . "and week between '" . $desde . "' and '" . $hasta . "') as " . $v['description'] . ",";
                }
                $sql_herramientas = substr($sql_herramientas, 0, -1);
                $sql_totales = substr($sql_totales, 0, -1);
                //echo $sql_herramientas;
                $data_herramientas[$herramienta[$i]] = $this->db->query($sql_herramientas)->result('array');
            }
            $data_herramientas['Totales'] = $this->db->query($sql_totales)->result('array');
        }
        return $data_herramientas;
    }
}