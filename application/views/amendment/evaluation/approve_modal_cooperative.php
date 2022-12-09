<style>

    @media screen and (min-width: 676px) {

        .modal-dialog {

          max-width: 1200px; /* New width for default modal */

        }

    }

</style>

<div class="row">

  <div class="col-sm-12 col-md-12">

    <div class="modal fade bd-example-modal-lg" id="approveAmendmentModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="approveAmendmentModalLabel" aria-hidden="true">

      <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">

          <?php echo form_open('amendment/approve_cooperative',array('id'=>'approveAmendmentForm','name'=>'approveAmendmentForm')); ?>

            <div class="modal-header">

              <h4 class="modal-title" id="approveAmendmentModalLabel">Are you sure you want to submit this application?</h4>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

              </button>

            </div> 

            <div class="modal-body">

              <input type="hidden" id="cooperativeID" name="cooperativeID" readonly>

              <div class="form-group">

                <label for="cName">Cooperative Name:</label>

                <input type="text" class="form-control validate[required]"  id="cName" name="cName" placeholder="" readonly>

              </div>



              <?php if(!in_array($admin_info->access_level,array(3,4))){?><h6><b>CDS Tool Findngs :</b></h6><?php }?> 

              <?php if($admin_info->access_level ==1 || $admin_info->access_level ==2){?>

                <?php if($coop_info->status == 6):?>

                   <pre><textarea class="form-control" rows="4" style="resize: none;text-align: left;padding:0px;margin-bottom:40px;" name="tool_findings"><?php if(strlen($tool_findings)>0){echo $tool_findings;}?></textarea></pre>

                <?php else:?>

                   <pre><textarea class="form-control" rows="4" style="resize: none;text-align: left;padding:0px;margin-bottom:40px;" name="tool_findings"><?php if(strlen($coop_info->tool_findings)>0){echo $coop_info->tool_findings."\n";}?></textarea></pre>

                <?php endif;?>

              

              <?php 

              }

              ?>

               

              <?php

              if($coop_info->status ==6 && $coop_info->third_evaluated_by>0)

              {

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

                      <div class="form-group">

                     

                      <pre><textarea class="form-control " style="resize: none;" id="documents" name="documents" placeholder=""rows="8"><?php if($coop_info->status!=3){if($director_comment!=NULL){foreach($director_comment as $cc){echo $cc['documents']."\n";}}}?></textarea></pre>

                           

                        </div>

                    </td>

                    <td style="border:1px solid black;padding-top:5px;text-align: left;">

                        <div class="form-group">

                              <pre><textarea class="form-control " style="resize: none;" id="comment" name="comment" placeholder=""rows="8"><?php if($coop_info->status!=3){if(is_array($director_comment) && count($director_comment)>0):foreach($director_comment as $cc) :if(strlen($cc['comment'])>0){ echo $cc['comment']."\n";  }endforeach;endif;

                               

                              } 

                          ?>  </textarea></pre>

                        </div>

                    </td>

                    <td style="border:1px solid black;padding-top:5px;text-align: left;">

                        <div class="form-group">

                              <pre><textarea class="form-control" style="resize: none;" id="comment" name="recomended_action" placeholder=""rows="8"><?php if($coop_info->status!=3){if(is_array($director_comment) && count($director_comment)>0):foreach($director_comment as $cc):if(strlen($cc['rec_action'])>0){echo$cc['rec_action']."\n";}endforeach;endif;

                               

                              } 

                               

                          ?></textarea></pre>

                           

                        </div>

                    </td>

                  </tr>

                </tbody>

              </table>

              <?php

              } //if from deffered or resubmit

              else

              {

              ?>

                

                <?php  if($admin_info->access_level != 3 && $admin_info->access_level != 4 ) { ?> 

                  

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

                        <div class="form-group">



                        <pre><textarea class="form-control " style="resize: none;" id="documents" name="documents" placeholder=""rows="8"><?php if($coop_info->status!=3){if(is_array($cds_comment) && count($cds_comment)>0){foreach($cds_comment as $cc){if(strlen($cc['documents'])>0){echo $cc['documents']."\n";}}}if(is_array($senior_comment) && count($senior_comment)>0){foreach($senior_comment as $cc){if(strlen($cc['documents'])>0){echo $cc['documents']."\n";}}}}?></textarea></pre>

                             

                          </div>

                      </td>

                      <td style="border:1px solid black;padding-top:5px;text-align: left;">

                          <div class="form-group">

                                <pre><textarea class="form-control " style="resize: none;" id="comment" name="comment" placeholder=""rows="8"><?php if($coop_info->status!=3){if(is_array($cds_comment) && count($cds_comment)>0):foreach($cds_comment as $cc) :if(strlen($cc['comment'])>0){ echo $cc['comment']."\n";  }endforeach;endif;

                                  if(is_array($senior_comment) && count($senior_comment)>0):foreach($senior_comment as $cc) :

                                    if(strlen($cc['comment'])>0)

                                    {

                                    echo $cc['comment']."\n";  

                                    }

                                endforeach;       

                                  endif;

                                } 

                            ?>  </textarea></pre>

                          </div>

                      </td>

                      <td style="border:1px solid black;padding-top:5px;text-align: left;">

                          <div class="form-group">

                                <pre><textarea class="form-control" style="resize: none;" id="comment" name="recomended_action" placeholder=""rows="8"><?php if($coop_info->status!=3){if(is_array($cds_comment) && count($cds_comment)>0):foreach($cds_comment as $cc):if(strlen($cc['rec_action'])>0){echo$cc['rec_action']."\n";}endforeach;endif;

                                  if(is_array($senior_comment) && count($senior_comment)>0):

                                  // echo'CDS COMMENT :'.PHP_EOL;

                                  foreach($senior_comment as $cc) :

                                    if(strlen($cc['rec_action'])>0)

                                    {

                                    echo $cc['rec_action'].PHP_EOL;  

                                    }

                                endforeach;       

                                  endif;

                                } 

                                 

                            ?></textarea></pre>

                             

                          </div>

                      </td>

                    </tr>

                  </tbody>

                </table>

                   <?php } ?>



              <?php

              }// if from deffered or resubmit

              ?>

              

            </div>

            <div class="modal-footer approveCooperativeFooter">

              <input class="btn btn-color-blue" type="submit" id="approveCooperativeBtn" name="approveCooperativeBtn" value="Submit">

            </div>

          </form>

        </div> <!--END MODAL CONTENT-->

      </div>

    </div>

  </div>

</div>

