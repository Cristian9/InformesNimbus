<?php

defined('BASEPATH') OR exit('No direct script access allowed');
ini_set( 'session.use_only_cookies', TRUE );                
ini_set( 'session.use_trans_sid', FALSE );

class Main_controller extends CI_Controller {

    public function __construct() {
        error_reporting(0);
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('main_model');
        require_once APPPATH . 'libraries/securesession.class.php';
    }

    function index() {
        redirect('login');
    }

    function habilitar(){
        $type = $this->input->post('type');
        $action = $this->input->post('action');
        $ids = $this->input->post('ids');
        if(!empty($ids)) {
            $update = $this->main_model->habilitar($type, $action, $ids);

            echo $update;
        }
    }

    function edit(){
        $params['idcategory']   = $this->input->post('idcategory');
        $params['programaid']   = $this->input->post('programaid');
        $params['fechainicio']  = $this->input->post('fechainicio');
        $params['fechafin']     = $this->input->post('fechafin');

        $this->load->view('main/edit_date_category', $params);
    }

    function addfechainicio(){
        $programa   = $this->input->post('programa');
        $idprograma = $this->input->post('idprograma');
        $periodo    = $this->input->post('periodo');
        $fec_inicio = $this->input->post('fec_inicio');
        $fec_final  = $this->input->post('fec_final');

        $add = $this->main_model->addfechainicio($programa, $idprograma, $periodo, $fec_inicio, $fec_final);

        echo $add;
    }

    function updfechas(){
        $start_date = $this->input->post('start_edit');
        $end_date = $this->input->post('end_edit');
        $idcategory = base64_decode($this->input->post('idcategory'));

        $upd = $this->main_model->updfechas($idcategory, $start_date, $end_date);

        echo $upd;
    }

    function areas_facultades(){
        $this->load->view('main/enable_disable');
    }

    function start_date(){
        $data['periodcate'] = $this->main_model->getPeriodCategory();
        $data['programs'] = $this->main_model->getPrograms();
        $data['periodos'] = $this->main_model->getPeriodos();
        $this->load->view('main/start_date', $data);
    }

    function getFacultades(){
        $enable = null;
        if ($this->input->post('chk') !== null) {
            $enable = $this->input->post('chk');
        }

        $json->listas = $this->main_model->getFacultades($enable);
        echo json_encode($json);
    }

    function getWeeks() {
        $periodo    = $this->input->get('periodo');
        $category   = $this->input->get('category');
        $json->listas = $this->main_model->getWeeks($periodo, $category);
        echo json_encode($json);
    }

    function auth() {
        session_start();
        $user = $this->input->post('usuario');
        $pass = $this->input->post('password');
        $capt = $this->input->post('captcha');
        $key = $_SESSION['key'];

        if (strtoupper($capt) == $key) {

            //$wsUrl = 'http://10.31.1.223:8051/ServiceAD.asmx?WSDL';
            //$isValid = $this->loginWSAuthenticate($user, $pass, $wsUrl);
            $isValid = 1;
            if ($isValid === 1) {
                $_SESSION['usuario'] = $user;
                $auth_check = $this->main_model->check_user($_SESSION['usuario']);
                if (!empty($auth_check)) {

                    $ss = new SecureSession();
                    $ss->check_browser = true;
                    $ss->check_ip_blocks = 3;
                    $ss->regenerate_id = true;
                    $ss->Open();
                    $_SESSION['logedinnimbus'] = true;
                    $this->main_model->add_audit('in');
                    redirect('main-menu');

                } else {
                    redirect('login?errorAuth=2');
                }
            } else {
                redirect('login?errorAuth=1');
            }
        } else {
            redirect('login?errorAuth=3');
        }
    }

    function login() {
        $this->load->view('login');
    }

    function menu_principal() {
        session_start();
        $ss = new SecureSession();
        $ss->check_browser = true;
        $ss->check_ip_blocks = 3;
        $ss->regenerate_id = true;
        
        if (!$ss->Check() || !isset($_SESSION['logedinnimbus']) || !$_SESSION['logedinnimbus']) {
            $this->login();
        } else {
            if (isset($_SESSION['usuario']) && $_SESSION['usuario'] != "") {
                $datos_menu = $this->main_model->get_menu($_SESSION['usuario']);
                $datos_perfil = $this->main_model->get_profile($_SESSION['usuario']);
                $city_profile = $this->main_model->get_city_assignment($_SESSION['usuario']);
                $category_profile = $this->main_model->get_category_assignment($_SESSION['usuario']);

                $aux = ['area_id', 'faculty_id', 'program_id', 'course_id'];

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
                
                $this->load->view('principal', $datos_menu);
            } else {
                $this->login();
            }
        }
    }

    function add_period() {
        $id = $this->input->post('id');
        $desc = $this->input->post('desc');

        $exists = $this->main_model->existsPeriod($id);

        if($exists){
            $record = false;
        }else{
            $record = $this->main_model->add_period($id, $desc);
        }
        
        echo $record;
    }

    function logout() {
        session_start();
        session_destroy();
        if (isset($_SESSION['usuario'])) {
            $this->main_model->add_audit('out');
        }
        $this->login();
    }

    /**
     * Checks whether a user has the right to enter on the platform or not
     * @param string The username, as provided in form
     * @param string The cleartext password, as provided in form
     * @param string The WS URL, as provided at the beginning of this script
     */
    function loginWSAuthenticate($username, $password, $wsUrl) {
        // check params
        if (empty($username) or empty($password) or empty($wsUrl)) {
            return false;
        }
        // Create new SOAP client instance
        $client = new SoapClient($wsUrl, array('trace' => true, 'exceptions' => true));
        if (!$client) {
            error_log('Could not instanciate SOAP client with URL ' . $wsUrl);
            return false;
        }
        // Include phpseclib methods, because of a bug with AES/CFB in mcrypt
        include_once substr(dirname(__FILE__), 0, -24) . '/static/Classes/phpseclib/Crypt/AES.php';
        error_log("dsdsd");
        // Define all elements necessary to the encryption
        $key = '-+*%$({[]})$%*+-';
        // Complete password con PKCS7-specific padding
        $blockSize = 16;
        $padding = $blockSize - (strlen($password) % $blockSize);
        $password .= str_repeat(chr($padding), $padding);
        $cipher = new Crypt_AES(CRYPT_AES_MODE_CFB);
        $cipher->setKeyLength(128);
        $cipher->setKey($key);
        $cipher->setIV($key);

        $cipheredPass = $cipher->encrypt($password);
        // Mcrypt call left for documentation purposes - broken, see https://bugs.php.net/bug.php?id=51146
        //$cipheredPass = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $password,  MCRYPT_MODE_CFB, $key);
        // Following lines present for debug purposes only
        /*
          $arr = preg_split('//', $cipheredPass, -1, PREG_SPLIT_NO_EMPTY);
          foreach ($arr as $char) {
          error_log(ord($char));
          }
         */
        // Change to base64 to avoid communication alteration
        $passCrypted = base64_encode($cipheredPass);
        //error_log($passCrypted);
        // The call to the webservice will change depending on your definition
        try {
            $response = $client->validaUsuarioAD(array('usuario' => $username, 'contrasenia' => $passCrypted, 'sistema' => 'informesnimbus'));
        } catch (SoapFault $fault) {
            error_log('Caught something');
            if ($fault->faultstring != 'Could not connect to host') {
                error_log('Not a connection problem');
                throw $fault;
            } else {
                error_log('Could not connect to WS host');
            }
            return 0;
        }
        //error_log(print_r($response,1));
        return $response->validaUsuarioADResult;
    }

}
