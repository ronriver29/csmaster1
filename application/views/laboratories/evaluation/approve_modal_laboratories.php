<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="approveCooperativeModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="approveCooperativeModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php /* echo form_open('cooperatives/approve_laboratories',array('id'=>'approveCooperativeForm','name'=>'approveCooperativeForm')); 
          */?> 
          <?php echo form_open('laboratories/approve_laboratories_2',array('id'=>'approveCooperativeForm','name'=>'approveCooperativeForm')); ?>

            <div class="modal-header">
              <h4 class="modal-title" id="approveCooperativeModalLabel">Are you sure you want to approve this application?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="cooperativeID" name="cooperativeID" value="<?=$lab_info->id?>" readonly>
              <div class="form-group">
                <label for="cName">Laboratory Name:</label>
                <input type="text" class="form-control validate[required]"  id="" value="<?='Laboratory Cooperative of '.$lab_info->laboratoryName?>" name="cName" placeholder="" readonly>
              </div>
              <?php if($admin_info->access_level==2){ ?>
              <div class="form-group">
                <label>Additional comment</label>
                <textarea class="form-control" name="comment" style="height:200px;resize:none;"> </textarea>
              </div>
              <?php } ?>
              <!-- <div class="alert alert-info" role="alert">
                Cooperative Name:<br>
                <strong class="cooperative-name-text">test</strong> <strong>Cooperative</strong>
              </div> -->
              <!-- <div class="form-group">
                <label for="comment">Additional Comment:</label>
                <textarea class="form-control " style="resize: none;" id="comment" name="comment" placeholder=""rows="8"><?php echo $coop_info->evaluation_comment;?></textarea>
              </div> -->
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

