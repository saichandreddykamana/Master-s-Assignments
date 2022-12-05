<?php
  class templates extends CI_Controller{
   public $user_details;

    public function __construct(){
      parent::__construct();
      if(!$this -> session -> userdata('is_logged_in')){
        redirect('login');
      }
    }

    // this function will get all the values of feedbacks, positions, interviewers and templated created by the logged in user and shows the data in the dashboard page.
    public function index(){

      //set user
      $this -> user_model -> setEmail($_SESSION['ID']);
      $user_details = $this -> user_model -> getLoggedInUserDetails();
      $this -> user_model -> setUserID($user_details -> user_id);

      // get user templates
		  $data['templates'] = $this -> template_model -> get_templates();
      $this -> user_model -> setCompany($user_details -> company);
      $data['user_name'] = $_SESSION['ID'];
      $data['is_admin'] = $this -> user_model -> CheckUserIsAdmin();
      $data['is_reviewer'] = $this -> user_model -> CheckUserIsReviewer();
      $data['is_creator'] = $this -> user_model -> CheckRecordCreator();

      // get candidates based on the user company
      $data['candidates'] = $this -> candidate_model -> getCandidates();

      // get positions and interviewers created by the user.
      $data['positions'] = $this -> position_model -> get_positions();
      $data['interviewers'] = $this -> interviewer_model -> get_interviewers();

		  //loading views
      $data['title'] = 'Dashboard';
      $this -> load -> view('user_Templates/header',$data);
      $this -> load -> view('templates/index', $data);
      $this -> load -> view('user_Templates/footer');
    }


    // this function will create new template using the values given by the logged in user.
    public function create(){
	    $data['title'] = 'Create Template';
      $this -> user_model -> setEmail($_SESSION['ID']);
      $user_details = $this -> user_model -> getLoggedInUserDetails();
      $this -> user_model -> setUserID($user_details -> user_id);

	    $this -> form_validation -> set_rules('template_name','Name Of the Template','required');
	   if($this -> form_validation -> run() === FALSE){
      $data['is_admin'] = $this -> user_model -> CheckUserIsAdmin();
      $data['is_reviewer'] = $this -> user_model -> CheckUserIsReviewer();
      $data['is_creator'] = $this -> user_model -> CheckRecordCreator();
      $data['positions'] = $this -> position_model -> get_positions();
		  $data['interviewers'] = $this -> interviewer_model -> get_interviewers();
		  //loading views
	     $this -> load -> view('user_Templates/header',$data);
	     $this -> load -> view('templates/create', $data);
	     $this -> load -> view('user_Templates/footer');
	   }else{
      $position_sel_arr = explode("--:--",$this -> input -> post('position_selected')) ;
      $this -> template_model -> setTemplateName($this -> input -> post('template_name'));
      $this -> candidate_model -> setCandidateMail($this -> input -> post('candidate_mail'));
      //$this -> user_model -> setEmail($this -> input -> post('candidate_mail'));
      if($this -> input -> post('feedback_sections') != ''){
        $this -> template_model -> setFeedbackSections($this -> input -> post('feedback_sections'));
      }else{
          $this -> template_model -> setFeedbackSections('[]');
      }
      $this -> template_model -> setPositionID($position_sel_arr[0]);
      $this -> template_model -> setInterviewerID($this -> input -> post('interviewer_selected'));
		  $this -> template_model -> create_template();
		  redirect('templates');
	   }
    }

   public function pageNotFound(){
     $this -> load -> view('user_Templates/PageNotFound');
   }

   // this function will get the values of the template selected and redirects user to the edit template page.
	 public function edit(){
     try{
        $template_url = basename(parse_url($_SERVER['REQUEST_URI'])['path']);
        $this -> user_model -> setEmail($_SESSION['ID']);
        $user_details = $this -> user_model -> getLoggedInUserDetails();
        $this -> user_model -> setUserID($user_details -> user_id);
        if($this -> input -> post('template_selected') == NULL){
           $_SESSION['selected_template'] = $template_url;
        }else{
           $_SESSION['selected_template'] = $this -> input -> post('template_selected');
        }

        $this -> template_model -> setSelectedTemplate($_SESSION['selected_template']);
        $data['is_admin'] = $this -> user_model -> CheckUserIsAdmin();
        $data['is_reviewer'] = $this -> user_model -> CheckUserIsReviewer();
        $data['is_creator'] = $this -> user_model -> CheckRecordCreator();
        $template_details =  $this -> template_model -> edit_template_details();
		    $data['template_details'] = $template_details;
        $data['feedback_comments'] = json_decode($template_details -> feedback_sections);
		    $data['positions'] = $this -> position_model -> get_positions();
		    $data['interviewers'] = $this -> interviewer_model -> get_interviewers();
        $data['title'] = 'Edit Template';
        if($data['template_details'] == ''){
          $data['template_details'] = new stdClass;
          $data['template_details'] -> template_id = '';
          $data['template_details'] -> template_name ='';
          $data['template_details'] -> feedback_sections = '[]';
          $data['template_details'] -> position_id = '';
          $data['template_details'] -> interviewer_id = '';
          $data['template_details'] -> user_id = '';
          $data['template_details'] -> candidate_mail = '';
        }
		    $this -> load -> view('user_Templates/header',$data);
	      $this -> load -> view('templates/edit', $data);
	      $this -> load -> view('user_Templates/footer');
        }catch(Exception $e){}
	 }

   // this funtion will send the new values to the database and will update the template with the new values.
	 public function update(){
     $position_sel_arr = explode("--:--",$this -> input -> post('position_selected')) ;
     $this -> user_model -> setEmail($_SESSION['ID']);
     $user_details = $this -> user_model -> getLoggedInUserDetails();
     $this -> user_model -> setUserID($user_details -> user_id);
     $this -> template_model -> setSelectedTemplate($_SESSION['selected_template']);
     $this -> template_model -> setTemplateName($this -> input -> post('name_selected'));
     $this -> candidate_model -> setCandidateMail($this -> input -> post('mail_selected'));
     $this -> template_model -> setFeedbackSections($this -> input -> post('feedback_sections'));
     $this -> template_model -> setInterviewerID($this -> input -> post('interviewer_selected'));
     $this -> template_model -> setPositionID($position_sel_arr[0]);
		 $this -> template_model -> update_template();
     redirect('templates');
   }

    // this function will delete the template selected by the logged in user.
	 public function delete_temp(){
     $this -> user_model -> setEmail($_SESSION['ID']);
     $user_details = $this -> user_model -> getLoggedInUserDetails();
     $this -> user_model -> setUserID($user_details -> user_id);
     $this -> template_model -> setSelectedTemplate($_SESSION['selected_template']);
		 $this -> template_model -> delete_template();
	 	 redirect('templates');
	 }

   public function generateFeedback(){
     $this -> load -> view('user_Templates/header',$data);
     $this -> load -> view('feedbacks/generate', $data);
     $this -> load -> view('user_Templates/footer');
   }
  }
  ?>
