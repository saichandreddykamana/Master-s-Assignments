<?php
  class interviewer_model extends CI_Model{

  private $interviewer_name, $user_id, $interviewer_mail_id,$selected_interviewer_id;

  public function __construct(){}

  // this function will set the interviewer name.
  public function setInterviewerName($interviewer_name){
    $this -> interviewer_name = $interviewer_name;
  }

  // this function will get the interviewer name.
  public function getInterviewerName(){
    return $this -> interviewer_name;
  }

  // this function will set the interviewer id.
  public function setInterviewerID($selected_interviewer_id){
    $this -> selected_interviewer_id = $selected_interviewer_id;
  }

  // this function will get the interviewer id.
  public function getInterviewerID(){
    return $this -> selected_interviewer_id;
  }

  // this function will set the interviewer mail id.
  public function setInterviewerMailID($interviewer_mail_id){
    $this -> interviewer_mail_id = $interviewer_mail_id;
  }

  // this function will get the interviewer mail id.
  public function getInterviewerMailID(){
    return $this -> interviewer_mail_id;
  }

  // this function will get the interviewers created by logged in user.
	public function get_interviewers(){
      $pdo_u =   $this -> user_model -> setConnection();
      $sql = 'SELECT * FROM interviewer';
      $stmt = $pdo_u -> prepare($sql);
      $stmt -> execute();
      return $stmt -> fetchAll();
	}

  // this function will create the interviewer using the values provided by the logged in user.
	public function create_interviewer(){
      $pdo_u =   $this -> user_model -> setConnection();
      $sql = 'INSERT INTO interviewer(interviewer_name, interviewer_mail_id, user_id) VALUES (?, ?, ?)';
      $stmt = $pdo_u -> prepare($sql);
      $stmt -> execute([$this -> getInterviewerName(), $this -> getInterviewerMailID(), $this -> user_model -> getUserID()]);
	}

  // this function will get the selected interviewer details.
	public function get_interviewer_details(){
      $pdo_u =   $this -> user_model -> setConnection();
      $sql = 'SELECT * FROM interviewer WHERE interviewer_id = ?';
      $stmt = $pdo_u -> prepare($sql);
      $stmt -> execute([$this -> getInterviewerID()]);
		  return $stmt -> fetch();
	}

  public function get_interviewer_details_using_mail(){
      $pdo_u =   $this -> user_model -> setConnection();
      $sql = 'SELECT * FROM interviewer WHERE interviewer_mail_id = ?';
      $stmt = $pdo_u -> prepare($sql);
      $stmt -> execute([$this -> getInterviewerMailID()]);
      return $stmt -> fetch();
  }

  // this function will update the selected interviewer details with the new values provided.
	public function update_interviewer(){
      $pdo_u =   $this -> user_model -> setConnection();
      $sql = 'UPDATE interviewer SET interviewer_id = ?, interviewer_name = ?, interviewer_mail_id = ? WHERE interviewer_id = ? AND user_id = ?';
      $stmt = $pdo_u -> prepare($sql);
      $stmt -> execute([$this -> getInterviewerID(), $this -> getInterviewerName(), $this -> getInterviewerMailID(), $this -> getInterviewerID(), $this -> user_model -> getUserID()]);
	  }
  }
?>
