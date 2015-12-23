<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#Controlador por defecto
$route['default_controller']    = 	'main_controller';

#Login
$route['login']                 = 	"main_controller/login";
$route['out']                   = 	"main_controller/logout";
$route['auth']                  = 	"main_controller/auth";
$route['main-menu']             = 	"main_controller/menu_principal";
$route['excel']                 = 	"main_controller/excel";
$route['addcal']                =   "main_controller/add_period";

#Users
$route['users']                 = 	"user_controller/index";
$route['asignar']               = 	"user_controller/asignar";
$route['users-(:any)']          = 	"user_controller/$1";

#Area
$route['area']                  = 	"area_controller/index";
$route['area-(:any)']           = 	"area_controller/$1";

#Facultad
$route['facultad']              = 	"facu_controller/index";
$route['facultad-(:any)']       = 	"facu_controller/$1";

#Carrera
$route['carrera']               = 	"carrera_controller/index";
$route['carrera-(:any)']        = 	"carrera_controller/$1";

#Cursos
$route['curso']                 = 	"curso_controller/index";
$route['curso-(:any)']          = 	"curso_controller/$1";

#Secciones
$route['secciones']             = 	"seccion_controller/index";
$route['secciones-(:any)']      = 	"seccion_controller/$1";

$route['404_override']          = 	'';
$route['translate_uri_dashes']  = 	FALSE;
