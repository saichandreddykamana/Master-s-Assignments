<div class="col-md-10" style="background:#f8f8f8;">
  <div class="col-md-12">
    <table class="table" style="width:90%;margin: 5%;border:1px solid #ddd">
      <tr class="" style="background:#001e49ed;color:white">
        <td>
          <center>
            <b> <?php if($is_creator == $interviewer_details -> user_id){ echo "Edit";}?> Interviewer </b>
          </center>
        </td>
      </tr>
      <tr>
        <td>
          <?php echo validation_errors();?>
          <?php echo form_open('interviewers/update');?>
            <input <?php if($is_creator != $interviewer_details -> user_id){ echo "readonly";}?> type="text" name="interviewer_name" class="form-control" value="<?php echo $interviewer_details -> interviewer_name; ?>" <?php if($interviewer_details -> interviewer_id == ''){echo "disabled";}?>/>
            <input <?php if($is_creator != $interviewer_details -> user_id){ echo "readonly";}?> class="form-control" type="text" name="interviewer_mail_id" id="interviewer_mail_id" style="" value="<?php echo $interviewer_details -> interviewer_mail_id;?>" <?php if($interviewer_details -> interviewer_id == ''){echo "disabled";}?>/>
            <button <?php if($is_creator != $interviewer_details -> user_id){ echo "disabled";}?> type="submit" name="update_interviewer" class="btn btn-primary btn-sm" style="margin-top:10px;background: #001e49ed;border-color: #001e49ed;" <?php if($interviewer_details -> interviewer_id == ''){echo "disabled";}?>>Update</button>
            <a class="btn btn-danger btn-sm" href="<?php echo base_url(); ?>templates" style="margin-top:10px;background:#b62200;border-color:#b62200"> Back </a>
          </form>
        </td>
      </tr>
    </table>
  </div>
</div>

  <script type="text/javascript" src="../assets/JS/create.js"></script>
