
<div class="login_register_container" style="padding:120px 60px">
  <div class="row" style="width:100%">
    <div class="col-md-5" style="border-right: 1px solid #ddd;padding-top: 3px;">
        <table class="table">
           <tr>
             <td style="border:none">
                <center> <h3 style=""> <span style="padding:5px 100px;background:#ffcf00;border-radius:3px"> Login </span> </h3> </center>
             </td>
           </tr>
           <tr>
             <td style="border:none">
               <center>
                  <div class="col-md-10">
                    <?php echo form_open('users/login');?>
                     <input type="email" name="login_email" class="form-control" placeholder="E-Mail Address" maxlength="50" title="Must be like user@example.com" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required value="<?php echo $login_email;?>"/>
                     <div style="display:flex">
                       <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="login_password" id="login_password" class="form-control" placeholder="Password" title="Must contain 8 or more characters that are of at least one number, and one uppercase and lowercase letter" required />
                       <i class="far fa-eye" id="togglePassword" style="margin-top: 20px;margin-left: -20px;cursor:pointer;color:#848282" onclick="changePasswordView('login_password','togglePassword')"></i>
                     </div>
                     <center>
                       <br>
                       <button type="submit" class="btn btn-primary btn-sm" name="submit" style="background: #0f50d1;border-color:#0f50d1;font-family:Zilla Slab;font-size:20px;width:170px;margin-top: 40px;"> <i class="fas fa-sign-in-alt" style="font-size:17px;margin-right: 5px;"></i> Login </button>
                     </center>
                     <?php
                     if($login_status == 'failed'){
                       echo '<p class="alert alert-danger" style="margin-top:20px;display:block"> Check Username or Password  </p>';
                     }
                     if($login_status == 'locked'){
                       echo '<p class="alert alert-danger" style="margin-top:20px;display:block"> Your Account is locked. Please contact admin to active the account. </p>';
                     }
                     ?>
                    </form>
                  </div>
              </center>
             </td>
           </tr>
        </table>
    </div>
    <div class="col-md-7">
      <table class="table">
         <tr>
           <td style="border:none">
              <center> <h3 style=""> <span style="padding:5px 100px;background:#ffd100;border-radius:3px"> Register </span> </h3> </center>
           </td>
         </tr>
         <tr>
           <td style="border:none">
             <center>
                <div class="col-md-10">
                  <?php echo form_open('users/register_user');?>
                    <div class="row" style="display:block">
                      <div class="col-md-12" style="display:inline-flex">
                       <input type="text" name="register_fname" class="form-control" placeholder="First Name" value="<?php echo $register_fname;?>" maxlength="50" required style="margin-right:5px"/>
                       <input type="text" name="register_lname" class="form-control" placeholder="Last Name" value="<?php echo $register_lname;?>" maxlength="50" required/>
                      </div>
                      <div class="col-md-12" style="display:inline-flex">
                         <input type="email" name="register_email" class="form-control" placeholder="E-Mail Address" value="<?php echo $register_email;?>" maxlength="50" style="margin-right:5px" title="Must be like user@example.com" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required/>
                      </div>
                      <div class="col-md-12" style="display:inline-flex">
                        <div  class="col-md-6" style="display:flex">
                        <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="register_password" id="register_password" class="form-control" placeholder="Password" title="Must contain 8 or more characters that are of at least one number, and one uppercase and lowercase letter" style="margin-right:5px" required/>
                         <i class="far fa-eye" id="registertogglePassword" style="margin-top: 20px;margin-left: -20px;cursor:pointer;color:#848282" onclick="changePasswordView('register_password','registertogglePassword')"></i>
                       </div>
                       <div  class="col-md-6" style="display:flex">
                       <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="register_cpassword" id="register_cpassword" class="form-control" placeholder="Confirm Password" title="Must contain 8 or more characters that are of at least one number, and one uppercase and lowercase letter" required/>
                        <i class="far fa-eye" id="registerctogglePassword" style="margin-top: 20px;margin-left: -20px;cursor:pointer;color:#848282" onclick="changePasswordView('register_cpassword','registerctogglePassword')"></i>
                      </div>
                     </div>
                   </div>
                    <center>
                      <br>
                       <button type="submit" class="btn btn-primary btn-sm" name="submit" style="background:#0f50d1;border-color:#0f50d1;font-family:Zilla Slab;font-size:20px;width:170px"> <i class="fas fa-arrow-circle-right" style="color:white;font-size:17px;margin-right:5px"></i> Register </button>
                    </center>
                    <?php
                        if($login_status == 'register failed'){
                          echo '<p class="alert alert-danger" style="margin-top:20px;display:block"> You may already have an account with us or Please check the details you entered. </p>';
                        }
                    ?>
                  </form>
                </div>
            </center>
           </td>
         </tr>
      </table>
    </div>
  </div>
</div>
<style>
body{
  font-family:Zilla Slab;
}
.form-control {
   margin: 12px 0;
 	 border-radius: 0;
	 border-color: #ccc;
   	border-width: 0 0 2px 0;
   	border-style: none none solid none;
   	box-shadow: none;
}

.form-control :focus{
	  box-shadow: none;
  	border-color: #5e9bfc;
}
</style>
<script type="text/javascript">
function changePasswordView(inputId,iconId){
  var id = document.getElementById(inputId);
  if(id.type == 'password'){
    id.type = 'text';
    document.getElementById(iconId).className = 'far fa-eye-slash';
  }else{
    id.type = 'password';
    document.getElementById(iconId).className = 'far fa-eye';
  }
}
</script>
