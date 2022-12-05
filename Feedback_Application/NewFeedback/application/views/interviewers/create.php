<div class="col-md-10" style="background:#f8f8f8;">
  <div class="col-md-12">
    <table class="table" style="width:90%;margin: 5%;border:1px solid #ddd">
      <tr class="" style="background:#001e49ed;color:white">
        <td>
          <center>
            <b> Create Interviewer </b>
          </center>
        </td>
      </tr>
      <tr>
        <td>
          <center>
             <div class="col-md-10">
                 <?php echo validation_errors();?>
                 <?php echo form_open('interviewers/create');?>
                   <input type="text" placeholder="Enter Interviewer Name" class="form-control" name="interviewer_name" required />
                   <input type="email" placeholder="Enter Interviewer Mail ID" class="form-control" name="interviewer_mail_id" required />
  		             <button type="submit" name="create_interviewer" class="btn btn-primary btn-sm" style="margin-top:10px;background: #001e49ed;border-color: #001e49ed;"> Create Interviewer </button>
                   <a class="btn btn-danger btn-sm" href="<?php echo base_url(); ?>templates" style="margin-top:10px;background:#b62200;border-color:#b62200"> Back </a>
  	             </form>
           </div>
          </center>
        </td>
      </tr>
    </table>
