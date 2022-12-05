<?php
 class user_model extends CI_Model{
    private $pdo,$email,$first_name,$last_name,$password,$company,$user_id,$uri,$is_reviewer,$is_admin;
    public function __construct(){}

    // SAI CHAND - this function will connect the database before performing any action.
    public function setConnection(){
      return $this -> connection_model -> connect_database();
    }

    public function setURI($uri){
      $this -> uri = $uri;
    }

    public function getURI(){
      return $this -> uri;
    }


    public function setReviewer($is_reviewer){
      $this -> is_reviewer = $is_reviewer;
    }

    public function setAdmin($is_admin){
      $this -> is_admin = $is_admin;
    }

    public function getReviewer(){
      return $this -> is_reviewer;
    }

    public function getAdmin(){
      return $this -> is_admin;
    }

        // this function will set the value of the user company.
        public function setCompany($company){
           $this -> company = $company;
        }

        // this function will get the value of the user company.
        public function getCompany(){
           return $this -> company;
        }


        // this function will set the e-mail value of the user.
        public function setEmail($email){
           $this -> email = $email;
        }

        // this function will get the e-mail value of the user.
        public function getEmail(){
           return $this -> email;
        }

        // this function will set the first name of the user.
        public function setFirstName($first_name){
           $this -> first_name = $first_name;
        }

        // this function will get the first name of the user.
        public function getFirstName(){
           return $this -> first_name;
        }

        // this function will set the last name of the user.
        public function setLastName($last_name){
           $this -> last_name = $last_name;
        }

        // this function will get the last name of the user.
        public function getLastName(){
           return $this -> last_name;
        }

        // this function will set the password of the user.
        public function setPassword($password){
           $this -> password = $password;
        }

        // this function will get the password of the user.
        public function getPassword(){
           return $this -> password;
        }
        // this function will get the user_id.
        public function getUserID(){
          return $this -> user_id;
        }

        // this function will set the user_id.
        public function setUserID($user_id){
          $this -> user_id = $user_id;
        }

    // SAI CHAND - Check the account whether it is disabled or not
    public function exitIfLocked(){
      $pdo_u =   $this -> setConnection();
      $limit_row = 1;
      $sql = 'SELECT account_disabled FROM users WHERE email_id = :email_id LIMIT :limit_row';
      $stmt =  $pdo_u -> prepare($sql);
      $mail = $this -> getEmail();
      $stmt -> bindParam(':email_id', $mail);
      $stmt -> bindParam(':limit_row', $limit_row);
      $stmt -> execute();
      $user_record = $stmt -> fetch();
      if($stmt -> rowCount() != 0){
          return $user_record -> account_disabled;
      }
      return 0;
    }
    // SAI CHAND - this function will check the database whether the user is registered or not.
	  public function check_user_exists(){
      $pdo_u =   $this -> setConnection();
      $limit_row = 1;
      $sql = 'SELECT u.email_id,u.password,u.login_attempts,u.user_id,r.name as "role_name" From users u,role_users ru, roles r where u.email_id = :email_id and ru.user_id = u.user_id and ru.role_id = r.role_id';
      $stmt =  $pdo_u -> prepare($sql);
      $mail = $this -> getEmail();
      $stmt -> bindParam(':email_id', $mail);
      $stmt -> execute();
      $user_record = $stmt -> fetchAll();
      $uri = $this -> getURI();
      $is_admin = FALSE;
      foreach($user_record as $role){
        // SAI CHAND - Check whether the logged in user is a Admin or Reviewer
        if($role -> role_name == 'Admin'){
          $is_admin = TRUE;
        }
      }
       if($stmt -> rowCount() != 0){
        if(password_verify($this -> getPassword(), $user_record[0] -> password)){
          //SAI CHAND - If the logged in user is an admin then the application will redirects the user to the Admin's Dashboard else the user will redirected to the Reviewer Dashboard
          if($is_admin == TRUE){
               return 0;
          }
         return 1;
        }
        // SAI CHAND - If the password entered by the user is invalid then the login attempts will be updated.
        //If the password is invalid and the login attempts value is 1 then user account is disabled
        if(($user_record[0] -> login_attempts - 1) > 0 && $uri != '/NewFeedback/users/register_user'){
            $this -> updateFailedLogin($user_record[0] -> login_attempts, $user_record[0] -> user_id);
        }else{
          if($uri != '/NewFeedback/users/register_user'){
             $this -> updateAccountDisabled($user_record[0] -> user_id);
             return 2;
           }
        }
         return 5;
      }
		  return -1;
  	}


    // SAI CHAND - Updates the account status to disabled when the login attempts equals to zero
    public function updateAccountDisabled($user){
      $pdo_u =   $this -> setConnection();
      $disabled = TRUE;
      $sql = "UPDATE users SET account_disabled = :disabled, login_attempts = 0 WHERE user_id=:user_id";
      $stmt =  $pdo_u -> prepare($sql);
      $stmt -> bindParam(':disabled', $disabled);
      $stmt -> bindParam(':user_id', $user);
      $stmt -> execute();
    }

    // SAI CHAND - Updates the login attempts number of the account when the user entered wrong password
    public function updateFailedLogin($login_num,$user){
      $pdo_u =   $this -> setConnection();
      $attempt_num = $login_num - 1;
      $sql = "UPDATE users SET login_attempts = :attempt_num WHERE user_id=:user_id";
      $stmt =  $pdo_u -> prepare($sql);
      $stmt -> bindParam(':attempt_num', $attempt_num);
      $stmt -> bindParam(':user_id', $user);
      $stmt -> execute();
    }

    // SAI CHAND - Create a new user in the application's database when the user enters valid details in the registration form
    public function register(){
      $pdo_u =   $this -> setConnection();
      $sql = 'INSERT INTO users(email_id,first_name,last_name,password) VALUES (:email_id,:first_name,:last_name,:password)';
      $stmt =  $pdo_u -> prepare($sql);
      $mail = $this -> getEmail();
      $firstN = $this -> getFirstName();
      $lastN = $this -> getLastName();
      $pass = password_hash($this -> getPassword(), PASSWORD_DEFAULT);
      $companyU = $this -> getCompany();
      $stmt -> bindParam(':email_id', $mail);
      $stmt -> bindParam(':first_name', $firstN);
      $stmt -> bindParam(':last_name', $lastN);
      $stmt -> bindParam(':password', $pass);
      $stmt -> execute();
      $user_record = $this -> getLoggedInUserDetails();
      $this -> user_model -> setUserID($user_record -> user_id);
      $this -> position_model -> setPositionName('Reviewer');
      $this -> interviewer_model -> setInterviewerName($firstN." ".$lastN);
      $this -> interviewer_model -> setInterviewerMailID($mail);
      $this -> interviewer_model -> create_interviewer();
      $this -> createRole($user_record -> user_id,1);
      $this -> createRole($user_record -> user_id,3);
    }

    //SAI CHAND - Create a specific role for a specific user
    public function createRole($user_id,$role){
      $pdo_u =   $this -> setConnection();
      $role_id = $role;
      $sql = 'INSERT INTO role_users(user_id,role_id) VALUES (:user_id,:role_id)';
      $stmt =  $pdo_u -> prepare($sql);
      $stmt -> bindParam(':user_id', $user_id);
      $stmt -> bindParam(':role_id',$role_id);
      $stmt -> execute();
    }

    //SAI CHAND - Deletes a specific role for a specific user
    public function deleteRole($user,$role_id){
      $pdo_u =   $this -> setConnection();
      $sql = "DELETE FROM role_users WHERE role_id = :role_id AND user_id=:user";
      $stmt =  $pdo_u -> prepare($sql);
      $stmt -> bindParam(':role_id', $role_id);
      $stmt -> bindParam(':user', $user);
      $stmt -> execute();
    }

    // SAI CHAND - Delete specific user from the application's Database
    public function deleteUser(){
      $pdo_u =   $this -> setConnection();
      $user = $this -> getUserID();
      $this -> deleteTemplateForUser();
      $this -> deleteInterviewerForUser();
      $this -> deletePositionForUser();
      $this -> deleteRoleForUser();
      $sql = "DELETE FROM users WHERE user_id=:user";
      $stmt =  $pdo_u -> prepare($sql);
      $stmt -> bindParam(':user', $user);
      $stmt -> execute();
    }

    //SAI CHAND - Before Deleting the user, the roles assigned to the user will be deleted first
    public function deleteRoleForUser(){
      $pdo_u =   $this -> setConnection();
      $user = $this -> getUserID();
      $sql = "DELETE FROM role_users WHERE user_id=:user";
      $stmt =  $pdo_u -> prepare($sql);
      $stmt -> bindParam(':user', $user);
      $stmt -> execute();
    }

    //SAI CHAND - Before Deleting the user, the interviewers created by the user will be deleted first
    public function deleteInterviewerForUser(){
      $pdo_u =   $this -> setConnection();
      $user = $this -> getUserID();
      $sql = "DELETE FROM interviewer WHERE user_id=:user";
      $stmt =  $pdo_u -> prepare($sql);
      $stmt -> bindParam(':user', $user);
      $stmt -> execute();
    }

    //SAI CHAND - Before Deleting the user, the positions created by the user will be deleted first
    public function deletePositionForUser(){
      $pdo_u =   $this -> setConnection();
      $user = $this -> getUserID();
      $sql = "DELETE FROM position WHERE user_id=:user";
      $stmt =  $pdo_u -> prepare($sql);
      $stmt -> bindParam(':user', $user);
      $stmt -> execute();
    }

    //SAI CHAND - Before Deleting the user, the templates created by the user will be deleted first
    public function deleteTemplateForUser(){
      $pdo_u =   $this -> setConnection();
      $user = $this -> getUserID();
      $sql = "DELETE FROM template WHERE user_id=:user";
      $stmt =  $pdo_u -> prepare($sql);
      $stmt -> bindParam(':user', $user);
      $stmt -> execute();
    }

    //SAI CHAND - Check the user whether an admin or not.
    public function CheckUserIsAdmin(){
      $pdo_u =   $this -> setConnection();
      $sql = 'SELECT * FROM role_users WHERE user_id = :user_id AND role_id = 2';
      $stmt = $pdo_u -> prepare($sql);
      $user = $this -> getUserID();
      $stmt -> bindParam(':user_id', $user);
      $stmt -> execute();
      if($stmt -> rowCount() > 0){
        return TRUE;
      }
      return FALSE;
    }

    //SAI CHAND - Check the user whether an reviewer or not.
    public function CheckUserIsReviewer(){
      $pdo_u =   $this -> setConnection();
      $sql = 'SELECT * FROM role_users WHERE user_id = :user_id AND role_id = 1';
      $stmt = $pdo_u -> prepare($sql);
      $user = $this -> getUserID();
      $stmt -> bindParam(':user_id', $user);
      $stmt -> execute();
      if($stmt -> rowCount() > 0){
        return TRUE;
      }
      return FALSE;
    }

    //SAI CHAND - Check whether the interviewer selected is created by the current user or not.
    public function CheckRecordCreator(){
      $pdo_u =   $this -> setConnection();
      $user = $this -> getUserID();
      $interviewer = $this -> interviewer_model -> getInterviewerID();
      $sql = 'SELECT * FROM interviewer WHERE user_id = :user_id AND interviewer_id = :interviewer_id';
      $stmt = $pdo_u -> prepare($sql);
      $stmt -> bindParam(':user_id', $user);
      $stmt -> bindParam(':interviewer_id', $interviewer);
      $stmt -> execute();
      if($stmt -> rowCount() > 0){
        return TRUE;
      }
      return FALSE;
    }

    // SAI CHAND - Update the user role as per the admin requirements
    public function updateUserRole(){
      $user = $this -> getUserID();
      if(!$this -> CheckUserIsReviewer() && $this -> getReviewer() == 1){
        $this -> createRole($user, 1);
      }
      if($this -> CheckUserIsReviewer() && $this -> getReviewer() == 0){
        $this -> deleteRole($user, 1);
      }
      if(!$this -> CheckUserIsAdmin() && $this -> getAdmin() == 1){
        $this -> createRole($user, 2);
      }
      if($this -> CheckUserIsAdmin() && $this -> getAdmin() == 0){
        $this -> deleteRole($user, 2);
      }
    }

    // this function will get the status of the jobs applied by the specific candidate.
    public function  getCandidateStatus(){
      $pdo_u =   $this -> setConnection();
      $sql = 'SELECT c.candidate_id,c.candidate_mail,c.candidate_name,c.candidate_status,p.position_name as "candidate_position" FROM candidates c, position p WHERE c.candidate_mail = ? AND p.position_id = c.candidate_position';
      $stmt = $pdo_u -> prepare($sql);
      $stmt -> execute([$this -> getEmail()]);
      return $stmt ->fetchAll();
    }

    // SAI CHAND - this function will get the details of the user using the provided e-mail id who tries to login into the system.
    public function getLoggedInUserDetails(){
       $pdo_u =   $this -> setConnection();
       $sql = 'SELECT * FROM users WHERE email_id = ?';
       $stmt = $pdo_u -> prepare($sql);
       $stmt -> execute([$this -> getEmail()]);
       return $stmt -> fetch();
    }

    //SAI CHAND - Get all users Details
    public function get_users(){
       $pdo_u =   $this -> setConnection();
       $sql = 'SELECT u.email_id,u.account_disabled,u.first_name,u.last_name,u.user_id,r.name as "role_name" From users u,role_users ru, roles r where u.email_id != "" and ru.user_id = u.user_id and ru.role_id = r.role_id ORDER BY u.user_id';
       $stmt = $pdo_u -> prepare($sql);
       $stmt -> execute();
       return $stmt -> fetchAll();
    }

    // SAI CHAND - Enables the disabled accounts
    public function updateUserAccountDisable(){
      $user = $this -> getUserID();
      $pdo_u =   $this -> setConnection();
      $attempt_num = 3;
      $sql = "UPDATE users SET login_attempts = :attempt_num, account_disabled = 0 WHERE user_id=:user_id";
      $stmt =  $pdo_u -> prepare($sql);
      $stmt -> bindParam(':attempt_num', $attempt_num);
      $stmt -> bindParam(':user_id', $user);
      $stmt -> execute();
    }
 }

?>
