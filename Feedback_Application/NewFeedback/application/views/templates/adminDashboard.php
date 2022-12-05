<div class="col-md-10" style="background:#f8f8f8;">
  <div class="col-md-12" style="display: flex;">
    <div class="col-md-6" style="display:flex;padding-top:20px">
      <h4>Welcome,<span style="color: #212db4;font-family: 'Zilla Slab';margin-left: 10px;"><?=$user_name?></span></h4>
    </div>
    <div class="col-md-6">
     <?php echo form_open('users/logout');?>
      <button class="btn btn-primary btn-sm" style="float: right;margin-top: 20px;background-color:#ffd100;border:1px solid #ffd100;font-size:17px;font-family:Zilla Slab;"> <b style="padding:5px 25px; color:black"> <i class="fas fa-sign-out-alt"></i> LOG OUT </b> </button>
     </form>
     <?php echo form_open('');?>
       <button class="btn btn-primary btn-sm" style="float: right;margin-top: 20px;background-color: #071d49;border:1px solid #071d49;font-size:17px;font-family:Zilla Slab;margin-right:15px"><b style="padding:5px 25px; color:white"> <i class="fas fa-user-edit"></i> PROFILE </b></button>
     </form>
    </div>
</div>
<div class="col-md-12">
    <table class="table" style="font-size: 18px;border: 1px solid #ddd;margin-top:50px">
      <tr class="" style="background:#001e49ed;color:white">
        <td><b>User Name</b></td>
        <td><b>E Mail ID</b></td>
        <td><b>Roles</b></td>
        <td></td>
      </tr>
      <?php
        foreach($users as $user){
          echo form_open('admin/update');
          echo ' <tr><td><input type="number" style="display:none" value= "'.$user['user_id'].'" name="user_id"/>'.$user['name'].'</td>';
          echo '<td>'.$user['email_id'].'</td>';
          echo '<td style="display:flex"><p style="padding:5px 10px"><input type="checkbox"  id ="user_id_a_"'.$user['user_id'].'" name="is_admin" ';
          if($user['is_admin']){
            echo "checked";
          }
          echo '/> Admin</p><p style="padding:5px 10px"><input type="checkbox" id ="user_id_r_"'.$user['user_id'].'" name="is_reviewer" ';
          if($user['is_reviewer']){
            echo "checked";
          }
          echo '/> Reviewer</p></td>';
          echo '<td><button name="delete" type="submit" class="btn btn-primary btn-sm" style= "float: right;background-color: #e1280b;border: 1px solid #e1280b;font-size: 17px;font-family:Zilla Slab;margin-left: 10px"><b style="padding:5px 25px; color:white;"> DELETE </b></button>';
          echo '<button name="update" id="update" type="submit" class="btn btn-primary btn-sm" style= "float: right;background-color: #ffd100;border: 1px solid #ffd100;font-size: 17px;font-family: Zilla Slab;"><b style="padding:5px 25px; color:black"> UPDATE </b></button>';

          if($user['account_disabled'] == 1){
            echo '<button name="account_update" type="submit" class="btn btn-primary btn-sm" style="float: right;background: #075732;border-color: #075732;margin-right: 10px;font-size: 17px;font-family: Zilla Slab;"><b style="padding:5px 25px; color:white"> Enable Account </b></button>';
          }
          echo '</td></tr></form>';
        }
       ?>
    </table>
</div>
</div>
