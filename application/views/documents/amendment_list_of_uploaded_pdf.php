<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_documents" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">
      <?php if($is_client) : ?>
      <?php endif;?>
    </h5>
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
<?php if($this->session->flashdata('delete_success')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('delete_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('delete_error')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('delete_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>


<div class="row">

  <div class="col-sm-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="committeesTable">
            <thead>
              <tr>
                <th>#</th>
                <th>FileName</th>
                <th>Date</th>
                <!-- <th>status</th> -->
             	<th></th>
              	
              </tr>
            </thead>
            <tbody>
            <?php if(isset($uploaded_list_pdf)) :?>	
        	<?php $a=1;foreach($uploaded_list_pdf as $row): ?>
              <tr>
                <td> <?=$a++;?></td>
                <td><?=$row['filename']?></td>
                <td><?=date('F-d-Y h:i:s',strtotime($row['created_at']))?></td>
              <!--   <td><?=$row['status']?></td> -->
               
                <td>
                	 
                  <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                  	<a class="btn btn-primary" target="_blank" href="<?php echo base_url();?>amendment/<?=$encrypted_id?>/amendment_documents/view_document_one/<?= encrypt_custom($this->encryption->encrypt($row['filename']))?>/<?=$doc_types?>">View</a>
                    <?php $array_status = array(1,11); ?>
                    <?php if(($is_client) && in_array($coop_info->status,$array_status)): ?>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletePDFModal_amendment" data-doctypess="<?=$row['document_num']?>" data-amendmentid="<?= $encrypted_id ?>" data-comname="<?=$row['filename']?>" data-fname="<?=$row['filename']?>" data-pdfid="<?= encrypt_custom($this->encryption->encrypt($row['id']))?>"><i class='fas fa-trash'></i> Delete</button>
                   <?php endif; ?>
                  </div>
                </td>
             
              </tr>
          <?php endforeach; ?>
      <?php else: echo"<tr><td>No Documents found</td></td>"; ?>
          <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<br>

<h3>New Upload</h3>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="committeesTable2">
            <thead>
              <tr>
                <th>#</th>
                <th>FileName</th>
                <th>Date</th>
                <!-- <th>status</th> -->
             	<th></th>
              	
              </tr>
            </thead>
            <tbody>
            <?php if(isset($defered_uploaded_list_pdf)) :?>	
        	<?php $a=1;foreach($defered_uploaded_list_pdf as $row): ?>
              <tr>
                <td> <?=$a++;?></td>
                <td><?=$row['filename']?></td>
                <td><?=date('F-d-Y h:i:s',strtotime($row['created_at']))?></td>
              <!--   <td><?=$row['status']?></td> -->
               
                <td>
                	 

                  <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                  	<a class="btn btn-primary" target="_blank" href="<?php echo base_url();?>amendment/<?=$encrypted_id?>/amendment_documents/view_document_one/<?= encrypt_custom($this->encryption->encrypt($row['filename']))?>/<?=$doc_types?>">View</a>
                    <?php if($is_client):?>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletePDFModal" data-doctypess="<?=$row['document_num']?>" data-coopid="<?= $encrypted_id ?>" data-comname="<?=$row['filename']?>" data-fname="" data-pdfid="<?= encrypt_custom($this->encryption->encrypt($row['id']))?>"><i class='fas fa-trash'></i> Delete</button>
                     <?php endif;?>   
                  </div>
                </td>
             
              </tr>
          <?php endforeach; ?>
      <?php else: echo"<tr><td>No Documents found</td></td>"; ?>
          <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
