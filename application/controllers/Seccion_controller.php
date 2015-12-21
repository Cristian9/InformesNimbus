<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Seccion_controller extends CI_Controller {

    public function __construct() {
        error_reporting(0);
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('seccion_model');
    }

    function index() {
        session_start();
        $data['category'] = $this->seccion_model->get_category();
        $this->load->view('secciones/view_seccion', $data);
    }

    function getPeriodos() {
        $category = $this->input->post('chk');
        $json->listas = $this->seccion_model->getPeriodos($category);
        echo json_encode($json);
    }

    function getWeeks() {
        $periodo = $this->input->get('periodo');
        $category = $this->input->get('category');
        $json->listas = $this->seccion_model->getWeeks($periodo, $category);
        echo json_encode($json);
    }

    function getSecciones() {
        session_start();
        $fid = $this->input->post('chk');
        $idprogram = $this->input->post('programa');
        $json->listas = $this->seccion_model->index($fid, $idprogram);
        echo json_encode($json);
    }

    function listar() {
        session_start();
        $radio = $this->input->post('radio');
        $cbo = $this->input->post('cbo');
        $prg = $this->input->post('prg');
        $check = $this->input->post('check');
        $fdesde = $this->input->post('f1');
        $fhasta = $this->input->post('f2');

        $lista = $this->seccion_model->listar(
                $radio, $prg, $cbo, $check, $fdesde, $fhasta
        );
        echo json_encode($lista);
    }

}
