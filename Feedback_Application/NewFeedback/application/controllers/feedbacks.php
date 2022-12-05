<?php
require 'fpdf182/fpdf.php';
  class feedbacks extends CI_Controller{

    public function __construct(){
      parent::__construct();
      if(!$this -> session -> userdata('is_logged_in')){
        redirect('login');
      }
    }
    public function generate(){
        $this -> user_model -> setEmail($_SESSION['ID']);
        $user_details = $this -> user_model -> getLoggedInUserDetails();
        $this -> user_model -> setUserID($user_details -> user_id);
        $template_id = $this -> input -> post("selected_template_id");
        if($template_id == ''){
          $template_id = $this -> template_model -> getSelectedTemplate();
        }
        if($template_id != ''){
          $this -> template_model -> setSelectedTemplate($template_id);
          $template = $this -> template_model -> edit_template_details();
          $data['template'] = $template;
          $data['feedback_comments'] = json_decode($template->feedback_sections);
          $position_id = $data['template'] -> position_id;
          $interviewer_id = $data['template'] -> interviewer_id;
          $this -> position_model -> setPositionID($position_id);
          $this -> interviewer_model -> setInterviewerID($interviewer_id);
          $position = $this -> position_model -> get_position_details();
          $interviewer = $this -> interviewer_model -> get_interviewer_details();
          $data['position'] = $position;
          $data['interviewer'] = $interviewer;
        }else{
          $data['template'] = new stdClass;
          $data['template'] -> template_id = '';
          $data['template'] -> template_name ='';
          $data['template'] -> feedback_sections = '[]';
          $data['template'] -> position_id = '';
          $data['template'] -> interviewer_id = '';
          $data['template'] -> user_id = '';
          $data['template'] -> candidate_mail = '';
          $data['position'] = new stdClass;
          $data['position'] -> position_id = '';
          $data['position'] -> position_name = '';
          $data['position'] -> number_of_positions = '';
          $data['interviewer'] = new stdClass;
          $data['interviewer'] -> interviewer_id = '';
          $data['interviewer'] -> interviewer_name = '';
        }


        $data['is_admin'] = $this -> user_model -> CheckUserIsAdmin();
        $data['is_reviewer'] = $this -> user_model -> CheckUserIsReviewer();
        $data['is_creator'] = $this -> user_model -> CheckRecordCreator();
        $data['title'] = 'Generate Feedback';
    	   $this -> load -> view('user_Templates/header',$data);
    	   $this -> load -> view('feedbacks/generate', $data);
    	   $this -> load -> view('user_Templates/footer');
    	}

    public function generateFeedback(){
      $this -> user_model -> setEmail($_SESSION['ID']);
      $user_details = $this -> user_model -> getLoggedInUserDetails();
      $this -> user_model -> setUserID($user_details -> user_id);
      $this -> candidate_model -> setTemplateID($this -> input -> post('template_id'));
      $this -> candidate_model -> setResult($this -> input -> post('candidate_result'));
      $this -> candidate_model -> setCandidateMail($this -> input -> post('candidate_mail'));
      $pdf = new FPDF();
      $pdf -> AddPage();
      $pdf -> SetFont('Arial', 'B', 15);
      $pdf -> Cell(0,20, ' -------Feedback------- ', 0, 1, 'C');
      $pdf -> Cell(0,10, 'Interview Result', 0, 2, '');
      $pdf -> SetFont('Arial', '', 12);
      if($this -> input -> post('candidate_result') == 'selected'){
        $pdf -> Cell(0, 10,"Congratulations!! You're are selected for the positions you applied for." , 0, 2, '');
      }else{
        $pdf -> Cell(0, 10,"Sorry!! You have rejected for the position you applied for. Don't worry, we have your resume and we will consider it in future." , 0, 2, '');
      }
      $pdf -> SetFont('Arial', 'B', 15);
      $pdf -> Cell(0, 10, 'Position Applied ', 0, 2, '');
      $pdf -> SetFont('Arial', '', 12);
      $pdf -> Cell(0, 10, $this -> input -> post('position_name') , 0, 2, '');
      $pdf -> SetFont('Arial', 'B', 12);
      $pdf -> Cell(0, 10, 'Feedback From Interviewer', 0, 2, '');
      $pdf -> SetFont('Arial', '', 12);
      $comments = json_decode($this -> input -> post('feedback_sections'));
        foreach($comments as $comment){
          $pdf -> Cell(0,10, "--> ".$comment , 0, 2, '');
        }
      $string_file = $pdf -> Output('S');
      $this -> candidate_model -> setDocument($string_file);
      $this -> candidate_model -> generateFeedbackForCandidates();
      redirect('templates');
     }

     public function createTemplateForCandidate(){
       $candidate_id = $this -> input -> post('candidate_id');
       $this -> candidate_model -> setCandidateID($candidate_id);
       $this -> candidate_model -> setCandidatePosition($this -> input -> post('candidate_position_id'));
       $candidate_details = $this -> candidate_model -> getCandidateDetails();
       $template_name = "Applied Candidate -".$candidate_details -> candidate_name. "'s Template";
       $this -> template_model -> setTemplateName($template_name);
       $this -> candidate_model -> setCandidateMail($candidate_details -> candidate_mail);
       $this -> template_model -> setFeedbackSections('[]');
       $this -> template_model -> setPositionID($candidate_details -> candidate_position);
       $this -> user_model -> setEmail($_SESSION['ID']);
       $user_details = $this -> user_model -> getLoggedInUserDetails();
       $this -> user_model -> setUserID($user_details -> user_id);
       $this -> interviewer_model -> setInterviewerMailID($_SESSION['ID']);
       $interviewer_details = $this -> interviewer_model -> get_interviewer_details_using_mail();
       $this -> template_model -> setInterviewerID($interviewer_details -> interviewer_id);
 		   $template = $this -> template_model -> create_template();
       $this -> template_model -> setSelectedTemplate($template);
       $this -> generate();
     }
}
?>
