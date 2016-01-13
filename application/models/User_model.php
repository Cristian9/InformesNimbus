<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function index() {

        $sql_userlevels = "SELECT distinct(nu.id), username, lastname, firstname, email, active, 
            a.rol, case a.rol when 1 then 'Administrador' when 2 then 'Vicerector' when 3 then 
            'Director de Area' when 4 then 'Decano' when 5 then 'Director de carrera' when 6 
            then 'Coordinador de curso' end as perfil from n_users nu inner join n_assignment 
            a on a.user_id = nu.id and nu.active=1";

        $sql_assigned_to = "SELECT nu.id, 
            (SELECT description from n_areas where id = a.area_id) as area,  
            (SELECT description from n_faculty where id = a.faculty_id) as facultad, 
            (SELECT description from n_programs where faculty_id = a.faculty_id and 
            program_id = a.program_id) as escuela, (SELECT course_title from 
            n_report_detail where course_code = a.course_id limit 1) as curso from 
            n_users nu inner join n_assignment a on a.user_id = nu.id and nu.active=1";

        $sql_assigned_city = "SELECT user_id, case city_id when 1 then 'Lima' when 2 
            then 'Chiclayo' end as Ciudad from n_assignment_city";

        $sql_assigned_category = "SELECT nca.user_id, ca.category from n_assignment_category 
            nca, n_category ca where nca.category_id = ca.id";

        $data_userlevel = $this->db->query($sql_userlevels)->result('array');
        $data_assigned_to = $this->db->query($sql_assigned_to)->result('array');
        $data_assigned_city = $this->db->query($sql_assigned_city)->result('array');
        $data_assigned_category = $this->db->query($sql_assigned_category)->result('array');

        return array($data_userlevel, $data_assigned_to, $data_assigned_city, $data_assigned_category);
    }

    function get_users() {
        $sql = "SELECT * from n_users order by lastname";
        $dta_usuario = $this->db->query($sql)->result('array');

        return $dta_usuario;
    }

    function get_areas() {
        $sql = "SELECT * from n_areas order by id, description";
        return $query = $this->db->query($sql)->result();
    }

    function get_facultades() {
        $sql = "SELECT * from n_faculty order by id, description";
        return $query = $this->db->query($sql)->result();
    }

    function getPeriodo() {
        $sql = "SELECT id, periodo as description from n_period order by id";
        return $this->db->query($sql)->result();
    }

    function get_category() {
        $sql = "SELECT id, category as description from n_category order by id";
        return $query = $this->db->query($sql)->result();
    }

    function get_carreras($faculty_id) {
        $sql = "SELECT program_id as id, description from n_programs where 
            faculty_id = '" . $faculty_id . "' order by program_id, description";
        return $query = $this->db->query($sql)->result();
    }

    function get_cursos() {
        $sql = "SELECT substr(code, 5, 4) as id, title 
            as description from course group by code order by code, title";
        return $query = $this->db->query($sql)->result();
    }

    function save_assignment($usuario, $usern, $niveles, $periodo, $program, $ciudad, $areas, $facultad, $facultadx, $carreras, $cursos) {
        // variable que contiene el array cargado
        $data = "";

        // Comprobar si existe la asignacion
        $sql_comprobar = "SELECT * from n_assignment where user_id = " . $usuario;
        $sql_menucounter = "SELECT max(id) total from n_item_menu order by id";

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
                    $sql_insert = "INSERT into n_assignment (user_id, rol, " . $key . ") 
                        VALUES (" . $usuario . ", " . $niveles . ", '" . $v . "')";

                    $this->db->query($sql_insert);
                }

                if ($key == 'program_id') {
                    $this->db->query("UPDATE n_assignment set faculty_id = '" . $facultadx . "' where user_id = '" . $usuario . "'");
                }
            }

            // tabla categoria
            foreach ($program as $value) {
                $sql_insert_category = "INSERT INTO n_assignment_category (user_id, category_id) 
                    VALUES (" . $usuario . ", '" . $value . "')";

                $this->db->query($sql_insert_category);
            }

            // tabla ciudad
            foreach ($ciudad as $value) {
                $sql_insert_city = "INSERT INTO n_assignment_city (user_id, city_id) 
                    VALUES (" . $usuario . ", " . $value . ")";

                $this->db->query($sql_insert_city);
            }
        } else {
            $sql_insert = "INSERT INTO n_assignment (user_id, rol) 
                VALUES (" . $usuario . ", " . $niveles . ")";
            $this->db->query($sql_insert);
        }
        $this->db->query("UPDATE n_users SET active = 1 WHERE id = '" . $usuario . "'");

        // llenar la tabla para el menu de accesos
        for ($i = $niveles; $i <= $query_menucounter[0]['total']; $i++) {

            if ($niveles == 3)
                if ($i != 3 && $i != 6)
                    continue;

            $sql_insert_accesos = "INSERT INTO n_permissions(user_id, menu_item_id) 
                VALUES (" . $usuario . ", " . $i . ")";
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

        $sql_add_audit = "INSERT INTO n_audit (username, user_afected, rol_user_afected, 
                action, access_date, ip_address) VALUES ('" . $_SESSION['usuario']. "', 
                '" . $usern . "', '" . $role_profile . "', 'Asignacion', '" . date('Y-m-d H:i:s') . "',
                '" . $_SERVER['REMOTE_ADDR'] . "')";

        $this->db->query($sql_add_audit);

        return ($query_access) ? true : false;
    }

    function add($user, $fstn, $lstn, $mail, $reco, $date) {

        $sql = "INSERT INTO n_users (lastname, firstname, username, 
            email, registration_date, creator_id, active) VALUES 
            ('" . strtoupper($lstn) . "', '" . $fstn . "', '" . $user . "',"
            . " '" . $mail . "', '" . $date . "', '" . $reco . "', 1)";

        return $this->db->query($sql);
    }

    function delete_assignment($userid) {
        $sql_del_assignment = "DELETE FROM n_assignment WHERE user_id = " . $userid;
        $sql_del_permission = "DELETE FROM n_permissions WHERE user_id = " . $userid;
        $sql_del_ascategory = "DELETE FROM n_assignment_category WHERE user_id = " . $userid;
        $sql_del_ascity = "DELETE FROM n_assignment_city WHERE user_id = " . $userid;

        $this->db->query($sql_del_assignment);
        $this->db->query($sql_del_permission);
        $this->db->query($sql_del_ascategory);
        $this->db->query($sql_del_ascity);
    }

    function isAssigned($user) {
        $sql_review = "SELECT count(distinct(n_users.id)) total FROM n_users, 
            n_assignment a WHERE a.user_id = n_users.id AND n_users.active=1 
            AND username = '" . $user . "'";

        $data = $this->db->query($sql_review)->result('array');

        return ($data[0]['total'] > 0) ? true : false;
    }

    function exists_user($user) {
        $sql_review = "SELECT count(distinct(username)) total 
            from n_users where username = '" . $user . "'";

        $data = $this->db->query($sql_review)->result('array');

        return ($data[0]['total'] > 0) ? true : false;
    }

    function delete($uid, $uname, $role) {

        $this->delete_assignment($uid);

        $sql_upd_user = "UPDATE n_users set active = 0 where id = '" . $uid . "'";

        $sql_add_audit = "INSERT INTO n_audit (username, user_afected, rol_user_afected, 
            action, access_date, ip_address) values ('" . $_SESSION['usuario'] . "', 
            '" . $uname . "', '" . $role . "', 'Desasignacion', '" . date('Y-m-d H:i:s') . "', 
            '" . $_SERVER['REMOTE_ADDR'] . "')";

        $upd = $this->db->query($sql_upd_user);
        $aud = $this->db->query($sql_add_audit);

        return ($upd && $aud) ? true : false;
    }

}

?>