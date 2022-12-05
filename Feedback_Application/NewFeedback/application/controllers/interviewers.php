<?php
  class interviewers extends CI_Controller{

    public function __construct(){
      parent::__construct();
      if(!$this -> session -> userdata('is_logged_in')){
        redirect('login');
      }else {
        $this -> user_model -> setEmail($_SESSION['ID']);
        $user_details = $this -> user_model -> getLoggedInUserDetails();
        $this -> user_model -> setUserID($user_details -> user_id);
        if($this -> user_model -> CheckUserIsAdmin() == 0){
          redirect('templates');
        }
      }
    }

    // this function will redirects the user to the create interviewer page.
    public function index(){
	   $data['title'] = 'Create Interviewer';
     $this -> user_model -> setEmail($_SESSION['ID']);
     $user_details = $this -> user_model -> getLoggedInUserDetails();
     $this -> user_model -> setUserID($user_details -> user_id);
     $data['is_creator'] = $this -> user_model -> getUserID();
     $data['is_admin'] = $this -> user_model -> CheckUserIsAdmin();
     $data['is_reviewer'] = $this -> user_model -> CheckUserIsReviewer();
	   //loading views
	   $this -> load -> view('user_Templates/header',$data);
	   $this -> load -> view('interviewers/create', $data);
	   $this -> load -> view('user_Templates/footer');
    }

    // this function will create a new interviewer in the database.
	  public function create(){
      $this -> user_model -> setEmail($_SESSION['ID']);
      $user_details = $this -> user_model -> getLoggedInUserDetails();
      $this -> user_model -> setUserID($user_details -> user_id);
      $this -> interviewer_model -> setInterviewerName($this -> input -> post('interviewer_name'));
      $this -> interviewer_model -> setInterviewerMailID($this -> input -> post('interviewer_mail_id'));
		  $this->interviewer_model-> create_interviewer();
		  redirect('templates');
  	}

  // this function will redirects the user to the edit interviewer page.
	public function edit(){
    $template_url = basename(parse_url($_SERVER['REQUEST_URI'])['path']);
    if($this -> input -> post('interviewer_selected') == NULL){
       $_SESSION['interviewer_selected'] = $template_url;
    }else{
       $_SESSION['interviewer_selected'] = $this -> input -> post('interviewer_selected');
    }
    $this -> user_model ->setEmail($_SESSION['ID']);
    $user_details = $this -> user_model -> getLoggedInUserDetails();
    $this -> user_model -> setUserID($user_details -> user_id);
    $this -> interviewer_model -> setInterviewerID($_SESSION['interviewer_selected']);
  	$data['title'] = 'Edit Interviewer';
    $data['is_creator'] = $this -> user_model -> getUserID();
    $data['is_admin'] = $this -> user_model -> CheckUserIsAdmin();
    $data['is_reviewer'] = $this -> user_model -> CheckUserIsReviewer();
    $data['interviewer_details'] = $this -> interviewer_model -> get_interviewer_details();
    if($data['interviewer_details'] == ''){
       $data['interviewer_details'] = new stdClass;
       $data['interviewer_details'] -> interviewer_id = '';
       $data['interviewer_details'] -> interviewer_name ='';
       $data['interviewer_details'] -> interviewer_mail_id = '';
       $data['interviewer_details'] -> user_id = '';
    }
		$this -> load -> view('user_Templates/header',$data);
	  $this -> load -> view('interviewers/edit', $data);
	  $this -> load -> view('user_Templates/footer');
	}

    // this function will update the existing interviewer details with the new details provided by logged in user.
	  public function update(){
        $this -> user_model -> setEmail($_SESSION['ID']);
        $user_details = $this -> user_model -> getLoggedInUserDetails();
        $this -> user_model -> setUserID($user_details -> user_id);
        $this -> interviewer_model -> setInterviewerID($_SESSION['interviewer_selected']);
        $this -> interviewer_model -> setInterviewerName($this -> input -> post('interviewer_name'));
        $this -> interviewer_model -> setInterviewerMailID($this->input->post('interviewer_mail_id'));
	  	  $this -> interviewer_model -> update_interviewer();
	  	  redirect('templates');
	 }

  }

  ?>
