<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="deferLaboratoryModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();" tabindex="-1" role="dialog" aria-labelledby="deferLaboratoryModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document" style="width:90% !important;max-width:1360px;">
        <div class="modal-content">
          <?php echo form_open('laboratories/defer_laboratory',array('id'=>'deferLaboratoryForm','name'=>'deferLaboratoryForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="deferMemberModalLabel">Are you sure you want to defer this application?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="laboratoryID" name="laboratoryID" readonly>
              <div class="alert alert-info" role="alert">
                Laboratory Name:<br>
                <strong class="laboratory-name-text">test</strong> <strong></strong>
              </div>
              <div class="form-group">
         
              <?php if($senior_comment!=NULL){ ?>
                <label for="comment">State the reason/s: </label>
            
                <textarea class="form-control validate[required]" style="resize: none;align-content: left;" id="comment" name="comment" rows="8"><?php foreach($senior_comment_limit1 as $srn_comment){echo $srn_comment['comment'].PHP_EOL;}?></textarea>
              <?php 
              }
              else
              {
              ?>
                <label for="comment">State the reason/s: </label>
    
                <textarea class="form-control validate[required]" style="resize: none;align-content: left;" id="comment" name="comment" rows="8"></textarea>
              <?php  
              }
              ?>
            
              </div>
            </div>
            <div class="modal-footer deferLaboratoryFooter">
              <input class="btn btn-color-blue" type="submit" id="deferLaboratoryBtn" name="deferLaboratoryBtn" value="Defer">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
