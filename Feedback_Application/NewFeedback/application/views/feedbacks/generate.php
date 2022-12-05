<div class="col-md-10" id="generate_container" style="background:#f8f8f8;">
  <div class="col-md-12">
    <table class="table" id="generate_form" style="">
      <tr class="" style="background:#001e49ed">
        <td>
          <center>
            <b style="color:white"> Generate Feedback </b>
          </center>
        </td>
      </tr>
      <tr>
        <td>
            <?php echo form_open('feedbacks/generateFeedback');?>
            <?php if($position->number_of_positions == 0){echo "<p class='alert alert-danger'>Vacancies for this position are already filled. If you need to generate feedback based on this position, then please update the vacancy number for this position.</p>";}?>
            <input id="template_id" name="template_id" style="display:none" class="form-control" value="<?php echo $template -> template_id?>" style="" readonly/>
            <input  name="template_name" class="form-control" value="<?php echo $template -> template_name?>" style="" readonly/>
            <input  name="position_name" class="form-control" value="<?php echo $position -> position_name?>" style="" readonly/>
            <input  name="interviewer_name" class="form-control" value="<?php echo $interviewer -> interviewer_name?>" style="" readonly/>
            <input  name="candidate_mail" class="form-control" value="<?php echo $template -> candidate_mail?>" style="" readonly/>
            <select name="candidate_result" class="form-control" >
              <option value="selected">Selected</option>
              <option value="rejected">Rejected</option>
            </select>
            <div class="row" id="feedback_comments_div">
             <?php foreach($feedback_comments as $index=>$comment):?>
               <?php echo "<div class='col-md-2'><p><input type='checkbox' id='checkbox_".$index."' checked='true' style='margin-right:10px;padding-top:10px' onclick='removeUncheckedOptions(this.id)'/><span id='comment_text_".$index."'>".$comment."</span><button type='button' class='btn btn-primary btn-sm' id='edit_".$index."' onclick='editFeedbackComment(this.id)' style='margin-left:10px;background: #001e49ed;border-color: #001e49ed;'>Edit</button></p></div>";?>
             <?php endforeach;?>
           </div>
            <div class="row" id="add_new_comment" style="display:none">
             <div class="col-md-12" style="">
                 <textarea type="text" id="add_new_comment_text" placeholder="Enter New Comment" class="form-control"  style="margin:0px"></textarea>
                 <button type="button" id="create_option" class="btn btn-primary btn-sm" onclick="addCommentsToTheList()" style="margin:10px 0px 0px 0px;width:100px;background: #001e49ed;border-color: #001e49ed;"> Add </button>
                 <button type="button" id="update_option" class="btn btn-primary btn-sm" onclick="updateCommentToTheList()" style="display:none;margin:10px 0px 0px 0px;width:100px;background: #001e49ed;border-color: #001e49ed;"> Update </button>
               </div>
             </div>
            <button type="button" style="float:left;background: #001e49ed;border-color: #001e49ed;" id="add_new_comment_btn" class="btn btn-primary btn-sm" onclick="showAddComment()"> New Comment </button>
            <br>
            <textarea name="sections" id="sections" style="display:none"><?php echo $template -> feedback_sections; ?></textarea>
            <textarea name="feedback_sections" id="feedback_sections" style="display:none"><?php echo $template -> feedback_sections; ?></textarea>
            <br>
            <button name="generate" id="generate" type="submit" class="btn btn-primary btn-sm" style="margin:10px 0px 0px 0px;width:100px;background: #001e49ed;border-color: #001e49ed;" <?php if($position->number_of_positions == 0){echo "disabled";}?>> Generate </button>
            <a class="btn btn-danger btn-sm" href="<?php echo base_url(); ?>templates" style="margin-top:10px;background:#b62200;border-color:#b62200"> Back </a>
          </form>
        </td>
      </tr>
    </table>
  </div>
</div>
<style>
#generate_form{
  width:90%;
  margin: 5%;
  border:1px solid #ddd;
}
</style>
<script type="text/javascript" src="../assets/JS/create.js"></script>

<script>
  function getPositionDetails(){
    try{
      var p = document.getElementById('position_selected').value;
          p = p.split("--:--");
         CKEDITOR.instances.editor1.setData(p[1]);
         CKEDITOR.instances.editor1.config.readOnly = true;
       }catch(err){}
  }
  getPositionDetails();
  disableGenerateFeedbackBtn();
</script>
