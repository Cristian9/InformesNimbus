<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Facu_controller extends CI_Controller {

    public function __construct() {
        error_reporting(0);
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('facu_model');
    }

    function index() {
        session_start();
        $data['category'] = $this->facu_model->get_category();
        $this->load->view('facultad/view_facultad', $data);
    }

    function getPeriodos() {
        $category = $this->input->post('chk');
        $json->listas = $this->facu_model->getPeriodos($category);
        echo json_encode($json);
    }

    function getFacultad() {
        session_start();
        $fid = $this->input->post('chk');
        $json->listas = $this->facu_model->index($fid);
        echo json_encode($json);
    }

    function listar() {
        session_start();
        $radio = $this->input->post('radio');
        $cbo = $this->input->post('cbo');
        $check = $this->input->post('check');
        $fdesde = $this->input->post('f1');
        $fhasta = $this->input->post('f2');
        $prg = $this->input->post('prg');

        $lista = $this->facu_model->listar(
                $radio, $prg, $cbo, $check, $fdesde, $fhasta
        );

        echo json_encode($lista);
    }

    function graficar() {
        session_start();
        $ciudad = $this->input->post('ciudad');
        $herramienta = $this->input->post('herramienta');
        $programa = $this->input->post('programa');
        $facultad = $this->input->post('facultad');
        $desde = $this->input->post('desde');
        $hasta = $this->input->post('hasta');

        $datos = $this->facu_model->data_graficar(
                $ciudad, $herramienta, $programa, $facultad, $desde, $hasta
        );
        $graficar = array();
        foreach ($datos as $key => $value) {
            if ($key == 'Totales')
                continue;

            foreach ($value as $v) {
                foreach ($v as $indice => $valor) {
                    $graficar[$key][$indice] = round(($valor / $datos['Totales'][0][$indice]) * 100);
                }
            }
        }
        echo json_encode(array($graficar, $datos));
    }

}
