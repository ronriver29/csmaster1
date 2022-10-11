<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <?php if(!$is_client){?>
    <?php if($admin_info->access_level != 3 && $admin_info->access_level != 4) {?>
      <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <?php } else {?>
      <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <?php } } else {?>
      <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <?php } ?>
    <?php if(!$is_client) : ?>
    <?php if($admin_info->access_level == 2 && $coop_info->status ==12) {?>
              <div class="btn-group float-right" role="group" aria-label="Basic example">
                <!-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#denyCooperativeModal" data-cname="<?= $proposedName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Deny</button> -->
                <button type="button" class="btn btn-secondary btn-sm btn-dark" data-toggle="modal" data-target="#revertCooperativeModal"  data-cname="<?= $coop_info->proposed_name?> <?=$coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Revert for re-evaluation</button>
              </div>
            <?php }?>
    <?php endif; ?>
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
        }

        if($coop_info->is_youth == 1){
            $youth_name = ' Youth ';
        } else {
            $youth_name = '';
        }
        ?>

    <?php if($admin_info->access_level !=5) : ?>
      <?php if($coop_info->status !=15):?>
      <div class="btn-group float-right" role="group" aria-label="Basic example">
        <a  class="btn btn-info btn-sm" href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/cooperative_tool">Validation Tool</a>
        <?php if(($admin_info->access_level ==2 || $is_active_director || $supervising_) && $coop_info->status != 10 && $coop_info->status != 11 &&  $coop_info->status != 6): ?>
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveCooperativeModal"  data-cname="<?= $coop_info->proposed_name?><?=$youth_name?><?=$coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?>><?=$submit?></button><!--  modify by Jayson change approve button to submit -->
      <?php endif; //endo fo coop info status ?>
        <?php endif;// is director and supervising?>
    <?php if($admin_info->access_level == 3 && $is_active_director || $supervising_) {?>
     <?php if($coop_info->status !=15):?>
        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#denyCooperativeModal" data-cname="<?= $coop_info->proposed_name?><?=$youth_name?><?= $coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Deny</button>
        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#deferCooperativeModal" data-cname="<?= $coop_info->proposed_name?><?=$youth_name?><?= $coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?>>Defer</button>
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
<?php if($this->cooperatives_model->check_if_revert($coop_info->id)){ } else {?>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg">* CDS Findings</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="width:90% !important;max-width:1360px;">
    <div class="modal-content">
	    <div class="modal-header">
	      <h4 class="modal-title" id="deferMemberModalLabel">CDS Findings</h4>
	      <!-- <h4 class="modal-title"></h4> -->
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	    </div>
	    <div class="modal-body">
	    	<div class="row">
	    		<div class="col-md-12">
			    	<?php
			                echo '<p class="font-weight-bold">CDS Tool Findings:</p>';
                      foreach($cooperatives_comments_cds as $cc) :
                        echo '<p>'.nl2br($cc['tool_comments']).'</p>';
                      endforeach;
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
                  <td style="border:1px solid black;padding-top:5px;">
                    <?php
                    	foreach($cooperatives_comments_cds as $cc) :
			                echo 'Date: '.date("F d, Y",strtotime($cc['date_created']));
			                echo '<ul type="square">';
			                    echo '<li>'.nl2br($cc['comment']).'</li>';
			                echo '</ul>';
			            endforeach;
                    ?>
                  </td>
                  <td style="border:1px solid black;padding-top:5px;">
                    <?php
                    	foreach($cooperatives_comments_cds as $cc) :
			                echo 'Date: '.date("F d, Y",strtotime($cc['date_created']));
			                echo '<ul type="square">';
			                    echo '<li>'.nl2br($cc['documents']).'</li>';
			                echo '</ul>';
			            endforeach;
                    ?>
                  </td>
                  <td style="border:1px solid black;padding-top:5px;">
                    <?php
                    	foreach($cooperatives_comments_cds as $cc) :
			                echo 'Date: '.date("F d, Y",strtotime($cc['date_created']));
			                echo '<ul type="square">';
			                    echo '<li>'.nl2br($cc['rec_action']).'</li>';
			                echo '</ul>';
			            endforeach;
                    ?>
                  </td>
                </tr>
              </tbody>
            </table>
    	</div>
	        <div class="modal-footer">
	            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
	        </div>
    </div>
  </div>
</div>
<?php } ?>
<?php endif;?>
<?php if(strlen($coop_info->comment_by_senior && $admin_info->access_level==3 || $admin_info->access_level==4 || $coop_info->status==12) || strlen($coop_info->comment_by_senior && $admin_info->access_level==2) && $coop_info->status!=15) : ?>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg2">* Senior Findings</button>

<div class="modal fade bd-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="width:90% !important;max-width:1360px;">
    <div class="modal-content">
	    <div class="modal-header">
	      <h4 class="modal-title" id="deferMemberModalLabel">Senior Findings</h4>
	      <!-- <h4 class="modal-title"></h4> -->
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	    </div>

	    <div class="modal-body">
	    	<!-- <div class="row">
	    		<div class="col-md-12">
			    	<?php
			                echo '<p class="font-weight-bold">CDS Tool Findings:</p>';
                      if($this->cooperatives_model->check_if_revert($coop_info->id)){
                        foreach($cooperatives_comments_snr as $cc) :
                          echo '<p>'.nl2br($cc['revert_tool']).'</p>';
                        endforeach;
                      } else {
                        foreach($cooperatives_comments_snr as $cc) :
                          echo '<p>'.nl2br($cc['tool_comments']).'</p>';
                        endforeach;
                      }
			        ?>
		    	</div>
	        </div> -->
          <?php
          if(!$this->cooperatives_model->check_if_revert($coop_info->id)){
          foreach($cooperatives_comments_snr as $cc) :
            echo '<b>Date: '.date("F d, Y",strtotime($cc['date_created'])).'</b>';
            echo '<p>'.nl2br($cc['tool_comments']).'</p>';
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
                  <td style="border:1px solid black;padding-top:5px;">
                    <?php

			                echo '<ul type="square">';
			                    echo '<li>'.nl2br($cc['comment']).'</li>';
			                echo '</ul>';
                    ?>
                  </td>
                  <td style="border:1px solid black;padding-top:5px;">
                    <?php
			                echo '<ul type="square">';
			                    echo '<li>'.nl2br($cc['documents']).'</li>';
			                echo '</ul>';
                    ?>
                  </td>
                  <td style="border:1px solid black;padding-top:5px;">
                    <?php
			                echo '<ul type="square">';
			                    echo '<li>'.nl2br($cc['rec_action']).'</li>';
			                echo '</ul>';
                    ?>
                  </td>
                </tr>
              </tbody>
            </table>
            <?php endforeach; } else { foreach($cooperatives_comments_snr_revert as $cc) :
            echo '<b>Date: '.date("F d, Y",strtotime($cc['date_created'])).'</b>';
            echo '<p>'.nl2br($cc['revert_tool']).'</p>'; ?>
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
                  <td style="border:1px solid black;padding-top:5px;">
                    <?php

                      echo '<ul type="square">';
                          echo '<li>'.nl2br($cc['comment']).'</li>';
                      echo '</ul>';
                    ?>
                  </td>
                  <td style="border:1px solid black;padding-top:5px;">
                    <?php
                      echo '<ul type="square">';
                          echo '<li>'.nl2br($cc['documents']).'</li>';
                      echo '</ul>';
                    ?>
                  </td>
                  <td style="border:1px solid black;padding-top:5px;">
                    <?php
                      echo '<ul type="square">';
                          echo '<li>'.nl2br($cc['rec_action']).'</li>';
                      echo '</ul>';
                    ?>
                  </td>
                </tr>
              </tbody>
            </table>
            <?php endforeach; } ?>
    	</div>
	        <div class="modal-footer">
	            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
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
<?php if($coop_info->status==10): ?>
        <button type="button" style="margin-left:10px;" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg4">* Denied Reason/s</button>
      <div class="modal fade bd-example-modal-lg4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" style="width:90% !important;max-width:1360px;">
          <div class="modal-content">
              <div class="modal-header">
                  The cooperative has been denied because of the following reason/s:
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
              </div>

              <div class="modal-body" style="table-layout: fixed;">
                <?php foreach($denied_comments as $cc) :
                echo '<b>Date: '.date("F d, Y",strtotime($cc['date_created'])).'</b><br>'; ?>
                <?php if($this->cooperatives_model->check_if_revert($coop_info->id)){
                  echo nl2br($cc['revert_tool']);
                } else {?>
                  <?=nl2br($cc['tool_comments'])?>
                <?php } ?>
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
                      <td style="border:1px solid black;padding-top:5px;"><?=nl2br($cc['comment'])?>
                      </td>
                      <td style="border:1px solid black;padding-top:5px;"><?=nl2br($cc['documents'])?>
                      </td>
                      <td style="border:1px solid black;padding-top:5px;"><?=nl2br($cc['rec_action'])?>
                      </td>
                    </tr>
                  </tbody>
                </table>

                  <!-- echo nl2br($cc['comment']); -->
          <?php endforeach; ?>

              <!-- <div class="modal-body" style="table-layout: fixed;">
                  <pre> <?php
      //            print_r($cooperatives_comments);
                  foreach($denied_comments as $cc) :
                      echo 'Date: '.date("F d, Y",strtotime($cc['date_created']));
                      echo '<ul type="square">';
                        if(strlen($cc['comment'])>0)
                        {
                          echo '<li>'.$cc['comment'].'</li>';
                        }
                      echo '</ul>';
                  endforeach;
                  ?>
                  </pre>
              </div> -->
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <!--            <button type="button" class="btn btn-primary">Save changes</button>-->
              </div>
          </div>
        </div>
      </div>

      </div>

       <br>
      <?php endif; ?>
<?php if((is_array($cooperatives_comments) && $admin_info->access_level==3) || (is_array($cooperatives_comments) && $supervising_) || (is_array($cooperatives_comments) && $admin_info->access_level==2  && $coop_info->status == 6) || (is_array($cooperatives_comments) && $admin_info->access_level==2 && $coop_info->status == 12)) : ?>

<button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg3">* Director Findings</button>

<div class="modal fade bd-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="width:90% !important;max-width:1360px;">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="deferMemberModalLabel">The cooperative has been deferred because of the following reason/s:</h4>
          <!-- <h4 class="modal-title"></h4> -->
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body form">
          <input type="hidden" id="cooperativeID" name="cooperativeID" readonly>
            <!-- <div class="form-group">
              <div class="col-md-12">
            <?php
                      echo '<p class="font-weight-bold">CDS Tool Findings:</p>';
                      foreach($cooperatives_comments as $cc) :
                        echo '<p>'.nl2br($cc['tool_comments']).'</p>';
                      endforeach;
              ?>
          </div>
          </div> -->
          <?php foreach($cooperatives_comments as $cc) :
            if($this->cooperatives_model->check_if_revert($coop_info->id)){
              echo '<b>Date: '.date("F d, Y",strtotime($cc['date_created'])).'</b>';
              echo '<p>'.nl2br($cc['revert_tool']).'</p>';
            } else {
              echo '<b>Date: '.date("F d, Y",strtotime($cc['date_created'])).'</b>';
              echo '<p>'.nl2br($cc['tool_comments']).'</p>';
            }
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
              <td style="border:1px solid black;padding-top:5px;">
                <?php
		                echo '<ul type="square">';
		                    echo '<li>'.nl2br($cc['comment']).'</li>';
		                echo '</ul>';
                ?>
              </td>
              <td style="border:1px solid black;padding-top:5px;">
                <?php
		                echo '<ul type="square">';
		                    echo '<li>'.nl2br($cc['documents']).'</li>';
		                echo '</ul>';
                ?>
              </td>
              <td style="border:1px solid black;padding-top:5px;">
                <?php
		                echo '<ul type="square">';
		                    echo '<li>'.nl2br($cc['rec_action']).'</li>';
		                echo '</ul>';
                ?>
              </td>
            </tr>
          </tbody>
        </table>
      <?php endforeach; ?>
    </div>
</div>
    </div>
  </div>

<!-- <div class="modal fade bd-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
<!--            <button type="button" class="btn btn-primary">Save changes</button>-->
        <!-- </div>
    </div>
  </div>
</div> -->

<?php endif;?>
<!-- SUPERVISING -->
    <?php if(is_array($supervising_comment && $admin_info->access_level==4) ||
    (is_array($supervising_comment) && $supervising_) ||
    (is_array($supervising_comment) && $admin_info->access_level==2) ||
    (is_array($supervising_comment) && $admin_info->access_level==3) ||
    (is_array($supervising_comment) && $admin_info->access_level==2 && $coop_info->status == 12)) :
    ?>
  <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg4">* Supervising CDS Findings</button>
    <div class="modal fade bd-example-modal-lg4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="width:90% !important;max-width:1360px;">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="deferMemberModalLabel">The cooperative has been deferred because of the following reason/s:</h4>
          <!-- <h4 class="modal-title"></h4> -->
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body form">
          <input type="hidden" id="cooperativeID" name="cooperativeID" readonly>
            <div class="form-group">
              <div class="col-md-12">
            <?php
                      // echo '<p class="font-weight-bold">CDS Tool Findings:</p>';
                      // foreach($supervising_comment as $cc) :
                      //   echo '<p>'.nl2br($cc['tool_comments']).'</p>';
                      // endforeach;
              ?>
          </div>
          </div>
        <?php
        if($this->cooperatives_model->check_if_revert($coop_info->id)){
        foreach($supervising_comment as $cc) :
          echo '<p class="font-weight-bold">CDS Tool Findings:</p>';
         echo '<p>'.nl2br($cc['revert_tool']).'</p>';
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
              <td style="border:1px solid black;padding-top:5px;">
                <?php
                    echo '<ul type="square">';
                        echo '<li>'.nl2br($cc['comment']).'</li>';
                    echo '</ul>';
                ?>
              </td>
              <td style="border:1px solid black;padding-top:5px;">
                <?php
                    echo '<ul type="square">';
                        echo '<li>'.nl2br($cc['documents']).'</li>';
                    echo '</ul>';
                ?>
              </td>
              <td style="border:1px solid black;padding-top:5px;">
                <?php
                    echo '<ul type="square">';
                        echo '<li>'.nl2br($cc['rec_action']).'</li>';
                    echo '</ul>';
                ?>
              </td>
            </tr>
          </tbody>
        </table>
      <?php endforeach; } else { foreach($supervising_comment as $cc) :
          echo '<p class="font-weight-bold">CDS Tool Findings:</p>';
          echo '<p>'.nl2br($cc['tool_comments']).'</p>'; ?>
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
              <td style="border:1px solid black;padding-top:5px;">
                <?php
                    echo '<ul type="square">';
                        echo '<li>'.nl2br($cc['comment']).'</li>';
                    echo '</ul>';
                ?>
              </td>
              <td style="border:1px solid black;padding-top:5px;">
                <?php
                    echo '<ul type="square">';
                        echo '<li>'.nl2br($cc['documents']).'</li>';
                    echo '</ul>';
                ?>
              </td>
              <td style="border:1px solid black;padding-top:5px;">
                <?php
                    echo '<ul type="square">';
                        echo '<li>'.nl2br($cc['rec_action']).'</li>';
                    echo '</ul>';
                ?>
              </td>
            </tr>
          </tbody>
        </table>
       <?php endforeach; } ?>

    </div>
</div>
    </div>
  </div>
<!-- </div> -->
    <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg4">* Supervising CDS Findings</button>
    <div class="modal fade bd-example-modal-lg4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                The cooperative has been deferred because of the following reason/s:
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body" style="table-layout: fixed;">
                <pre><?php
                foreach($supervising_comment as $c) :
                    echo 'Date: '.date("F d, Y",strtotime($c['date_created']));
                    echo '<ul type="square">';
                        echo '<li>'.$c['comment'].'</li>';
                    echo '</ul>';
                endforeach;
            ?></pre>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>-->
            <!--</div>
        </div>
      </div>
    </div> -->
    <?php endif;?>
<!-- END SUPERVISING -->
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
        <?php if ($coop_info->category_of_cooperative == 'Primary'): ?>
                <?= base_url().'cooperatives/'.$encrypted_id.'/documents/bylaws_primary';?>
        <?php elseif ($coop_info->grouping == 'Union'): ?>
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
        <h5 class="card-title">Article of Cooperation</h5>
        <p class="card-text">This is the generated Article of Cooperation</p>
        <a target="_blank" href="
        <?php if ($coop_info->category_of_cooperative == 'Primary' || $coop_info->type_of_cooperative == 'Bank' || $coop_info->type_of_cooperative == 'Insurance'): ?>
                <?php $url_ =  base_url().'cooperatives/'.$encrypted_id.'/documents/articles_cooperation_primary';?>
        <?php elseif ($coop_info->grouping == 'Union' && $coop_info->type_of_cooperative == 'Union'): ?>
                <?php $url_= base_url().'cooperatives/'.$encrypted_id.'/documents/articles_cooperation_union';?>
        <?php else: ?>
                <?php $url_ =base_url().'cooperatives/'.$encrypted_id.'/documents/articles_cooperation_federation';?>
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
        <?php if ($coop_info->category_of_cooperative == 'Primary'): ?>
                <?= base_url().'cooperatives/'.$encrypted_id.'/documents/affidavit_primary';?>
        <?php elseif ($coop_info->grouping == 'Union'): ?>
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
          <?php if($coop_info->created_at >= '2022-10-11'){ ?>
                <a target="_blank" href="<?php echo base_url();?>cooperatives/<?=$encrypted_id?>/documents/simplified_economic_survey" class="btn btn-primary">View</a>
              <?php } else { ?>
                <a target="_blank" href="<?php echo base_url();?>cooperatives/<?=$encrypted_id?>/documents/economic_survey" class="btn btn-primary">View</a>
              <?php } ?>
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

          <?php if($is_client && $coop_info->status<=1 || ($is_client && $coop_info->status==11)): ?>
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
          <?php if($is_client && $coop_info->status<=1 || ($is_client && $coop_info->status==11)): ?>
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
<!-- OTHERS --><br>
  <div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Other Requirements</h5>
            <p class="card-text">
              <!-- modify by json -->
              <?php if(isset($document_others_unifed)) : ?>
               <!--  <a target="_blank" href="<?php echo base_url();?>cooperatives/<?=$encrypted_id?>/documents/view_document_one/<?= encrypt_custom($this->encryption->encrypt($document_one->filename))?>"> -->

                 <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf/<?=$encrypted_id?>/42">

                  <?php if($is_client) : ?>
                    This is your Others document.
                  <?php else : ?>
                    This is the Others document.
                  <?php endif;?>
                </a>
              <?php endif ?>
              <?php if(!isset($document_others_unifed)) : ?>
                Please upload your others document.
              <?php endif ?>
              <br>
            </p>

          <?php //if($coop_info->status<=1 || $coop_info->status>=11 && $coop_info->status!=15): ?>
          <?php if($is_client && $coop_info->status<=1 || ($is_client && $coop_info->status==11)): ?>
            <?php if($is_client) : ?>
                <a href="<?php echo base_url();?>cooperatives/<?=$encrypted_id?>/documents/upload_document_others_unifed" class="btn btn-primary">Upload</a>
            <?php endif;?>
          <?php endif; ?>

        </div>
      </div>
  </div>
  <!-- OTHERS END -->
<?php
// print_r($ching);
// echo"<pre>";print_r($coop_type);"<pre>";
if(!empty($coop_type)):
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
                <?php if($is_client && $coop_info->status<=1 || ($is_client && $coop_info->status==11)): ?>
                    <a href="<?php echo base_url();?>cooperatives/<?=$encrypted_id?>/documents/upload_document_others/<?=encrypt_custom($this->encryption->encrypt($coop['id']))?>" class="btn btn-primary">Upload</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php endforeach; ?>
</div>
<?php endif; //not empty?>
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
