<!DOCTYPE html>
<html>
   <head>
     <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0"/>
      <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css" type="text/css"/>
      <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <title><?= $title ?></title>
      <link rel="shortcut icon" href="https://i.ibb.co/fpSkbVK/Screenshot-171.png"/>
      <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Bebas+Neue&family=Bree+Serif&family=Fredoka+One&family=Josefin+Sans:wght@500&family=Patua+One&family=Secular+One&family=Zilla+Slab:wght@600&display=swap" rel="stylesheet"/>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
      <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"/>

   </head>
   <body onload="">
           <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:white;height:65px;background-color: #f8f8f8;height: 65px;border-radius: 30px;width: 80%;text-align: center;margin-left: 150px;margin-top: 40px;">
             <a class="navbar-brand" href="<?php echo base_url(); ?>" style="padding-left:30px;font-family:Zilla Slab;font-weight:600;color:#ffd100;font-size: 30px;"> <span style="color:#0f50d1">Happy</span> Tech </a>
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon" style="background-color: black;"></span>
             </button>

             <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
               <ul class="navbar-nav mr-auto mt-2 mt-lg-0" style="width:100%">
                 <li class="nav-item"  >
                   <a class="nav-link" style="color:black;padding: 5px 25px;font-family: Zilla Slab;" href="<?php echo base_url(); ?>">  HOME </a>
                 </li>
                 <li class="nav-item" >
                   <a class="nav-link"  style="color:black;padding: 5px 25px;font-family: Zilla Slab;" href=""> CANDIDATE STATUS </a>
                 </li>

               <li class="nav-item" style="width:70%">
                 <a type="button"  href="<?php echo base_url(); ?>Login" class="btn btn-warning btn-sm" style="margin-right: 40px;background-color:#ffd100;font-size:17px;font-family:Zilla Slab; float: right;"> <b style="padding: 10px 40px;"> <i class="fas fa-sign-in-alt"></i> Login</b> </a>
               </li>
               </ul>
            </div>
      </nav>
     <script>AOS.init();</script>
     <style>
     .nav-link:hover{
       background-color: #ffd100;
       border-radius:5px;
     }

     .nav li a {
     	color: white;
     	font-size: 20px;
     	font-style: oblique;
     	font-weight: bold;
     	text-decoration: none;
     }

     .nav li {
     	list-style: none;
     	padding: 16px 0;
     }

     .nav {
     	display: block;
     	padding: 0;
     	margin: 90px 20px 0 20px;
     	transition: 0.3s ease;

     }
     </style>
