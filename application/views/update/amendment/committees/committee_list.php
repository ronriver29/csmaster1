<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
   <!--  <h5 class="text-primary text-right">
      <?php if($is_client) : ?>
      Step 7
      <?php endif;?>
    </h5> -->
  </div>
</div>
<?php if($this->session->flashdata('committee_redirect')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info text-center" role="alert">
       <?php echo $this->session->flashdata('committee_redirect'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('committee_success')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('committee_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('committee_error')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('committee_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php 
//if($gad_count < 1 || $committees_count_member < 3):

if(!$complete_position):
 ?>

       <div class="col-sm-12 col-md-12">
        <div class="alert alert-info text-justify" role="alert">

           Note:
           <ul>
           
             <?php if($gad_count < 1) echo '<li>There must be 1 GAD member on the list</li>';?>
              <?php if(!$election)
              {

               echo'<li>There must be 1 Election member on the list</li>';
              }

              ?>
              <?php if(!$ethics)
              {
                  echo'<li>There must be 1 Ethics member on the list</li>'; 
              } 
              ?>
              <?php if(!$media_concil)
              {
                echo'<li>There must be 1 Mediation and Conciliation member on the list</li>';
              } 
              ?> 
              <?php if(!$audit)
              {
                echo'<li>There must be 1 Audit member on the list</li>';
              } 
              if(!$credit)
              {
                echo'<li>There must be 1 Credit member on the list</li>';
              }
              ?>   
           </ul>
        </div>
       </div>

<?php endif;?>
<div class="row">
  <?php if(($is_client && $coop_info->status==15) || $this->session->userdata('access_level')==6): ?>
  
    <div class="col-sm-12 offset-md-10 col-md-2 mb-2">
      <a class="btn btn-color-blue btn-block" role="button"href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>/committees_update/add" role="button"><i class="fas fa-plus"></i> Add Committee
      </a>
   
    </div>
  <?php endif; ?>
  <div class="col-sm-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="committeesTable">
            <thead>
              <tr>
                <th>Committee</th>
             
                <th>Action</th>
             
              </tr>
            </thead>
            <tbody>
            <?php foreach($committees as $committee) : ?>
              <tr>
                <td><?= $committee['name']?></td>
                <td>
                  <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                  <?php if(($is_client && $coop_info->status==15) || $this->session->userdata('access_level')==6): ?> 
                    <a href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>/committees_update/<?= encrypt_custom($this->encryption->encrypt($committee['id']))?>/edit" class="btn btn-warning text-white"><i class="fas fa-edit"></i> Edit</a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCommitteeModal" data-comname="<?= $committee['name'] ?>" data-fname="" data-coopid="<?= $encrypted_id ?>" data-committeeid="<?= encrypt_custom($this->encryption->encrypt($committee['id']))?>"><i class='fas fa-trash'></i> Delete</button>
                  <?php endif; ?>
                  </div>
                </td> 
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
