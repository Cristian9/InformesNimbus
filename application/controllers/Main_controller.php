<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('main_model');
    }

    function index() {
        redirect('login');
    }

    function excel() {
        $this->load->view('algo');
    }

    function auth() {
        session_start();
        $user = $this->input->post('usuario');
        $pass = $this->input->post('password');
        
        // Respuesta del AD
        $ok = 'ok';
        
        if ($ok == 'ok') {
            $_SESSION['usuario'] = $user;
            $auth_check = $this->main_model->check_user($_SESSION['usuario']);
            if(!empty($auth_check)){
                redirect('main-menu');
            }else{
                redirect('login?errorAuth=1');
            }
        }
    }

    function login() {
        $this->load->view('login');
    }

    function menu_principal() {
        session_start();
        if (isset($_SESSION['usuario']) && $_SESSION['usuario'] != "") {
            $datos_menu = $this->main_model->get_menu($_SESSION['usuario']);
            $datos_perfil = $this->main_model->get_profile($_SESSION['usuario']);
            $city_profile = $this->main_model->get_city_assignment($_SESSION['usuario']);
            $category_profile = $this->main_model->get_category_assignment($_SESSION['usuario']);

            $aux = ['area_id', 'faculty_id', 'program_id', 'curso_id'];

            foreach ($datos_perfil as $key => $value) {
                foreach ($value as $k => $v) {
                    if (in_array($k, $aux)) {
                        $_SESSION[$k][$key] = $v;
                    } else {
                        $_SESSION[$k] = $v;
                    }
                }
            }

            $_SESSION['city'] = $city_profile;
            $_SESSION['category'] = $category_profile;

            /* echo "<pre>";
              print_r($_SESSION);
              exit; */
            $this->load->view('principal', $datos_menu);
        } else {
            $this->login();
        }
    }

    function add_period() {
        $id = $this->input->post('id');
        $desc = $this->input->post('desc');
        $record = $this->main_model->add_period($id, $desc);
        echo $record;
    }

    function logout() {
        session_start();
        session_destroy();
        $this->login();
    }

}
