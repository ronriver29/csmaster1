  <div class="row mb-2">

  <div class="col-sm-12 col-md-12">

    <?php if($coop_info->status == 11 || $coop_info->status == 10 || $coop_info->status == 9 || $coop_info->status ==2 || ($coop_info->status ==6 && $coop_info->third_evaluated_by>0))

    {

    ?>

          <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>amendment" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>

    <?php    

    }

    else

    {

    ?>

         <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>amendment" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>

    <?php    

    }

    ?>  

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

     <!-- FOR SENIOR  -->



            <?php /* if(!$is_client && $admin_info->access_level == 2 && $coop_info->status ==12) {?>

              <div class="btn-group float-right" role="group" aria-label="Basic example">

                <!-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#denyCooperativeModal" data-cname="<?= $proposedName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Deny</button> -->

                <button type="button" class="btn btn-secondary btn-sm btn-dark" data-toggle="modal" data-target="#revert_Modal"  data-cname="<?=$proposedName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Revert for re-evaluation</button>

              </div>  

            <?php } */?>

            <!-- END SENIOR -->



    <?php if($is_client) : ?>

    <h5 class="text-primary text-right">

    </h5> 

  <?php else :?>

    <?php $status_arrays= array(10,11,12); 

    if (!in_array($coop_info->status, $status_arrays)){?>

   <!--  <?php if($admin_info->access_level != 3 && $admin_info->access_level != 4){

            $submit = 'Submit';

        } else {

            $submit = 'Approve';

        }?> -->

    <?php if($admin_info->access_level !=5) : ?>

     

      <div class="btn-group float-right" role="group" aria-label="Basic example">

        <a  class="btn btn-info btn-sm" href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_cooperative_tool">Validation Tool</a>

        <!-- Supervising -->

        <?php if($is_active_director || $supervising_): ?>

        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveAmendmentModal"  data-cname="<?= $proposedName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($amendment_id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?>> Approve<!-- <?=$submit?> --></button>

      <?php endif; ?>

        <!-- end Supervising -->

    <?php if($admin_info->access_level == 3 && $is_active_director || $supervising_) {?>

        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#denyCooperativeModal" data-cname="<?= $proposedName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Deny</button>



        <?php 

        if($coop_info->status ==17)

        {

          ?>

           <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#revertCooperativeModal"  data-cname="<?=$proposedName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Defer</button>

      <?php

        }

        else

        {   

      ?>    

           <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#deferCooperativeModal"  data-cname="<?=$proposedName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Defer</button>

      <?php    

        }

       ?>  

       

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

<?php endif;?>

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

    <?php if(!empty($cds_comment) && $cds_comment !=NULL):?>

    <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg">* CDS Findings</button>



    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

      <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

              <h4 class="modal-title" id="deferMemberModalLabel">CDS Findings</h4>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">

              <span aria-hidden="true">&times;</span>

            </div>

            <div class="modal-body" style="overflow: hidden;">

             

                  <?php

                  echo '<p class="font-weight-bold">CDS Tool Findings:</p>';

                  // echo '<p>'.nl2br($coop_info->tool_findings).'</p>';

                  if(is_array($cds_comment) && count($cds_comment)>0):

                     foreach($cds_comment as $cc) : 



                    echo'<div class="row">';

                    echo '<div class="col-md-12">';

                      echo nl2br($cc['tool_findings']);

                    echo'</div>';

                    echo'</div>';  

                  ?>

               

              

              <table class="table"  with="100%" style="table-layout:fixed">

                <thead>

                  <tr>

                    <th style="border:1px solid black;">Documents</th>

                    <th style="border:1px solid black;">Findings</th>

                    <th style="border:1px solid black;">Recommended Action</th>

                  </tr>

                </thead>

                <tbody>

                  <tr>

                    <td class="col-md-4" style="border:1px solid black;padding-top:5px;text-align: left;"><?php 

                           

                              if(strlen($cc['documents'])>0)

                                {

                                  echo 'Date: '.date("F d, Y",strtotime($cc['created_at']));

                                    echo '<ul type="square">';

                                    echo '<li>'.nl2br($cc['documents']).'</li>';

                                    echo '</ul>';

                                }

                           

                    ?>

                    </td>

                    <td class="col-md-4" style="word-break: break-all;border:1px solid black;padding-top:5px;text-align: left;"><?php 

                            if(strlen($cc['comment'])>0)

                            {

                              echo 'Date: '.date("F d, Y",strtotime($cc['created_at']));

                              echo '<ul type="square">';

                                echo '<li>'.nl2br($cc['comment']).'</li>';

                              echo '</ul>';

                            }

                     

                    ?>

                    </td>

                  <td class="col-md-4" style="border:1px solid black;padding-top:5px;text-align: left;">

                        <?php

                       

                        echo 'Date: '.date("F d, Y",strtotime($cc['created_at']));

                        echo '<ul type="square">';

                          echo '<li>'.nl2br($cc['rec_action']).'</li>';

                        echo '</ul>';

                        

                        ?>

                  </td>

                </tr>

              </tbody>

              </table>  

             <?php endforeach;?>

            <?php endif;?>

          </div> <!-- modal body -->

          <div class="modal-footer">

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            <!--<button type="button" class="btn btn-primary">Save changes</button>-->

          </div>

        </div> <!-- modal content -->

      </div> <!-- modal dialog -->

    </div>

    <?php endif; //end of strlen commetn ?>



    <!-- END CDS -->

   <!--  START SENIOR --> 

   <?php if(!empty($senior_comment_array) && is_array($senior_comment_array)): ?>

    <?php $senior_comment = array_filter($senior_comment); ?>

   <?php if(strlen($senior_comment_array && $admin_info->access_level==3 ) || strlen($senior_comment_array && $admin_info->access_level==2) || strlen($senior_comment_array && $admin_info->access_level==4) && $coop_info->status!=15) : ?>

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

                <?php

                foreach($senior_comment_array as $cc){

                ?>

                <div class="form-group">

                  <div class="col-md-12">

                    <?php

                    echo '<p class="font-weight-bold">CDS Tool Findings:</p>';

                    echo '<p>'.nl2br($cc['tool_findings']).'</p>';

                    ?>

                  </div>

                </div>

                <table class="table"  with="100%">

                  <thead>

                    <tr>

                      <th style="border:1px solid black;">Documents</th>

                      <th style="border:1px solid black;">Findings</th>

                      <th style="border:1px solid black;">Recommended Action</th>

                    </tr>

                  </thead>

                  <tbody>

                    <tr>

                      <td style="border:1px solid black;padding-top:5px;text-align: left;">

                        <?php

                     

                        echo 'Date: '.date("F d, Y",strtotime($cc['created_at']));

                        echo '<ul type="square">';

                          echo '<li>'.nl2br($cc['documents']).'</li>';

                        echo '</ul>';

                        

                   

                        ?>

                      </td>

                      <td style="border:1px solid black;padding-top:5px;text-align: left;">

                        <?php

                        echo 'Date: '.date("F d, Y",strtotime($cc['created_at']));

                        echo '<ul type="square">';

                          echo '<li>'.nl2br($cc['comment']).'</li>';

                        echo '</ul>';

                        ?>

                      </td>

                      <td style="border:1px solid black;padding-top:5px;text-align: left;">

                        <?php

                        echo 'Date: '.date("F d, Y",strtotime($cc['created_at']));

                        echo '<ul type="square">';

                          echo '<li>'.nl2br($cc['rec_action']).'</li>';

                        echo '</ul>';

                        ?>

                      </td>

                    </tr>

                    

                  </tbody>

                </table>

                  <?php } //end foreach?>

              </div>



              <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                <!--            <button type="button" class="btn btn-primary">Save changes</button>-->

              </div>

              </div>

              </div>

              </div>

             

    <?php endif;?>

    <?php endif;?>          

   <!--  END SENIOR --> 

      <!--  START DIRECTOR -->



  <?php if(!empty($director_comment_array) && is_array($director_comment_array)): ?>

  <?php if(strlen(($director_comment_array && $admin_info->access_level==3) || ($director_comment && $admin_info->access_level==2) || ($admin_info->access_level==4) && $coop_info->status == 6 || strlen(($admin_info->access_level==2 && $coop_info->status == 12)))) : ?>

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

             <?php 

          

                foreach($director_comment_array as $cc) :

                    echo '<p class="font-weight-bold">CDS Tool Findings:</p>';

                    echo '<p>'.nl2br($cc['tool_findings']).'</p>'; 

                  ?>

            <table class="table"  with="100%">

                <thead>

                  <tr>

                    <th style="border:1px solid black;">Documents</th>

                    <th style="border:1px solid black;">Findings</th>

                    <th style="border:1px solid black;">Recommended Action</th>

                  </tr>

                </thead>

                <tbody>

                  

                  <tr>

                    <td style="border:1px solid black;padding-top:5px;text-align: left;">

                       <?php

                           

                                  echo 'Date: '.date("F d, Y",strtotime($cc['created_at']));

                                  echo '<ul type="square">';

                                      echo '<li>'.nl2br($cc['documents']).'</li>';

                                  echo '</ul>'; 

                                 

                           

                          ?>   

    

                    </td>

                    <td style="border:1px solid black;padding-top:5px;text-align: left;">

                          <?php

                               

                                    echo 'Date: '.date("F d, Y",strtotime($cc['created_at']));

                                    echo '<ul type="square">';

                                        echo '<li>'.nl2br($cc['comment']).'</li>';

                                    echo '</ul>'; 

                                 

                            ?>

                    </td>

                    <td style="border:1px solid black;padding-top:5px;">

                         <?php

                               

                                  echo 'Date: '.date("F d, Y",strtotime($cc['created_at']));

                                  echo '<ul type="square">';

                                      echo '<li>'.nl2br($cc['rec_action']).'</li>';

                                  echo '</ul>'; 

                                 

                              



                          ?> 

                    </td>

                  </tr>

                </tbody>

              </table>

            <?php endforeach;?>

          </div>



          <div class="modal-footer">

              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

  

          </div>

      </div>

    </div>

  </div>

 



  <?php endif; //end of is clien?> 

   <?php endif; //end of is clien?> 



 <?php endif; //end of is clien?> 

<?php endif; //end strlen of director comment?>

<!-- END DIRECTOR -->



 <!--  START SUPERVISING -->



  <?php if(!empty($supervising_comment) && is_array($supervising_comment)): ?>

  <?php if(strlen(($supervising_comment && $admin_info->access_level==4) || ($supervising_comment && $admin_info->access_level==2) || ($admin_info->access_level==3) && $coop_info->status == 6 || strlen(($admin_info->access_level==2 && $coop_info->status == 12)))) : ?>

  <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg4">* Supervising CDS Findings</button>



  <div class="modal fade bd-example-modal-lg4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

      <div class="modal-content">

          <div class="modal-header">

              The cooperative has been deferred because of the following reason/s:

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                  <span aria-hidden="true">&times;</span>

          </div>

          <div class="modal-body" style="table-layout: fixed;">

             <?php 

                    echo '<p class="font-weight-bold">CDS Tool Findings:</p>';

                    echo '<p>'.nl2br($tool_findings).'</p>'; 

                  ?>

            <table class="table"  with="100%">

                <thead>

                  <tr>

                    <th style="border:1px solid black;">Documents</th>

                    <th style="border:1px solid black;">Findings</th>

                    <th style="border:1px solid black;">Recommended Action</th>

                  </tr>

                </thead>

                <tbody>

                  

                  <tr>

                    <td style="border:1px solid black;padding-top:5px;text-align: left;">

                       <?php

                           if(is_array($supervising_comment) && count($supervising_comment)>0):   

                              foreach($supervising_comment as $cc) :

                                if(strlen($cc['documents'])>0)

                                {

                                  echo 'Date: '.date("F d, Y",strtotime($cc['created_at']));

                                  echo '<ul type="square">';

                                      echo '<li>'.nl2br($cc['documents']).'</li>';

                                  echo '</ul>'; 

                                 

                                }

                              endforeach;

                            endif;

                          ?>   

    

                    </td>

                    <td style="border:1px solid black;padding-top:5px;text-align: left;">

                          <?php

                                if(is_array($supervising_comment) && count($supervising_comment)>0):

                                  foreach($supervising_comment as $cc) :

                                    if(strlen($cc['comment'])>0)

                                    {

                                    echo 'Date: '.date("F d, Y",strtotime($cc['created_at']));

                                    echo '<ul type="square">';

                                        echo '<li>'.nl2br($cc['comment']).'</li>';

                                    echo '</ul>'; 

                                   

                                    }

                                  endforeach;

                                endif;

                            ?>

                    </td>

                    <td style="border:1px solid black;padding-top:5px;">

                         <?php

                                if(is_array($supervising_comment) && count($supervising_comment)>0):

                                // echo'CDS COMMENT :'.PHP_EOL;

                                foreach($supervising_comment as $cc) :

                                  if(strlen($cc['rec_action'])>0)

                                  {

                                  echo 'Date: '.date("F d, Y",strtotime($cc['created_at']));

                                  echo '<ul type="square">';

                                      echo '<li>'.nl2br($cc['rec_action']).'</li>';

                                  echo '</ul>'; 

                                 

                                  }

                                endforeach;

                                endif;



                          ?> 

                    </td>

                  </tr>

                </tbody>

              </table>

          </div>

          <div class="modal-footer">

              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

  <!--            <button type="button" class="btn btn-primary">Save changes</button>-->

          </div>

      </div>

    </div>

  </div>



<?php endif; ?>

<?php endif; //end strlen of director comment?>

<!-- END SUPERVISING -->

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

  <?php if($acbl['bylaws'] == true):?>

  <div class="col-sm-12 col-md-4">

    <div class="card">

      <div class="card-body">

        <h5 class="card-title">By Laws</h5>

        <p class="card-text">This is the generated Bylaws. </p>

        <a target="_blank" href="

        <?php if ($coop_info->category_of_cooperative === 'Primary'): ?>

                <?= base_url().'amendment/'.$encrypted_id.'/amendment_documents/bylaws_primary';?>

        <?php elseif ($coop_info->grouping === 'Union'): ?>

                <?= base_url().'amendment/'.$encrypted_id.'/document/bylaws_union';?>

        <?php else: ?>

                <?= base_url().'amendment/'.$encrypted_id.'/bylaw_federation';?>

        <?php endif; ?>

        " class="btn btn-primary">View</a>

      </div>

    </div>

  </div>

<?php endif; ?>



<?php  if($acbl['articles']==true):?>

  <div class="col-sm-12 col-md-4">

    <div class="card">

      <div class="card-body">

        <h5 class="card-title">Article  of Cooperation</h5>

        <p class="card-text">This is the generated Article  of Cooperation</p>
        <?php if ($coop_info->category_of_cooperative === 'Primary'): ?>

                <?php $url_ = base_url().'amendment/'.$encrypted_id.'/amendment_documents/articles_cooperation_primary';?>

        <?php elseif ($coop_info->category_of_cooperative === 'Others'): ?>

                <?php $url_= base_url().'amendment/'.$encrypted_id.'/document/articles_union';?>

        <?php else: ?>

                <?php $url_ = base_url().'amendment/'.$encrypted_id.'/document/articles_federation';?>

        <?php endif; ?>

        <a target="_blank" href="<?=$url_?>" class="btn btn-primary" id="btn-article">View</a>

      </div>

    </div>

  </div>

<?php endif; ?>

  <div class="col-sm-12 col-md-4">

    <div class="card">

      <div class="card-body">

        <h5 class="card-title">Treasurer's Affidavit</h5>

        <p class="card-text">This is the generated Treasurer's Affidavit.</p>

        <a target="_blank" href="

        <?php if ($coop_info->category_of_cooperative === 'Primary'): ?>

                <?= base_url().'amendment/'.$encrypted_id.'/amendment_documents/affidavit_primary';?>

        <?php elseif ($coop_info->category_of_cooperative === 'Others'): ?>

                <?= base_url().'amendment/'.$encrypted_id.'/document/affidavit_union';?>

        <?php else: ?>

                <?= base_url().'amendment/'.$encrypted_id.'/document/affidavit_federation';?>

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

  <?php $acceptedStatus= array(1,11); ?>

  <div class="col-sm-12 col-md-4">

      <div class="card">

        <div class="card-body">

          <h5 class="card-title">General Assembly Resolution</h5>

            <p class="card-text">

              <!-- modify by json -->

              <?php 

              if($ga) 

              { 

              ?>

                 <a target="_blank" href="<?php echo base_url();?>amendment_documents/list_upload_pdf/<?=$encrypted_id?>/19">

                  <?php if($is_client) : ?>

                    This is your General Assembly Resolution document.

                  <?php else : ?>

                   General Assembly Resolution document.

                  <?php endif;?>

                </a>

              <?php

              }

              else

              {

              ?>

                 Please upload your required  General Assembly Resolution document.    

              <?php   

              }

              ?>

               <br>

               <?php if($is_client && in_array($coop_info->status,$acceptedStatus)): ?>

               <a href="<?php echo base_url();?>amendment/<?=$encrypted_id?>/amendment_documents/upload_document_one" class="btn btn-primary">Upload</a>

               <?php endif; ?> 

            </p>

        </div>

      </div>

  </div>



 



<!-- modify json -->

  <div class="col-sm-12 col-md-4">

      <div class="card">

        <div class="card-body">

          <h5 class="card-title">BOD and Secretary Certificate</h5>

            <p class="card-text">

              <?php 

              if($bod_sec)

              {

              ?>

              <a target="_blank" href="<?php echo base_url();?>amendment_documents/list_upload_pdf/<?=$encrypted_id?>/20">

                <?php if($is_client) : ?>

                  This is your PBOD and Secretary Certificate document.

                <?php else : ?>

                  BOD and Secretary Certificate document.

                <?php endif;?>

               </a>

              <?php

              }

              else

              {

              ?>

                 Please upload your required BOD and Secretary Certificate document

            <?php  

              }

              ?>

               <br>

              <?php if($is_client && in_array($coop_info->status,$acceptedStatus)): ?>

                 <a href="<?php echo base_url();?>amendment/<?=$encrypted_id?>/amendment_documents/upload_document_two" class="btn btn-primary">Upload</a>

              <?php endif; ?>

               </p>

        </div>

      </div>

  </div>



    

<!-- </div>

<div class="row" style="padding-top:20px;"> -->

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

  <br />

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







  <div class="col-sm-12 col-md-4">

      <div class="card">

        <div class="card-body">

          <h5 class="card-title">Other Requirements</h5>

            <p class="card-text">

              <?php 

              if($other_doc)

              {

              ?>

              <a target="_blank" href="<?php echo base_url();?>amendment_documents/list_upload_pdf/<?=$encrypted_id?>/30">

                <?php if($is_client) : ?>

                  This is your other uploaded documents.

                <?php else : ?>

                  Other uploaded document.

                <?php endif;?>

               </a>

              <?php

              }

              else

              {

               

                echo 'Other uploaded document.';

              }

              ?>

              <br>

              <?php if($is_client && in_array($coop_info->status,$acceptedStatus)): ?>

                

                 <a href="<?php echo base_url();?>amendment/<?=$encrypted_id?>/amendment_documents/upload_document_other" class="btn btn-primary">Upload</a>

             

              <?php endif; ?>

               </p>

        </div>

      </div>

  </div>



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

