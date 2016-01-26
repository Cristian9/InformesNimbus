<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Config extends CI_Config {

    public function __construct() {
        $this->config = & get_config();
        // Set the base_url automatically if none was provided
        if (empty($this->config['base_url'])) {
            // The regular expression is only a basic validation for a valid "Host" header.
            // It's not exhaustive, only checks for valid characters.
            if (isset($_SERVER['HTTP_HOST']) && preg_match('/^((\[[0-9a-f:]+\])|(\d{1,3}(\.\d{1,3}){3})|[a-z0-9\-\.]+)(:\d+)?$/i', $_SERVER['HTTP_HOST'])) {
                //Check if the SERVER_HOST is a trusted host to avoid HTTP Host header attacks 
                //TODO: improve this by checking the ENVIRONMENT variable and ignore trusted_hosts when is testing or development
                $trusted = false;
                if (!empty($this->config['trusted_hosts'])) {
                    foreach ($this->config['trusted_hosts'] as $trusted_host) {
                        $parsed_url = parse_url(trim($trusted_host));
                        $path_explode = explode('/', $parsed_url['path'], 2);
                        $real_trusted_host = trim(isset($parsed_url['host']) ? $parsed_url['host'] : array_shift($path_explode));
                        if ($trusted = preg_match("/^((.*?)\.)?" . $real_trusted_host . "$/i", $_SERVER['HTTP_HOST'])) {
                            break;
                        }
                    }
                } else {
                    $trusted = true;
                }

                if ($trusted) {
                    $base_url = (is_https() ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']
                            . substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'], basename($_SERVER['SCRIPT_FILENAME'])));
                } else {
                    $_SERVER['HTTP_HOST'] = "localhost";
                    $base_url = 'http://localhost/';
                }
            } else {
                $base_url = 'http://localhost/';
            }
            $this->set_item('base_url', $base_url);
        }
        log_message('info', 'Config Class Initialized');
    }

}
