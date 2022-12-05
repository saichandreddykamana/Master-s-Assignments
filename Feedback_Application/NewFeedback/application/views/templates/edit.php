<div class="col-md-10" style="background:#f8f8f8;">
  <div class="col-md-12">
    <table class="table" style="width:90%;margin: 5%;border:1px solid #ddd">
      <tr class="" style="background:#001e49ed;color:white">
        <td>
          <center>
            <b> Edit Template </b>
          </center>
        </td>
      </tr>
      <tr>
        <td>
          <?php echo form_open('templates/update');?>
            <input class="form-control" type="hidden" name="selected_template_name" value="<?php echo $template_details -> template_id?>" disabled="true" style="width: -webkit-fill-available;"/>
            <input class="form-control"  <?php if($template_details -> template_id == '') echo "disabled";?> type="text" name="name_selected" value="<?php echo $template_details -> template_name?>" style="width: -webkit-fill-available;" required/>
            <select name="interviewer_selected" class="form-control"  <?php if($template_details -> template_id == '') echo "disabled";?>>
              <?php foreach($interviewers as $interviewer):?>
               <option value="<?php echo $interviewer -> interviewer_id;?>" <?php echo ($template_details -> interviewer_id == $interviewer -> interviewer_id) ? 'selected' : ''; ?>><?php echo $interviewer -> interviewer_name; ?></option>
              <?php endforeach;?>
            </select>
            <input class="form-control" type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" <?php if($template_details -> template_id == '') echo "disabled";?> name="mail_selected" value="<?php echo $template_details -> candidate_mail?>" style="width: -webkit-fill-available;" required/>
          <div class="row" id="feedback_comments_div">
             <?php foreach($feedback_comments as $index=>$comment):?>
               <?php echo "<div class='col-md-4'><p><input type='checkbox' id='checkbox_".$index."' checked='true' style='margin-right:10px;padding-top:10px' onclick='removeUncheckedOptions(this.id)'/><span id='comment_text_".$index."'>".$comment."</span><button type='button' class='btn btn-primary btn-sm' id='edit_".$index."' onclick='editFeedbackComment(this.id)' style='margin-left:10px;background: #001e49ed;border-color: #001e49ed;'>Edit</button></p></div>";?>
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
            <textarea class="form-control" name="sections" id="sections" style="display:none"><?php echo $template_details -> feedback_sections; ?></textarea>
            <textarea class="form-control" name="feedback_sections" id="feedback_sections" style="display:none"><?php echo $template_details -> feedback_sections; ?></textarea>
            <br>
            <select name="position_selected" id="position_selected" class="form-control" onchange="getPositionDetails()" <?php if($template_details -> template_id == '') echo "disabled";?>>
              <?php foreach($positions as $position):?>
               <option value='<?php echo $position -> position_id."--:--".$position -> position_description;?>' <?php echo ($template_details -> position_id == $position -> position_id) ? 'selected' : ''; ?>><?php echo $position -> position_name; ?></option>
              <?php endforeach;?>
            </select>
            <textarea name="editor1"></textarea>
             <script> CKEDITOR.replace('editor1'); </script>
            <button type="submit" name="update_template" class="btn btn-primary btn-sm"  <?php if($template_details -> template_id == '') echo "disabled";?> style="margin-top:10px;background: #001e49ed;border-color: #001e49ed;">Update</button>
            <a class="btn btn-danger btn-sm" href="<?php echo base_url(); ?>templates" style="margin-top:10px;background:#b62200;border-color:#b62200"> Back </a>
          </form>
          <br>
          <?php echo form_open('templates/delete_temp');?>
           <center>
             <p class="alert alert-danger" style="width: 70%;margin: 0 15%;"> Once the template is deleted cannot be restored
                <button type="submit" name="delete_template" class="btn btn-danger btn-sm" style="background:#b62200;border-color:#b62200" <?php if($template_details -> template_id == '') echo "disabled";?>>Delete</button>
              </p>
           </center>
          </form>
        </td>
      </tr>
    </table>
<script type="text/javascript" src="../assets/JS/create.js"></script>
<<script> getSelectedOptions('feedback_sections'); </script>
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
</script>
