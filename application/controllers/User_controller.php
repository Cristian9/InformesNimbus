<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_controller extends CI_Controller {

    public function __construct() {
        error_reporting(0);
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('user_model');
    }

    function index() {
        $data = $this->user_model->index();
        $user_assignment = array();
        foreach ($data as $key => $value) {

            if (!$user_assignment[$value['id']]) {
                $user_assignment[$value['id']] = array();
                $user_assignment[$value['id']] = $data[$key];
            } else {
                $user_assignment[$value['id']]['Accesos'] .= " &crarr;<br/>" . $value['Accesos'];
            }
        }

        $datos['user'] = $user_assignment;

        $this->load->view('user/view_user', $datos);
    }

    function newperiod() {
        $this->load->view('user/new_period');
    }

    function newuser() {
        $this->load->view('user/new_user');
    }

    function asignar() {
        $data['user'] = $this->user_model->get_users();
        $this->load->view('user/asignar_usuario', $data);
    }

    function get_areas() {
        $json->listas = $this->user_model->get_areas();
        echo json_encode($json);
    }

    function get_category() {
        $json->listas = $this->user_model->get_category();
        echo json_encode($json);
    }

    function getPeriodo() {
        $json->listas = $this->user_model->getPeriodo();
        echo json_encode($json);
    }

    function get_facultades() {
        $json->listas = $this->user_model->get_facultades();
        echo json_encode($json);
    }

    function get_carreras() {
        $facultad = $this->input->post('facultad');
        $json->listas = $this->user_model->get_carreras($facultad);
        echo json_encode($json);
    }

    function get_cursos() {
        $json->listas = $this->user_model->get_cursos();
        echo json_encode($json);
    }

    function save_assignment() {
        session_start();
        $usuario = $this->input->post('usuario');
        $usern = $this->input->post('usern');
        $niveles = $this->input->post('niveles');
        $periodo = $this->input->post('periodo');
        $program = $this->input->post('program');
        $areas = $this->input->post('areas');
        $facultad = $this->input->post('facultad');
        $facultadx = $this->input->post('facultadx');
        $carreras = $this->input->post('carreras');
        $cursos = $this->input->post('cursos');
        $ciudad = $this->input->post('ciudad');

        $asignacion = $this->user_model->save_assignment(
                $usuario, $usern, $niveles, $periodo, $program, $ciudad, $areas, $facultad, $facultadx, $carreras, $cursos
        );
        print $asignacion;
    }

    function add() {
        session_start();
        $user = $this->input->post('user');
        $fstn = $this->input->post('fstn');
        $lstn = $this->input->post('lstn');
        $mail = $this->input->post('mail');
        $reco = $_SESSION['id'];
        $date = date('Y-m-d H:i:s');

        $record = $this->user_model->add(
                $user, $fstn, $lstn, $mail, $reco, $date
        );
        echo $record;
    }

    function review() {
        $user = $this->input->post('username');
        $type = $this->input->post('type');

        if ($type == 'new') {
            $result = $this->user_model->review_useradd($user);
        } else {
            $result = $this->user_model->review_assignment($user);
        }


        echo ($result != '0') ? true : false;
    }

    function delete() {
        session_start();
        $uid = base64_decode($_GET['uid']);
        $uname = base64_decode($_GET['uname']);
        $role = base64_decode($_GET['role']);
        $delete_assignment = $this->user_model->delete($uid, $uname, $role);

        if ($delete_assignment) {
            redirect('main-menu#users');
        } else {
            die('Error');
        }
    }

}

?>