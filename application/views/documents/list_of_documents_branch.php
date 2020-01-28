<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>branches/<?= $encrypted_branch_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <?php if($is_client) : ?>
    <h5 class="text-primary text-right">
      Step 2
    </h5>
    <?php else :?>
      <?php if($branch_info->status == 23 || $branch_info->status == 24){ ?>
        <div class="btn-group float-right" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveBranchModal"  data-cname="<?= $branch_info->brgy?>, <?= $branch_info->city?> <?= $branch_info->branchName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branch_info->id))?>" >Submit</button>
        <?php if($branch_info->status == 23){ ?>
          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#denyBranchModal" data-cname="<?= $branch_info->brgy?>, <?= $branch_info->city?> <?= $branch_info->branchName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branch_info->id))?>">Deny</button>
          <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#deferBranchModal"  data-cname="<?= $branch_info->brgy?>, <?= $branch_info->city?> <?= $branch_info->branchName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branch_info->id))?>">Defer</button>
        <?php } ?>
        </div>
        <?php } ?>
      <?php if($admin_info->access_level !=5 && $branch_info->status != 23 && $branch_info->status != 24) : ?>
        <div class="btn-group float-right" role="group" aria-label="Basic example">
          <?php if($branch_info->status>=9) echo '<a class="btn btn-info btn-sm" href="'.base_url().'branches/'.$encrypted_branch_id.'/cooperative_tool/branch">Tool</a>';
          ?>
        <?php 
        if($branch_info->status != 18 && $branch_info->status != 23){
            if($admin_info->access_level == 3){
                $submit = 'Approve';
            } else {
                $submit = 'Submit';
            } ?>
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveBranchModal"  data-cname="<?= $branch_info->brgy?>, <?= $branch_info->city?> <?= $branch_info->branchName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branch_info->id))?>" <?php if(($branch_info->tool_yn_answer==null && $branch_info->status>=9 || $branch_info->status>=23)) echo 'disabled';?> ><?=$submit?></button>
            <?php if($admin_info->access_level == 3) {?>
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#denyBranchModal" data-cname="<?= $branch_info->brgy?>, <?= $branch_info->city?> <?= $branch_info->branchName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branch_info->id))?>" <?php if($branch_info->tool_yn_answer==null && $branch_info->status>=9) echo 'disabled';?> >Deny</button>
                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#deferBranchModal"  data-cname="<?= $branch_info->brgy?>, <?= $branch_info->city?> <?= $branch_info->branchName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branch_info->id))?>" <?php if($branch_info->tool_yn_answer==null && $branch_info->status>=9) echo 'disabled';?> >Defer</button>
            <?php } ?>
        <?  } ?>
        </div>
      <?php endif; ?>
  </div>
</div>
<?php if(strlen(($branch_info->comment_by_senior_level1 && $admin_info->access_level==3)) && $branch_info->status == 23) : ?>
    <div class="row mt-3">
      <div class="col-sm-12 col-md-12">
        <div class="alert alert-info" role="alert">
          <p class="font-weight-bold">CDS Comment:</p>
          <pre><?= $branch_info->comment_by_senior_level1 ?></pre>
        </div>
      </div>
    </div>
<?php endif;?>
<?php if(strlen(($branch_info->comment_by_specialist && $admin_info->access_level==2) || $admin_info->access_level==3) && $branch_info->status != 23) : ?>
    <div class="row mt-3">
      <div class="col-sm-12 col-md-12">
        <div class="alert alert-info" role="alert">
          <p class="font-weight-bold">CDS Comment:</p>
          <pre><?= $branch_info->comment_by_specialist ?></pre>
        </div>
      </div>
    </div>
<?php endif;?>
<?php if(strlen($branch_info->comment_by_senior && $admin_info->access_level==3) ||strlen($branch_info->comment_by_senior && $admin_info->access_level==2)) : ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info" role="alert">
        <p class="font-weight-bold">Senior Comment:</p>
        <pre><?= $branch_info->comment_by_senior ?></pre>
      </div>
    </div>
  </div>
<?php endif;?>
<?php if(strlen(($branch_info->temp_evaluation_comment && $admin_info->access_level==3) || ($branch_info->temp_evaluation_comment && $admin_info->access_level==2) || ($branch_info->status == 17))) : ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger" role="alert">
        <p class="font-weight-bold">This cooperative has been deferred because of the following reason/s:</p>
        <pre><?= $branch_info->temp_evaluation_comment ?></pre>
      </div>
    </div>
  </div>
<?php endif;?>
<?php endif; ?>
<?php if($this->session->flashdata('redirect_documents')): ?>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info text-center" role="alert">
        <?php echo $this->session->flashdata('redirect_documents'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('document_5_success')): ?>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info text-center" role="alert">
        <?php echo $this->session->flashdata('document_5_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('document_5_error')): ?>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('document_5_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('document_6_success')): ?>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info text-center" role="alert">
        <?php echo $this->session->flashdata('document_6_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('document_6_error')): ?>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('document_6_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('document_7_success')): ?>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info text-center" role="alert">
        <?php echo $this->session->flashdata('document_7_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('document_7_error')): ?>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('document_7_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>

<div class="row mb-2">
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">By Laws</h5>
        <p class="card-text">This is the cooperative Bylaws. </p>
        <a target="_blank" href="
        <?php if ($branch_info->category_of_cooperative === 'Primary'): ?>
                <?= base_url().'branches/'.$encrypted_id.'/documents/bylaws_primary_branch';?>
        <?php elseif ($branch_info->grouping === 'Union'): ?>
                <?= base_url().'branches/'.$encrypted_id.'/documents/bylaws_union';?>
        <?php else: ?>
                <?= base_url().'branches/'.$encrypted_id.'/documents/bylaws_federation';?>
        <?php endif; ?>
        " class="btn btn-primary">View</a>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Articles of Cooperation</h5>
        <p class="card-text">This is the cooperative Articles of Cooperation</p>
        <a target="_blank" href="
        <?php if ($branch_info->category_of_cooperative === 'Primary'): ?>
                <?= base_url().'branches/'.$encrypted_id.'/documents/articles_cooperation_primary_branch';?>
        <?php elseif ($branch_info->grouping === 'Union'): ?>
                <?= base_url().'branches/'.$encrypted_id.'/documents/articles_cooperation_union';?>
        <?php else: ?>
                <?= base_url().'branches/'.$encrypted_id.'/documents/articles_cooperation_federation';?>
        <?php endif; ?>
        " class="btn btn-primary">View</a>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Treasurer's Affidavit</h5>
        <p class="card-text">This is the cooperative Treasurer's Affidavit.</p>
        <a target="_blank" href="
        <?php if ($branch_info->category_of_cooperative === 'Primary'): ?>
                <?= base_url().'branches/'.$encrypted_id.'/documents/affidavit_primary_bs';?>
        <?php elseif ($branch_info->grouping === 'Union'): ?>
                <?= base_url().'branches/'.$encrypted_id.'/documents/affidavit_union';?>
        <?php else: ?>
                <?= base_url().'branches/'.$encrypted_id.'/documents/affidavit_federation';?>
        <?php endif; ?>
        " class="btn btn-primary">View</a>
      </div>
    </div>
  </div>
</div>
<div class="row mb-2">
<!--  <div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Economic Survey</h5>
          <p class="card-text">This is the cooperative Economic Survey.</p>
          <a target="_blank" href="<?php echo base_url();?>cooperatives/<?=$encrypted_id?>/documents/economic_survey" class="btn btn-primary">View</a>
        </div>
      </div>
  </div>-->
<!--  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Surety Bond of Accountable Officers</h5>
        <p class="card-text">This is the cooperative Surety Bond of Accountable Officers.</p>
            <a target="_blank" href="<?php echo base_url();?>branches/<?=$encrypted_id?>/documents/view_document_one/<?= encrypt_custom($this->encryption->encrypt($document_one->filename))?>" class="btn btn-primary">View</a>
          
      </div>
    </div>
  </div>-->
<!--  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Pre-Registration PRS Certificate</h5>
        <p class="card-text">This is the cooperative Pre-Registration PRS Certificate.</p>
          <a target="_blank" href="<?php echo base_url();?>cooperatives/<?=$encrypted_id?>/documents/view_document_two/<?= encrypt_custom($this->encryption->encrypt($document_two->filename))?>" class="btn btn-primary">View</a>
      </div>
    </div>
  </div>-->
</div>
<?php if($branch_info->type=='Branch') : ?>
<div class="row mb-2">  
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Business Plan</h5>
        <p class="card-text">
          <?php if($document_5) : ?>
<!--            Modify by anjury-->
            <!--<a target="_blank" href="<?php echo base_url();?>branches/<?=$encrypted_id?>/documents/<?=$encrypted_branch_id?>/view_document_5/<?= encrypt_custom($this->encryption->encrypt($document_5->filename))?>">-->
            <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf_branch/<?=$encrypted_branch_id?>/5">
              This is the uploaded Business Plan.
            </a>
          <?php endif ?>
          <?php if(!$document_5) : ?>
            Please upload your Business Plan.
          <?php endif ?>
          <br>
        </p>
        <?php if($is_client && $branch_info->status<=1 || $branch_info->status==17): ?>
          <a href="<?php echo base_url();?>branches/<?=$encrypted_branch_id?>/documents/upload_document_5" class="btn btn-primary">Upload</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">G.A. Resolution</h5>
        <p class="card-text">
          <?php if($document_6) : ?>
            <!--Modify by anjury-->
            <!--<a target="_blank" href="<?php echo base_url();?>branches/<?=$encrypted_id?>/documents/<?=$encrypted_branch_id?>/view_document_6/<?= encrypt_custom($this->encryption->encrypt($document_6->filename))?>">-->
            <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf_branch/<?=$encrypted_branch_id?>/6">
              This is the uploaded G.A. Resolution.
            </a>
          <?php endif ?>
          <?php if(!$document_6) : ?>
            Please upload your G.A. Resolution.
          <?php endif ?>
          <br>
        </p>
        <?php if($is_client && $branch_info->status<=1 || $branch_info->status==17): ?>
          <a href="<?php echo base_url();?>branches/<?=$encrypted_branch_id?>/documents/upload_document_6" class="btn btn-primary">Upload</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Certification</h5>
        <p class="card-text">
          <?php if($document_7) : ?>
            <!--Modify by anjury-->
            <!--<a target="_blank" href="<?php echo base_url();?>branches/<?=$encrypted_id?>/documents/<?=$encrypted_branch_id?>/view_document_7/<?= encrypt_custom($this->encryption->encrypt($document_7->filename))?>">-->
            <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf_branch/<?=$encrypted_branch_id?>/7">
            This is the uploaded Certification.
            </a>
          <?php endif ?>
          <?php if(!$document_7) : ?>
            Please upload your Certification.
          <?php endif ?>
          <br>
        </p>
        <?php if($is_client && $branch_info->status<=1 || $branch_info->status==17): ?>
          <a href="<?php echo base_url();?>branches/<?=$encrypted_branch_id?>/documents/upload_document_7" class="btn btn-primary">Upload</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<div class="row">
    <!-- <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">AFS</h5>
        <p class="card-text">
          <?php if($document_7) : ?>
            <a target="_blank" href="<?php echo base_url();?>branches/<?=$encrypted_id?>/documents/<?=$encrypted_branch_id?>/view_document_8/<?= encrypt_custom($this->encryption->encrypt($document_7->filename))?>">
              This is the uploaded Certification.
            </a>
          <?php endif ?>
          <?php if(!$document_7) : ?>
            Please upload your Certification.
          <?php endif ?>
          <br>
        </p>
        <?php if($is_client && $branch_info->status<=1 || $branch_info->status==17): ?>
          <a href="<?php echo base_url();?>branches/<?=$encrypted_branch_id?>/documents/upload_document_8" class="btn btn-primary">Upload</a>
        <?php endif; ?>
      </div>
    </div>
  </div> -->

  <div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Audited Financial Statement</h5>
          <p class="card-text">This is the cooperative Audited Financial Statement for 3 years.</p>
          <a target="_blank" href="">View</a>
        </div>
      </div>
  </div>
</div>
  <?php else :?>
<div class="row mb-2"> 
<!--  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Business Plan</h5>
        <p class="card-text">
          <?php if($document_5) : ?>
            <a target="_blank" href="<?php echo base_url();?>branches/<?=$encrypted_id?>/documents/<?=$encrypted_branch_id?>/view_document_5/<?= encrypt_custom($this->encryption->encrypt($document_5->filename))?>">
              This is the uploaded Document 1.
            </a>
          <?php endif ?>
          <?php if(!$document_5) : ?>
            Please upload the Document 1.
          <?php endif ?>
          <br>
        </p>
        <?php if($is_client && $branch_info->status<=1): ?>
          <a href="<?php echo base_url();?>branches/<?=$encrypted_branch_id?>/documents/upload_document_5" class="btn btn-primary">Upload</a>
        <?php endif; ?>
      </div>
    </div>
  </div>-->
<!--  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">G.A Resolution</h5>
        <p class="card-text">
          <?php if($document_6) : ?>
            <a target="_blank" href="<?php echo base_url();?>branches/<?=$encrypted_id?>/documents/<?=$encrypted_branch_id?>/view_document_6/<?= encrypt_custom($this->encryption->encrypt($document_6->filename))?>">
              This is the uploaded Document 2.
            </a>
          <?php endif ?>
          <?php if(!$document_6) : ?>
            Please upload the Document 2.
          <?php endif ?>
          <br>
        </p>
        <?php if($is_client && $branch_info->status<=1): ?>
          <a href="<?php echo base_url();?>branches/<?=$encrypted_branch_id?>/documents/upload_document_6" class="btn btn-primary">Upload</a>
        <?php endif; ?>
      </div>
    </div>
  </div>-->
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Certification</h5>
        <p class="card-text">
          <?php if($document_7) : ?>
            <!--Modify by anjury-->
            <!--<a target="_blank" href="<?php echo base_url();?>branches/<?=$encrypted_id?>/documents/<?=$encrypted_branch_id?>/view_document_7/<?= encrypt_custom($this->encryption->encrypt($document_7->filename))?>">-->
            <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf_branch/<?=$encrypted_branch_id?>/7">
                This is the uploaded Document 1.
            </a>
          <?php endif ?>
          <?php if(!$document_7) : ?>
            Please upload the Document 1.
          <?php endif ?>
          <br>
        </p>
        <?php if($is_client && $branch_info->status<=1 || $branch_info->status==17): ?>
          <a href="<?php echo base_url();?>branches/<?=$encrypted_branch_id?>/documents/upload_document_7" class="btn btn-primary">Upload</a>
        <?php endif; ?>
      </div>
    </div>
  </div>  
<!--</div>-->
<!--<div class="row">-->
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Certificate of Compliance</h5>
        <p class="card-text">
          <?php if($document_8) : ?>
            <!--<a target="_blank" href="<?php echo base_url();?>branches/<?=$encrypted_id?>/documents/<?=$encrypted_branch_id?>/view_document_8/<?= encrypt_custom($this->encryption->encrypt($document_8->filename))?>">-->
            <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf_branch/<?=$encrypted_branch_id?>/8">
              This is the uploaded Document 2.
            </a>
          <?php endif ?>
          <?php if(!$document_8) : ?>
            Please upload the Document 2.
          <?php endif ?>
          <br>
        </p>
        <?php if($is_client && $branch_info->status<=1 || $branch_info->status==17): ?>
          <a href="<?php echo base_url();?>branches/<?=$encrypted_branch_id?>/documents/upload_document_8" class="btn btn-primary">Upload</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Oath of Undertaking</h5>
        <p class="card-text">
          <?php if($document_9) : ?>
            <!--<a target="_blank" href="<?php echo base_url();?>branches/<?=$encrypted_id?>/documents/<?=$encrypted_branch_id?>/view_document_9/<?= encrypt_custom($this->encryption->encrypt($document_9->filename))?>">-->
            <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf_branch/<?=$encrypted_branch_id?>/9">
              This is the uploaded Document 3.
            </a>
          <?php endif ?>
          <?php if(!$document_9) : ?>
            Please upload the Document 3.
          <?php endif ?>
          <br>
        </p>
        <?php if($is_client && $branch_info->status<=1 || $branch_info->status==17): ?>
          <a href="<?php echo base_url();?>branches/<?=$encrypted_branch_id?>/documents/upload_document_9" class="btn btn-primary">Upload</a>
        <?php endif; ?>
      </div>
    </div>
  </div> 
</div>
<?php endif; ?>  
