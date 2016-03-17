<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Curso_controller extends CI_Controller {

    public function __construct() {
        error_reporting(0);
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('curso_model');
    }

    function index() {
        session_start();
        $data['category'] = $this->curso_model->get_category();
        $this->load->view('curso/view_curso', $data);
    }

    function getPeriodos() {
        $category = $this->input->post('chk');
        $json->listas = $this->curso_model->getPeriodos($category);
        echo json_encode($json);
    }
    
    function getCursos($curso_id) {
        session_start();
        $curso_id = $this->input->post('category');
        $json->listas = $this->curso_model->index($curso_id);
        echo json_encode($json);
    }

    function listar() {
        session_start();
        $categoria = $this->input->post('categoria');
        $check = $this->input->post('check');
        $curso = $this->input->post('curso');
        $ciudad = $this->input->post('ciudad');
        $fdesde = $this->input->post('f1');
        $fhasta = $this->input->post('f2');

        $lista = $this->curso_model->listar(
                $categoria, $check, $curso, $ciudad, $fdesde, $fhasta
        );
        echo json_encode($lista);
    }

}
