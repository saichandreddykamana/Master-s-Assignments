<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['templates'] = 'templates/index';
$route['admin'] = 'admin/index';
$route['feedbacks'] = 'feedbacks/index';
$route['positions'] = 'positions/index';
$route['interviewers'] = 'interviewers/index';
$route['templates/create'] = 'templates/create';
$route['templates/edit/(:any)'] = 'templates/edit';
$route['feedbacks/create'] = 'feedbacks/create';
$route['feedbacks/edit/(:any)'] = 'feedbacks/edit';
$route['positions/edit/(:any)'] = 'positions/edit';
$route['interviewers/create'] = 'interviewers/create';
$route['interviewers/edit/(:any)'] = 'interviewers/edit';
$route['default_controller'] = 'homepage/index';
$route['(:any)'] ='homepage/$1';
$route['404_override'] = 'templates/index';
$route['translate_uri_dashes'] = FALSE;
$has_session = session_status() == PHP_SESSION_ACTIVE;
if($has_session == 0){
  $route['Login'] = 'templates/index';
}
