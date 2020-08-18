<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <?php if($is_client) : ?>
    <h5 class="text-primary text-right">
      Step 10
    </h5> 
  <?php else :?>
    <?php if ($coop_info->status !=12){?>
    <?php if($admin_info->access_level != 3 && $admin_info->access_level != 4){
            $submit = 'Submit';
        } else {
            $submit = 'Approve';
        }?>

    <?php if($admin_info->access_level !=5) : ?>
      <?php if($coop_info->status !=15):?>
      <div class="btn-group float-right" role="group" aria-label="Basic example">
        <a  class="btn btn-info btn-sm" href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/cooperative_tool">Tool</a>
        <?php if($admin_info->access_level ==2 || $is_active_director || $supervising_): ?>
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveCooperativeModal"  data-cname="<?= $coop_info->proposed_name?> <?=$coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?>><?=$submit?></button><!--  modify by Jayson change approve button to submit -->
      <?php endif; //endo fo coop info status ?>  
        <?php endif;// is director and supervising?>
    <?php if($admin_info->access_level == 3 && $is_active_director || $supervising_) {?>
     <?php if($coop_info->status !=15):?>
        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#denyCooperativeModal" data-cname="<?= $coop_info->proposed_name?> <?= $coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Deny</button>
        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#deferCooperativeModal" data-cname="<?= $coop_info->proposed_name?> <?= $coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?>>Defer</button>
      <?php endif; //coo status 15 ?>
    <?php } ?>
      </div>
      <?php endif;?>
        <?php } ?>
  <?php endif; ?>

  </div>
</div>
<?php if($is_client) : ?>
    <?php else :?>
<?php if(strlen(($coop_info->comment_by_specialist && $admin_info->access_level==2) && $coop_info->status != 15 || $admin_info->access_level==3 || $admin_info->access_level==4) && strlen($coop_info->comment_by_specialist)>0 && $coop_info->status != 15) : ?>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg">* CDS Findings</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            CDS Findings
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </div>
        <div class="modal-body">
            <pre><?php 
    //            print_r($cooperatives_comments);
                foreach($cooperatives_comments_cds as $cc) :
                    echo 'Date: '.date("F d, Y",strtotime($cc['date_created']));
                    echo '<ul type="square">';
                        echo '<li>'.$cc['comment'].'</li>';
                    echo '</ul>';
                endforeach;
                    echo '<p class="font-weight-bold">CDS Tool Findings:</p>';
                    echo '<p>'.$coop_info->tool_findings.'</p>';
            ?></pre>  
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <!--<button type="button" class="btn btn-primary">Save changes</button>-->
        </div>
    </div>
  </div>
</div>
<!--  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info" role="alert">
        <p class="font-weight-bold">CDS Comment:</p>
        <pre><?= $coop_info->comment_by_specialist ?></pre>
        <?php if(strlen($coop_info->tool_findings)){
            echo '<p class="font-weight-bold">CDS Tool Findings:</p>';
            echo '<p>'.$coop_info->tool_findings.'</p>';
        }?>
      </div>
    </div>
  </div>-->
<?php endif;?>
<?php if(strlen($coop_info->comment_by_senior && $admin_info->access_level==3 || $admin_info->access_level==4 || $coop_info->status==12) || strlen($coop_info->comment_by_senior && $admin_info->access_level==2) && $coop_info->status!=15) : ?>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg2">* Senior Findings</button>

<div class="modal fade bd-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            Senior Findings
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </div>
        <div class="modal-body">
            <pre><?php 
//            print_r($cooperatives_comments);
            foreach($cooperatives_comments_snr as $cc) :
                echo 'Date: '.date("F d, Y",strtotime($cc['date_created']));
                echo '<ul type="square">';
                    echo '<li>'.$cc['comment'].'</li>';
                echo '</ul>';
            endforeach;
        ?></pre>  
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<!--            <button type="button" class="btn btn-primary">Save changes</button>-->
        </div>
    </div>
  </div>
</div>
<!--  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info" role="alert">
        <p class="font-weight-bold">Senior Comment:</p>
        <pre><?= $coop_info->comment_by_senior ?></pre>
      </div>
    </div>
  </div>-->
<?php endif;?>
<?php if(strlen(($coop_info->temp_evaluation_comment && $admin_info->access_level==3) || $supervising_ || ($coop_info->temp_evaluation_comment && $admin_info->access_level==2)  && $coop_info->status == 6 || strlen(($coop_info->temp_evaluation_comment && $admin_info->access_level==2 && $coop_info->status == 12)))) : ?>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg3">* Director Findings</button>

<div class="modal fade bd-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            The cooperative has been deferred because of the following reason/s:
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </div>
        <div class="modal-body" style="table-layout: fixed;">
            <pre><?php 
//            print_r($cooperatives_comments);
            foreach($cooperatives_comments as $cc) :
                echo 'Date: '.date("F d, Y",strtotime($cc['date_created']));
                echo '<ul type="square">';
                    echo '<li>'.$cc['comment'].'</li>';
                echo '</ul>';
            endforeach;
        ?></pre>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<!--            <button type="button" class="btn btn-primary">Save changes</button>-->
        </div>
    </div>
  </div>
</div>
<!--  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger" role="alert">
        <p class="font-weight-bold">This cooperative has been deferred because of the following reason/s:</p>
        <pre><?= $coop_info->temp_evaluation_comment ?></pre>
      </div>
    </div>
  </div>-->
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
<?php if($this->session->flashdata('document_one_success')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-info text-center" role="alert">
      <?php echo $this->session->flashdata('document_one_success'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('document_one_error')): ?>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('document_one_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('document_two_success')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-info text-center" role="alert">
      <?php echo $this->session->flashdata('document_two_success'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('document_two_error')): ?>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('document_two_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<hr>
<div class="row mb-2">
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">By Laws</h5>
        <p class="card-text">This is the generated Bylaws. </p>
        <a target="_blank" href="
        <?php if ($coop_info->category_of_cooperative === 'Primary'): ?>
                <?= base_url().'cooperatives/'.$encrypted_id.'/documents/bylaws_primary';?>
        <?php elseif ($coop_info->grouping === 'Union'): ?>
                <?= base_url().'cooperatives/'.$encrypted_id.'/documents/bylaws_union';?>
        <?php else: ?>
                <?= base_url().'cooperatives/'.$encrypted_id.'/documents/bylaws_federation';?>
        <?php endif; ?>
        " class="btn btn-primary">View</a>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Article  of Cooperation</h5>
        <p class="card-text">This is the generated Article  of Cooperation</p>
        <a target="_blank" href="
        <?php if ($coop_info->category_of_cooperative === 'Primary'): ?>
                <?= base_url().'cooperatives/'.$encrypted_id.'/documents/articles_cooperation_primary';?>
        <?php elseif ($coop_info->grouping === 'Union'): ?>
                <?= base_url().'cooperatives/'.$encrypted_id.'/documents/articles_cooperation_union';?>
        <?php else: ?>
                <?= base_url().'cooperatives/'.$encrypted_id.'/documents/articles_cooperation_federation';?>
        <?php endif; ?>
        " class="btn btn-primary">View</a>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Treasurer's Affidavit</h5>
        <p class="card-text">This is the generated Treasurer's Affidavit.</p>
        <a target="_blank" href="
        <?php if ($coop_info->category_of_cooperative === 'Primary'): ?>
                <?= base_url().'cooperatives/'.$encrypted_id.'/documents/affidavit_primary';?>
        <?php elseif ($coop_info->grouping === 'Union'): ?>
                <?= base_url().'cooperatives/'.$encrypted_id.'/documents/affidavit_union';?>
        <?php else: ?>
                <?= base_url().'cooperatives/'.$encrypted_id.'/documents/affidavit_federation';?>
        <?php endif; ?>
        " class="btn btn-primary">View</a>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Economic Survey</h5>
          <p class="card-text">This is the generated Economic Survey.</p>
          <a target="_blank" href="<?php echo base_url();?>cooperatives/<?=$encrypted_id?>/documents/economic_survey" class="btn btn-primary">View</a>
        </div>
      </div>
  </div>
  <div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Surety Bond of Accountable Officers</h5>
            <p class="card-text">
              <!-- modify by json -->
              <?php if(isset($document_one)) : ?>
               <!--  <a target="_blank" href="<?php echo base_url();?>cooperatives/<?=$encrypted_id?>/documents/view_document_one/<?= encrypt_custom($this->encryption->encrypt($document_one->filename))?>"> -->

                 <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf/<?=$encrypted_id?>/1">

                  <?php if($is_client) : ?>
                    This is your Surety Bond of Accountable Officers document.
                  <?php else : ?>
                    This is the Surety Bond of Accountable Officers document.
                  <?php endif;?>
                </a>
              <?php endif ?>
              <?php if(!isset($document_one)) : ?>
                Please upload your required Surety Bond of Accountable Officers document.
              <?php endif ?>
              <br>
            </p>

          <?php if($coop_info->status<=1 || $coop_info->status>=11 && $coop_info->status!=15): ?>
            <?php if($is_client) : ?>
                <a href="<?php echo base_url();?>cooperatives/<?=$encrypted_id?>/documents/upload_document_one" class="btn btn-primary">Upload</a>
            <?php endif;?>
          <?php endif; ?>

        </div>
      </div>
  </div>


<!-- modify json -->
  <div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Pre-Registration Seminar PRS Certificates</h5>
            <p class="card-text">
              <?php if(isset($document_two)) : ?>
              <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf/<?=$encrypted_id?>/2">

                <?php if($is_client) : ?>
                  This is your Pre-Registration Seminar PRS Certificate document.
                <?php else : ?>
                  This is the Pre-Registration Seminar PRS Certificate document.
                <?php endif;?>
               </a>
              <?php endif ?>
              <?php if(!isset($document_two)) : ?>
              Please upload your required Pre-Registration PRS Certificate document
              <?php endif ?>
              <br>
            </p>
          <?php if($is_client && $coop_info->status<=1 || $coop_info->status==11): ?>
            <a href="<?php echo base_url();?>cooperatives/<?=$encrypted_id?>/documents/upload_document_two" class="btn btn-primary">Upload</a>
          <?php endif; ?>
        </div>
      </div>
  </div>

     <!-- <div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Pre-Registration Seminar PRS Certificate</h5>
            <p class="card-text">
              <?php if($document_two) : ?>
              <a target="_blank" href="<?php echo base_url();?>cooperatives/<?=$encrypted_id?>/documents/view_document_two/<?= encrypt_custom($this->encryption->encrypt($document_two->filename))?>">
                <?php if($is_client) : ?>
                  This is your Pre-Registration Seminar PRS Certificate document.
                <?php else : ?>
                  This is the Pre-Registration Seminar PRS Certificate document.
                <?php endif;?>
               </a>
              <?php endif ?>
              <?php if(!$document_two) : ?>
              Please upload your required Pre-Registration PRS Certificate document
              <?php endif ?>
              <br>
            </p>
          <?php if($is_client && $coop_info->status<=1): ?>
            <a href="<?php echo base_url();?>cooperatives/<?=$encrypted_id?>/documents/upload_document_two" class="btn btn-primary">Upload</a>
          <?php endif; ?>
        </div>
      </div>
  </div> -->
</div>
<!--ANJURY-->
<div class="row">
<?php 
// print_r($ching);
// echo"<pre>";print_r($coop_type);echo"<pre>";
$count=0;
    foreach ($coop_type as $coop) : 
?>
    <?php $count++;?>
    <div class="col-sm-12 col-md-4">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?=$coop['coop_title']?></h5>
                <p class="card-text">
                    <?php if($count==1){?>
                        <?php if(isset($document_others)) : ?>
                        <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf/<?=$encrypted_id?>/<?=$coop['document_num']?>">

                        <?php if($is_client) : ?>
                          This is your <?=$coop['coop_title']?> document.
                        <?php else : ?>
                          This is the <?=$coop['coop_title']?> document.
                        <?php endif;?>
                        </a>
                        <?php endif ?>
                        <?php if(!isset($document_others)) : ?>
                            <?=$coop['coop_desc']?>
                        <?php endif ?>
                        <br>
                    <?php } else {?>
                        <?php if(isset($document_others2)) : ?>
                        <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf/<?=$encrypted_id?>/<?=$coop['document_num']?>">

                        <?php if($is_client) : ?>
                          This is your <?=$coop['coop_title']?> document.
                        <?php else : ?>
                          This is the <?=$coop['coop_title']?> document.
                        <?php endif;?>
                        </a>
                        <?php endif ?>
                        <?php if(!isset($document_others2)) : ?>
                            <?=$coop['coop_desc']?>
                        <?php endif ?>
                        <br>
                    <?php } ?>
                </p>
                <?php if($is_client && $coop_info->status<=1 || $coop_info->status==11): ?>
                    <a href="<?php echo base_url();?>cooperatives/<?=$encrypted_id?>/documents/upload_document_others/<?=encrypt_custom($this->encryption->encrypt($coop['id']))?>" class="btn btn-primary">Upload</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php endforeach; ?>
</div>
<!--ANJURY END-->
<pre>
    <?php // print_r($coop_type);?>
    <?php // print_r($ching);?>
    <?php // echo $ching4;?>
</pre>