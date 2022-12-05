<div class="col-md-10" style="background:#f8f8f8;">
  <div class="col-md-12">
    <table class="table" style="width:90%;margin: 5%;border:1px solid #ddd">
      <tr class="" style="background:#001e49ed;color:white">
        <td>
          <center>
            <b> Create Position </b>
          </center>
        </td>
      </tr>
      <tr>
        <td>
           <center>
            <?php echo validation_errors();?>
            <?php echo form_open('positions/create');?>
            <input type="text" placeholder="Enter Position Name" class="form-control" name="position_name" required />
            <textarea name="editor1"></textarea>
             <script> CKEDITOR.replace('editor1'); </script>
            <input type="number" placeholder="Enter Position Number" class="form-control" name="number_of_positions" required />
             <button type="submit" name="create_position" class="btn btn-primary btn-sm" style="margin-top:10px;background: #001e49ed;border-color: #001e49ed;"> Create </button>
             <a class="btn btn-danger btn-sm" href="<?php echo base_url(); ?>templates" style="margin-top:10px;background:#b62200;border-color:#b62200"> Back </a>
            </center>
          </form>
        </td>
      </tr>
    </table>
