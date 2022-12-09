 <style type="text/css">
.modal-dialog {
  height: 100%;
  width: 100%;
  display: flex;
  align-items: center;
}

.modal-content {
  margin: 0 auto;
}
 </style>
 <div class="row">

  <div class="col-sm-12 col-md-12">

    <div class="modal fade" id="confirmModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="deferCooperativeModalLabel" aria-hidden="true">

      <div class="modal-dialog" role="document"> 

        <div class="modal-content col-md-6" >

         <!--  <?php echo form_open('amendment/defer_cooperative',array('id'=>'deferCooperativeForm','name'=>'deferCooperativeForm')); ?> -->

            <div class="modal-header">

              <h4 class="modal-title" id="deferMemberModalLabel">Use System Generated ACBL?</h4>
         
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

              </button>

            </div>

            <div class="modal-body">
                 <div> <center> <p>If No, Coop will upload their own version of ACBL</p></center></div>
              <div class="col-md-12"><a href="<?php echo base_url();?>amendment_documents/custom_acbl/<?=$encrypted_id?>/0" class="form-control btn btn-info">Yes</a></div><br>
               <div class="col-md-12"><a href="<?php echo base_url();?>amendment_documents/custom_acbl/<?=$encrypted_id?>/1" class="form-control btn btn-warning">No</a></div>

            </div>
<!-- 
            <div class="modal-footer deferCooperativeFooter">

              <input class="btn btn-color-blue" type="submit" id="deferCooperativeBtn" name="deferCooperativeBtn" value="<?=($coop_info->status==12 ? "Submit" : "Defer")?>">

            </div> -->

          <!-- </form> -->

        </div>

      </div>

    </div>

  </div>

</div>
