<div class="col-md-10" style="background:#f8f8f8;">
  <div class="col-md-12">
    <table class="table" style="width:90%;margin: 5%;border:1px solid #ddd">
      <tr class="" style="background:#001e49ed;color:white">
        <td>
          <center>
            <b> Generate Feedback </b>
          </center>
        </td>
      </tr>
      <tr>
        <td>
          <center>
            <button type="button" class="btn btn-primary btn-sm" style="background: #001e49ed;border-color: #001e49ed;margin-bottom:0px"> View Candidate Resume </button>
          </center>
          <?php echo validation_errors();?>
          <?php echo form_open('feedbacks/generateFeedbacks');?>
          <select name="selected_template_id" id="selected_template_id" class="form-control" onchange="getSelectedTemplate()">
            <?php foreach($templates as $template):?>
              <option value="<?php echo $template -> template_id;?>"><?php echo $template -> template_name; ?></option>
            <?php endforeach;?>
          </select>
            <input type="text" id="selected_company_name" name="selected_company_name" class="form-control" readonly value="<?php echo $position -> company_name?>"/>
          <input type="text" id="selected_position_name" name="selected_position_name" class="form-control" readonly value="<?php echo $position -> position_name?>"/>
          <textarea id="selected_position_description" name="selected_position_description" class="form-control" style="display:none"><?php echo $position -> position_description?></textarea>
          <p class="alert alert-danger" style="<?php if($position -> number_of_positions == 0){ echo "display:block";}else{echo "display:none";}?>"> All Vacancies are filled for this position </p>
          <textarea name="editor1"></textarea>
           <script> CKEDITOR.replace('editor1'); </script>
        <textarea style="display:none" id="feedback_sections" name="feedback_sections" class="form-control" readonly><?php echo $template -> feedback_sections ?></textarea>

        <div class="row" id="selected_feedback_options" style="display:none;margin-left:10px"></div>
         <div class="row" id="add_new_comment" style="display:none">
          <div class="col-md-12" style="">
              <input type="text" id="add_new_comment_text" placeholder="Enter New Comment" class="form-control"  style="margin:0px"/>
              <button name="create_option" type="button" class="btn btn-primary btn-sm" onclick="addCommentsToTheList()" style="margin:10px 0px 0px 0px;;background: #001e49ed;border-color: #001e49ed;"> Add </button>
            </div>
          </div>
          <br>
         <button type="button" style="float:left;background: #001e49ed;border-color: #001e49ed;" id="add_new_comment_btn" class="btn btn-primary btn-sm" onclick="showAddComment()"> Add New Comment </button>
         <br><br>
         <select name="candidate_interviewer" id="candidate_interviewer" class="form-control">
           <?php foreach($interviewers as $interviewer):?>
             <option value='<?php echo $interviewer -> interviewer_id;?>' ><?php echo $interviewer -> interviewer_name; ?></option>
           <?php endforeach;?>
         </select>
       <select class="form-control"  name="candidate_result">
         <option value="Approved"> Approved </option>
         <option value="Rejected"> Rejected </option>
       </select>
       <input type="text" class="form-control"  name="candidates_mails" value="<?php echo $candidate_mail; ?>" readonly/>
       <textarea class="form-control"  name="extra_comments" rows="5" placeholder="Enter Extra Comments"></textarea>
        <button type="submit" name="generate_feedback" class="btn btn-primary btn-sm" style="margin-top:10px;background: #001e49ed;border-color: #001e49ed;" <?php if($position -> number_of_positions == 0){echo "disabled";}?>>Generate Feedback</button>
         <a class="btn btn-danger btn-sm" href="<?php echo base_url(); ?>templates" style="margin-top:10px;background:#b62200;border-color:#b62200"> Back </a>
       </form>
        </td>
      </tr>
    </table>
  </div>
</div>
<script type="text/javascript" src="../assets/JS/create.js"></script>
<script> getSelectedOptions('feedback_sections'); </script>
<script>
function getPositionDetails(){
  try{
    var p = document.getElementById('selected_position_description').value;
       CKEDITOR.instances.editor1.setData(p);
       CKEDITOR.instances.editor1.config.readOnly = true;
     }catch(err){}
}
getPositionDetails();

function getSelectedTemplate(){
  try{
  var id = "selected_template_id";
  var value = document.getElementById(id).value;
      value = value.split(':');
      var options = document.getElementById('feedback_selected').options;
      for(var i = 0 ; i < options.length ; i++){
        var val = options[i].value;
        val = val.split(':');
        if(val[0] == value[1]){
          document.getElementById('feedback_selected').value = options[i].value;
          getSelectedOptions('feedback_selected');
          break;
        }
      }
    }catch(err){
      alert(err);
    }
}
</script>
