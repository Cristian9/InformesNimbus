<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        $sql = "select n_users.id, username, lastname, firstname, email, "
                . "active, case a.rol when 1 then 'Administrador' "
                . "when 2 then 'Vicerector' when 3 then 'Director de Area' when 4 then "
                . "'Decano' when 5  then 'Director de carrera' when 6 "
                . "then 'Coordinador de curso' end as perfil from n_users, "
                . "n_assignment a where a.user_id = n_users.id and n_users.active=1";
        $dta_usuario = $this->db->query($sql)->result('array');

        return $dta_usuario;
    }

    function get_users() {
        $sql = "select * from n_users order by lastname";
        $dta_usuario = $this->db->query($sql)->result('array');

        return $dta_usuario;
    }

    function get_areas() {
        $sql = "select * from n_areas order by id, description";
        return $query = $this->db->query($sql)->result();
    }

    function get_facultades() {
        $sql = "select * from n_faculty order by id, description";
        return $query = $this->db->query($sql)->result();
    }

    function getPeriodo() {
        $sql = "select id, periodo as description from n_period order by id";
        return $this->db->query($sql)->result();
    }

    function get_category() {
        $sql = "select id, category as description from n_category order by id";
        return $query = $this->db->query($sql)->result();
    }

    function get_carreras($faculty_id) {
        $sql = "select program_id as id, description from n_programs where faculty_id = '" . $faculty_id . "' order by program_id, description";
        return $query = $this->db->query($sql)->result();
    }

    function get_cursos() {
        $sql = "select code as id, title as description from course order by code, title";
        return $query = $this->db->query($sql)->result();
    }

    function save_assignment($usuario, $usern, $niveles, $periodo, $program, $ciudad, $areas, $facultad, $facultadx, $carreras, $cursos) {
        // variable que contiene el array cargado
        $data = "";

        // Comprobar si existe la asignacion
        $sql_comprobar = "select * from n_assignment where user_id = " . $usuario;
        $sql_menucounter = "select max(id) total from n_item_menu order by id";

        $query_comprobar = $this->db->query($sql_comprobar)->result('array');
        $query_menucounter = $this->db->query($sql_menucounter)->result('array');

        if (!empty($query_comprobar)) {
            $role_profile = "";

            $this->delete_assignment($usuario);
        }

        // Verifica que array es el que esta cargado
        (!empty($areas)) && ($data['area_id'] = $areas);
        (!empty($facultad)) && ($data['faculty_id'] = $facultad);
        (!empty($carreras)) && ($data['program_id'] = $carreras);
        (!empty($cursos)) && ($data['course_id'] = $cursos);
        // inserta el array cargado
        if (!empty($data)) {
            foreach ($data as $key => $value) {

                foreach ($value as $v) {
                    $sql_insert = "insert into n_assignment (user_id, rol, " . $key . ") " .
                            "values (" . $usuario . ", " . $niveles . ", '" . $v . "')";

                    $this->db->query($sql_insert);
                }

                if ($key == 'program_id') {
                    $this->db->query("update n_assignment set faculty_id = '" . $facultadx . "' where user_id = '" . $usuario . "'");
                }
            }

            // tabla categoria
            foreach ($program as $value) {
                $sql_insert_category = "insert into n_assignment_category (user_id, category_id) values (" . $usuario . ", '" . $value . "')";
                $this->db->query($sql_insert_category);
            }

            // tabla ciudad
            foreach ($ciudad as $value) {
                $sql_insert_city = "insert into n_assignment_city (user_id, city_id) values (" . $usuario . ", " . $value . ")";
                $this->db->query($sql_insert_city);
            }
        } else {
            $sql_insert = "insert into n_assignment (user_id, rol) " .
                    "values (" . $usuario . ", " . $niveles . ")";
            $this->db->query($sql_insert);
        }
        $this->db->query("update n_users set active = 1 where id = '" . $usuario . "'");
        // llenar la tabla para el menu de accesos
        for ($i = $niveles; $i <= $query_menucounter[0]['total']; $i++) {

            if ($niveles == 3)
                if ($i != 3 && $i != 6)
                    continue;

            $sql_insert_accesos = "insert into n_permissions(user_id, menu_item_id) " .
                    "values (" . $usuario . ", " . $i . ")";
            $query_access = $this->db->query($sql_insert_accesos);
        }

        switch ($niveles) {
            case 1:
                $role_profile = 'Administrador';
                break;
            case 2:
                $role_profile = 'Vicerector';
                break;
            case 3:
                $role_profile = 'Director de Area';
                break;
            case 4:
                $role_profile = 'Decano';
                break;
            case 5:
                $role_profile = 'Director de carrera';
                break;
            case 6:
                $role_profile = 'Coordinador de curso';
                break;
        }

        $sql_add_audit = "insert into n_audit (username, user_afected, rol_user_afected, action, access_date, "
                . "ip_address) values ('" . $_SESSION['usuario']
                . "', '" . $usern . "', '" . $role_profile . "', 'Asignacion', '" . date('Y-m-d H:i:s') . "',"
                . $_SERVER['REMOTE_ADDR'] . "')";

        $this->db->query($sql_add_audit);

        return ($query_access) ? true : false;
    }

    function add($user, $fstn, $lstn, $mail, $reco, $date) {
        $sql = "insert into n_users (lastname, firstname, username, "
                . " email, registration_date, creator_id, active) "
                . "values ('" . strtoupper($lstn) . "', '" . $fstn . "', '" . $user . "',"
                . " '" . $mail . "', '" . $date . "', '" . $reco . "', 1)";
        return $this->db->query($sql);
    }

    function delete_assignment($userid) {
        $sql_del_assignment = "delete from n_assignment where user_id = " . $userid;
        $sql_del_permission = "delete from n_permissions where user_id = " . $userid;
        $sql_del_ascategory = "delete from n_assignment_category where user_id = " . $userid;
        $sql_del_ascity = "delete from n_assignment_city where user_id = " . $userid;

        $this->db->query($sql_del_assignment);
        $this->db->query($sql_del_permission);
        $this->db->query($sql_del_ascategory);
        $this->db->query($sql_del_ascity);
    }

    function delete($uid, $uname, $role) {

        $this->delete_assignment($uid);

        $sql_upd_user = "update n_users set active = 0 where id = '" . $uid . "'";

        $sql_add_audit = "insert into n_audit (username, user_afected, rol_user_afected, action, access_date, "
                . "ip_address) values ('" . $_SESSION['usuario']
                . "', '" . $uname . "', '" . $role . "', 'Desasignacion', '" . date('Y-m-d H:i:s') . "', "
                . $_SERVER['REMOTE_ADDR'] . "')";

        $upd = $this->db->query($sql_upd_user);
        $aud = $this->db->query($sql_add_audit);

        return ($upd && $aud) ? true : false;
    }

}

?>