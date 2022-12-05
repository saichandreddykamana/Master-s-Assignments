<div class="col-md-10" style="background:#f8f8f8;">
  <div class="col-md-12">
    <table class="table" style="width:90%;margin: 5%;border:1px solid #ddd">
      <tr class="" style="background:#001e49ed;color:white">
        <td>
          <center>
            <b> Edit Profile </b>
          </center>
        </td>
      </tr>
      <tr>
        <td>
          <?php echo validation_errors();?>
          <?php echo form_open('users/updateProfile');?>
            <input  type="text" name="first_name" class="form-control" value="<?php echo $user_details -> first_name; ?>" <?php if($user_details -> user_id == ''){echo "disabled";}?>/>
            <input  type="text" name="last_name" class="form-control" value="<?php echo $user_details -> last_name; ?>" <?php if($user_details -> user_id == ''){echo "disabled";}?>/>
            <input  type="text" name="e-mail" class="form-control" value="<?php echo $user_details -> email_id; ?>" <?php if($user_details -> user_id == ''){echo "disabled";}?>/>

            <button  type="submit" name="update_interviewer" class="btn btn-primary btn-sm" style="margin-top:10px;background: #001e49ed;border-color: #001e49ed;">Update</button>
            <a class="btn btn-danger btn-sm" href="<?php echo base_url(); ?>templates" style="margin-top:10px;background:#b62200;border-color:#b62200"> Back </a>
          </form>
        </td>
      </tr>
    </table>
  </div>
</div>

  <script type="text/javascript" src="../assets/JS/create.js"></script>
