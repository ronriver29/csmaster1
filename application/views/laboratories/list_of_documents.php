<?php if($this->session->flashdata('deny_msg')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-<?=$this->session->flashdata('status_msg')?> text-center" role="alert">
      <?php echo $this->session->flashdata('deny_msg'); ?>
    </div>
  </div>
</div>
<?php endif; ?>



<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <?php if($lab_info->status !=21) { ?>
      <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>laboratories/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <?php } else { ?>
      <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>laboratories/<?= encrypt_custom($this->encryption->encrypt($lab_info->coop_id)) ?>/laboratory_registered" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <?php } ?>
    <?php if($is_client) : ?>
    <h5 class="text-primary text-right" >
      Step 9
    </h5>
  <?php else :?>
    <?php if($admin_info->access_level !=5 && $lab_info->status !=24 && $lab_info->status !=21) : ?>
      <div class="btn-group float-right" role="group" aria-label="Basic example">
        <!--<a  class="btn btn-info btn-sm" href="<?php echo base_url();?>laboratories/<?= $encrypted_id ?>/laboratories_cooperative_tool">Tool</a>-->

        <?php if( $admin_info->access_level==3 || $admin_info->access_level==4){?>
           <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveCooperativeModal"  data-cname="<?= $lab_info->laboratoryName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($lab_info->id))?>">Approve</button>
        <?php }else{ ?> 
      
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveCooperativeModal"  data-cname="<?= $lab_info->laboratoryName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($lab_info->id))?>">Submit</button>
        <?php } ?>

         <?php if( $admin_info->access_level==3 || $admin_info->access_level==4){?> 
        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#denyLaboratoryModal" data-cname="<?= $lab_info->laboratoryName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($lab_info->id))?>">Deny</button>
        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#deferLaboratoryModal"  data-cname="<?= $lab_info->laboratoryName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($lab_info->id))?>">Defer</button>
      </div>
      <?php } ?>
      <?php endif;?>
  <?php endif; ?>
  </div>
</div>

<?php if($admin_info->access_level==3 || $admin_info->access_level==4 || $admin_info->access_level==2){//if(($admin_info->access_level ==2)  || ($admin_info->access_level ==3)){?>
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
<?php } //end of access level?>
    
<?php if($admin_info->access_level==3 || $admin_info->access_level==4){//if(($admin_info->access_level ==2)  || ($admin_info->access_level ==3)){?>
<!-- <?php if(isset($comment_list_senior) && strlen($comment_list_senior->comment)>0){ ?>
  <div class="row mt-3 col-md-12"> 
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info" role="alert">
        <p class="font-weight-bold">Senior Comment:</p>
        <pre><?php echo $comment_list_senior->comment; ?></pre>
      </div>
    </div>
  </div>
<?php } ?> -->
<?php } //end of access level?>

<?php if(isset($senior_comment) || isset($director_comment)){?>
<div class="row mt-3 col-md-12"> 
  <div class="col-sm-12 col-md-12">
  <?php if(isset($senior_comment)){ ?>
       <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg2">* Senior Findings
    </button>
  <?php } ?>

  <?php if(is_array($director_comment)){?>
      <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg3">* Director Findings
    </button>
  <?php } ?>  
  </div>
  </div>
<?php } //end of button ?>
<div class="modal fade bd-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="width:90% !important;max-width:1360px;">
    <div class="modal-content">
        <div class="modal-header">
            Senior Findings
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </div>
        <div class="modal-body form">
          <strong>Senior Comment : </strong>
            <?php 
      // print_r($senior_comment);
            if(isset($senior_comment)){
              foreach($senior_comment as $sc){
                 // echo'<strong>'.$sc['comment_by'].' :</strong><br>';
                echo 'Date: '.date("F d, Y",strtotime($sc['created_at'])).'<br>';
                echo '<ul type="square">';
                    echo '<li>'.$sc['comment'].'</li>';
                echo '</ul>';
                 // echo $sc['comment'].'<br>';
            }
          }//end if
        ?> 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<!--            <button type="button" class="btn btn-primary">Save changes</button>-->
        </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document" style="width:90% !important;max-width:1360px;">
    <div class="modal-content">
        <div class="modal-header">
            Director Findings
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </div>
        <div class="modal-body form">
          <strong>Director Comment :</strong>
            <?php 
            if(isset($director_comment)){
              foreach($director_comment as $dc){
                // echo'<strong>'.$dc['comment_by'].' :</strong><br><br>';
                echo 'Date: '.date("F d, Y",strtotime($dc['created_at'])).'<br>';
                echo '<ul type="square">';
                   echo '<li>'.$dc['comment'].'</li>';
                // echo $dc['comment'].'<br>';
                echo '</ul>';
              }  
          }//end if
        ?> 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<!--            <button type="button" class="btn btn-primary">Save changes</button>-->
        </div>
    </div>
  </div>
</div>

<?php if(($admin_info->access_level==2) || ($admin_info->access_level==3 || $admin_info->access_level==4)){//if(($admin_info->access_level ==2)  || ($admin_info->access_level ==3)){?>
<?php if(isset($comment_list_defer_director->comment) && strlen($comment_list_defer_director->comment)>0){ ?>
 

 

  <div class="row mt-3 col-md-12" > 
    <div class="col-sm-12 col-md-12">
     <!--  <div class="alert alert-danger" role="alert">
         <p class="font-weight-bold">Laboratory has been deferred.</p> -->
       <!--  <p class="font-weight-bold">Director Comment:</p>
        <pre><?php echo $comment_list_defer_director->comment; ?></pre> -->
    <!--   </div> -->
    </div>
  </div>
<?php } ?>
<?php } //end of access level?>




<div class="col-sm-12 col-md-12" style="margin-top:10px;">
    <div class="card border-top-blue mb-4">
      
      <div class="card-header">
        <div class="row">
          <div class="col-sm-12 col-md-8">
            <h4>Laboratories Registration Form</h4>
          </div>
          <div class="col-sm-12 offset-md-2 col-md-2">
            <h5 class="text-primary text-right">Step 1</h5>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
                  <div class="col-sm-12 col-md-12">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong>Application Information:</strong>
                  </div>
              </div>
            </div>
            <div class="row" style="margin-bottom:30px;">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="coopName">Name of the Laboratory</label>
                  <input type="text" class="form-control" name="labName" id="labName" disabled="" value="<?=$lab_info->laboratoryName.' Laboratory Cooperative'?>">
                </div>
              </div>
            </div>
<!--            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="typeOfBranch">Type:</label>
                  <select class="custom-select validate[required]" name="typeOfBranch" id="typeOfBranch">
                    <option value="">--</option>
                    <option value="Branch">Branch</option>
                    <option value="Satellite">Satellite</option>
                  </select>
                </div>
              </div>
            </div> -->
<!--            <div class="row">
              <div class="col-sm-12 col-md-12 col-industry-subclass">
                
              </div>
            </div>
            <br/>-->
<!--            <div class="row rd-row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="areaOfOperation">Coverage Area</label>
                  <select class="custom-select validate[required]" name="areaOfOperation" id="areaOfOperation">
                      <option value="Branch">Branch</option>
                        <option value="Satellite">Satellite</option>
                  </select>
                </div>
              </div>
            </div>-->
            
          </div>
          
<?php if($cooperator_list !=NULL): ?>
          
          
          <div class="row">
           <div class="col-sm-12 col-md-12" style="margin-bottom:40px;">
             <strong>List of Members/Cooperators</strong><br />
            <div class="row">
             
                 
        
              <?php $count=1; foreach($cooperator_list as $row): ?>
                <div class="col-sm-12 col-md-4">
                 <?php echo $count.'. '.ucfirst($row['full_name']).' '.ucfirst($row['middle_name']).' '.ucfirst($row['last_name']); ?>
                
                </div>

                   <?php $count++; endforeach; ?>

            </div>
          </div>
        <?php endif; ?>
          <div class="col-sm-12 col-md-12">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <strong>Address of Laboratory Cooperative</strong>
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="blkNo">House/Lot &amp; Blk No.</label>
                  <input type="text" class="form-control" name="blkNo" id="blkNo" disabled="" value="<?=$lab_info->house_blk_no?>">
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="streetName">Street Name</label>
                  <input type="text" class="form-control" name="streetName" id="streetName" disabled="" value="<?=$lab_info->streetName?>">
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label>Barangay</label>
                  <input type="text" class="custom-select" disabled="" value="<?=$lab_info->brgy?>">
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="city">City/Municipality</label>
                  <input type="text" class="custom-select" disabled="" value="<?=$lab_info->city?>">
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="province">Province</label>
                  <input type="text" class="custom-select" disabled="" value="<?=$lab_info->province?>">
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="region">Region</label>
                  <input type="text" class="custom-select" disabled="" value="<?=$lab_info->region?>">
                </div>
              </div>
            </div>
          </div>
        </div>
<!--          <div class="col-sm-12 offset-md-1 col-md-10 align-self-end">
            <div class="form-group">
              <div class="custom-control custom-checkbox text-center mt-2">
                <input type="checkbox" class="custom-control-input" id="branchAddAgree" name="branchAddAgree">
                <label class="custom-control-label" for="branchAddAgree"><p class="font-weight-bolder">I have read and agreed to our Terms and Conditions.</p></label>
              </div>
            </div>
          </div>-->
        </div>
      </div>
<!--      <div class="card-footer">
        <div class="row">
          <div class="col-sm-6 offset-md-10 col-md-2 align-self-center col-reserve-btn">
              <input class="btn btn-block btn-color-blue" type="submit" id="branchAddBtn" name="branchAddBtn" value="Submit" disabled="">
          </div>
        </div>
      </div>-->
    </div>


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
                <?= base_url().'laboratories/'.$encrypted_cid.'/laboratories_documents/bylaws_primary/'.$encrypted_ids;?>
        <?php elseif ($coop_info->grouping === 'Union'): ?>
                <?= base_url().'laboratories/'.$encrypted_ids.'/laboratories_documents/bylaws_union';?>
        <?php else: ?>
                <?= base_url().'laboratories/'.$encrypted_ids.'/laboratories_documents/bylaws_federation';?>
        <?php endif; ?>
        " class="btn btn-primary">View</a>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Article of Cooperation</h5>
        <p class="card-text">This is the generated Article of Cooperation</p>
        <a target="_blank" id="btn-article" href="
        <?php if ($coop_info->category_of_cooperative === 'Primary'): ?>
                <?= $url_ = base_url().'laboratories/'.$encrypted_cid.'/laboratories_documents/articles_cooperation_primary';?>
        <?php elseif ($coop_info->grouping === 'Union'): ?>
                <?= $url_ = base_url().'cooperatives/'.$encrypted_cid.'/documents/articles_cooperation_union';?>
        <?php else: ?>
                <?= $url_ = base_url().'cooperatives/'.$encrypted_cid.'/documents/articles_cooperation_federation';?>
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
                <?= base_url().'laboratories/'.$encrypted_cid.'/laboratories_documents/affidavit_primary_lab';?>
        <?php elseif ($coop_info->grouping === 'Union'): ?>
                <?= base_url().'cooperatives/'.$encrypted_cid.'/documents/affidavit_union';?>
        <?php else: ?>
                <?= base_url().'cooperatives/'.$encrypted_cid.'/documents/affidavit_federation';?>
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
          <a target="_blank" href="<?php echo base_url();?>laboratories/<?=$encrypted_cid?>/laboratories_documents/economic_survey_lab" class="btn btn-primary">View</a>
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
             
                
                 <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf_laboratory/<?=$encrypted_cid?>/1">

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
              <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf/<?=$encrypted_cid?>/2">

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
          <?php if($is_client && $coop_info->status<=1 || $coop_info->status==11): ?>
            <a href="<?php echo base_url();?>cooperatives/<?=$encrypted_id?>/documents/upload_document_two" class="btn btn-primary">Upload</a>
          <?php endif; ?>
        </div>
      </div>
  </div>
   <!-- end of modify -->

      <?php 
 // echo"<pre>";print_r($coop_type);echo"<pre>";
 // echo $this->encryption->decrypt(decrypt_custom($encrypted_cid));
$count=0;
  if($coop_type!=NULL)
  {
    foreach ($coop_type as $coop) : 
  
?>
    <div class="col-sm-12 col-md-4" style="margin-top:10px;">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?=$coop['coop_title']?></h5>
                <p class="card-text">


                  <?php $countcert = 1;
                            foreach($coop['link'] as $row_link)
                            {
                            
                             ?>

                               <a target="_blank" href="<?php echo base_url();?>laboratories_documents/view_document_one_lab3/<?=encrypt_custom($this->encryption->encrypt($row_link['id']))?>/<?=encrypt_custom($this->encryption->encrypt($row_link[
                               'filename']))?>/<?=$row_link['document_num']?>">

                                  <?php if($is_client) : ?>
                                    This is your <?=$coop['coop_title']?> document.
                                  <?php else : ?>
                                    <?php if($countcert == 1){
                                  ?>This is the <?=$coop['coop_title']?> document.<?php } ?><br><ul> Filename: <li><?=$row_link['filename']?></li></ul>
                                  <?php endif;?>
                             </a>

                             <?php $countcert++;
                            }
                          ?> 

                </p>
                <?php if($is_client && $coop_info->status<=1 || $coop_info->status==11): ?>
                    <a href="<?php echo base_url();?>cooperatives/<?=$encrypted_cid?>/documents/upload_document_others/<?=encrypt_custom($this->encryption->encrypt($coop['id']))?>" class="btn btn-primary">Upload</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php endforeach; ?>
<?php } //end if not null ?>
   <!-- end modify -->

   <div class="col-sm-12 col-md-4" style="margin-top:20px;">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Manual of Operation</h5>
           

            <?php if(isset($Manual_of_board)){
            $file_name = encrypt_custom($this->encryption->encrypt($Manual_of_board->filename)); ?>
          <!--  <a target="_blank" href="<?php echo base_url();?>laboratories/<?=$encrypted_id?>/view_document_laboratory/<?=$file_name?>/25">  </a> -->

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
             <?php if($is_client) : ?>
             <a href="<?php echo base_url();?>laboratories/<?=$encrypted_id?>/documents/upload_manual_operation/25" class="btn btn-primary">Upload</a>
            <?php endif; ?>

           <!--   <a target="_blank" href="<?php echo base_url();?>cooperatives/<?=$encrypted_id?>/documents/economic_survey" class="btn btn-primary">View</a> -->
        </div>
      </div>
  </div>


  <div class="col-sm-12 col-md-4" style="margin-top:10px;">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Board Resolution</h5>
            

             <?php if(isset($Board_of_resolution)){
                $file_name = encrypt_custom($this->encryption->encrypt($Board_of_resolution->filename));
            ?>
           <!--  <a target="_blank" href="<?php echo base_url();?>laboratories/<?=$encrypted_id?>/view_document_laboratory/<?=$file_name?>/26"> This is your Board Resolution document.</a>
 -->
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
             <?php if($is_client) : ?>
             <a href="<?php echo base_url();?>laboratories/<?=$encrypted_id?>/documents/upload_manual_operation/26" class="btn btn-primary">Upload</a>
           <?php endif; ?>
           

           

        </div>
      </div>



</div>

<!-- OTHERS -->
  <div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Other Requirements</h5>
            <p class="card-text">
              <!-- modify by json -->
              <?php if(isset($document_others_lab)) : ?>
               <!--  <a target="_blank" href="<?php echo base_url();?>cooperatives/<?=$encrypted_id?>/documents/view_document_one/<?= encrypt_custom($this->encryption->encrypt($document_one->filename))?>"> -->

                 <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf_laboratory/<?=$encrypted_id?>/42">

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

            <?php if($is_client) : ?>
                <a href="<?php echo base_url();?>laboratories/<?=$encrypted_id?>/documents/upload_document_others_lab" class="btn btn-primary">Upload</a>
                <!-- <a href="<?php echo base_url();?>branches/<?=$encrypted_id?>/documents/upload_document_others_bns" class="btn btn-primary">Upload</a> -->
            <?php endif;?>

        </div>
      </div>
  </div>
  <!-- OTHERS END --> 

</div> <!-- end of row -->
<script src="<?=base_url();?>assets/js/jquery-3.7.1.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
      $('#btn-article').on('click',function(){
          alert("If total number of pages in Acknowledgement didn't appear, please refresh the page.");
            window.open('<?=$url_?>');
            return false;
      });
  });
  
</script>
