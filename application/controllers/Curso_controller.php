<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Curso_controller extends CI_Controller{
    
    public function __construct() {
        error_reporting(0);
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('curso_model');
    }

    function index() {
        session_start();
        $data['periodo'] = $this->curso_model->getPeriodo();
        $this->load->view('curso/view_curso', $data);
    }

    function getCursos($curso_id) {
        session_start();
        $curso_id = $this->input->post('category');
        $json->listas = $data['curso'] = $this->curso_model->index( $curso_id );
        echo json_encode($json);
    }

    function listar() {
        session_start();
        $categoria  = $this->input->post('categoria');
        $check      = $this->input->post('check');
        $curso      = $this->input->post('curso');
        $f1         = $this->input->post('f1');
        $f2         = $this->input->post('f2');
        
        $lista = $this->curso_model->listar(
                    $categoria,
                    $check,
                    $curso,
                    $f1,
                    $f2
                );
        echo json_encode($lista);
    }
}