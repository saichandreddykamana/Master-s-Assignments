<?php
  class feedback_model extends CI_Model{

    private $user_id,$feedback_name,$feedback_sections,$selected_feedback_id,$single_feedback_section;

	  public function __construct(){}

    // this function will set the feedback name.
    public function setFeedbackName($feedback_name){
      $this -> feedback_name = $feedback_name;
    }

    // this function will get the feedback name.
    public function getFeedbackName(){
      return $this -> feedback_name;
    }

    // this function will set the feedback id.
    public function setFeedbackID($selected_feedback_id){
      $this -> selected_feedback_id = $selected_feedback_id;
    }

    // this function will get the feedback id.
    public function getFeedbackID(){
      return $this -> selected_feedback_id;
    }

    // this function will set the feedback sections value.
    public function setFeedbackSections($feedback_sections){
      $this -> feedback_sections = $feedback_sections;
    }

    // this function will get the feedback sections value.
    public function getFeedbackSections(){
      return $this -> feedback_sections;
    }

    // this function will set the single feedback section value.
    public function setFeedbackSingleSection($single_feedback_section){
      $this -> single_feedback_section = $single_feedback_section;
    }

    // this function will get the single feedback section.
    public function getFeedbackSingleSection(){
      return $this -> single_feedback_section;
    }

    // this function will get the feedbacks created by the logged in user.
	  public function get_feedbacks(){
       $pdo_u = $this -> user_model -> setConnection();
       $sql = 'SELECT * FROM feedback WHERE user_id = ?';
       $stmt = $pdo_u -> prepare($sql);
       $stmt -> execute([$this -> getUserID()]);
       return $stmt -> fetchAll();
	  }

    // this function will create the new feedback in the database.
	  public function create_feedback(){
      $pdo_u = $this -> user_model -> setConnection();
      $sql = 'INSERT INTO feedback(feedback_name, feedback_sections, user_id) VALUES (?, ?, ?)';
      $stmt = $pdo_u -> prepare($sql);
      $stmt -> execute([$this -> getFeedbackName(), $this -> getFeedbackSections(), $this -> getUserID()]);

	  }

    // this function will get the selected feedback details.
	  public function get_feedback_details(){
      $pdo_u = $this -> user_model -> setConnection();
      $sql = 'SELECT * FROM feedback WHERE feedback_id = ? AND user_id = ?';
      $stmt = $pdo_u -> prepare($sql);
      $stmt -> execute([ $this -> getFeedbackID(), $this -> getUserID()]);
      return $stmt -> fetch();
	  }

    // this function will update the selected feedback details with the new values provided by the logged in user.
	  public function update_feedback(){
      $pdo_u = $this -> user_model -> setConnection();
      $sql = 'UPDATE feedback SET feedback_id = ?, feedback_name = ?, feedback_sections = ?, user_id = ? WHERE feedback_id = ? AND user_id = ?';
      $stmt = $pdo_u -> prepare($sql);
      $stmt -> execute([$this -> getFeedbackID(), $this -> getFeedbackName(), $this -> getFeedbackSections(), $this -> getUserID(), $this -> getFeedbackID(), $this -> getUserID()]);
	  }

    // this function will add or edit the single feedback option for a selected feedback
    public function updateFeedbackSection(){
      $pdo_u = $this -> user_model -> setConnection();
      $sql = 'UPDATE feedback SET feedback_sections = ? WHERE feedback_id = ? AND user_id = ?';
      $stmt = $pdo_u -> prepare($sql);
      $stmt -> execute([$this -> getFeedbackSections(), $this -> getFeedbackID(), $this -> getUserID()]);
    }
  }
?>
