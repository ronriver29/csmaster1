<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="approveCooperativeModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="approveCooperativeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document" style="width:90% !important;max-width:1360px;">
        <div class="modal-content">
          <?php /* echo form_open('cooperatives/approve_laboratories',array('id'=>'approveCooperativeForm','name'=>'approveCooperativeForm')); 
          */?> 
          <?php echo form_open('laboratories/approve_laboratories_2',array('id'=>'approveCooperativeForm','name'=>'approveCooperativeForm')); ?>
            <?php
            if($lab_info->status == 2){
              $submit = 'submit';
            } else {
              $submit = 'approve';
            }
            ?>
            <div class="modal-header">
              <h4 class="modal-title" id="approveCooperativeModalLabel">Are you sure you want to <?=$submit?> this application?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="cooperativeID" name="cooperativeID" value="<?=$lab_info->id?>" readonly>
              <div class="form-group">
                <label for="cName">Laboratory Name:</label>
                <input type="text" class="form-control validate[required]"  id="" value="<?=$lab_info->laboratoryName.' Laboratory Cooperative'?>" name="cName" placeholder="" readonly>
              </div>
              <?php if($admin_info->access_level==2){ ?>
              <div class="form-group">
                <label>Additional comment</label>
                <?php if($lab_info->status == 2 && $lab_info->third_evaluated_by!=0){ ?>
                  <textarea class="form-control" name="comment" style="height:200px;resize:none;"><?php foreach($director_comment_limit1 as $cc) : echo $cc['comment']."\n";endforeach; ?></textarea>
                <?php } else { ?>
                  <textarea class="form-control" name="comment" style="height:200px;resize:none;"></textarea>
                <?php } ?>
                
              </div>
              <?php } ?>
            </div>
            <div class="modal-footer approveCooperativeFooter">
                <?php if($admin_info->access_level >=3) : ?>
                        <input class="btn btn-color-blue" type="submit" id="approveCooperativeBtn" name="approveCooperativeBtn" value="Approve">
                <?php endif; ?>

                  <?php if($admin_info->access_level ==2) : ?>
              <input class="btn btn-color-blue" type="submit" id="approveCooperativeBtn" name="approveCooperativeBtn" value="Submit">
            <?php endif; ?>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

