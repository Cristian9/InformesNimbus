<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Area_controller extends CI_Controller {

    public function __construct() {
        error_reporting(0);
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('area_model');
    }

    function index() {
        session_start();
        $data['category'] = $this->area_model->get_category();
        $this->load->view('areas/view_areas', $data);
    }

    function getPeriodos() {
        $category = $this->input->post('chk');
        $json->listas = $this->area_model->getPeriodos($category);
        echo json_encode($json);
    }

    function getAreas() {
        session_start();
        $enable = null;
        
        if($this->input->post('chk') !== null) {
            $enable = $this->input->post('chk');
        }

        $json->listas = $this->area_model->index($enable);
        echo json_encode($json);
    }

    function listar() {
        session_start();
        $ciudad         = $this->input->post('ciudad');
        $herramienta    = $this->input->post('herramienta');
        $prg            = $this->input->post('prg');
        $areas          = $this->input->post('areas');
        $fdesde         = $this->input->post('f1');
        $fhasta         = $this->input->post('f2');

        $lista = $this->area_model->listar(
                $ciudad, $areas, $herramienta, $prg, $fdesde, $fhasta
        );
        echo json_encode($lista);
    }

    function graficar() {
        session_start();
        $ciudad         = $this->input->post('ciudad');
        $programa       = $this->input->post('programa');
        $area           = $this->input->post('area');
        $desde          = $this->input->post('desde');
        $hasta          = $this->input->post('hasta');
        $herramienta    = $this->input->post('herramientas');

        $datos = $this->area_model->data_graficar(
                $ciudad, $programa, $area, $desde, $hasta, $herramienta
        );
        /* print_r($datos);
          exit; */
        $graficar = array();
        foreach ($datos as $k => $v) {
            if ($k == 'Totales')
                continue;
            foreach ($v as $val) {
                foreach ($val as $key => $value) {
                    $graficar[$k][$key] = round(($value / $datos['Totales'][0][$key]) * 100);
                }
            }
        }
        echo json_encode(array($graficar, $datos));
    }

}

?>