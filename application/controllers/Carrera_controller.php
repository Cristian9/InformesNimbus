<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Carrera_controller extends CI_Controller {

    public function __construct() {
        error_reporting(0);
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('carrera_model');
    }

    function index() {
        session_start();
        $data['category'] = $this->carrera_model->get_category();
        $this->load->view('carrera/view_carrera', $data);
    }

    function getPeriodos() {
        $category = $this->input->post('chk');
        $json->listas = $this->carrera_model->getPeriodos($category);
        echo json_encode($json);
    }

    function getWeeks() {
        $periodo = $this->input->get('periodo');
        $category = $this->input->get('category');
        $json->listas = $this->carrera_model->getWeeks($periodo, $category);
        echo json_encode($json);
    }

    function getFacultades() {
        session_start();
        $fid = $this->input->post('chk');
        $json->listas = $this->carrera_model->index($fid);
        echo json_encode($json);
    }

    function getEscuela() {
        session_start();
        $idchk = $this->input->post('chk');
        $facultad = $this->input->post('facultades');
        $programa = $this->input->post('prg');

        $json->listas = $this->carrera_model->getEscuelas($idchk, $facultad, $programa);
        echo json_encode($json);
    }

    function listar() {
        session_start();
        $ciudad = $this->input->post('ciudad');
        $carrera = $this->input->post('carrera');
        $facultad = $this->input->post('facultad');
        $prg = $this->input->post('prg');
        $herram = $this->input->post('herram');
        $fdesde = $this->input->post('f1');
        $fhasta = $this->input->post('f2');

        $lista = $this->carrera_model->listar(
                $ciudad, $prg, $carrera, $facultad, $herram, $fdesde, $fhasta
        );
        echo json_encode($lista);
    }

    function graficar() {
        session_start();
        $ciudad = $this->input->post('ciudad');
        $herram = $this->input->post('herram');
        $progra = $this->input->post('progra');
        $carrer = $this->input->post('carrer');
        $facult = $this->input->post('facult');
        $fdesde = $this->input->post('fdesde');
        $fhasta = $this->input->post('fhasta');

        $dato = $this->carrera_model->graficar(
                $ciudad, $herram, $progra, $carrer, $facult, $fdesde, $fhasta
        );

        foreach ($dato as $key => $value) {
            if ($key == 'Totales')
                continue;

            foreach ($value as $v) {
                foreach ($v as $indice => $valor) {
                    $graficar[$key][$indice] = round(($valor / $dato['Totales'][0][$indice]) * 100);
                }
            }
        }
        echo json_encode(array($graficar, $dato));
    }

}
