<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="approveAmendmentModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="approveAmendmentModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
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
           <!--    < <div class="alert alert-info" role="alert">
                Cooperative Name:<br>
                <strong class="cooperative-name-text">test</strong> <strong>Cooperative</strong>
              </div> --> 
              <div class="form-group">
               
                <?php if($admin_info->access_level != 3 ) { ?>
                        <label for="comment">Additional Comment:</label>
                      <pre>  <textarea class="form-control " style="resize: none;" id="comment" name="comment_by_specialist_senior" placeholder=""rows="8">
                    <?php
                    if($coop_info->status!=3)
                    {
                      if(is_array($cds_comment) && count($cds_comment)>0):
                      // echo'CDS COMMENT :'.PHP_EOL;
                      foreach($cds_comment as $cc) :
                        if(strlen($cc['comment'])>0)
                        {
                        echo $cc['comment'].PHP_EOL;  
                        }
                      endforeach;
                          if(strlen($coop_info->tool_findings)>0)
                          {
                             echo 'CDS Tool Findings:';
                             echo $coop_info->tool_findings;
                          }
                         
                      endif;

                      if(is_array($senior_comment) && count($senior_comment)>0):
                      // echo'CDS COMMENT :'.PHP_EOL;
                      foreach($senior_comment as $cc) :
                        if(strlen($cc['comment'])>0)
                        {
                        echo $cc['comment'].PHP_EOL;  
                        }
                    endforeach;       
                      endif;


                    } 
                     
                ?>  
                        </textarea></pre>
                    <?php } ?>
              </div>  
            </div>
            <div class="modal-footer approveCooperativeFooter">
              <input class="btn btn-color-blue" type="submit" id="approveCooperativeBtn" name="approveCooperativeBtn" value="Submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
