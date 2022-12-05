<?php
  class admin extends CI_Controller{
   public $user_details;

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
    public function index(){
      // get users
      $users = $this -> user_model -> get_users();
      $this -> user_model -> setEmail($_SESSION['ID']);
      $user_det = $this -> user_model -> getLoggedInUserDetails();
      $this -> user_model -> setUserID($user_det -> user_id);
      $users_list = [];
      $user_details;
      foreach($users as $user){
        $user_details['user_id'] = $user -> user_id;
        $user_details['account_disabled'] = $user -> account_disabled;
        $user_details['name'] = $user -> first_name." ".$user -> last_name;
        $user_details['email_id'] = $user -> email_id;
        $user_details['is_admin'] = FALSE;
        $user_details['is_reviewer'] = FALSE;
        if($user -> role_name == 'Admin'){
          $user_details['is_admin'] = TRUE;
        }
        if($user -> role_name == 'Reviewer'){
          $user_details['is_reviewer'] = TRUE;
        }
        if(!$this -> userExists($users_list, $user_details['email_id'])){
          array_push($users_list,$user_details);
        }else{
          foreach($users_list as &$list){
            if($user -> role_name == 'Reviewer' && $user -> email_id == $list['email_id']){
              $list['is_reviewer'] = TRUE;
            }
            if($user -> role_name == 'Admin' && $user -> email_id == $list['email_id']){
              $list['is_admin'] = TRUE;
            }
          }
        }
      }
      $data['is_admin'] = $this -> user_model -> CheckUserIsAdmin();
      $data['is_reviewer'] = $this -> user_model -> CheckUserIsReviewer();
      $data['users'] = $users_list;
      //loading views
      $data['title'] = 'Edit Users';
      $data['user_name'] = $_SESSION['ID'];
      $this -> load -> view('user_Templates/header',$data);
      $this -> load -> view('templates/adminDashboard', $data);
      $this -> load -> view('user_Templates/footer');
    }

    public function userExists($arr,$em){
      foreach($arr as $a){
        if($a['email_id'] == $em){
          return true;
        }
      }
      return false;
    }
    public function update(){
        $is_reviewer = 0;
        $is_admin = 0;
        $this -> user_model -> setUserID($this -> input -> post('user_id'));
        if(isset($_POST['update'])){
         if($this -> input -> post('is_reviewer') == 'on'){
           $is_reviewer = 1;
         }
         if($this -> input -> post('is_admin') == 'on'){
           $is_admin = 1;
         }
         $this -> user_model -> setReviewer($is_reviewer);
         $this -> user_model -> setAdmin($is_admin);
         $this -> user_model -> updateUserRole();
       }
       if(isset($_POST['delete'])){
          $this -> user_model -> deleteUser();
       }
       if(isset($_POST['account_update'])){
          $this -> user_model -> updateUserAccountDisable();
       }
       redirect('admin');
    }
  }
?>
