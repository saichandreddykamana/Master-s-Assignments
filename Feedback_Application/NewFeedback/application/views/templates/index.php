<div class="col-md-10" style="background:#f8f8f8;">
    <div class="col-md-12" style="display: flex;">
      <div class="col-md-6" style="display:flex;padding-top:20px">
       <h4>Welcome,<span style="color: #212db4;font-family: 'Zilla Slab';margin-left: 10px;"><?=$user_name?></span></h4>
      </div>
      <div class="col-md-6">
       <?php echo form_open('users/logout');?>
        <button class="btn btn-primary btn-sm" style="float: right;margin-top: 20px;background-color:#ffd100;border:1px solid #ffd100;font-size:17px;font-family:Zilla Slab;"> <b style="padding:5px 25px; color:black"> <i class="fas fa-sign-out-alt"></i> LOG OUT </b> </button>
       </form>
       <?php echo form_open('users/editProfile');?>
         <button class="btn btn-primary btn-sm" style="float: right;margin-top: 20px;background-color: #071d49;border:1px solid #071d49;font-size:17px;font-family:Zilla Slab;margin-right:15px"><b style="padding:5px 25px; color:white"> <i class="fas fa-user-edit"></i> PROFILE </b></button>
       </form>
      </div>
    </div>
    <?php if($is_admin == 1){
      echo '<div class="row" style="margin-top:0px"><div class="col-md-6"><form action="positions/edit" method="POST"><select name="position_selected" class="form-control" id="position_selected" onchange="disablePositionBtn()"><option value="N/A"> Select Position </option>';
        foreach($positions as $position){
          echo '<option value="'.$position -> position_id.'" >'.$position -> position_name.'</option>';
        }
      echo '</select>';
      echo '<button id="selected_position_btn" type="submit" style="background: #001e49ed;border-color: #001e49ed;" class="btn btn-primary btn-sm" disabled ="true"> <i class="fas fa-edit"></i>&nbsp; Edit Position </button></form></div>';
      echo '<div class="col-md-6"><form action="interviewers/edit" method="POST"><select name="interviewer_selected" class="form-control" id="interviewer_selected" onchange="disableInterviewerBtn()"><option value="N/A"> Select Interviewer </option>';
       foreach($interviewers as $interviewer){
         echo '<option value="'.$interviewer -> interviewer_id.'">'.$interviewer -> interviewer_name.'</option>';
       }
      echo '</select><button id="selected_interviewer_btn" type="submit" class="btn btn-primary btn-sm" style="background: #001e49ed;border-color: #001e49ed;" disabled ="true"> <i class="fas fa-edit"></i>&nbsp;Edit Interviewer </button></form></div></div>';
    }
    ?>
    <?php if($is_reviewer == 1){
     echo '<div class="col-md-12" style="margin-top:80px;"><form action="templates/edit" method="POST"><select name="template_selected" class="form-control" id="template_selected" onchange="disableTemplateBtn()" style="margin:1% 0"><option value="select_template"> Select Template </option>';
            foreach($templates as $template){
              echo ' <option value="'.$template -> template_id.'" >'. $template -> template_name.'</option>';
            }
     echo '</select>';
     echo '<button id="selected_template_btn" style="background: #001e49ed;border-color: #001e49ed;" type="submit" disabled ="true" class="btn btn-primary btn-sm" > <i class="fas fa-edit"></i>&nbsp; Edit Template </button></form><div style="width: 200px;margin-left: 140px;margin-top: -30px;">';
     echo '<form action="feedbacks/generate" method="POST">';
     echo '<input type="text" id="selected_template_id" name="selected_template_id" style="display:none"/><button id="generate_feedback_btn" style="background:#075732;border-color:#075732" type="submit" disabled ="true" class="btn btn-success btn-sm"> <i class="fas fa-plus-square"></i>&nbsp; Generate Feedback </button> </form></div></div>';
     echo '<div class="col-md-12" style="margin-top:2%;"><table class="table" style="font-size: 18px;border: 1px solid #ddd;"><tr class="" style="background:#001e49ed;color:white"><td><b>Candidates Name</b></td><td><b>Candidates Mail</b></td><td><b>Position</b></td><td><b>Status</b></td><td></td></tr><tr style="display:';
           if(count($candidates) == 0){
             echo 'contents';
           }else{
             echo 'none';
           }
           echo'"><td>  No Candidates Applied </td><td></td><td></td><td></td></tr>';
          $count = -1;
         foreach($candidates as $candidate){
           $count++;
           echo '  <tr><td>'.$candidate -> candidate_name.'</td><td>'.$candidate -> candidate_mail.'</td><td>'.$candidate -> candidate_position_name.'</td><td>'.$candidate -> candidate_status.'</td><td style=""><textarea type="text" id="candidate_resume" style="display:none" >'.$candidate -> candidate_resume.'</textarea><form action="feedbacks/createTemplateForCandidate" method="POST"><input style="display:none" readonly class="form-control" name="candidate_id" value="'.$candidate -> candidate_id.'"/><input style="display:none" readonly class="form-control" name="candidate_position_id" value="'.$candidate -> candidate_position.'"/><button class="btn btn-primary btn-sm" style="background:#198754;border-color:#198754"> <i class="fas fa-plus-square"></i>&nbsp; Generate Feedback </button></form></td></tr>';
         }
       echo '</table> </div>';
    }
    ?>
  </div>
 </div>
</div>
<style>
   .form-control{
    appearance: menulist;
   }
</style>
<script type="text/javascript" src="<?php echo base_url();?>assets/JS/create.js"></script>
