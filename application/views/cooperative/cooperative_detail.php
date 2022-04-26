<div class="row mb-2">
  <div class="col-sm-12 col-md-2">
    <a class="btn btn-secondary btn-sm btn-block"  href="<?php echo base_url();?>cooperatives" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
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
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-success text-center" role="alert">
      <?php echo $this->session->flashdata('cooperative_success'); ?>
    </div>
  </div>
</div>
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
<?php if(!$is_client){?>
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
<?php } ?>
<?php if($coop_info->status==11 || $coop_info->status==10 && count($deferred_comments) >= 1 && ($coop_info->evaluated_by > 0)) : ?>
<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg3">* Deferred Reason/s</button>
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
            foreach($deferred_comments as $cc) :
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

<!-- <div class="modal fade bd-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="width:90% !important;max-width:1360px;">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="deferMemberModalLabel">The cooperative has been deferred because of the following reason/s:</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body form"> 
          <input type="hidden" id="cooperativeID" name="cooperativeID" readonly>

          <table class="table"  with="100%">
            <thead>
              <tr>
                <th style="border:1px solid black;">Documents</th>
                <th style="border:1px solid black;">Findings</th>
                <th style="border:1px solid black;">Recomended Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="border:1px solid black;padding-top:5px;">
                  <?php 
                      foreach($deferred_comments as $cc) :
                        echo 'Date: '.date("F d, Y",strtotime($cc['date_created']));
                        echo '<ul type="square">';
                            echo '<li>'.nl2br($cc['comment']).'</li>';
                        echo '</ul>';
                      endforeach;
                  ?></pre>
                </td>
                <td style="border:1px solid black;padding-top:5px;">
                  <?php 
                      foreach($deferred_comments as $cc) :
                        echo 'Date: '.date("F d, Y",strtotime($cc['date_created']));
                        echo '<ul type="square">';
                            echo '<li>'.nl2br($cc['documents']).'</li>';
                        echo '</ul>';
                      endforeach;
                  ?></pre>
                </td>
                <td style="border:1px solid black;padding-top:5px;">
                  <?php 
                      foreach($deferred_comments as $cc) :
                        echo 'Date: '.date("F d, Y",strtotime($cc['date_created']));
                        echo '<ul type="square">';
                            echo '<li>'.nl2br($cc['rec_action']).'</li>';
                        echo '</ul>';
                      endforeach;
                  ?></pre>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </form>
    </div>
  </div>
</div> -->

<div class="modal fade bd-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="width:90% !important;max-width:1360px;">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="deferMemberModalLabel">The cooperative has been deferred because of the following reason/s:</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body form"> 
          <input type="hidden" id="cooperativeID" name="cooperativeID" readonly>

          <?php foreach($deferred_comments as $cc) :
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
          <!-- <table class="table"  with="100%">
            <thead>
              <tr>
                <th style="border:1px solid black;">Documents</th>
                <th style="border:1px solid black;">Findings</th>
                <th style="border:1px solid black;">Recomended Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="border:1px solid black;padding-top:5px;">
                  <?php 
                      foreach($deferred_comments as $cc) :
                        echo 'Date: '.date("F d, Y",strtotime($cc['date_created']));
                        echo '<ul type="square">';
                            echo '<li>'.nl2br($cc['comment']).'</li>';
                        echo '</ul>';
                      endforeach;
                  ?>
                </td>
                <td style="border:1px solid black;padding-top:5px;">
                  <?php 
                      foreach($deferred_comments as $cc) :
                        echo 'Date: '.date("F d, Y",strtotime($cc['date_created']));
                        echo '<ul type="square">';
                            echo '<li>'.nl2br($cc['documents']).'</li>';
                        echo '</ul>';
                      endforeach;
                  ?></pre>
                </td>
                <td style="border:1px solid black;padding-top:5px;">
                  <?php 
                      foreach($deferred_comments as $cc) :
                        echo 'Date: '.date("F d, Y",strtotime($cc['date_created']));
                        echo '<ul type="square">';
                            echo '<li>'.nl2br($cc['rec_action']).'</li>';
                        echo '</ul>';
                      endforeach;
                  ?></pre>
                </td>
              </tr>
            </tbody>
          </table> -->
        </div>
      </form>
    </div>
  </div>
</div>

<?php endif; ?>

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
        <strong>Proposed Name:</strong>
        <p class="text-muted">
            <?php if($coop_info->grouping == 'Union' && $coop_info->type_of_cooperative == 'Union') {?>
                <?= $coop_info->proposed_name?> <?= $coop_info->grouping?> Of <?= $coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?>
            <?php } else { ?>
                <?= $coop_info->proposed_name?> <?= $coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?> <?= $coop_info->grouping?> 
            <?php } ?>
        </p>
        <hr>
        <strong>Category of Cooperative</strong>
        <p class="text-muted">
          <?= $coop_info->category_of_cooperative?>
        </p>
        <hr>
        <strong>Business Activities - Subclass</strong>
        <p class="text-muted">
          <?php foreach($business_activities as $casd) : ?>
          &#9679; <?= $casd['bactivity_name'] ?> - <?= $casd['bactivitysubtype_name']?><br>
          <?php endforeach; ?>
          <!--  $coop_info->bactivity_name -->
        </p>
        <hr>
        <strong>Common Bond of Membership</strong>
        <p class="text-muted">
          <?= $coop_info->common_bond_of_membership?>
        </p>
        <hr>
        <?php if($coop_info->common_bond_of_membership=="Institutional" || $coop_info->common_bond_of_membership=="Associational"){
            echo '<strong> Field of Membership</strong>';
            echo '<p class="text-muted">'.$coop_info->field_of_membership.'</p>';
            echo '<hr>';
            echo '<strong> Name of Institution <br></strong>';
            foreach($inssoc as $insoc) :
            echo '&#9679'; echo $insoc; echo '<br>';
            endforeach;
            echo '<hr>';
        } else if ($coop_info->common_bond_of_membership=="Occupational"){?>
        <strong>Composition of Members</strong>
        <p class="text-muted">
          <?php foreach($members_composition as $compo) : ?>
          &#9679; <?= $compo['composition'] ?><br>
          <?php endforeach; ?>
        </p>
        <hr>
        <?php } ?>
        <strong>Area of Operation</strong>
        <p class="text-muted">
          <?php if($coop_info->area_of_operation=="Interregional"){
          $region_array = array();
          
          foreach ($regions_island_list as $region_island_list){
            array_push($region_array, $region_island_list['regDesc']);
          }
          // echo implode(", ", $region_array);
          $last  = array_slice($region_array, -1);
          $first = join(', ', array_slice($region_array, 0, -1));
          $both  = array_filter(array_merge(array($first), $last), 'strlen');
          echo 'Inter-Regional - '. join(' and ', $both);

            // echo 'Inter-Regional -';
          } else {
            echo $coop_info->area_of_operation;
          }?>
        </p>
        <hr>
        <strong>Proposed address of the cooperative</strong>
        <p class="text-muted">
          <?php if($coop_info->house_blk_no==null && $coop_info->street==null) $x=''; else $x=', ';?>
          <?=ucwords($coop_info->house_blk_no)?> <?=ucwords($coop_info->street).$x?> <?=$coop_info->brgy.', '?> <?=$coop_info->city.', '?> <?= $coop_info->province.', '?> <?=$coop_info->region?>
        </p>
        <hr>
        <?php if($is_client) : ?>
          <strong>Status</strong>
          <p class="text-muted">
            <?php if($coop_info->status==0) echo "EXPIRED"; ?>
            <?php if($coop_info->status==1) echo "PENDING"; ?>
            <?php if($coop_info->status==2) echo "FOR VALIDATION"; ?>
            <?php if($coop_info->status>=3 && $coop_info->status<=5) echo "FOR VALIDATION"; ?>
            <?php if($coop_info->status>=6 && $coop_info->status<=9 && $coop_info->third_evaluated_by<=0) echo "FOR EVALUATION"; ?>
            <?php if($coop_info->status>=2 && $coop_info->status<=9 && $coop_info->third_evaluated_by<0) echo "ON EVALUATION"; ?>
            <?php if($coop_info->status==9 && $coop_info->third_evaluated_by>0) echo "FOR RE-EVALUATION";?>
            <?php if($coop_info->status==10) echo "DENIED"; ?>
            <?php if($coop_info->status==11 && !$this->cooperatives_model->check_if_revert($coop_info->id)) echo "DEFERRED"; ?>
            <?php if($coop_info->status==11 && $this->cooperatives_model->check_if_revert($coop_info->id)) echo "REVERTED-DEFERRED"; ?>
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
          <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/rupdate" class="btn btn-block btn-color-blue"><i class='fas fa-edit'></i> Update Basic Information</a>
        </div>
      <?php endif; ?>
    </div>
  </div>
<?php if(!$is_client) : ?>
  <div class="col-sm-12 col-md-8">
    <ul class="list-group">
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
        <?php if($coop_info->status!= 0): ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/bylaws" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif;?>
      </li>
      
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
        <?php if($coop_info->status!= 0): ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/capitalization" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif;?>
      </li>
      
      <li class="list-group-item  flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
            <?php if($coop_info->grouping=="Federation"){
                $coopaff = 'Members';
            } else if($coop_info->grouping=="Union"){
                $coopaff = 'Federation';
            } else {
                $coopaff = 'Cooperators';
            }?>
          <h5 class="mb-1 font-weight-bold">List of <?=$coopaff?></h5>
          <small class="text-muted">
              <?php if($coop_info->grouping == 'Federation'){
                  $grouping = $affiliator_complete;
              } else if($coop_info->grouping == 'Union' && $coop_info->type_of_cooperative == 'Union'){
                  $grouping = $affiliates_complete;
              } else {
                  $grouping = $cooperator_complete;
              }?>
            <?php if($grouping): ?>
              <span class="badge badge-success">COMPLETE</span>
            <?php endif; ?>
            <?php if(!$grouping): ?>
              <span class="badge badge-secondary">PENDING</span>
            <?php endif; ?>
          </small>
        </div>
          <?php
                if($coop_info->grouping == 'Federation'){
                    $groupingname = 'Affiliators';
                    $stepfourdirectory = 'affiliators';
                } else if($coop_info->grouping == 'Union' && $coop_info->type_of_cooperative == 'Union') {
                    $groupingname = 'Federation';
                        $stepfourdirectory = 'unioncoop';
                } else {
                    $groupingname = 'Cooperators';
                    $stepfourdirectory = 'cooperators';
                }
            ?>
        <?php if($coop_info->status!= 0 && $bylaw_complete): ?>
        <small class="text-muted">
          <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/<?=$stepfourdirectory?>" class="btn btn-info btn-sm">View</a>
        </small>
      <?php endif ?>
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
        <?php if($coop_info->status!= 0 && $bylaw_complete && $grouping): ?>
        <small class="text-muted">
          <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/purposes" class="btn btn-info btn-sm">View</a>
        </small>
      <?php endif ?>
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
        <?php if($coop_info->status!= 0 && $bylaw_complete && $grouping && $purposes_complete): ?>
        <small class="text-muted">
          <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/articles" class="btn btn-info btn-sm">View</a>
        </small>
      <?php endif ?>
      </li>
      <li class="list-group-item  flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1 font-weight-bold">List of Committees</h5>
          <small class="text-muted">
            <?php if($committees_complete == TRUE): ?>
              <span class="badge badge-success">COMPLETE</span>
            <?php endif; ?>
            <?php if($committees_complete == FALSE): ?>
              <span class="badge badge-secondary">PENDING</span>
            <?php endif; ?>
          </small>
        </div>
        <?php if($coop_info->status!= 0 && $bylaw_complete && $article_complete && $grouping && $purposes_complete): ?>
        <small class="text-muted">
          <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/committees" class="btn btn-info btn-sm">View</a>
        </small>
      <?php endif ?>
      </li>
      <li class="list-group-item  flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1 font-weight-bold">Additional Information: Economic Survey</h5>
          <small class="text-muted">
            <?php if($economic_survey_complete): ?>
              <span class="badge badge-success">COMPLETE</span>
            <?php endif; ?>
            <?php if(!$economic_survey_complete): ?>
              <span class="badge badge-secondary">PENDING</span>
            <?php endif; ?>
          </small>
        </div>
        <?php if($coop_info->status!= 0 && $bylaw_complete && $article_complete && $grouping && $committees_complete && $purposes_complete): ?>
        <small class="text-muted">
          <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/survey" class="btn btn-info btn-sm">View</a>
        </small>
      <?php endif ?>
      </li>
      <li class="list-group-item  flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1 font-weight-bold">List of Staff/Employees</h5>
          <small class="text-muted">
            <?php if($staff_complete): ?>
              <span class="badge badge-success">COMPLETE</span>
            <?php endif; ?>
            <?php if(!$staff_complete): ?>
              <span class="badge badge-secondary">PENDING</span>
            <?php endif; ?>
          </small>
        </div>
        <?php if($coop_info->status!= 0 && $bylaw_complete && $article_complete && $purposes_complete && $grouping && $committees_complete && $economic_survey_complete): ?>
        <small class="text-muted">
          <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/staff" class="btn btn-info btn-sm">View</a>
        </small>
      <?php endif ?>
      </li>
      <li class="list-group-item  flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1 font-weight-bold">
            Generated Bylaws, Article of Cooperation, Economic Survey, Treasurer's Affidavit and Uploaded documents
          </h5>
          <small class="text-muted">
              <?php if($document_one && $document_two): ?>
              <span class="badge badge-success">COMPLETE</span>
            <?php endif;?>
            <?php if(!$document_one && !$document_two): ?>
            <span class="badge badge-secondary">PENDING</span>
          <?php endif;?>
          </small>
        </div>
        <?php if($coop_info->status!= 0 && $bylaw_complete && $purposes_complete && $article_complete && $grouping && $committees_complete && $economic_survey_complete && $staff_complete): ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/documents" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif ?>
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
          <?php if(($coop_info->status==3 || $coop_info->status==6) && $bylaw_complete && $purposes_complete && $article_complete && $grouping && $committees_complete && $economic_survey_complete && $staff_complete && $document_one && $document_two): ?>
          <small class="text-muted">
            <div class="btn-group" role="group" aria-label="Basic example">
              <a  class="btn btn-info btn-sm" href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/cooperative_tool">Validation Tool</a>
              <?php if($coop_info->grouping == 'Union' && $coop_info->type_of_cooperative == 'Union'){?>
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveCooperativeModal"  data-cname="<?= $coop_info->proposed_name?> <?= $coop_info->grouping?> Of <?=$coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Submit</button>
              <?php } else {?>
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveCooperativeModal"  data-cname="<?= $coop_info->proposed_name?> <?=$coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Submit</button>
              <?php }?>
              <?php if($coop_info->status!=3 && $coop_info->status!=6){?>
              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#denyCooperativeModal" data-cname="<?= $coop_info->proposed_name?> <?= $coop_info->type_of_cooperative?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>"  <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Deny</button>
              <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#deferCooperativeModal"  data-cname="<?= $coop_info->proposed_name?> <?= $coop_info->type_of_cooperative?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>"  <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Defer</button>
              <?php } ?>
            </div>
          </small>
          <?php endif; ?>
          <?php if($admin_info->access_level == 2 && $coop_info->status ==12) {?>
              <div class="btn-group" role="group" aria-label="Basic example">
                <!-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#denyCooperativeModal" data-cname="<?= $proposedName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Deny</button> -->
                <button type="button" class="btn btn-secondary btn-sm btn-dark" data-toggle="modal" data-target="#revertCooperativeModal"  data-cname="<?= $coop_info->proposed_name?> <?=$coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Revert for re-evaluation</button>
              </div>  
            <?php }?>
        </li>
    </ul>
  </div>
  <?php else : ?>
    <div class="col-sm-12 col-md-8">
      <ul class="list-group">
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold ">Step 1</h5>
            <small>
              <?php if($coop_info->status!=0): ?>
                <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if($coop_info->status==0) :?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <p class="mb-1 font-italic">Cooperative Name Reservation and Basic Information.</p>
        </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 2</h5>
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
          <?php if($coop_info->status!= 0): ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/bylaws" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif;?>
        </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 3</h5>
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
          <?php if($bylaw_complete): ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/capitalization" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif;?>
        </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 4</h5>
            <small class="text-muted">
              <?php if($coop_info->grouping == 'Federation'){
                  $grouping = $affiliator_complete;
              } else if($coop_info->grouping == 'Union' && $coop_info->type_of_cooperative == 'Union'){
                  $grouping = $affiliates_complete;
              } else {
                  $grouping = $cooperator_complete;
              }?>
              <?php if($grouping): ?>
                <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if(!$grouping): ?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
            <?php
                if($coop_info->grouping == 'Federation'){
                    $groupingname = 'Affiliators';
                    $stepfourdirectory = 'affiliators';
                } else if($coop_info->grouping == 'Union' && $coop_info->type_of_cooperative == 'Union') {
                    $groupingname = 'Federation';
                    $stepfourdirectory = 'unioncoop';
                } else {
                    $groupingname = 'Cooperators';
                    $stepfourdirectory = 'cooperators';
                }
            ?>
          <p class="mb-1 font-italic">List of <?=$groupingname?></p>
          <?php if($coop_info->status!= 0 && $bylaw_complete && $capitalization_complete): ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/<?=$stepfourdirectory?>" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif ?>
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
          <?php if($coop_info->status!= 0 && $bylaw_complete && $grouping): ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/purposes" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif ?>
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
          <?php if($coop_info->status!= 0 && $bylaw_complete && $grouping && $purposes_complete): ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/articles" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif ?>
        </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 7</h5>
            <small class="text-muted">
             
              <?php if($committees_complete == TRUE): ?>
                <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if($committees_complete == FALSE): ?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <p class="mb-1 font-italic">List of Committees</p>
          <?php if($coop_info->status!= 0 && $bylaw_complete && $purposes_complete && $article_complete && $grouping): ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/committees" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif ?>
        </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 8</h5>
            <small class="text-muted">
              <?php if($economic_survey_complete): ?>
                <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if(!$economic_survey_complete): ?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
            <?php // foreach($committeescount as $committeecount) : ?>
                <?php // $count = $committeecount['count'];?>
            <?php // endforeach; ?>
          <p class="mb-1 font-italic">Additional Information: Economic Survey</p>
          <?php if($coop_info->status!= 0 && $bylaw_complete && $purposes_complete && $article_complete && $grouping && $committees_complete): ?>
            <?php // if($count == 0) {?>
            <?php // } else {?>
                <small class="text-muted">
                  <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/survey" class="btn btn-info btn-sm">View</a>
                </small>
            <?php // } ?>
        <?php endif ?>
        </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 9</h5>
            <small class="text-muted">
              <?php if($staff_complete): ?>
                <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if(!$staff_complete): ?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <p class="mb-1 font-italic">List of Staff/Employees</p>
          <?php if($coop_info->status!= 0 && $bylaw_complete && $purposes_complete && $article_complete && $grouping && $committees_complete && $economic_survey_complete): ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/staff" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif ?>
        </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 10</h5>
            <small class="text-muted">
                <?php ;
                if($document_one && $document_two && $document_completed): ?>
                    <span class="badge badge-success">COMPLETE</span>
               
                <?php else ://   (!$document_one && !$document_two && !$document_completed): ?>
                    <span class="badge badge-secondary">PENDING</span>
                <?php endif;?>
            </small>
          </div>
          <p class="mb-1 font-italic">View your Bylaws, Article of Cooperation, Economic Survey, Treasurer Affidavit and
            <?php if($is_client) : ?>
            Upload other documents
            <?php else : ?>
            Uploaded documents
            <?php endif;?>
          </p>
          <?php if($coop_info->status!= 0 && $bylaw_complete && $purposes_complete && $article_complete && $grouping && $committees_complete && $economic_survey_complete && $staff_complete): ?>
            <small class="text-muted">
              <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/documents" class="btn btn-info btn-sm">View</a>
            </small>
          <?php endif ?>
        </li>
          <li class="list-group-item  flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1 font-weight-bold">Step 11</h5>
              <small class="text-muted">
                <?php if($coop_info->status > 1 && $coop_info->status !=11) :?>
                <span class="badge badge-success">COMPLETE</span>
                <?php endif; ?>
                <?php if($coop_info->status == 1 || $coop_info->status ==11) :?>
                <span class="badge badge-secondary">PENDING</span>
                <?php endif; ?>
              </small>
            </div>
            <p class="mb-1 font-italic">Finalize and review all the information you provide. After reviewing your application, click proceed for evaluation of your application.</p>
            <?php if(($coop_info->status == 1||$coop_info->status == 11) && $bylaw_complete && $purposes_complete && $article_complete && $grouping && $committees_complete && $economic_survey_complete && $staff_complete && $document_one && $document_two && $document_completed): ?>
            <small class="text-muted">
              <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/evaluate" class="btn btn-color-blue btnFinalize btn-sm ">Submit</a>
            </small>
            <?php endif; ?>
          </li>
          <li class="list-group-item  flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1 font-weight-bold">Step 12</h5>
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
              <h5 class="mb-1 font-weight-bold">Step 13</h5>
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
            <?php if(($coop_info->status==16) && $bylaw_complete && $purposes_complete && $article_complete && $grouping && $committees_complete && $economic_survey_complete && $staff_complete && $document_one && $document_two): ?>
              <small class="text-muted">
                <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/payments" class="btn btn-color-blue btn-sm ">Payment</a>
              </small>
            <?php endif ?>
             <!-- donwload payment form -->
              <?php
              if(($coop_info->status ==13) && $bylaw_complete && $purposes_complete && $article_complete && $grouping && $committees_complete && $economic_survey_complete && $staff_complete && $document_one && $document_two)
              {
                if ($pay_from=='reservation'){
                  $rf=(((($bylaw_info->kinds_of_members == 1) ? $total_regular['total_paid'] * $capitalization_info->par_value : $total_regular['total_paid'] * $capitalization_info->par_value + $total_associate['total_paid'] *$capitalization_info->par_value ) *0.001 >500 ) ? (($bylaw_info->kinds_of_members == 1) ?  ($total_regular['total_paid'] * $capitalization_info->par_value) : ($total_regular['total_paid'] *$capitalization_info->par_value + $total_associate['total_paid'] *$capitalization_info->par_value)) *0.001 : 500.00);
                  $lrf=(($rf)*.01>10) ?($rf)*.01 : 10;
                  if(!empty($coop_info->acronym_name)){ 
                    $acronym_name = '('.$coop_info->acronym_name.') ';
                  } else {
                      $acronym_name = '';
                  }

                  if($coop_info->grouping == 'Union' && $coop_info->type_of_cooperative == 'Union'){
                      $payorname = ucwords($coop_info->proposed_name.' '.$coop_info->grouping.' Of '.$coop_info->type_of_cooperative .' Cooperative '.$acronym_name);
                  } else {
                      $payorname = ucwords($coop_info->proposed_name.' '.$coop_info->type_of_cooperative .' Cooperative '.$acronym_name.' '.$coop_info->grouping);
                  }
                  $amount_in_words=0;
                    $amount_in_words = ($rf+$lrf+$name_reservation_fee);
                  ini_set('precision', 17);
                  $total_ = number_format($amount_in_words,2);
                  // $total_amount_in_words = ($pos = strpos($amount_in_words,'.')) ? substr( $amount_in_words,0,$pos + 3) : number_format( $amount_in_words);
                  $peso_cents = '';
                  if(substr($total_,-3)=='.00')
                  {
                    $peso_cents ='Pesos';
                  }
                $w = new Numbertowords();
                ?>
                <?php
                  $report_exist = $this->db->where(array('payor'=>$payorname))->get('payment');
                  if($report_exist->num_rows()==0){
                    // Payment Series
                    $current_year = date('Y');
                    $this->db->select('*');
                    $this->db->from('payment');
                    $this->db->where("(refNo IS NOT NULL OR refNo != '') AND YEAR(date) = '".$current_year."'");
                    $series = $this->db->count_all_results();
                    $series = $series + 1;
                    $datee = date('Y-m-d',now('Asia/Manila'));
                    $amount = number_format($name_reservation_fee,2).'<br/>'.number_format($rf,2).'<br/>'.number_format($lrf,2).'<br/>'.number_format(100,2);
                    // End Payment Series
                  } else {
                    echo $payorname;
                    $this->db->select('*');
                    $this->db->from('payment');
                    $this->db->where('payor',$payorname);
                    $query = $this->db->get();
                    $series = $query->row();
                    $datee = $series->date;
                    $series = $series->refNo;
                    $amount = $series->amount;
                    
                    // $string = substr($lastseries, strrpos($lastseries, '-' )+1);
                    // $series = $string; // about-us
                  }
                  
                  if($coop_info->category_of_cooperative == 'Tertiary'){
                    $registrationfeename = 'Tertiary';
                  } else if ($coop_info->category_of_cooperative == 'Secondary'){
                    $registrationfeename = 'Secondary';
                  } else {
                    $registrationfeename = 'Primary';
                  }
                ?>
                   <?php echo form_open('payments/add_payment',array('id'=>'paymentForm','name'=>'paymentForm')); ?>
                   <input type="hidden" class="form-control" id="cooperativeID" name="cooperativeID" value="<?=$encrypted_id ?>">
                  <input type="hidden" class="form-control" id="tDate" name="tDate" value="<?=$datee; ?>">
                  <input type="hidden" class="form-control" id="refNo" name="refNo" value="<?=$series?>">
                  <input type="hidden" class="form-control" id="payor" name="payor" value="<?=$payorname?>">
                  <input type="hidden" class="form-control" id="nature" name="nature" value="Name Registration">
                  <!-- <input type="hidden" class="form-control" id="particulars" name="particulars" value="Name Reservation Fee<br/>Registration<br/>Legal and Research Fund Fee"> -->
                  <input type="hidden" class="form-control" id="particulars" name="particulars" value="Name Reservation Fee<br/>Registration Fee - <?=$registrationfeename?><br><i>(1/10 of 1% of Php<?=number_format($capitalization_info->total_amount_of_paid_up_capital,2)?> paid up capital amounted to Php<?=number_format($capitalization_info->total_amount_of_paid_up_capital*0.001,2)?> or a minimum of Php500.00, whichever is higher)</i><br/>Legal and Research Fund Fee<br/>COC Fee">
                  <input type="hidden" class="form-control" id="amount" name="amount" value="<?=number_format($name_reservation_fee,2).'<br/>'.number_format($rf,2).'<br/>'.number_format($lrf,2).'<br/>'.number_format(100,2) ?>">
                  <input type="hidden" class="form-control" id="total" name="total" value="<?=$rf+$lrf+$name_reservation_fee?>">
                  <input type="hidden" class="form-control" id="nature" name="rCode" value="<?= $coop_info->rCode ?>">
                
                 <input style="width:20%;" class="btn btn-info btn-sm" type="submit" id="offlineBtn" name="offlineBtn" value="Download O.P">
                

            </form>

                   
                <?php
                }
              }
            ?>
              <!-- END download payment form -->
          </li>
      </ul>
    </div>
    <?php endif; ?>
</div>
