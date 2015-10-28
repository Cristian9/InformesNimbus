<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Seccion_controller extends CI_Controller{
    
    public function __construct() {
        error_reporting(0);
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('seccion_model');
    }

    function index() {
        session_start();
        $data['periodo'] = $this->seccion_model->getPeriodo();
        $this->load->view('secciones/view_seccion', $data);
    }

    function getSecciones() {
        session_start();
        $fid = $this->input->post('chk');
        $id = $this->input->post('programa');
        $json->listas = $data['seccion'] = $this->seccion_model->index($fid, $id);
        echo json_encode($json);
    }

    function listar() {
        session_start();
        $radio  = $this->input->post('radio');
        $cbo    = $this->input->post('cbo');
        $prg    = $this->input->post('prg');
        $check  = $this->input->post('check');
        $f1     = $this->input->post('f1');
        $f2     = $this->input->post('f2');
        
        $lista = $this->seccion_model->listar(
                    $radio,
                    $prg,
                    $cbo,
                    $check,
                    $f1,
                    $f2
                );
        echo json_encode($lista);
    }
}