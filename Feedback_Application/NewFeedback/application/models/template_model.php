<?php
  class template_model extends CI_Model{
    private $selected_template, $user_id,$template_name,$feedback_sections,$position_id,$interviewer_id;
	  public function __construct(){

	  }

    // this function will set the feedback sections value.
    public function setFeedbackSections($feedback_sections){
      $this -> feedback_sections = $feedback_sections;
    }

    // this function will get the feedback sections value.
    public function getFeedbackSections(){
      return $this -> feedback_sections;
    }


    // this function will set the selected template.
    public function setSelectedTemplate($selected_template){
      $this -> selected_template = $selected_template;
    }

    // this function will get the selected template.
    public function getSelectedTemplate(){
      return $this -> selected_template;
    }

    // this function will set the feedback id.
    public function setFeedbackID($feedback_id){
      $feedback_id = explode(":",$feedback_id);
      $this -> feedback_id = $feedback_id[0];
    }

    // this function will get the feedback id.
    public function getFeedbackID(){
      return $this -> feedback_id;
    }

    // this function will set the template name.
    public function setTemplateName($template_name){
      $this -> template_name = $template_name;
    }

    // this function will get the template name.
    public function getTemplateName(){
      return $this -> template_name;
    }

    // this function will set the position id.
    public function setPositionID($position_id){
      $this -> position_id = $position_id;
    }

    // this function will get the position id.
    public function getPositionID(){
      return $this -> position_id;
    }

    // this function will set the interviewer id.
    public function setInterviewerID($interviewer_id){
      $this -> interviewer_id = $interviewer_id;
    }

    // this function will get the interviewer id.
    public function getInterviewerID(){
      return $this -> interviewer_id;
    }

    // this function will get the templates created by the logged in user.
	  public function get_templates(){
      $pdo_u =   $this -> user_model -> setConnection();
      $sql = 'SELECT * FROM template WHERE user_id = ?';
      $stmt = $pdo_u -> prepare($sql);
      $stmt -> execute([$this -> user_model -> getUserID()]);
      $templates = $stmt -> fetchAll();
			return $templates;
	  }

    // this function will create template on behalf of the logged in user .
	  public function create_template(){
      $pdo_u =   $this -> user_model -> setConnection();

      $sql = 'INSERT INTO template(template_name,user_id,feedback_sections,interviewer_id,position_id,candidate_mail) VALUES (?,?,?,?,?,?)';
      $stmt = $pdo_u -> prepare($sql);
      $stmt -> execute([$this -> getTemplateName(), $this -> user_model -> getUserID(), $this -> getFeedbackSections(), $this -> getInterviewerID(), $this -> getPositionID(), $this -> candidate_model -> getCandidateMail()]);
      $template = $pdo_u -> lastInsertId();
      $this -> interviewer_model -> setInterviewerID($this -> getInterviewerID());
      $interviewer_details = $this -> interviewer_model -> get_interviewer_details();
      $this -> user_model -> setUserID($interviewer_details ->  user_id);
      $temp_result = $this -> user_model -> CheckUserIsReviewer();
        if(!$temp_result){
          $this -> user_model -> createRole($interviewer_details ->  user_id, 1);
      }
      return $template;
	  }

    // this function will get the details of the template selected by the logged in user to edit.
	  public function edit_template_details(){
      $pdo_u =   $this -> user_model -> setConnection();
      $sql = 'SELECT * FROM template WHERE template_id =? AND user_id = ? LIMIT ?';
      $limit = 1;
      $stmt = $pdo_u -> prepare($sql);
      $stmt -> execute([$this -> getSelectedTemplate(), $this -> user_model -> getUserID(), $limit]);
		  $data = $stmt -> fetch();
      return $data;
	  }

    public function getTemplatesForSelectedPosition(){
      $pdo_u =   $this -> user_model -> setConnection();
      $sql = 'SELECT * FROM template WHERE position_id = ? AND user_id = ? ';
      $stmt = $pdo_u -> prepare($sql);
      $stmt -> execute([$this -> getPositionID(), $this -> user_model -> getUserID()]);
      $data = $stmt -> fetchAll();
      return $data;
    }

    // this function will update the selected template using the new values.
	  public function update_template(){
        $pdo_u =   $this -> user_model -> setConnection();
        $sql = 'UPDATE template SET template_id = ?, candidate_mail =?, template_name =?, user_id = ?, interviewer_id = ?, feedback_sections = ?, position_id = ? WHERE template_id = ? AND user_id = ?';
        $stmt = $pdo_u -> prepare($sql);
        $stmt -> execute([$this -> getSelectedTemplate(), $this -> candidate_model -> getCandidateMail(), $this -> getTemplateName(), $this -> user_model -> getUserID(),  $this -> getInterviewerID(), $this -> getFeedbackSections(), $this -> getPositionID(), $this -> getSelectedTemplate(), $this -> user_model -> getUserID()]);
        $this -> interviewer_model -> setInterviewerID($this -> getInterviewerID());
        $interviewer_details = $this -> interviewer_model -> get_interviewer_details();
        $this -> user_model -> setUserID($interviewer_details ->  user_id);
        $temp_result = $this -> user_model -> CheckUserIsReviewer();
          if(!$temp_result){
            $this -> user_model -> createRole($interviewer_details ->  user_id, 1);
        }
      }

    // this function will delete selected template.
	  public function delete_template(){
        $pdo_u =   $this -> user_model -> setConnection();
        $sql = 'DELETE FROM generated_feedbacks WHERE template_id = ?';
        $stmt = $pdo_u -> prepare($sql);
        $stmt -> execute([$this -> getSelectedTemplate()]);
        $sql = 'DELETE FROM template WHERE template_id =? AND user_id = ?';
        $stmt = $pdo_u -> prepare($sql);
        $stmt -> execute([$this -> getSelectedTemplate(), $this -> user_model -> getUserID()]);

	  }
  }
?>
