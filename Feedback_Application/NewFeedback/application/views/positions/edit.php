<div class="col-md-10" style="background:#f8f8f8;">
  <div class="col-md-12">
    <table class="table" style="width:90%;margin: 5%;border:1px solid #ddd">
      <tr class="" style="background:#001e49ed;color:white">
        <td>
          <center>
            <b> Edit Position </b>
          </center>
        </td>
      </tr>
      <tr>
        <td>
          <?php echo validation_errors();?>
          <?php echo form_open('positions/update');?>
            <input type="text" placeholder="Enter Position Name" class="form-control" value="<?php echo $position -> position_name; ?>" <?php if($position -> position_id == ''){ echo "disabled";} ?>  name="position_name" required />
             <textarea  name="editor1"><?php echo $position -> position_description;?></textarea>
             <script> CKEDITOR.replace('editor1'); </script>
            <input type="number" placeholder="Enter Position Number" class="form-control" name="number_of_positions" value="<?php echo $position -> number_of_positions; ?>" <?php if($position -> position_id == ''){ echo "disabled";} ?>  required />
            <button type="submit" name="create_position" class="btn btn-primary btn-sm" style="margin-top:10px;background: #001e49ed;border-color: #001e49ed;" <?php if($position -> position_id == ''){ echo "disabled";} ?> > Update </button>
            <a class="btn btn-danger btn-sm" href="<?php echo base_url(); ?>templates" style="margin-top:10px;background:#b62200;border-color:#b62200"> Back </a>
          </form>
        </td>
      </tr>
    </table>
  </div>
</div>
  <script type="text/javascript" src="../assets/JS/create.js"></script>
