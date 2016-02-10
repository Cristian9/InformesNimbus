<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Area_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
            $sql = "SELECT id, description FROM n_areas ORDER BY id";
        } else {
            $sql = "SELECT ar.id, ar.description from n_areas ar, n_assignment a, 
            n_users u where ar.id = a.area_id and a.user_id = u.id and u.username = '" . $_SESSION['usuario'] . "'";
        }

        $query = $this->db->query($sql);
        return $query->result('array');
    }

    function getPeriodos($category) {
        $sql = "SELECT np.period as id, pr.periodo as description 
            from n_period_category np, n_period pr where 
            np.period = pr.id and np.category_id = '" . $category . "'";
            
        return $this->db->query($sql)->result('array');
    }

    function getWeeks($periodo, $category) {
        $sql = "SELECT weeks from n_period_category where 
            period = '" . $periodo . "' AND category_id = '" . $category . "'";

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

        $sql_category = "SELECT id, category from n_category " . $sql_filtro;

        return $this->db->query($sql_category)->result('array');
    }

    function listar($ciudad, $area, $herramienta, $prg, $del, $al) {
        $estadisticas = array();
        $periodo = substr($prg, 1, 3);
        $sql_ciudad = ($ciudad[0] == "1") ?
                " and n.faculty not in ('F3', 'F4', 'F5', 'F6', 'F7', 'FP', 'F8') " :
                " and n.faculty in ('F3', 'F4', 'F5', 'F6', 'F7', 'FP', 'F8') ";

        $sql_area = ($area != '0') ? " inner join n_course_areas 
                nc on n.course_code = nc.course_code and nc.area_id = 
                '".$area."' and nc.period = '" . $periodo . "'" : "";

        if ($_SESSION['rol'] == 3) {
            if ($area == '0') {
                foreach ($_SESSION['area_id'] as $value) {
                    $in .= "'" . $value . "',";
                }
                $in = substr($in, 0, -1);

                $sql_area = " inner join n_course_areas 
                    nc on n.course_code = nc.course_code and nc.area_id in 
                    (" . $in . ") and nc.period = '" . $periodo . "'";
            }
        }

        $sql = "SELECT n.category, f.description as facultad, c.description, 
            n.nbr_users, n.section_code, n.course_code, if(n.turno=1, 'mañana', 
            if(n.turno=2,'tarde', 'noche')) as turno, n.course_title, 
            n.coach, n.lastname, n.firstname, SEC_TO_TIME(SUM(TIME_TO_SEC(n.time_conection))) Tiempo";

        $sql_from = " FROM n_report_detail n " . $sql_area . " inner join n_faculty 
            f on f.id = n.faculty inner join n_programs c on c.program_id = 
            n.program and f.id = c.faculty_id and n.week between '" . $del . 
            "' and '" . $al ."' " . $sql_ciudad . " and n.category = '" . $prg . 
            "' GROUP BY n.section_code";


        if (!empty($herramienta)) {
            $sql_columns = ", ";
            for ($i = 0; $i < count($herramienta); $i++) {
                if (!stristr($herramienta[$i], 'course_base')) {
                    $sql_columns .= "SUM(" . $herramienta[$i] . ") AS " . $herramienta[$i] . ", ";
                } else {
                    $sql_columns .= $herramienta[$i] . " AS " . $herramienta[$i] . ", ";
                }
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
        $periodo = substr($programa, 1, 3);
        $sql_ciudad = ($ciudad[0] == "1") ?
                " n.faculty not in ('F3', 'F4', 'F5', 'F6', 'F7', 'FP', 'F8') " :
                " n.faculty in ('F3', 'F4', 'F5', 'F6', 'F7', 'FP', 'F8') ";

        $where_area = ($area == '0') ? "" : " where id = '" . $area . "'";

        if ($_SESSION['rol'] == 3) {
            if ($area == '0') {
                foreach ($_SESSION['area_id'] as $value) {
                    $in .= "'" . $value . "',";
                }
                $in = substr($in, 0, -1);
                $where_area = " where id in (" . $in . ")";
            }
        }

        $data_areas = $this->db->query("SELECT * from n_areas " . $where_area . " order by id, description")->result('array');

        if (!empty($herramienta)) {
            for ($i = 0; $i < count($herramienta); $i++) {
                $sql_herramientas = "";
                $sql_totales = "";
                $sql_herramientas = "SELECT ";
                $sql_totales = "SELECT ";
                foreach ($data_areas as $v) {
                    $sql_totales .= "(SELECT COUNT(distinct(n.section_code)) from n_report_detail " 
                        . " n inner join n_course_areas c on" . $sql_ciudad 
                        . " and n.course_code = c.course_code and c.area_id = '" . $v['id'] . "' and " 
                        . " c.period = '" . $periodo . "' and n.course_title not in ('INGLES I', 'INGLES II', 'INGLES III') " 
                        . " and n.category = '" . $programa . "' and n.week between '".$desde."' and '".$hasta."'"
                        . " order by n.course_title asc) " . $v['description'] . ",";
                    
                    $sql_herramientas .= "(SELECT count(distinct(n.section_code)) from n_report_detail " 
                        . " n inner join n_course_areas c on" . $sql_ciudad 
                        . " and n." . $herramienta[$i] . " <> 0 and n.course_code = c.course_code and c.area_id = '" . $v['id'] . "' and " 
                        . " c.period = '" . $periodo . "' and n.course_title not in ('INGLES I', 'INGLES II', 'INGLES III') " 
                        . " and n.category = '" . $programa . "' and n.week between '" . $desde . "' and '" . $hasta . "') as " . $v['description'] . ",";
                }
                $sql_herramientas = substr($sql_herramientas, 0, -1);
                $sql_totales = substr($sql_totales, 0, -1);
                
                $data_herramientas[$herramienta[$i]] = $this->db->query($sql_herramientas)->result('array');
            }
            $data_herramientas['Totales'] = $this->db->query($sql_totales)->result('array');
        }
        return $data_herramientas;
    }
}