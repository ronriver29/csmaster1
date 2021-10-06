<?php if($this->session->flashdata('redirect_admin_applications_message')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-warning text-center" role="alert">
       <?php echo $this->session->flashdata('redirect_admin_applications_message'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('add_admin_success')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('add_admin_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('add_admin_error')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('add_admin_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('update_admin_success')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('update_admin_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('update_admin_error')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('update_admin_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('delete_admin_success')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('delete_admin_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('delete_admin_error')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('delete_admin_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <h5 class="text-primary text-right">SMS Allowed Actions - B&S Inside</h5>
  </div>
</div>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

/*tr:nth-child(even) {
  background-color: #dddddd;
}*/
</style>

<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <?php echo form_open('api_settings/bns_inside',array('id'=>'editAdministratorForm','name'=>'editAdministratorForm')); ?>
      <div class="card-body">
        <table>
          <tr>
            <th>Action</th>
            <th>Message</th>
            <th>Allow</th>
          </tr>
          <?php
            foreach($bns_inside_sms_list as $row){
              echo '<tr>';
                echo '<input type="hidden" name="page_id[]" value="'.$row['actionid'].'"/>';
                echo '<td>'.$row['actiondesc'].'</td>';
                echo '<td><textarea type="text" class="form-control" id="message" name="message_'.$row['actionid'].'">'.$row['message'].'</textarea></td>';
                if($row['allowed'] == 1){
                  $checked = 'checked';
                } else {
                  $checked = 0;
                }?>
                <td><input type="checkbox" name="allowed_<?=$row['actionid']?>" <?php if($row['allowed']==1) { echo "checked" ;} else { echo "";}?> /></td>
              <?php echo '</tr>';
            }
          ?>
        </table>
      </div>
      <div class="card-footer editAdministratorFooter"> 
        <input class="btn btn-color-blue btn-block" type="submit" id="editAdministratorBtn" name="editAdministratorBtn" value="Save">
      </div>
    </form>
    </div>
  </div>
</div>
