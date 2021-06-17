<?php $total_subscribed = 0;?>
<?php $total_paid = 0;?>
<?php foreach ($list_cooperators as $cooperator) : ""?>
    <?php 
        $total_subscribed += $cooperator['number_of_subscribed_shares'];
        $total_paid += $cooperator['number_of_paid_up_shares'];
    ?>
<?php endforeach; ?>



<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="addAffiliatorModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('affiliators/add_affiliators',array('id'=>'deleteCooperatorForm','name'=>'deleteCooperatorForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="deleteModalLabel">Are you sure you want to add this?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" class="form-control" id="cooperativesID" name="cooperativesID" value="<?=$encrypted_id ?>">
              
              <input type='hidden' id='available_subscribed_capital' value="<?=isset($capitalization_info->total_no_of_subscribed_capital) ? $capitalization_info->total_no_of_subscribed_capital - $total_subscribed: ''?>" />
              <input type='hidden' id='available_paid_up_capital' value="<?=isset($capitalization_info->total_no_of_paid_up_capital) ? $capitalization_info->total_no_of_paid_up_capital - $total_paid: ''?>" />
              <input type='hidden' id='minimum_subscribed_share_regular' value="<?=isset($capitalization_info->minimum_subscribed_share_regular) ? $capitalization_info->minimum_subscribed_share_regular: ''?>" />
              <input type='hidden' id='minimum_paid_up_share_regular' value="<?=isset($capitalization_info->minimum_paid_up_share_regular) ? $capitalization_info->minimum_paid_up_share_regular: ''?>" />
              <input type='hidden' id='minimum_subscribed_share_associate' value="<?=isset($capitalization_info->minimum_subscribed_share_associate) ? $capitalization_info->minimum_subscribed_share_associate: ''?>" />
              <input type='hidden' id='minimum_paid_up_share_associate' value="<?=isset($capitalization_info->minimum_paid_up_share_associate) ? $capitalization_info->minimum_paid_up_share_associate: ''?>" />
              <input type="hidden" class="validate[required]" id="cooperativeID" name="cooperativesID">
              <input type="hidden" class="validate[required]" id="application_id" name="applicationid">
              <input type="hidden" class="validate[required]" id="coopname" name="coopName">
              <input type="hidden" class="validate[required]" id="regno" name="regNo">
              <input type="hidden" class="validate[required]" id="regid" name="registered_id">
              <div class="alert alert-info" role="alert">
                <p> Are you sure you want to add <strong class="cooperator-name-text">test</strong> Cooperative?</p>
              </div>
              <div class="alert alert-info" role="alert">
                <strong>Reminder: <small>(The information below is in your bylaws (capitalization))</small></strong>
                 <ul>
                   <li>Regular Member must subscribed at least <strong><?= $capitalization_info->minimum_subscribed_share_regular?></strong> shares and pay at least <strong><?= $capitalization_info->minimum_paid_up_share_regular?></strong> shares.</li>
                   <?php if($bylaw_info->kinds_of_members ==2) : ?>
                    <li>Associate Member must subscribed at least  <strong><?= $capitalization_info->minimum_subscribed_share_associate?></strong> shares and pay at least <strong><?= $capitalization_info->minimum_paid_up_share_associate?></strong> shares.</li>
                  <?php endif; ?>
                 </ul>
                </div>
            </div>

            <!-- <div class="form-group">
              <label for="membershipType">Type of Membership:</label>
              <select class="custom-select validate[required]" id="membershipType" name="membershipType">
                <option value="" selected>--</option>
                <option value="Regular">Regular</option>
                <?php if($bylaw_info->kinds_of_members==2) :?>
                  <option value="Associate">Associate</option>
                <?php endif?>
              </select>
            </div> -->
            <div class="col-md-12">
              <div class="form-group">
                <label for="subscribedShares">No of subscribed shares:</label>
                <input type="number" max="<?=isset($capitalization_info->total_no_of_subscribed_capital) ? $capitalization_info->total_no_of_subscribed_capital - $total_subscribed: ''?>" class="form-control validate[required,min[1],custom[integer]]" id="subscribedShares" name="subscribedShares">
                <div id="subscribed-note" style="color: red; font-size: 12px;"></div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="paidShares">No of paid-up Shares:</label>
                <input type="number" min="1" max="<?=isset($capitalization_info->total_no_of_paid_up_capital) ? $capitalization_info->total_no_of_paid_up_capital - $total_paid: ''?>" class="form-control validate[required,min[1],custom[integer],funcCall[validateAddNumberOfPaidUpGreaterCustom]]" id="paidShares" name="paidShares">
                <div id="paid-note" style="color: red; font-size:12px;"></div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="paidShares">Name of Representative:</label>
                <input type="text" id="representative" class="form-control validate[required]" name="representative">
                <div id="paid-note" style="color: red; font-size:12px;"></div>
              </div>
            </div>

            <div class="modal-footer deleteCooperatorFooter">
              <input class="btn btn-color-blue btn-block" type="submit" id="deleteCooperatorBtn" name="deleteCooperatorBtn" value="Add">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
