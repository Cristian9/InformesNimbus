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
        
        foreach ($data[0] as $key => $value) {
            $user_assignment[$key]['id'] = $value['id'];
            $user_assignment[$key]['username'] = $value['username'];
            $user_assignment[$key]['firstname'] = $value['firstname'];
            $user_assignment[$key]['lastname'] = $value['lastname'];
            $user_assignment[$key]['email'] = $value['email'];
            $user_assignment[$key]['perfil'] = $value['perfil'];

            foreach ($data[1] as $k => $v) {
                if($v['id'] == $value['id']){

                    if (isset($user_assignment[$key]['area'])) {

                        foreach ($v as $index => $items) {
                            if($index == 'id')
                                continue;

                            if(!stristr($user_assignment[$key][$index], $items)){
                                $user_assignment[$key][$index] .= (!empty($items)) ? "&bull; " . $items . "<br>" : "";
                            }
                        }

                    } else {

                        foreach ($v as $index => $items) {
                            if($index == 'id')
                                continue;

                            $user_assignment[$key][$index] = (!empty($items)) ? "&bull; " . $items . "<br>" : "";
                        }
                    }
                }
            }

            foreach ($data[2] as $k => $v) {

                if ($v['user_id'] == $value['id']) {
                    $user_assignment[$key]['ciudad'] .= $v['Ciudad'] . "<br/>";

                } elseif ($value['rol'] == 1 || $value['rol'] == 2) {
                    $user_assignment[$key]['ciudad'] = "Todos";
                }
            }

            foreach ($data[3] as $k => $v) {
                if ($v['user_id'] == $value['id']) {

                    $user_assignment[$key]['programa'] .= $v['category'] . "<br/>";

                } elseif ($value['rol'] == 1 || $value['rol'] == 2) {
                    $user_assignment[$key]['programa'] = "Todos";
                }
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

        $exists_user = $this->user_model->exists_user($user);

        if($exists_user){
            $record = false;
        }else{
            $record = $this->user_model->add(
                $user, $fstn, $lstn, $mail, $reco, $date
            );
        }

        echo $record;
    }

    function review() {
        $user = $this->input->post('username');
        $type = $this->input->post('type');

        if ($type == 'new') {
            $result = $this->user_model->exists_user($user);
        } else {
            $result = $this->user_model->isAssigned($user);
        }


        echo $result;
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