<?php
class users extends CI_Controller {

  // this function will checks whether user is valid or not and will be redirected accordingly.
	public function login(){

				$data['login_email'] = '';
		    $data['register_email'] = '';
	    	$data['register_fname'] = '';
		    $data['register_lname'] = '';
				$this -> form_validation -> set_rules('login_email','E-Mail ID','required');
			  $this -> form_validation -> set_rules('login_password','Password','required');
	   if($this -> form_validation -> run() === FALSE){
			  $data['login_status'] = 'failed';
			  $data['title'] = "Login";


		    //loading views
 	 	  	$this -> load -> view('login_Templates/header',$data);
 	 	  	$this -> load -> view('login_pages/Login', $data);
	   }else{
			  $data['login_status'] = 'failed';
			  $data['title'] = "Login";
			  $num = 0;

			  $email = filter_var($this -> input -> post('login_email'),FILTER_VALIDATE_EMAIL);
			  $password = htmlspecialchars(stripslashes(trim($this -> input -> post('login_password'))));
	      $this -> user_model -> setEmail($email);
				$this -> user_model -> setPassword($password);
			  if(strlen($email) != 0 && strlen($password) != 0){
					if(!$this -> user_model -> exitIfLocked()){
				    $num = $this -> user_model -> check_user_exists();
	        }else{
						$num = 2;
					}
					if($num == 1){
						$data['login_status'] = 'passed';
						$has_session = session_status() == PHP_SESSION_ACTIVE;
						if($has_session == 1){
							session_start();
							$this -> session -> set_userdata('is_logged_in',TRUE);
							$_SESSION['ID'] = $email;
							redirect('templates');
						}
					 }else{
						 if($num == 2){
							 $data['login_status'] = 'locked';
							 $data['title'] = "Login";
						 }
						 if($num == 0){
							 $data['login_status'] = 'passed';
 							 $has_session = session_status() == PHP_SESSION_ACTIVE;
 							if($has_session == 1){
 								session_start();
 								$this -> session -> set_userdata('is_logged_in',TRUE);
 								$_SESSION['ID'] = $email;
 								redirect('admin');
 							}
						}else{
							$data['login_email'] = $this -> input -> post('login_email');
							$this -> session -> set_userdata('is_logged_in',FALSE);
 						  $this -> load -> view('login_Templates/header',$data);
 		  	 	    $this -> load -> view('login_pages/Login', $data);
						}
					 }
			 }
	   }
  }


  // this function will get the values from the register form and create the user in the database.
	public function register_user(){
		   $this -> form_validation -> set_rules('register_fname','First Name','required');
		   $this -> form_validation -> set_rules('register_lname','last Name','required');
		   $this -> form_validation -> set_rules('register_email','Mail ID','required');
		   $this -> form_validation -> set_rules('register_password','Password','required');
		   $this -> form_validation -> set_rules('register_cpassword','Confirm Password','required');
			 $data['login_status'] = '';
		   $data['title'] = "Registration";
		 if($this -> form_validation -> run() === FALSE){
			  $data['register_email'] = $this -> input -> post('register_email');
			  $data['register_fname'] = $this -> input -> post('register_fname');
			  $data['register_lname'] = $this -> input -> post('register_lname');
			  $this -> load -> view('login_Templates/header',$data);
	 	  	$this -> load -> view('login_pages/Login', $data);
			}else{
				$email = filter_var($this -> input -> post("register_email"),FILTER_VALIDATE_EMAIL);
				$first_name = filter_var($this -> input -> post("register_fname"), FILTER_SANITIZE_STRING);
				$last_name = filter_var($this -> input -> post("register_lname"), FILTER_SANITIZE_STRING);
				$password = htmlspecialchars(stripslashes(trim($this -> input -> post("register_password"))));
				$confirm_password = htmlspecialchars(stripslashes(trim($this -> input -> post("register_cpassword"))));
				$request = $_SERVER['REQUEST_URI'];
				if($password == $confirm_password and $email != ''){
					$this -> user_model -> setEmail($email);
					$this -> user_model -> setURI($request);
				  $result = $this -> user_model -> check_user_exists();
					// SAI CHAND - If user doesn't exists in the database, will create a new user
				  if($result == -1){
						$this -> user_model -> setEmail($email);
						$this -> user_model -> setFirstName($first_name);
						$this -> user_model -> setLastName($last_name);
						$this -> user_model -> setPassword($password);
						$this -> user_model -> register();
						session_start();
						$this -> session -> set_userdata('is_logged_in',TRUE);
						$has_session = session_status() == PHP_SESSION_ACTIVE;
						if($has_session){
							$data['login_status'] = 'passed';
							$_SESSION['ID'] = $email;
						}
						redirect('templates');
				  }else{
						$data['login_status'] = 'register failed';
					}
				}else{
				  	$data['login_status'] = 'register failed';
				}
			}
			if($data['login_status'] == 'register failed'){
				$data['register_email'] = $this -> input -> post('register_email');
				$data['register_fname'] = $this -> input -> post('register_fname');
				$data['register_lname'] = $this -> input -> post('register_lname');
				$data['login_email'] = $this -> input -> post('login_email');
				$this -> load -> view('login_Templates/header',$data);
				$this -> load -> view('login_pages/Login', $data);
			}
	}

  // this function check whether the user is logged in or not.
	public function checkLoggedInUser(){
		$email = $_SESSION['ID'];
		$this -> user_model -> setEmail($email);
		$result = $this -> user_model -> getLoggedInUserDetails();
	}

  // this function will logs the user out.
	public function logout(){
		session_unset();
		session_destroy();
		$has_session = session_status() == PHP_SESSION_ACTIVE;
		if(!$has_session){
			redirect('login');
		}
	}
}
?>
