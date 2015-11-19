<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_menu($userid) {
        $user_id = "select id from n_users where username = '" . $userid . "'";
        $result = $this->db->query($user_id)->result('array');
        $sql = "select * from n_item_menu where "
                . "id in (select menu_item_id from "
                . "n_permissions where user_id = '" . $result[0]['id'] . "')";

        $datos['menu'] = $this->db->query($sql)->result('array');

        return $datos;
    }

    function get_profile($userid) {
        $sql_profile = "select u.id, concat(u.lastname, ', ', u.firstname) "
                . " nombre, pr.rol,  pr.area_id, pr.faculty_id, "
                . " pr.program_id, pr.course_id from n_users u, n_assignment "
                . " pr where u.id = pr.user_id and u.username = '" . $userid . "'";

        return $this->db->query($sql_profile)->result('array');
    }

    function get_city_assignment($userid) {
        $sql_assignment_city = "select city_id from n_assignment_city, n_users u where u.id = user_id and u.username = '" . $userid . "'";

        return $this->db->query($sql_assignment_city)->result('array');
    }

    function check_user($user) {
        $sql_check = "select username from n_users where username = '" . $user . "' and active = '1'";
        return $this->db->query($sql_check)->result('array');
    }

    function add_audit($act) {
        $action = ($act == 'in') ? 'login' : 'logout';
        $sql_audit = "insert into n_audit(username, action, "
                . "access_date, ip_address) values ('" . $_SESSION['usuario']
                . "', '" . $action . "', '" . date('Y-m-d H:i:s') "', " 
                . $_SERVER['REMOTE_ADDR'] . "')";
        $this->db->query($sql_audit);
    }

    function get_category_assignment($userid) {
        $sql_assignment_category = "select category_id, c.category "
                . " from n_assignment_category, n_users u, n_category "
                . " c where u.id = user_id and category_id = c.id and u.username = '" . $userid . "' order by category_id";

        return $this->db->query($sql_assignment_category)->result('array');
    }

    function add_period($id, $desc) {
        $sql_new_period = "insert into n_period values ('" . $id . "', '" . $desc . "')";
        return $this->db->query($sql_new_period);
    }

}
