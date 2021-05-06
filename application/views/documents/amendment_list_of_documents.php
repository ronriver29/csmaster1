<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
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
      <?php
        if(strlen($coop_info->acronym)>0)
        {
            $acronym_ = '('.$coop_info->acronym .')';
        }
        else
        {
             $acronym_='';
        }

        if(count(explode(',',$coop_info->type_of_cooperative))>1)
        {
          $proposedName = $coop_info->proposed_name.' Multipurpose Cooperative '. $acronym_;
        }
        else
        {
           $proposedName= $coop_info->proposed_name.' '.$coop_info->type_of_cooperative.' Cooperative '. $acronym_;
        }
      ?>
      <div class="btn-group float-right" role="group" aria-label="Basic example">
        <a  class="btn btn-info btn-sm" href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_cooperative_tool">Tool</a>
        <!-- Supervising -->
        <?php if($admin_info->access_level ==2 || $is_active_director || $supervising_): ?>
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveAmendmentModal"  data-cname="<?= $proposedName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($amendment_id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?>><?=$submit?></button>
      <?php endif; ?>
        <!-- end Supervising -->
    <?php if($admin_info->access_level == 3 && $is_active_director || $supervising_) {?>
        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#denyCooperativeModal" data-cname="<?= $proposedName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Deny</button>
        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#deferCooperativeModal"  data-cname="<?=$proposedName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Defer</button>
    <?php } //end Supervising?>
      </div>
      <?php endif;?>
        <?php } ?>
  <?php endif; ?>

  </div>
</div>
<?php if($is_client) : ?>
    <?php else :?>
<?php if(strlen(($coop_info->comment_by_specialist && $admin_info->access_level==2) || $admin_info->access_level==3)) : ?>
<!--  <?php if(strlen($have_cds_comment)>0):?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info" role="alert">
        <p class="font-weight-bold">CDS Comment:</p>
        <pre><?= $have_cds_comment ?></pre>
      </div>
    </div>
  </div>
<?php endif; ?> -->
<?php endif;?>
<!-- <?php if(strlen($have_senior_comment && $admin_info->access_level==3 || $coop_info->status==12)) : ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info" role="alert">
        <p class="font-weight-bold">Senior Comment:</p>
        <pre><?= $have_senior_comment ?></pre>
      </div>
    </div>
  </div>
<?php endif;?> -->
<?php if($is_client) : ?>
  <?php if(strlen(($have_director_comment && $admin_info->access_level==3) || ($coop_info->temp_evaluation_comment && $admin_info->access_level==2) && $coop_info->status == 24)) : ?>
    <div class="row mt-3">
      <div class="col-sm-12 col-md-12">
        <div class="alert alert-danger" role="alert">
          <p class="font-weight-bold">This cooperative has been deferred because of the following reason/s:</p>
          <pre><?= $have_director_comment ?></pre>
        </div>
      </div>
    </div>
<?php endif; //end if client ?>
  <?php else: ?>  
    <!-- START CDS -->

    <?php if(!empty($senior_comment) && is_array($senior_comment)): ?>
   <!--  <?php $have_cds_comment = array_filter($have_cds_comment);?> -->
    <?php if(!empty($cds_comment) && $cds_comment !=NULL):?>
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
                    if(count($cds_comment)>0):
                    foreach($cds_comment as $cc) :
                        echo 'Date: '.date("F d, Y",strtotime($cc['created_at']));
                        echo '<ul type="square">';
                            echo '<li>'.$cc['comment'].'</li>';
                        echo '</ul>';
                    endforeach;
                        echo '<p class="font-weight-bold">CDS Tool Findings:</p>';
                        echo '<p>'.$coop_info->tool_findings.'</p>';
                    endif;    
                ?></pre>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
      </div>
    </div>
    <?php endif; //end of strlen commetn ?>
  <?php endif;?>  
    <!-- END CDS -->
   <!--  START SENIOR -->
  
   <?php if(!empty($senior_comment) && is_array($senior_comment)): ?>
    <?php $senior_comment = array_filter($senior_comment); ?>
   <?php if(strlen($senior_comment && $admin_info->access_level==3 ) || strlen($senior_comment && $admin_info->access_level==2) || strlen($senior_comment && $admin_info->access_level==4) && $coop_info->status!=15) : ?>
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
                foreach($senior_comment as $cc) :
                    echo 'Date: '.date("F d, Y",strtotime($cc['created_at']));
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
    <?php endif;?>
  <?php endif; //end of strlen comment ?>
   <!--  END SENIOR -->
   <!--  START DIRECTOR -->
  <?php if(!empty($director_comment) && is_array($director_comment)): ?>
  <?php if(strlen(($director_comment && $admin_info->access_level==3) || ($director_comment && $admin_info->access_level==2) || ($have_director_comment && $admin_info->access_level==4) && $coop_info->status == 6 || strlen(($have_director_comment && $admin_info->access_level==2 && $coop_info->status == 12)))) : ?>
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
              foreach($director_comment as $cc) :
                  echo 'Date: '.date("F d, Y",strtotime($cc['created_at']));
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
 
  <?php endif; //end if director button?>  
  <?php endif; //end of is clien?>

<?php endif; ?>
<?php endif; //end strlen of director comment?>
<!-- END DIRECTOR -->
<hr>
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
<div class="row mb-2">
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">By Laws</h5>
        <p class="card-text">This is the generated Bylaws. </p>
        <a target="_blank" href="
        <?php if ($coop_info->category_of_cooperative === 'Primary'): ?>
                <?= base_url().'amendment/'.$encrypted_id.'/amendment_documents/bylaws_primary';?>
        <?php elseif ($coop_info->grouping === 'Union'): ?>
                <?= base_url().'amendment/'.$encrypted_id.'/amendment_documents/bylaws_union';?>
        <?php else: ?>
                <?= base_url().'amendment/'.$encrypted_id.'/amendment_documents/bylaws_federation';?>
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
                <?php $url_ = base_url().'amendment/'.$encrypted_id.'/amendment_documents/articles_cooperation_primary';?>
        <?php elseif ($coop_info->grouping === 'Union'): ?>
                <?php $ulr_= base_url().'amendment/'.$encrypted_id.'/amendment_documents/articles_cooperation_union';?>
        <?php else: ?>
                <?php $url_ = base_url().'amendment/'.$encrypted_id.'/amendment_documents/articles_cooperation_federation';?>
        <?php endif; ?>
        " class="btn btn-primary" id="btn-article">View</a>
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
                <?= base_url().'amendment/'.$encrypted_id.'/amendment_documents/affidavit_primary';?>
        <?php elseif ($coop_info->grouping === 'Union'): ?>
                <?= base_url().'amendment/'.$encrypted_id.'/amendment_documents/affidavit_union';?>
        <?php else: ?>
                <?= base_url().'amendment/'.$encrypted_id.'/amendment_documents/affidavit_federation';?>
        <?php endif; ?>
        " class="btn btn-primary">View</a>
      </div>
    </div>
  </div>
</div>
 <div class="row">
  <!--<div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Economic Survey</h5>
          <p class="card-text">This is the generated Economic Survey.</p>
          <a target="_blank" href="<?php echo base_url();?>amendment/<?=$encrypted_id?>/amendment_documents/economic_survey" class="btn btn-primary">View</a>
        </div>
      </div>
  </div> -->
  <div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Surety Bond of Accountable Officers</h5>
            <p class="card-text">
              <!-- modify by json -->
              <?php if(isset($document_one)) : ?>
               <!--  <a target="_blank" href="<?php echo base_url();?>amendment/<?=$encrypted_id?>/documents/view_document_one/<?= encrypt_custom($this->encryption->encrypt($document_one->filename))?>"> -->

                 <a target="_blank" href="<?php echo base_url();?>amendment_documents/list_upload_pdf/<?=$encrypted_id?>/1">

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
          <?php if($is_client && $coop_info->status<=1 || $coop_info->status>=11): ?>
            <a href="<?php echo base_url();?>amendment/<?=$encrypted_id?>/amendment_documents/upload_document_one" class="btn btn-primary">Upload</a>
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
              <a target="_blank" href="<?php echo base_url();?>amendment_documents/list_upload_pdf/<?=$encrypted_id?>/2">

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
            <a href="<?php echo base_url();?>amendment/<?=$encrypted_id?>/amendment_documents/upload_document_two" class="btn btn-primary">Upload</a>
          <?php endif; ?>
        </div>
      </div>
  </div>

    
</div>
<!--ANJURY-->
<div class="row" style="padding-top:20px;">
  <?php 
  $count_coop_type = explode(',',$coop_info->cooperative_type_id); 
  if(count($count_coop_type)>1)
  {
    ?>

      <div class="col-sm-12 col-md-4">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Feasibility Study</h5>
                <p class="card-text">
                  <?php 
                   if($feasibity)
                   { 
                  ?>
                  <a href="<?php echo base_url().'amendment/'.$encrypted_id.'/amendment_documents/doc_link_view/'.encrypt_custom($this->encryption->encrypt(3));?>">Detailed Feasibility Study</a>
                  <?php
                   }
                   else
                   {
                  ?>
                    Detailed Feasibility Study
                  <?php
                   } 
                  ?>
                </p>
                <?php if($is_client && $coop_info->status<=1 || $coop_info->status==11){ ?>
                <a href="<?php echo base_url().'amendment/'.$encrypted_id.'/amendment_documents/upload_cooptype_document/'.encrypt_custom($this->encryption->encrypt(3)).'/';?>" class="btn btn-primary">Upload</a>
              <?php } ?>
            </div>
        </div>
      </div> <!-- end col-md-4 -->        

       <div class="col-sm-12 col-md-4" >
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Books of Account</h5>
                <p class="card-text">
                  <?php
                   if($books_of_account)
                   {
                  ?>
                  <a href="<?php echo base_url().'amendment/'.$encrypted_id.'/amendment_documents/doc_link_view/'.encrypt_custom($this->encryption->encrypt(4));?>">
                  Undertaking to maintain separate books of accounts for each business activity
                  </a>
                  <?php
                   }
                   else
                   {
                  ?>
                     Undertaking to maintain separate books of accounts for each business activity
                  <?php
                   }
                  ?>
             
              </p>
                <?php if($is_client && $coop_info->status<=1 || $coop_info->status==11){ ?>
                  <a href="<?php echo base_url().'amendment/'.$encrypted_id.'/amendment_documents/upload_cooptype_document/'.encrypt_custom($this->encryption->encrypt(4));?>" class="btn btn-primary">Upload</a>
                <?php }?>  
            </div>
        </div>
      </div> <!-- end col-md-4 -->        
    <?php

  }//end count
  ?>
<?php 
$count=0;

  if(count($coop_type)>0)
  {
    foreach ($coop_types_ as $doc_) : 
    $doc_num = $doc_['document_num'];
?>
    <?php $count++;?>
    <div class="col-sm-12 col-md-4" >
        <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?=$doc_['title']?></h5>
                <p class="card-text">
                  <?php
                  if(strlen($doc_['link'])>0)
                  {
                  ?>
                  <a target="_blank" href="<?php echo base_url().'amendment/'.$encrypted_id.'/amendment_documents/doc_link_view/'.encrypt_custom($this->encryption->encrypt($doc_num));?>"><?=$doc_['description']?></a>
                  <?php
                  }
                  else
                  {
                  ?>
                    <?=$doc_['description']?>
                  <?php  
                  }
                  ?>
                        
                </p>
                <?php if($is_client && $coop_info->status<=1 || $coop_info->status==11): ?>
                    <a href="<?php echo base_url().'amendment/'.$encrypted_id.'/amendment_documents/upload_cooptype_document/'.encrypt_custom($this->encryption->encrypt($doc_num));?>" class="btn btn-primary">Upload</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php endforeach; ?>
 <?php }?>   
</div> <!-- end of row -->
<!--ANJURY END-->

<script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
      $('#btn-article').on('click',function(){
          alert("If total number of pages in Acknowledgement didn't appear, please refresh the page.");
            window.open('<?=$url_?>');
            return false;
      });
  });
  
</script>
