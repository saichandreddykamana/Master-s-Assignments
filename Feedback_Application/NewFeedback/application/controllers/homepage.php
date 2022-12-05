<?php

class homepage extends CI_Controller{
  	public function __construct(){
    parent::__construct();
    if($this -> session -> userdata('is_logged_in')){
      redirect('templates');
    }
  }

  // this function will load the homepage when the application is opened.
  public function index(){
    $data['title'] = 'Home';
    $this -> load -> view('login_templates/header',$data);
    $this -> load -> view('login_pages/homepage', $data);

  }

  // this function will load the login page when the admin clicks on login / register button.
  public function Login(){
    $data['title'] = 'Login';
    $data['login_status'] = '';
    $data['login_email'] ='';
    $data['register_email'] = '';
    $data['register_fname'] = '';
    $data['register_lname'] = '';
    $this -> load -> view('login_templates/header',$data);
    $this -> load -> view('login_pages/login', $data);
  }
}

?>
