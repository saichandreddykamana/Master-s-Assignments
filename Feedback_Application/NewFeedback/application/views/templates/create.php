<div class="col-md-10" style="background:#f8f8f8;">
  <div class="col-md-12">
    <table class="table" style="width:90%;margin: 5%;border:1px solid #ddd">
      <tr class="" style="background:#001e49ed;color:white">
        <td>
          <center>
            <b> Create Template </b>
          </center>
        </td>
      </tr>
      <tr>
        <td>
          <?php echo validation_errors();?>
          <?php echo form_open('templates/create');?>
            <input title="Enter Template Title" type="text" placeholder="Enter Template Title" class="form-control" name="template_name" required/>

            <input title="Enter candidate mail" placeholder="Enter candidate mail" name="candidate_mail" class="form-control" value="" style="" required/>
            <select title="Select interviewer" name="interviewer_selected" class="form-control" required >
             <?php foreach($interviewers as $interviewer):?>
              <option value="<?php echo $interviewer -> interviewer_id;?>" ><?php echo $interviewer -> interviewer_name; ?></option>
             <?php endforeach;?>
            </select>
            <div class="row" id="feedback_comments_div"></div>
            <br>
            <textarea style="display:none" id="feedback_sections" name="feedback_sections" class="form-control" readonly></textarea>
            <textarea style="display:none" id="sections" name="sections" class="form-control" readonly></textarea>
            <div class="row" id="add_new_comment" style="display:none">
             <div class="col-md-12" style="">
                 <textarea type="text" id="add_new_comment_text" placeholder="Enter New Comment" class="form-control"  style="margin:0px"></textarea>
                 <button type="button" id="create_option" class="btn btn-primary btn-sm" onclick="addCommentsToTheList()" style="margin:10px 0px 0px 0px;width:100px;background: #001e49ed;border-color: #001e49ed;"> Add </button>
                 <button type="button" id="update_option" class="btn btn-primary btn-sm" onclick="updateCommentToTheList()" style="display:none;margin:10px 0px 0px 0px;width:100px;background: #001e49ed;border-color: #001e49ed;"> Update </button>
               </div>
             </div>
            <button type="button" style="float:left;background: #001e49ed;border-color: #001e49ed;" id="add_new_comment_btn" class="btn btn-primary btn-sm" onclick="showAddComment()"> New Comment </button>
            <br>
            <select title="Select Position" id="position_selected" name="position_selected" class="form-control" onchange="getPositionDetails()" required>
             <?php foreach($positions as $position):?>
               <option value='<?php echo $position -> position_id."--:--".$position -> position_description;?>' ><?php echo $position -> position_name; ?></option>
             <?php endforeach;?>
            </select>

            <textarea name="editor1"></textarea>
             <script> CKEDITOR.replace('editor1'); </script>
              <button type="submit" name="create_template" class="btn btn-primary btn-sm" style="margin-top:10px;background: #001e49ed;border-color: #001e49ed;">Create Template</button>
              <a class="btn btn-danger btn-sm" href="<?php echo base_url(); ?>templates" style="margin-top:10px;background:#b62200;border-color:#b62200"> Back </a>
           </form>
        </td>
      </tr>
    </table>
  </div>
</div>
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
</script>
