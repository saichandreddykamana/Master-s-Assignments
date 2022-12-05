<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>

<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
   <li data-target="#carouselExampleSlidesOnly" data-slide-to="0" class="active"></li>
   <li data-target="#carouselExampleSlidesOnly" data-slide-to="1"></li>
 </ol>
  <div class="carousel-inner">
    <div class="carousel-item active" data-interval="3000">
      <div class="homepage-body-container">
               <div class="row" style="margin: 1% 2%;" id ="info">
                  <div id="candidate_info" class="col-md-12" style="">
                    <div class="vertical-center">
                      <h1 style="font-family: 'Zilla Slab';text-align:center;color:#0f50d1"> Get the feedback for your interview and <span style="color: #787474">improve your skills</span> </h1>
                      <center>
                        <button class="btn btn-secondary btn-sm" id="apply-btn" onclick="showCandidateForm()" type="button" style="width:200px;background-color:#0f50d1;border-color:#0f50d1;padding:5px 40px;font-family:Zilla Slab;font-size:17px"> <i class="fas fa-arrow-right"></i> Apply Now </button>
                      </center>
                    </div>
                  </div>
                </div>
             </div>
    </div>
    <div class="carousel-item" data-interval="5000">
      <div class="admin_container" >
         <div class="row" style="margin: 1% 2%;" id ="info">
             <div id="admin_info" class="col-md-12" style="">
              <div class="vertical-left">
                <h1 style="font-family: 'Zilla Slab';text-align:center"> Give <span style="color: black">feedbacks</span>  for <span style="color: black">candidates</span> using templates </h1>
                 <center>
                   <a class="btn btn-secondary btn-sm" id="register_btn"  type="" href="<?php echo base_url(); ?>Login" style="background-color:#0f50d1;border-color:#0f50d1;padding:5px 40px;font-family:Zilla Slab;font-size:17px"> <i class="fas fa-user"></i> Register </a>
                 </center>
               </div>
             </div>
           </div>
      </div>
    </div>
  </div>
</div>
      <div id="myModal" class="modal">
        <div class="modal-content">
           <button class="btn btn-danger btn-xs" onclick="hideCandidateForm()"> Close</button>
        </div>

      </div>

      <script>
       function showCandidateForm(){
           var modal = document.getElementById("myModal");
               modal.style.display = "block";
         }

         function hideCandidateForm(){
           var modal = document.getElementById("myModal");
               modal.style.display = "none";
         }

       alert("Reminder : In this Web Application, My(Sai Chand Reddy Kamana - 2022785) Part is Homepage, Login and Registration Page, Reviewer Dashboard, Admin Dashboard, Create and Edit Position and Interview.");
      </script>
<style>

body{
  overflow-x: hidden;
  font-family: 'Zilla Slab';
}

.carousel-indicators li {
  background-color: black;

}
.carousel-indicators{
    top:105%;
}

#info{
height:70vh;
}

#register_btn:hover {
  background:yellow;
}

#apply-btn :hover {
  background:yellow;
}

.form-control {
  margin:15px 0;
	border-radius: 5px;
	border-color: #ccc;

}
.form-control :focus{
	box-shadow: none;
	border-color: #5e9bfc;
}

.modal {
  padding-top: 100px;
  left: 0;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0,0.4);
  display: none;
  position: fixed;
  z-index: 1;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;

}

.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 50%;
}

#candidate_info{
  background-image: url("assets/images/Homepage_1_container.jpg");
  background-size: cover;
  background-repeat: no-repeat;
  height:100vh;
}
#admin_info{
  background-image: url("assets/images/homepage_container_2.jpg");
  background-size: cover;
  background-repeat: no-repeat;
  height:100vh;
}
/*###Desktops, big landscape tablets and laptops(Large, Extra large)####*/
@media screen and (min-width: 1024px){
  .vertical-center,.vertical-left {
    width:40%;
    margin: 0;
    position: relative;
    top: 30%;
  }
  .vertical-center{
    left:55%;
  }
  .vertical-left{
    left:0%;
  }
  h1{
    font-size:50px;
  }
}

/*###Tablet(medium)###*/
@media screen and (min-width : 768px) and (max-width : 1023px){
  .vertical-center,.vertical-left  {
    width:100%;
    margin: 0;
    position: relative;
    left:0%;
    top: 30%;
  }
  h1{
    font-size:30px;
  }
}

/*### Smartphones (portrait and landscape)(small)### */
@media screen and (min-width : 0px) and (max-width : 767px){
  .vertical-center,.vertical-left  {
    width:100%;
    margin: 0;
    position: relative;
    left:0%;
    top: 30%;
  }
  h1{
    font-size:20px;
  }
}
</style>
