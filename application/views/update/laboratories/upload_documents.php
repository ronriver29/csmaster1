<?php if($this->session->flashdata('doc_msg')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-<?=$this->session->flashdata('status_msg')?> text-center" role="alert">
      <?php echo $this->session->flashdata('doc_msg'); ?>
    </div>
  </div>
</div>
<?php endif; ?>



<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>laboratories_update/<?= $encrypted_id ?>/view" role="button"><i class="fas fa-arrow-left"></i> Go Back </a>

    <?php if($is_client) : ?>
    <h5 class="text-primary text-right">
      Step 3
    </h5>
  <?php else :?>

  <?php endif; ?>
  </div>
</div>


<?php if(isset($comment_list_director) && strlen($comment_list_director->comment)>0){ ?>

  <div class="row mt-3 col-md-12">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger" role="alert">
        <p class="font-weight-bold">Laboratory has been denied.</p>
        <p class="font-weight-bold">Director Comment:</p>
        <pre><?php echo $comment_list_director->comment; ?></pre>
      </div>
    </div>
  </div>

<?php } ?>


<?php if(isset($comment_list_senior) && strlen($comment_list_senior->comment)>0){ ?>

  <div class="row mt-3 col-md-12">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info" role="alert">
        <p class="font-weight-bold">Senior Comment:</p>
        <pre><?php echo $comment_list_senior->comment; ?></pre>
      </div>
    </div>
  </div>
<?php } ?>


<?php if(isset($comment_list_defer_director->comment) && strlen($comment_list_defer_director->comment)>0){ ?>

  <div class="row mt-3 col-md-12">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger" role="alert">
         <p class="font-weight-bold">Laboratory has been deffered.</p>
        <p class="font-weight-bold">Director Comment:</p>
        <pre><?php echo $comment_list_defer_director->comment; ?></pre>
      </div>
    </div>
  </div>
<?php } ?>






<div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">

      <div class="card-header">
        <div class="row">
          <div class="col-sm-12 col-md-8">
            <h4></h4>
          </div>
          <div class="col-sm-12 offset-md-2 col-md-2">
            <h5 class="text-primary text-right"></h5>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
                  <div class="col-sm-12 col-md-12">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong></strong>
                  </div>
              </div>
            </div>
            <div class="row">

          </div>
          <div class="col-sm-12 col-md-12 col-com">
                <div class="form-group">
                  <label for="compositionOfMembers1"> </label>




<div class="row mb-2">

  <div class="col-sm-12 col-md-12">

<?php if($is_client) : ?>
    <?php else :?>
<!-- <?php if(strlen(($coop_info->comment_by_specialist && $admin_info->access_level==2) || $admin_info->access_level==3)) : ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info" role="alert">
        <p class="font-weight-bold">CDS Comment:</p>
        <pre><?= $coop_info->comment_by_specialist ?></pre>
      </div>
    </div>
  </div>
<?php endif;?> -->
<!-- <?php if(strlen($coop_info->comment_by_senior && $admin_info->access_level==3)) : ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info" role="alert">
        <p class="font-weight-bold">Senior Comment:</p>
        <pre><?= $coop_info->comment_by_senior ?></pre>
      </div>
    </div>
  </div>
<?php endif;?> -->
<!-- <?php if(strlen($coop_info->temp_evaluation_comment && $admin_info->access_level==3)) : ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger" role="alert">
        <p class="font-weight-bold">This cooperative has been deferred because of the following reason/s:</p>
        <pre><?= $coop_info->temp_evaluation_comment ?></pre>
      </div>
    </div>
  </div>
<?php endif;?> -->
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
<div class="row mb-2">
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">By Laws</h5>
        <p class="card-text">This is the generated Bylaws. </p>
        <a target="_blank" href="
        <?php if ($coop_info->category_of_cooperative === 'Primary'): ?>
                <?= base_url().'laboratories/'.$cid.'/laboratories_documents/bylaws_primary/'.$encrypted_ids;?>
        <?php elseif ($coop_info->grouping === 'Union'): ?>
                <?= base_url().'cooperatives/'.$cid.'/documents/bylaws_union';?>
        <?php else: ?>
                <?= base_url().'cooperatives/'.$cid.'/documents/bylaws_federation';?>
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
                <?= $url_ = base_url().'laboratories/'.$cid.'/laboratories_documents/articles_cooperation_primary';?>
        <?php elseif ($coop_info->grouping === 'Union'): ?>
                <?= base_url().'cooperatives/'.$cid.'/documents/articles_cooperation_union';?>
        <?php else: ?>
                <?= base_url().'cooperatives/'.$cid.'/documents/articles_cooperation_federation';?>
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
                <?= base_url().'laboratories/'.$cid.'/laboratories_documents/affidavit_primary_lab';?>
        <?php elseif ($coop_info->grouping === 'Union'): ?>
                <?= base_url().'cooperatives/'.$cid.'/documents/affidavit_union';?>
        <?php else: ?>
                <?= base_url().'cooperatives/'.$cid.'/documents/affidavit_federation';?>
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
          <a target="_blank" href="<?php echo base_url();?>laboratories/<?=$cid?>/laboratories_documents/economic_survey_lab" class="btn btn-primary">View</a>
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


                 <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf_laboratory/<?=$cid?>/1">

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



        </div>
      </div>
  </div>


<!-- modify json -->
  <div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Pre-Registration Seminar PRS Certificate</h5>
            <p class="card-text">

              <?php if(isset($document_two)) : ?>
              <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf_laboratory/<?=$cid?>/2">

                <?php if($is_client) : ?>
                  This is your Pre-Registration Seminar PRS Certificate document.
                <?php else : ?>
                  This is the Pre-Registration Seminar PRS Certificate document.
                <?php endif;?>
               </a>


             <?php else: ?>

              Please upload your required Pre-Registration PRS Certificate document
                 <?php endif ?>
              <br>
            </p>
         <!--  <?php if($is_client && $coop_info->status<=1 || $coop_info->status==11): ?>
            <a href="<?php echo base_url();?>cooperatives/<?=$cid?>/documents/upload_document_two" class="btn btn-primary">Upload</a>
          <?php endif; ?> -->
        </div>
      </div>
  </div>
   <!-- end of modify -->

   <!-- modify  -->

   <?php
 // echo"<pre>";print_r($coop_type);echo"<pre>";
 // echo $this->encryption->decrypt(decrypt_custom($cid));
$count=0;
  if($coop_type!=NULL)
  {
    foreach ($coop_type as $coop) :
?>
    <?php $count++;?>
    <div class="col-sm-12 col-md-4" style="margin-top:10px;">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?=$coop['coop_title']?></h5>
                <p class="card-text">

                     <!--
                        <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf/<?=$cid?>/<?=$coop['id']?>">

                        <?php if($is_client) : ?>
                          This is your <?=$coop['coop_title']?> document.
                        <?php else : ?>
                          This is the <?=$coop['coop_title']?> document.
                        <?php endif;?> -->

                      <!--   </a> -->

                         <?php
                            foreach($coop['link'] as $row_link)
                            {

                             ?>

                               <a target="_blank" href="<?php echo base_url();?>laboratories_documents/view_document_one_lab3/<?=encrypt_custom($this->encryption->encrypt($row_link['id']))?>/<?=encrypt_custom($this->encryption->encrypt($row_link[
                               'filename']))?>/<?=$row_link['document_num']?>">

                                  <?php if($is_client) : ?>
                                    This is your <?=$coop['coop_title']?> document.
                                  <?php else : ?>
                                    This is the <?=$coop['coop_title']?> document.
                                  <?php endif;?>
                             </a>

                             <?php
                            }
                          ?>

                        <br>

                        <!-- <?php if(isset($document_others2)) : ?>
                        <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf/<?=$cid?>/<?=$coop['id']?>">

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
                        <br> -->

                </p>
                <?php if($is_client && $coop_info->status<=1 || $coop_info->status==11): ?>
                    <a href="<?php echo base_url();?>cooperatives/<?=$cid?>/documents/upload_document_others/<?=encrypt_custom($this->encryption->encrypt($coop['id']))?>" class="btn btn-primary">Upload</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php endforeach; ?>
 <?php } //end if null?>
   <!-- end modify -->

   <!-- <div class="col-sm-12 col-md-4" style="margin-top:20px;">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Manual of Operation</h5>


            <?php if(isset($Manual_of_board)){
            $file_name = encrypt_custom($this->encryption->encrypt($Manual_of_board->filename)); ?>

           <a target="_blank" href="<?php echo base_url();?>laboratories/<?=$encrypted_id?>/laboratories_documents/view_document_one_lab3/<?=$file_name?>/25">This is your Manual Resolution document.</a>

            <?php
            }
            else{
            ?>

              <p class="card-text">
                     Please upload your required Manual of Operation document
              </p>

            <?php
            }
            ?>
            <br>
             <a href="<?php echo base_url();?>laboratories_update/<?=$encrypted_id?>/upload_manual_operation/25" class="btn btn-primary">Upload</a>
        </div>
      </div>
  </div> -->

  <!-- <div class="col-sm-12 col-md-4" style="margin-top:10px;">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Board Resolution</h5>


             <?php if(isset($Board_of_resolution)){
                $file_name = encrypt_custom($this->encryption->encrypt($Board_of_resolution->filename));
            ?>
            <a target="_blank" href="<?php echo base_url();?>laboratories/<?=$encrypted_id?>/laboratories_documents/view_document_one_lab3/<?=$file_name?>/25">This is your Board Resolution document.</a>

            <?php
            }
            else
            {
              ?>

              <p class="card-text">
              Please upload your required Board Resolution document
            </p>


            <?php
            }
            ?>
            <br>
             <a href="<?php echo base_url();?>laboratories_update/<?=$encrypted_id?>/upload_manual_operation/26" class="btn btn-primary">Upload</a>





        </div>
      </div>
  </div> -->
<br>
<!-- OTHERS -->
  <div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Other Requirements</h5>
            <p class="card-text">
              <!-- modify by json -->
              <?php if(isset($document_others_lab)) : ?>
               <!--  <a target="_blank" href="<?php echo base_url();?>cooperatives/<?=$encrypted_id?>/documents/view_document_one/<?= encrypt_custom($this->encryption->encrypt($document_one->filename))?>"> -->

                 <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf_laboratory_updating/<?=$encrypted_id?>/42">

                  <?php if($is_client) : ?>
                    This is your Others document.
                  <?php else : ?>
                    This is the Others document.
                  <?php endif;?>
                </a>
              <?php endif ?>
              <?php if(!isset($document_others_lab)) : ?>
                Please upload your others document.
              <?php endif ?>
              <br>
            </p>

            <?php if(($is_client && $coop_info->lab_status != 30) && ($is_client && $coop_info->lab_status != 31)) : ?>
                <a href="<?php echo base_url();?>laboratories_update/<?=$encrypted_id?>/upload_document_others_lab" class="btn btn-primary">Upload</a>
                <!-- <a href="<?php echo base_url();?>branches/<?=$encrypted_id?>/documents/upload_document_others_bns" class="btn btn-primary">Upload</a> -->
            <?php elseif(!$is_client && ($coop_info->lab_status != 30 || $is_client && $coop_info->lab_status != 31)): ?>
            <?php //if($is_client) : ?>
                <a href="<?php echo base_url();?>laboratories_update/<?=$encrypted_id?>/upload_document_others_lab" class="btn btn-primary">Upload</a>
                <!-- <a href="<?php echo base_url();?>branches/<?=$encrypted_id?>/documents/upload_document_others_bns" class="btn btn-primary">Upload</a> -->
            <?php endif;?>

        </div>
      </div>
  </div>
  <!-- OTHERS END -->
</div>



</div> <!-- end of row -->
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
