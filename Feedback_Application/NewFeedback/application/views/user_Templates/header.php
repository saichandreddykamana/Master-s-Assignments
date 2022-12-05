<!DOCTYPE html>
<html>
   <head>
      <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css" type="text/css"/>
      <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <title><?= $title ?></title>
      <link rel="shortcut icon" href="https://i.ibb.co/fpSkbVK/Screenshot-171.png"/>
      <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Bebas+Neue&family=Bree+Serif&family=Fredoka+One&family=Josefin+Sans:wght@500&family=Patua+One&family=Secular+One&family=Zilla+Slab:wght@600&display=swap" rel="stylesheet"/>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
   </head>
   <body>
     <div class="template_container">
      <div class="row" style="width:100%;height:100vh">
       <div class="col-md-2" style="background:#001e49ed;color:white;">
         <div class="col-md-12">
          <center>
             <h1 style="margin-top:80px;font-size:100px;color:#ffd100"> HT</h1>
             <h5 style="color:#ffd100;margin-top:-20px"> Happy Tech </h5>
          </center>
         </div>
         <div class="col-md-12"  style="margin:60px 0px; margin-left: 5px;" >
           <div class="admin_menu" id="dashboard_link">
             <a class="admin_link" href="<?php echo base_url(); ?>templates" style="text-decoration:none;color:white">
              <span>
                <i class="fas fa-columns" style="margin-right:5px"></i> DASHBOARD
              </span>
             </a>
           </div>
           <?php if($is_reviewer == 1){
             echo "<div class='admin_menu' style='display:block'>
               <a class='admin_link' href='".base_url()."templates/create"."' style='text-decoration:none;color:white'>
                 <span>
                   <i class='fas fa-plus-circle' style='margin-right:5px'></i> TEMPLATE
                 </span>
               </a>
             </div>";
           }
           if($is_admin == 1){
             echo "<div class='admin_menu' style='display:block'>
               <a class='admin_link' href='".base_url()."positions/index"."' style='text-decoration:none;color:white'>
                <span>
                  <i class='fas fa-plus-circle' style='margin-right:5px'></i> POSITION
                </span>
               </a>
             </div>
             <div class='admin_menu' style='display:block'>
               <a class='admin_link' href='".base_url()."interviewers/index"."' style='text-decoration:none;color:white'>
                <span>
                  <i class='fas fa-plus-circle' style='margin-right:5px'></i> INTERVIEWER
                </span>
               </a>
             </div>
             <div class='admin_menu' style='display:block'>
               <a class='admin_link' href='".base_url()."admin/index"."' style='text-decoration:none;color:white'>
                <span>
                  <i class='fas fa-users-cog' style='margin-right:5px'></i> EDIT USERS
                </span>
               </a>
             </div>";
           }
           ?>
         </div>
       </div>
<style>
body{
  font-family: Zilla Slab;
}
.admin_menu{
  padding:15px 0px;
}
.admin_link{
  padding: 15px 25px;
}
.form-control{
  margin:3% 0%;
}
.admin_menu:hover{
  background:#001e49ed;
}

</style>
