<style>
    @media screen and (min-width: 676px) {
        .modal-dialog {
          max-width: 1200px; /* New width for default modal */
        }
    }
</style>

<?php 
$brgy ='';
$city='';
$province='';
$region='';
  if(isset($coop_info2))
  {
    $brgy = $coop_info2->brgy;
    $city = $coop_info2->city;
    $province = $coop_info2->province;
    $region = $coop_info2->region;
  }
?>
<div class="row mb-2">
  <div class="col-sm-12 col-md-2">
    <?php if($is_client){ ?>
    <a class="btn btn-secondary btn-sm btn-block"  href="<?php echo base_url();?>amendment" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <?php }else{ ?>

       <a class="btn btn-secondary btn-sm btn-block"  href="<?php echo base_url();?>updated_amendment_info" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
     <?php } ?>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
<?php if($this->session->flashdata('amendment_msg')) :?>   
       <div class="alert alert-<?=$this->session->flashdata('msg_class')?> alert-dismissible">
         <button type = "button" class="close" data-dismiss = "alert">x</button>
         <?=$this->session->flashdata('amendment_msg')?>
       </div>
   <?php endif; ?>
 </div>
</div>
<?php if($this->session->flashdata('redirect_message')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-info text-center" role="alert">
      <?php echo $this->session->flashdata('redirect_message'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('cooperative_success')): ?>



<?php endif; ?>
<?php if($this->session->flashdata('cooperative_error')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-danger text-center" role="alert">
      <?php echo $this->session->flashdata('cooperative_error'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php if($coop_info->status==0): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-warning text-center" role="alert">
        Your reservation has expired. Please update your cooperative details.
      </div>
    </div>
  </div>

<?php endif; ?>


<?php if(!$is_client) :?>

  <!-- START CDS -->
    <?php if(!empty($cds_comment) && $cds_comment !=NULL && $coop_info->status >3):?>
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
                  if(!$is_client){
                  echo '<p class="font-weight-bold">CDS Tool Findings:</p>';
                  }
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
 

  <?php endif; //end director array?> 
   <?php endif; //end director if?> 
<?php endif; //no is client?>

<?php if($is_client && $coop_info->status==11 && ($coop_info->evaluated_by > 0) || ($is_client && $is_deferred)) : ?>
  
  <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg3">* Deferred Reason/s</button>

  <div class="modal fade bd-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg3">
      <div class="modal-content">
          <div class="modal-header">
              The cooperative has been deferred because of the following reason/s:
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
          </div>
          <div class="modal-body" style="table-layout: fixed;">
        
        <?php   
          if(is_array($deffered_comment) && count($deffered_comment)>0):  
            foreach($deffered_comment as $cc) :
        ?>
            <div class="form-group">
                <div class="col-md-12">
                  <?php 
                  if(!$is_client)
                  {
                    echo '<p class="font-weight-bold"> Tool Findings:</p>';
                  }
                              echo '<b>Date: '.date("F d, Y",strtotime($cc['created_at'])).'</b>';
                              echo '<ul type="square">';
                              echo '<li>'.nl2br($cc['tool_findings']).'</li>';
                              echo '</ul>';   
                 
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

        <?php
            endforeach;
          endif;
        ?>             
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <!--            <button type="button" class="btn btn-primary">Save changes</button>-->
          </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php if($is_client && $coop_info->status==10 && ($coop_info->evaluated_by > 0)) : ?>
  
  <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg6">* Denied Reason/s</button>

  <div class="modal fade bd-example-modal-lg6" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg6">
      <div class="modal-content">
           <div class="modal-header">
              The cooperative has been denied because of the following reason/s:
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
          </div>
          <div class="modal-body" style="table-layout: fixed;">
        
        <?php   
          if(is_array($denied_comment) && count($denied_comment)>0):  
            foreach($denied_comment as $cc) :
        ?>
            <div class="form-group">
                <div class="col-md-12">
                  <?php 
                    if(!$is_client)
                    {
                        echo '<p class="font-weight-bold"> Tool Findings:</p>';
                    }
                              echo '<b>Date: '.date("F d, Y",strtotime($cc['created_at'])).'</b>';
                              echo '<ul type="square">';
                              echo '<li>'.nl2br($cc['tool_findings']).'</li>';
                              echo '</ul>';   
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

        <?php
            endforeach;
          endif;
        ?>             
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <!--            <button type="button" class="btn btn-primary">Save changes</button>-->
          </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<hr>
<div class="row mb-2">
  <div class="col-sm-12 col-md-4">
    <div class="card border-top-blue shadow-sm mb-4">
      <?php if(!$is_client) : ?>
        <div class="card-header">
          <div class="row">
            <div class="col-sm-6 col-md-8">
              <h5 class="float-left font-weight-bold">Basic Information</h5>
            </div>
            <div class="col-sm-6 col-md-4">
              <small class="float-right">
                <?php if($coop_info->status!=0): ?>
                  <span class="badge badge-success">COMPLETE</span>
                <?php endif; ?>
                <?php if($coop_info->status==0) :?>
                  <span class="badge badge-secondary">PENDING</span>
                <?php endif; ?>
              </small>
            </div>
          </div>
        </div>
      <?php endif;?>
      <?php if($is_client) : ?>
        <div class="card-header">
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <h5 class="float-left font-weight-bold">Basic Information</h5>
            </div>
          </div>
        </div>
      <?php endif;?>
      <div class="card-body">
        <small>
        <strong>Cooperative Name:</strong>
        <p class="text-muted">
         
           <?php 
           // $count_type =explode(',',$coop_info->type_of_cooperative);
           // if(strlen($coop_info->acronym)>0)
           // {
           //    $acronym_ = '('.$coop_info->acronym.')';
           // }
           // else
           // {
           //  $acronym_='';
           // }
           //  if(count($count_type)>1)
           //  {
           //    $proposedName_ = $coop_info->proposed_name.' Multipurpose Cooperative '.$coop_info->grouping.' '.$acronym_ ;
           //  }
           //  else
           //  {
           //     $proposedName_ = $coop_info->proposed_name.' '.$coop_info->type_of_cooperative.' Cooperative '.$coop_info->grouping.' '.$acronym_;
           //  }
           // $proposedName_ ;// = $coop_info->coopName;
           echo $coop_info->coopName;
           ?>
    
         

        </p>
        <hr>
        <strong>Category of Cooperative</strong>
        <p class="text-muted">
          <?=$coop_info->category_of_cooperative?><br>
         
        </p>
        <hr>
         <strong>Type of Cooperative</strong>
        <p class="text-muted">
          <?php
            if(count(explode(',',$coop_info->type_of_cooperative ))>1)
            {
              echo 'Multipurpose : '.$coop_info->type_of_cooperative;
            }
            else
            {
              echo $coop_info->type_of_cooperative;
            }
          ?>
        </p>
        <hr>
        <?php if($coop_info->grouping!='Union'){?>
        <strong>Business Activities - Subclass</strong>
        <p class="text-muted">
          <?php
          if($business_activities !=null)
          {
           foreach($business_activities as $casd) : ?>
        
          &#9679; <?= $casd['bactivity_name'] ?> - <?= $casd['bactivitysubtype_name']?><br>
          <?php endforeach; ?>
         <?php }?>
        </p>
        <hr>
      <?php }?>
        <strong>Common Bond of Membership</strong>
        <p class="text-muted"> <?=$coop_info->common_bond_of_membership?></p>
         <hr>
          <?php
           if($coop_info->common_bond_of_membership=='Associational' || $coop_info->common_bond_of_membership=='Institutional')
           {
            ?>
            <strong>Field of Membership:</strong>
            <p class="text-muted"><?=$coop_info->field_of_membership?></p>
             <hr>
              <strong>Name of Associational:</strong>
              <p class="text-muted"><?=$coop_info->name_of_ins_assoc?></p>
            <?php
           }
           elseif($coop_info->common_bond_of_membership=='Occupational')
           {
            ?>

            <strong>Composition of Members</strong>
            <p class="text-muted">
              <?php foreach($members_composition as $compo) : ?>
              &#9679; <?= $compo['composition'] ?><br>
              <?php endforeach; ?>
            </p>

            <?php
           }
           else
           {
            
           }
           ?>
       
      
        <hr>
        <strong>Area of Operation</strong>
        <p class="text-muted">
          <?php
          if($coop_info->area_of_operation == 'Interregional')
          {
             $regions_array  = array();
             foreach($regions_list as $regions)
             {
              array_push($regions_array, $regions['regDesc']);
             }
              $last  = array_slice($regions_array, -1);
              $first = join(', ', array_slice($regions_array, 0, -1));
              $both  = array_filter(array_merge(array($first), $last), 'strlen');
              echo 'Inter-Regional - '. join(' and ', $both);
          }
          else
          {
            echo $coop_info->area_of_operation;
          }
          ?>
        </p>
        <hr>
        <strong>Proposed address of the cooperative</strong>
        <p class="text-muted">
          <?php if($coop_info->house_blk_no==null && $coop_info->street==null) $x=''; else $x=', ';?>
          <?=ucwords($coop_info->house_blk_no)?> <?=ucwords($coop_info->street).$x?> <?=$brgy.', '?> <?=$city.', '?> <?= $province.', '?> <?=$region?>
        </p>
        <hr>
        <?php if($is_client) : ?>
          <strong>Status</strong>
          <p class="text-muted"> 
            <!-- <?php if($coop_info->status==0) echo "EXPIRED"; ?>
            <?php if($coop_info->status==1) echo "PENDING"; ?>
            <?php if($coop_info->status==6 && $coop_info->third_evaluated_by>0) echo "FOR RE-EVALUATION";?>
            <?php if($coop_info->status>=2 && $coop_info->status<=9 && $coop_info->third_evaluated_by <=0) echo "ON EVALUATION"; ?>

            <?php if($coop_info->status==10) echo "DENIED"; ?>
            <?php if($coop_info->status==11) echo "DEFERRED"; ?>
            <?php if($coop_info->status==12) echo "FOR PRINTING & SUBMISSION"; ?> 

            <?php if($coop_info->status==13 || $coop_info->status==14) echo "COMPLETE"; ?>
            <?php if($coop_info->status==15) echo "REGISTERED"; ?>
            <?php if($coop_info->status==16) echo "FOR PAYMENT"; ?>
            <?php if($coop_info->status==17) echo "REVERT FOR RE-EVALUATION"; ?> -->

            <?php if($coop_info->status==0) echo "EXPIRED"; ?>
            <?php if($coop_info->status==1) echo "PENDING"; ?>
            <?php if($coop_info->status==2) echo "FOR VALIDATION"; ?>
            <?php if($coop_info->status>=3 && $coop_info->status<=5) echo "FOR VALIDATION"; ?>
            <?php if($coop_info->status>=6 && $coop_info->status<=9 && $coop_info->third_evaluated_by<=0) echo "FOR EVALUATION"; ?>
            <?php if($coop_info->status>=2 && $coop_info->status<=9 && $coop_info->third_evaluated_by<0) echo "ON EVALUATION"; ?>
            <?php if($coop_info->status==9 && $coop_info->third_evaluated_by>0) echo "FOR RE-EVALUATION";?>
            <?php if($coop_info->status==10) echo "DENIED"; ?>
            <?php if($coop_info->status==11 && !$this->amendment_model->check_if_revert($coop_info->id)) echo "DEFERRED"; ?>
            <?php if($coop_info->status==11 && $this->amendment_model->check_if_revert($coop_info->id)) echo "REVERTED-DEFERRED"; ?>
            <?php if($coop_info->status==12) echo "FOR PRINTING & SUBMISSION"; ?>
            <?php if($coop_info->status==17) echo "FOR REVERSION-FOR RE-EVALUATION"; ?>

            <?php if($coop_info->status==13 || $coop_info->status==14) echo "COMPLETE"; ?>
            <?php if($coop_info->status==15) echo "REGISTERED"; ?>
              <?php if($coop_info->status==16) echo "FOR PAYMENT"; ?> 
          </p>
          <hr> 
          <?php if($coop_info->status==1 || $coop_info->status==12) :?>
            <strong>Expiration</strong>
            <p class="text-muted">
              <?= date("Y-m-d h:i:sa",strtotime($coop_info->expire_at)) ?>
            </p>
          <?php endif; ?>
        <?php endif; ?>
      </small>
      </div>
      <?php if(($is_client && ($coop_info->status==11||$coop_info->status<=1)) || (!$is_client &&  $coop_info->status==3) || (!$is_client &&  $coop_info->status==6)): ?>
        <div class="card-footer">
          <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_update" class="btn btn-block btn-color-blue"><i class='fas fa-edit'></i> Update Basic Information</a>
        </div>
      <?php endif; ?>
    </div>
  </div>
<?php if(!$is_client) : ?>
  <div class="col-sm-12 col-md-8">
    <ul class="list-group">

        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold "> </h5>
            <small>
              <?php if($coop_info->status!=0): ?>
                <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if($coop_info->status==0) :?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
           <h5 class="mb-1 font-weight-bold">Cooperative Basic Information.</h5>
           <small class="text-muted">
            <a href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>/update" class="btn btn-info btn-sm">View</a>
          </small>
        </li>
    
      <li class="list-group-item  flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1 font-weight-bold">Additional Information: By Laws</h5>
          <small class="text-muted">
            <?php if($bylaw_complete): ?>
              <span class="badge badge-success">COMPLETE</span>
            <?php endif; ?>
            <?php if(!$bylaw_complete) :?>
              <span class="badge badge-secondary">PENDING</span>
            <?php endif; ?>
          </small>
        </div>

          <small class="text-muted">
            <?php  if($is_update_cooperative): ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>/bylaw_update" class="btn btn-info btn-sm">View </a>
          </small>
        <?php endif; ?>
          </small>
        
      </li>
       <?php if($coop_info->grouping !=='Union') :?>
      <li class="list-group-item  flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1 font-weight-bold">Additional Information: Capitalization</h5>
          <small class="text-muted">
            <?php if($capitalization_complete): ?>
              <span class="badge badge-success">COMPLETE</span>
            <?php endif; ?>
            <?php if(!$capitalization_complete) :?>
              <span class="badge badge-secondary">PENDING</span>
            <?php endif; ?>
          </small>
        </div>
        <?php  if($coop_info->status!= 0): ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>/capitalization" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif; ?>
      </li>
      <?php endif; ?>  
      <li class="list-group-item  flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
           <?php 
       
          switch ($coop_info->grouping) {
            case 'Union':
                 $module = 'Members';
                 $moduleUrl = 'union_update';
              break;
            case 'Federation':
                   $module = 'Members';
                 $moduleUrl = 'update_affiliators';
            break;
            default:
                 $module ='Cooperators';
                 $moduleUrl ='amendment_cooperators';
              break;
          }
          ?>
          <h5 class="mb-1 font-weight-bold">List of <?=$module?></h5>
          <!-- <h5 class="mb-1 font-weight-bold">List of Cooperators</h5> -->
          <small class="text-muted">
            <?php if($cooperator_complete): ?>
              <span class="badge badge-success">COMPLETE</span>
            <?php endif; ?>
            <?php if(!$cooperator_complete): ?>
              <span class="badge badge-secondary">PENDING</span>
            <?php endif; ?>
          </small>
        </div>


       
         
           <small class="text-muted">
            <a href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>/<?=$moduleUrl?>" class="btn btn-info btn-sm">View</a>
          </small> 
        </li>
  
      <li class="list-group-item  flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1 font-weight-bold">Cooperative's Purposes</h5>
          <small class="text-muted">
            <?php if($purposes_complete): ?>
              <span class="badge badge-success">COMPLETE</span>
            <?php endif; ?>
            <?php if(!$purposes_complete) :?>
              <span class="badge badge-secondary">PENDING</span>
            <?php endif; ?>
          </small>
        </div>
      
        <small class="text-muted">
            <a href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>/purposes" class="btn btn-info btn-sm">View</a>
          </small> 
    
      </li>
      <li class="list-group-item  flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1 font-weight-bold">Additional Information: Articles of Cooperation</h5>
          <small class="text-muted">
            <?php if($article_complete): ?>
              <span class="badge badge-success">COMPLETE</span>
            <?php endif; ?>
            <?php if(!$article_complete) :?>
              <span class="badge badge-secondary">PENDING</span>
            <?php endif; ?>
          </small>
        </div>
     <small class="text-muted">
            <a href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>/articles_update" class="btn btn-info btn-sm">View</a>
          </small> 
      </li>
      <li class="list-group-item  flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1 font-weight-bold">List of Committees</h5>
          <small class="text-muted">
            <?php if($committees_complete): ?>
              <span class="badge badge-success">COMPLETE</span>
            <?php endif; ?>
            <?php if(!$committees_complete): ?>
              <span class="badge badge-secondary">PENDING</span>
            <?php endif; ?>
          </small>
        </div>
        <small class="text-muted">
            <a href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>/committees_update" class="btn btn-info btn-sm">View</a>
          </small> 
      </li>
    
      <li class="list-group-item  flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1 font-weight-bold">
            Generated Bylaws, Article of Cooperation, Treasurer's Affidavit and Uploaded documents
          </h5>
          <small class="text-muted">
              <?php if($ga_complete && $bod_sec_complete && $status_document_cooptype): ?>
              <span class="badge badge-success">COMPLETE</span>
            <?php else:?>
            <span class="badge badge-secondary">PENDING</span>
          <?php endif;?>
          </small>
        </div>
         <a href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>/amendment_documents" class="btn btn-info btn-sm">View</a>
      </li> 
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
           <h5 class="mb-1 font-weight-bold">Finalize and review all the information provided. After reviewing the application, You can now evaluate the application.</h5>
            <small class="text-muted">
              <?php if($coop_info->status > 3) :?>
              <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if($coop_info->status == 3) :?>
              <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small> 
             
          </div> 
            <small class="text-muted">
            <div class="btn-group" role="group" aria-label="Basic example">
              <?php if($coop_info->grouping == 'Union' && $coop_info->type_of_cooperative == 'Union'){?>
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveCooperativeModal"  data-cname="<?= $coop_info->proposed_name?> <?= $coop_info->grouping?> Of <?=$coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>">Submit</button>
              <?php } else {?>
                <?php
              if(($coop_info->status == 40 && $coop_info->status != 41)):
            ?>
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveAmendmentModal"  data-cname="<?= $coop_info->coopName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>" >Submit All</button>
              <?php endif; }?>
            </div>
          </small>

           <?php  if($coop_info->status == 6 && $this->session->userdata('access_level') ==2){ ?>
             <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveAmendmentModal"  data-cname="<?= $proposedName_?>" data-coopid="<?=encrypt_custom($this->encryption->encrypt($amendment_id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Submit </button>
              <a  class="btn btn-info btn-sm" href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_cooperative_tool">Validation Tool</a>
            <?php } ?>
          <?php if($coop_info->status==3 && $bylaw_complete && $purposes_complete && $article_complete && $cooperator_complete &&  $ga_complete && $bod_sec_complete && $status_document_cooptype): ?>
          <small class="text-muted">
            <div class="btn-group" role="group" aria-label="Basic example">
              <a  class="btn btn-info btn-sm" href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_cooperative_tool">Validation Tool</a>
              <?php
                if(strlen($coop_info->acronym)>0)
                {
                  $acronym_ = '('.$coop_info->acronym.')';
                }
                else
                {
                  $acronym_='';
                }
                if(count(explode(',',$coop_info->type_of_cooperative))>1)
                {
                  $proposedName_ = $coop_info->proposed_name.' Multipurpose Cooperative '.$acronym_;
                }
                else
                {
                  $proposedName_ = $coop_info->proposed_name.' '.$coop_info->type_of_cooperative.' Cooperative '.$acronym_;
                }
              ?>

              <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveAmendmentModal"  data-cname="<?= $proposedName_?>" data-coopid="<?=encrypt_custom($this->encryption->encrypt($amendment_id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Submit </button>
              <?php if($coop_info->status!=3){?>
              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#denyCooperativeModal" data-cname="<?= $coop_info->proposed_name?> <?= $coop_info->type_of_cooperative?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>"  <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Deny</button>
              <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#deferCooperativeModal"  data-cname="<?= $proposedName_?> " data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>"  <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Defer</button>
              <?php } ?>
            </div>
          </small>
          <?php endif; ?>
        </li>
             <!-- START REVERT -->
          <?php if($coop_info->status == 12 && $this->session->userdata('access_level') ==2)
          {
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
                <button type="button" class="btn btn-secondary btn-sm btn-dark" data-toggle="modal" data-target="#revertCooperativeModal"  data-cname="<?=$proposedName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Revert for re-evaluation</button>
              </div>  
          <?php  
          }
          ?>
          <!-- END REVERT -->
    </ul>
  </div>
  <?php else : ?>
    <div class="col-sm-12 col-md-8">
      <ul class="list-group">
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold "> Step 1 </h5>
            <small>
              <?php if($coop_info->status!=0): ?>
                <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if($coop_info->status==0) :?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <p class="mb-1 font-italic">Cooperative Basic Information.</p>
           <small class="text-muted">
            <a href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>/update" class="btn btn-info btn-sm">View</a>
          </small>
        </li>

 
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 2 </h5>
            <small class="text-muted">
              <?php if($bylaw_complete): ?>
                <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if(!$bylaw_complete) :?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <p class="mb-1 font-italic">Additional Information: By Laws</p>
       <small class="text-muted">
            <a href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>/bylaw_update" class="btn btn-info btn-sm">View </a>
          </small>  
        </li>
   

      <?php if($coop_info->grouping !=='Union') :?>
         
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold"> Step 3 </h5>
            <small class="text-muted">
              <?php if($capitalization_complete): ?>
                <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if(!$capitalization_complete) :?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <p class="mb-1 font-italic">Capitalization</p>
     
          <small class="text-muted">
           <a href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>/capitalization" class="btn btn-info btn-sm">View </a> 
          </small> 
        </li>
     
      <?php endif; ?>
   
        
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold"> Step 4</h5>
            <small class="text-muted">
              <?php if($cooperator_complete): ?>
                <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if(!$cooperator_complete): ?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <?php 
       
          switch ($coop_info->grouping) {
            case 'Union':
                 $module = 'Members';
                 $moduleUrl = 'union_update';
              break;
            case 'Federation':
                   $module = 'Members';
                 $moduleUrl = 'update_affiliators';
            break;
            default:
                 $module ='Cooperators';
                 $moduleUrl ='amendment_cooperators';
              break;
          }
          ?>
          <p class="mb-1 font-italic">List of <?=$module?></p>
         
           <small class="text-muted">
            <a href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>/<?=$moduleUrl?>" class="btn btn-info btn-sm">View</a>
          </small> 
        </li>
  
   
       
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 5</h5>
            <small class="text-muted">
              <?php if($purposes_complete): ?>
                <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if(!$purposes_complete) :?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <p class="mb-1 font-italic">Cooperative's Purposes</p>
        
          <small class="text-muted">
            <a href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>/purposes" class="btn btn-info btn-sm">View</a>
          </small> 
        </li>

        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 6</h5>
            <small class="text-muted">
              <?php if($article_complete): ?>
                <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if(!$article_complete) :?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <p class="mb-1 font-italic">Additional Information: Articles of Cooperation</p>
        
          <small class="text-muted">
            <a href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>/articles_update" class="btn btn-info btn-sm">View</a>
          </small>  
       
        </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 7</h5>
            <small class="text-muted">
              <?php if($complete_position): ?>
                <span class="badge badge-success">COMPLETE</span>
             <?php else: ?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <p class="mb-1 font-italic">List of Committees</p>
        
         <small class="text-muted">
            <a href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>/committees_update" class="btn btn-info btn-sm">View</a>
          </small> 
       
        </li>
    


      <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 8</h5>
            <small class="text-muted"> 
          
            <?php /*  $count_coop_type= explode(',',$coop_info->type_of_cooperative); ?>
            <?php if(count( $count_coop_type)>1){?>
              
                <?php if($status_document_cooptype && $ga_complete && $bod_sec_complete): ?>
                <span class="badge badge-success">COMPLETE</span>
                <?php else: ?>
                <span class="badge badge-secondary">PENDING</span>
                <?php endif;?>
            <?php }else{ ?> 

           
                 <?php if($status_document_cooptype && $ga_complete && $bod_sec_complete): ?>
                <span class="badge badge-success">COMPLETE</span>
                <?php else: ?>
             
                <span class="badge badge-secondary">PENDING</span>
                <?php endif;?>

            <?php }//end else */?> 
           
               <?php if($status_document_cooptype && $ga_complete && $bod_sec_complete): ?>
                <span class="badge badge-success">COMPLETE</span>
                <?php else: ?>
             
                <span class="badge badge-secondary">PENDING</span>
                <?php endif;?>
            </small>
          </div>
          <p class="mb-1 font-italic">View your Bylaws, Article of Cooperation, Treasurer Affidavit and
            <?php if($is_client) : ?>
            Upload other documents
            <?php else : ?>
            Uploaded documents
            <?php endif;?>
          </p>
       
            <small class="text-muted">
              <a href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>/amendment_documents" class="btn btn-info btn-sm">View</a>
            </small>
          
        </li>
   


          <li class="list-group-item  flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1 font-weight-bold"></h5>
              <small class="text-muted">
                <?php if($coop_info->status > 1) :?>
                <span class="badge badge-success">COMPLETE</span>
                <?php endif; ?>
                <?php if($coop_info->status == 1) :?>
                <span class="badge badge-secondary">PENDING</span>
                <?php endif; ?>
              </small>
            </div>
            <p class="mb-1 font-italic">Finalize and review all the information you provide. After reviewing your application, click proceed for evaluation of your application.</p>
            <?php $status_array= array(40,41);
             if(!in_array($coop_info->status,$status_array)){?>
              <small class="text-muted">
                <a href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>/evaluate" class="btn btn-color-blue btnFinalize btn-sm ">Submit</a>
              </small>
            <?php } ?>
          </li>
<?php /*
          <li class="list-group-item  flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1 font-weight-bold"></h5>
              <small class="text-muted">
                <?php if($coop_info->status == 16 || $coop_info->status == 15 || $coop_info->status == 13 || $coop_info->status == 14) :?>
                <span class="badge badge-success">COMPLETE</span>
                <?php endif; ?>
                <?php if($coop_info->status == 12) :?>
                <span class="badge badge-secondary">PENDING</span>
                <?php endif; ?>
              </small>
            </div>
            <p class="mb-1 font-italic">Wait for an e-mail notification list of documents for submission.</p>
          </li>
          <li class="list-group-item  flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1 font-weight-bold"></h5>
              <small class="text-muted">
                <?php if($coop_info->status == 15 || $coop_info->status == 13 || $coop_info->status == 14) :?>
                <span class="badge badge-success">COMPLETE</span>
                <?php endif; ?>
                <?php if($coop_info->status == 16) :?>
                <span class="badge badge-secondary">PENDING</span>
                <?php endif; ?>
              </small>
            </div>
            <p class="mb-1 font-italic">Wait for an e-mail notification of payment procedure.</p>
            
            <?php if(($coop_info->status==16) && $bylaw_complete && $purposes_complete && $article_complete && $cooperator_complete && $committees_complete && $status_document_cooptype): ?>
              <small class="text-muted">
                <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_payments" class="btn btn-color-blue btn-sm ">Payment</a>
              </small>
            <?php endif ?>
            <!-- Download payment -->
            <?php
            if(($coop_info->status ==13) && $bylaw_complete && $purposes_complete && $article_complete && $cooperator_complete && $committees_complete && $status_document_cooptype && $complete_position)
              {   
                if ($pay_from=='reservation'){
               
                     $basic_reservation_fee =300;
                     $name_reservation_fee =0;
                     $acronym ='';
                     // $amendment_name = ''; 
                    if(strlen($coop_info->acronym)>0)
                 {
                  $acronym = ' ('.$coop_info->acronym.')';
                 
                 }
                
                
                if(count(explode(',',$coop_info->type_of_cooperative))>1)
                {
                  $proposeName = rtrim($coop_info->proposed_name).' Multipurpose Cooperative'.' '.$acronym;
                }
                else
                {

                    $proposeName = rtrim($coop_info->proposed_name).' '.$coop_info->type_of_cooperative.' Cooperative'.' '.$acronym;
                }
               
                $name_comparison = strcasecmp($orig_proposedName_formated,$proposeName);
                // var_dump($original_coop_name); var_dump($proposeName);
                if($name_comparison!=0)
                {
                
                  $name_reservation_fee = 100;
                }
                    
                    
                     $rf=0;
                     $percentage_amount = 0;
                     $total_amendment_fee = 0;
                    //fixed amount
                    $diff_amount = $amendment_capitalization->total_amount_of_paid_up_capital - $coop_capitalization->total_amount_of_paid_up_capital;
                    //amendment paid up is greater than coop total paid up
                    if($diff_amount>0)
                    {
                      $percentage_amount= $diff_amount * 0.001; // 1 over 10 of 1% 
                      $total_reservation_fee = $percentage_amount+ $basic_reservation_fee;
                      $rf = $total_reservation_fee;

                    }
                    else
                    {
                      $rf =  $basic_reservation_fee;
                    }
                    // $lrf=(($rf+$name_reservation_fee)*.01>10) ?($rf+$name_reservation_fee)*.01 : 10;
                     $lrf=$rf*0.01;
                     if($lrf<10)
                     {
                      $lrf=10;

                     }
                   
                     
                     if($percentage_amount>0)
                     {
                       $total_amendment_fee   = $percentage_amount +$basic_reservation_fee;
                        
                     }
                     else
                     {
                        $total_amendment_fee   = 300;
                     }
                  }


                 ?>
                
               <?php echo form_open('Amendment_payments/add_payment',array('id'=>'paymentForm','name'=>'paymentForm')); ?>
                 <input type="hidden" class="form-control" id="cooperativeID" name="cooperativeID" value="<?=$encrypted_id ?>">
                <input type="hidden" class="form-control" id="ref_no" name="ref_no" value="<?=$ref_no?>">
               <!--  <input type="hidden" class="form-control" id="tDate" name="tDate" value="<?=date('Y-m-d',now('Asia/Manila')); ?>"> -->
                <input type="hidden" class="form-control" id="payor" name="payor" value="<?=$proposeName?>">
                <input type="hidden" class="form-control" id="nature" name="nature" value="Amendment">
                <?php if($name_reservation_fee>0):?>
                <input type="hidden" class="form-control" id="particulars" name="particulars" value="Name Reservation Fee<br/>Amendment Fee - Primary<br>(1/10 of 1% of Php '<?=number_format($diff_amount,2)?>' increased in paid up capital<br> amounted to Php '<?=number_format($percentage_amount,2)?>' or a minimum of<br> Php 300.00 whichever is higher)<br>Legal and Research Fund Fee">
                 <input type="hidden" class="form-control" id="amount" name="amount" value="<?=number_format($name_reservation_fee,2).'<br/>'.number_format($total_amendment_fee,2).'<br/><br><br><br>'.number_format($lrf,2) ?>">
                <?php else: ?>
                <input type="hidden" class="form-control" id="particulars" name="particulars" value="Amendment Fee <br/>(1/10 of 1% of Php <?=number_format($diff_amount,2)?> increased in paid up capital<br> amounted to Php <?=number_format($percentage_amount,2)?> or a minimum of<br> Php 300.00 whichever is higher)<br>Legal and Research Fund Fee">
                <input type="hidden" class="form-control" id="amount" name="amount" value="<?=number_format($total_amendment_fee,2).'<br/><br><br><br>'.number_format($lrf,2) ?>">
                <?php endif;?>
               
                <input type="hidden" class="form-control" id="total" name="total" value="<?=$total_amendment_fee+$lrf+$name_reservation_fee?>">
                <input type="hidden" class="form-control" id="nature" name="rCode" value="<?= $coop_info->rCode ?>">
                 <input style="width:20%;" class="btn btn-info btn-sm" type="submit" id="offlineBtn" name="offlineBtn" value="Download O.P">
            </div>
          </form>
            <?php
             }  
            ?>
            <!-- end download payment -->
          </li>

 */ ?>
      </ul>
    </div>
    <?php endif; ?>
</div>

