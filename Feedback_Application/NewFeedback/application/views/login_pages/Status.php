<div class="candidate_status_container" style="margin-bottom:100px;margin-top:30px">
  <div class="row" style="width:100%">
    <div class="col-md-12">
      <table class="table">
        <tr>
          <td style="border:none">
            <center>
              <h2 style="font-family:Zilla Slab"><span style="background:#ffd100;padding:5px 40px;border-radius:3px;">Candidate Status</span></h2>
            </center>
          </td>
        </tr>
        <tr>
          <td style="border:none">
            <center>
              <div class="col-md-10" style="padding:5px 140px">
              <form>
                <input type="email" name="candidate_email" class="form-control" placeholder="Enter Candidate Email ID" maxlength="50" title="Must be like user@example.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required/>
                <button type="submit" class="btn btn-primary btn-sm" style="padding:5px 30px;background-color:#0f50d1;border:1px solid #0f50d1;font-size:16px;margin-top:20px"> <i class="fas fa-arrow-circle-right"></i> Track Application </button>
              </form>
              <table class="table" style="margin-top:30px;border: 1px solid #0f50d1" >
                  <tr class="table-primary">
                    <td style="background: #0f50d1;color: white;"> <center> <h5> Position </h5> </center> </td>
                    <td style="background: #0f50d1;color: white;"> <center> <h5> Application Status </h5> </center> </td>
                  </tr>
                  <tr style="display:<?php if(count($candidate_list) == 0){ echo 'contents';}else{echo 'none';} ?>">
                    <td> <center>Please Enter Candidate Mail - No Applications Available </center></td>
                    <td></td>
                  </tr>
                  <?php foreach($candidate_list as $candidate):?>
                   <tr style="border: 1px solid #071d49;">
                     <td style="border:none">
                       <center>
                         <?php echo $candidate -> candidate_position;?>
                       </center>
                     </td>
                     <td style="border:none">
                       <center>
                         <?php echo $candidate -> candidate_status;?>
                       </center>
                     </td>
                   </tr>
                  <?php endforeach;?>
              </table>
            </div>
          </center>
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>
<style>
body{
  font-family:Zilla Slab;
}
.form-control {
	border-radius: 0;
	border-color: #ccc;
   	border-width: 0 0 2px 0;
   	border-style: none none solid none;
   	box-shadow: none;
}
.form-control :focus{
	box-shadow: none;
	border-color: #5e9bfc;
}
</style>
