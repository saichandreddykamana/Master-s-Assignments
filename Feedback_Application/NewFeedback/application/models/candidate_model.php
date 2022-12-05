<?php
require 'PHPMailer/PHPMailerAutoload.php';
 class candidate_model extends CI_Model{
   private $user_id,$pdo_u,$candidate_email,$feedback_document,$candidate_name,$candidate_position,$candidate_company,$candidate_resume,$candidate_mail_option,$template_id,$extra_comments,$candidate_result,$feedback_comments,$candidate_id;

   public function setCandidateMail($candidate_email){
     $this -> candidate_email = $candidate_email;
   }

   public function getCandidateMail(){
     return $this -> candidate_email;
   }

   public function setCandidateResume($candidate_resume){
     $this -> candidate_resume = $candidate_resume;
   }

   public function getCandidateResume(){
     return $this -> candidate_resume;
   }

   public function setCandidatePosition($candidate_position){
     $this -> candidate_position = $candidate_position;
   }

   public function getCandidatePosition(){
     return $this -> candidate_position;
   }

   public function setResult($candidate_result){
     $this -> candidate_result = $candidate_result;
   }

   public function getResult(){
     return $this -> candidate_result;
   }

   public function setDocument($feedback_document){
     $this -> feedback_document = $feedback_document;
   }

   public function getDocument(){
     return $this -> feedback_document;
   }

   public function setCandidateName($candidate_name){
     $this -> candidate_name = $candidate_name;
   }

   // this function will get the candidate name.
   public function getCandidateName(){
     return $this -> candidate_name;
   }

      public function setTemplateID($template_id){
        $this -> template_id = $template_id;
      }

      public function getTemplateID(){
        return $this -> template_id;
      }

      public function setCandidateID($candidate_id){
        $this -> candidate_id = $candidate_id;
      }

      public function getCandidateID(){
        return $this -> candidate_id;
      }

      public function setFeedbackComments($feedback_comments){
        $this -> feedback_comments = $feedback_comments;
      }

      public function getFeedbackComments(){
        return $this -> feedback_comments;
      }

      public function setExtraComments($extra_comments){
        $this -> extra_comments = $extra_comments;
      }

      public function getExtraComments(){
        return $this -> extra_comments;
      }

   // get the list of candidates who applied for any positions in the feedback application.
   public function getCandidates(){
     $pdo_u =   $this -> user_model -> setConnection();
     $sql = 'SELECT c.candidate_mail, c.candidate_id, c.candidate_name,p.position_name as "candidate_position_name",c.candidate_position, c.candidate_status, c.candidate_resume FROM candidates c, position p WHERE candidate_status ="Pending" AND p.position_id = c.candidate_position';
     $stmt  = $pdo_u -> prepare($sql);
     $stmt -> execute();
     return $stmt -> fetchAll();
   }

   public function getCandidateDetails(){
     $pdo_u =   $this -> user_model -> setConnection();
     $sql = 'SELECT * FROM candidates WHERE candidate_id = ? AND candidate_position = ?';
     $stmt  = $pdo_u -> prepare($sql);
     $stmt -> execute([$this -> getCandidateID(), $this -> getCandidatePosition()]);
     return $stmt -> fetch();
   }

 }
 ?>
