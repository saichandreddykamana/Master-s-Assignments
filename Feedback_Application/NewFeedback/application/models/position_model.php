<?php
  class position_model extends CI_Model{
    private $user_id,$position_id,$position_description,$company_name,$position_name,$number_of_positions;
	  public function __construct(){}

    // this function will set the company name.
    public function setCompanyName($company_name){
       $this -> company_name = $company_name;
    }

    // this function will get the company name.
    public function getCompanyName(){
     return $this -> company_name;
    }

    // this function will set the position id.
    public function setPositionID($position_id){
      $this -> position_id = $position_id;
    }

    // this function will get the position id.
    public function getPositionID(){
      return $this -> position_id;
    }

    // this function will set the position description value.
    public function setPositionDescription($position_description){
      $this -> position_description = $position_description;
    }

    // this function will get the position description value.
    public function getPositionDescription(){
      return $this -> position_description;
    }

    // this function will set the position name.
    public function setPositionName($position_name){
      $this -> position_name = $position_name;
    }

   // this function will get the position name.
    public function getPositionName(){
      return $this -> position_name;
    }

    // this function will set the number of positions available.
    public function setPositionNumber($number_of_positions){
      $this -> number_of_positions = $number_of_positions;
    }

    // this function will get the number of positions available.
    public function getPositionNumber(){
      return $this -> number_of_positions;
    }

    public function getPositionIDByName(){
      $pdo_u = $this -> user_model -> setConnection();
      $sql = 'SELECT * FROM position WHERE user_id = ? AND company_name = ? AND position_name = ?';
      $stmt = $pdo_u -> prepare($sql);
      $stmt -> execute([$this -> user_model -> getUserID(), $this -> getCompanyName(), $this -> getPositionName()]);
      return $stmt -> fetch();
    }

    // this function will get the positions created by the logged in user.
	  public function get_positions(){
       $pdo_u = $this -> user_model -> setConnection();
       $sql = 'SELECT * FROM position';
       $stmt = $pdo_u -> prepare($sql);
       $stmt -> execute();
       return $stmt -> fetchAll();
	  }

    // this function will create position by the details provided by the logged in user.
	  public function create_position(){
      $pdo_u = $this -> user_model -> setConnection();
      $sql = 'INSERT INTO position (position_name, number_of_positions, user_id, company_name, position_description) VALUES (?,?,?,?,?)';
      $stmt = $pdo_u -> prepare($sql);
      $stmt -> execute([$this -> getPositionName(), $this -> getPositionNumber(), $this -> user_model -> getUserID(), $this -> getCompanyName(), $this -> getPositionDescription()]);
	  }

    // this function will get the details of selected position.
	  public function get_position_details(){
      $pdo_u = $this -> user_model -> setConnection();
      $sql = 'SELECT * FROM position WHERE position_id = ?';
      $stmt = $pdo_u -> prepare($sql);
      $stmt -> execute([$this -> getPositionID()]);
		  return $stmt -> fetch();
	  }

    // this function will update the existing position with the new values provided by the logged in user.
	  public function update_position(){
      $pdo_u = $this -> user_model -> setConnection();
      $sql = 'UPDATE position SET position_name = ?, number_of_positions = ?, position_description = ? WHERE position_id = ?';
      $stmt = $pdo_u -> prepare($sql);
      $stmt -> execute([ $this -> getPositionName(), $this -> getPositionNumber(), $this -> getPositionDescription(), $this -> getPositionID()]);
	  }

    // this function will update the existing position with the new values provided by the logged in user.
	  public function update_position_number(){
      $pdo_u = $this -> user_model -> setConnection();
      $sql = 'UPDATE position SET number_of_positions = number_of_positions - 1 WHERE position_id = ?';
      $stmt = $pdo_u -> prepare($sql);
      $stmt -> execute([$this -> getPositionID()]);
	  }
  }
?>
