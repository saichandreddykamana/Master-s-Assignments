<?php
  class positions extends CI_Controller{

    public function __construct(){
      parent::__construct();
      if(!$this -> session -> userdata('is_logged_in')){
        redirect('login');
      }
    }

    // this function redirects the user to the create new position page.
    public function index(){

	   $data['title'] = 'Create Position';
	   //loading views
     $this -> user_model -> setEmail($_SESSION['ID']);
     $user_details = $this -> user_model -> getLoggedInUserDetails();
     $this -> user_model -> setUserID($user_details -> user_id);
     $data['is_admin'] = $this -> user_model -> CheckUserIsAdmin();
     $data['is_reviewer'] = $this -> user_model -> CheckUserIsReviewer();
     $data['is_creator'] = $this -> user_model -> CheckRecordCreator();
     if($this -> user_model -> CheckUserIsAdmin() == 1){
	      $this -> load -> view('user_Templates/header',$data);
	      $this -> load -> view('positions/create', $data);
	     $this -> load -> view('user_Templates/footer');
     }else{
       redirect('templates');
     }
    }

    // this function gets the values and create new position in the database.
	  public function create(){
       $this -> user_model -> setEmail($_SESSION['ID']);
       $user_details = $this -> user_model -> getLoggedInUserDetails();
       $this -> user_model -> setUserID($user_details -> user_id);
       $this -> position_model -> setPositionName($this -> input -> post('position_name'));
       $this -> position_model -> setCompanyName($user_details -> company);
       $this -> position_model -> setPositionNumber($this -> input -> post('number_of_positions'));
       $this -> position_model -> setPositionDescription($this -> input -> post('editor1'));
	 	   $this -> position_model -> create_position();
		   redirect('templates');
	  }

    // this function will redirects the users to the edit position page.
	  public function edit(){
      $template_url = basename(parse_url($_SERVER['REQUEST_URI'])['path']);
      if($this -> input -> post('position_selected') == NULL){
         $_SESSION['position_selected'] = $template_url;
      }else{
         $_SESSION['position_selected'] = $this -> input -> post('position_selected');
      }
      $this -> user_model -> setEmail($_SESSION['ID']);
      $user_details = $this -> user_model -> getLoggedInUserDetails();
      $this -> user_model -> setUserID($user_details -> user_id);
      
      $this -> position_model -> setPositionID($_SESSION['position_selected']);
      $data['is_admin'] = $this -> user_model -> CheckUserIsAdmin();
      $data['is_reviewer'] = $this -> user_model -> CheckUserIsReviewer();
      $data['is_creator'] = $this -> user_model -> CheckRecordCreator();
		  $data['title'] = 'Edit Position';
      $data['position'] = $this -> position_model -> get_position_details();
      if($data['position'] == ''){
         $data['position'] = new stdClass;
         $data['position'] -> position_id = '';
         $data['position'] -> position_name ='';
         $data['position'] -> number_of_positions = '';
         $data['position'] -> user_id = '';
         $data['position'] -> company_name = '';
         $data['position'] -> position_description = '';
      }
		  $this -> load -> view('user_Templates/header',$data);
	    $this -> load -> view('positions/edit', $data);
	    $this -> load -> view('user_Templates/footer');
	  }

    // this function update the existing position with the new values provided by the logged in user.
  	public function update(){
      $this -> user_model -> setEmail($_SESSION['ID']);
      $user_details = $this -> user_model -> getLoggedInUserDetails();
      $this -> user_model -> setUserID($user_details -> user_id);
	  	$position_obj = $this -> position_model -> get_position_details();
      $this -> position_model -> setPositionID($_SESSION['position_selected']);
      $this -> position_model -> setPositionName($this -> input -> post('position_name'));
      $this -> position_model -> setCompanyName($user_details -> company);
      $this -> position_model -> setPositionNumber($this -> input -> post('number_of_positions'));
      $this -> position_model -> setPositionDescription($this -> input -> post('editor1'));
		  $this -> position_model -> update_position();
	  	redirect('templates');
	  }
  }

  ?>
