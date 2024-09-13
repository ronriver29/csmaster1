<style type="text/css">
  #ul-admin {
  list-style-type: none;
  margin: 0;
  padding: 0;
 
  }
  #ul-admin li a{
    text-decoration:none;
    float:right;
   width: auto;
   margin-left: 5px;
  }
</style>
<?php if(!$is_client && $admin_info->access_level == 3 &&  $admin_info->is_director_active == 0) : ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info" role="alert">
        <p><strong>Note: </strong><br>You can only view the documents of a cooperative but you can't evaluate them.<br> To be able to evaluate a cooperative, you must revoke all the authority of the Supervising CDS.</p>
      </div>
    </div>
  </div>
<?php endif;?>
<?php if($this->session->flashdata('redirect_applications_message')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info text-center" role="alert">
       <?php echo $this->session->flashdata('redirect_applications_message'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('list_success_message')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-success text-center" role="alert">
      <?php echo $this->session->flashdata('list_success_message'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('list_error_message')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-danger text-center" role="alert">
      <?php echo $this->session->flashdata('list_error_message'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('delete_admin_success')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('delete_admin_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<center><h3>Search</h3></center>
<div class="portlet-body">
  <?=form_open();?>
    <div class="row">
      <div class="col-md-10">
        <div class="form-group">
          <label for="eAddress">Cooperative Name</label>
          <div id='search'><input type="text" class="form-control" id="coopname" name="coopname"></div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label for="eAddress">Show</label>
          <select class="form-control" id="limit" name="limit" required=""></div>
            <option value="10">10</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="500">500</option>
            <option value="750">750</option>
          </select>
        </div>
      </div>
    </div>
    <center><button type="submit" name="submit" value="submit" class="btn btn-info" >Submit</button></center>
  </form>
</div>
<br>
<?php if(is_array($list_branches)){?>
<div class="row">
  <?php if($is_client) :?>
   <?php if($count_cooperatives->coop_count == 0){?>
  <div class="col-sm-12 offset-md-8 col-md-4 mb-2">
    <a class="btn btn-color-blue btn-block" href="<?php echo base_url();?>cooperatives/reservation" role="button">New Registration</a>
  </div>
  <?php } ?>
  <?php endif; ?>
  <?php if(!$is_client && $admin_info->access_level == 3) : ?>
    <?php if($admin_info->is_director_active == 1) : ?>
    <div class="col-sm-12 offset-md-8 col-md-4 mb-2">
      <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#grantSupervisorModal"><i class='fas fa-user-plus'></i> Grant all Authority to Supervising CDS</button>
    </div>
    <?php else : ?>
      <div class="col-sm-12 offset-md-8 col-md-4 mb-2">
        <button type="button" class="btn btn-warning text-white btn-block" data-toggle="modal" data-target="#revokeSupervisorModal"><i class='fas fa-user-times'></i> Revoke all Authority of Supervising CDS</button>
      </div>
    <?php endif; ?>
  <?php endif;?>
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue shadow-sm mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Name of Laboratory</th>
                <th>Name of Cooperative</th>
                <th>Location</th>
                <?php if(!$is_client) : ?>
                <?php endif;?>
                <th>Status</th>
                <th>Action </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list_branches as $branches) : ?>
                <tr>
                  <td>  <?php echo $branches['laboratoryName']; ?>
                  <td>  <?php echo $branches['coopName']; ?>
                  <td>
                    <?php if($branches['house_blk_no']==null && $branches['streetName']==null) $x=''; else $x=', ';?>
                    <?=$branches['house_blk_no']?> <?=$branches['streetName'].$x?> <?=$branches['brgy']?>, <?=$branches['city']?>, <?= $branches['province']?> <?=$branches['region']?>
                  </td>
                  <td>
                      <span class="badge badge-secondary">
                        <?php if($branches['status']==30 )echo "FOR VALIDATION"; 
                        ?>

                      </span>
                    </td>
                  <?php if($is_client) :?>
                    <td>
                      <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($branches['id'])) ?>" class="btn btn-info"><i class='fas fa-eye'></i> View</a>
                      <?php if($branches['status']<2 || $branches['status']==10|| $branches['status']==11) : ?>
                        <?php if($branches['grouping'] != 'Federation'){?>
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCooperativeModal" data-cname="<?= $branches['proposed_name']?> <?= $branches['type_of_cooperative']?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branches['id']))?>"><i class='fas fa-trash'></i><?php echo ($branches['status']==10 || $branches['status']==11) ? "Delete": "Cancel" ?></button>
                        <?php } else { ?>
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCooperativeModal" data-cname="<?= $branches['proposed_name']?> Federation of <?= $branches['type_of_cooperative']?> Cooperative <?php if(!empty($branches['acronym_name'])){ echo '('.$branches['acronym_name'].')';}?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branches['id']))?>"><i class='fas fa-trash'></i><?php echo ($branches['status']==10 || $branches['status']==11) ? "Delete": "Cancel" ?></button>
                        <?php }?></td>
                      <?php endif;?>
                      </div>
                    </td>
                  <?php endif;?>
                  <?php if(!$is_client) :?>
                    <?php if($branches['status']==30): ?>
                      <td>
                        <a href="<?php echo base_url();?>laboratories_update/<?= encrypt_custom($this->encryption->encrypt($branches['id'])) ?>/view" class="btn btn-info"><i class='fas fa-eye'></i> View Laboratory</a>
                      </td>
                    <?php endif; ?>
                  <?php endif;?> 
                  
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?=$links?>
      </div>
    </div>
<?php } ?>