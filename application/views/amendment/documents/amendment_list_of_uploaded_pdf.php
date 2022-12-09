<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>/amendment_documents" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
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
                <td>
                   
                  <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <a class="btn btn-primary" target="_blank" href="<?php echo base_url();?>amendment_update/<?=$encrypted_id?>/amendment_update_documents/view_document_one/<?= encrypt_custom($this->encryption->encrypt($row['filename']))?>/<?=$doc_num?>">View</a>
                    
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletePDFModal_amendment" data-doctypess="<?=$row['document_num']?>" data-amendmentid="<?= $encrypted_id ?>" data-comname="<?=$row['filename']?>" data-fname="<?=$row['filename']?>" data-pdfid="<?= encrypt_custom($this->encryption->encrypt($row['id']))?>"><i class='fas fa-trash'></i> Delete</button>
                 
                  </div>
                </td>
             
              </tr>
          <?php endforeach; ?>
      <?php else: echo"<tr><td colspan='4'>No Documents found</td></td>"; ?>
          <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<br>

