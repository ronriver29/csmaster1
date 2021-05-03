<style>
    .err-message-note{
        color:grey;
        font-size: 7;
    }
    .err-message-note-error{
        color:red !important;
    }
</style>
<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">
      <?php if($is_client): ?>
      Step 3
      <?php endif; ?>
    </h5>
  </div>
</div>
<?php if(!$this->session->flashdata('bylaw_success') || !$this->session->flashdata('bylaw_error') || !$this->session->flashdata('bylaw_redirect')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-info" role="alert">
      Capitalization
    </div>
  </div>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('capitalization_redirect')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-info text-center" role="alert">
      <?php echo $this->session->flashdata('capitalization_redirect'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('capitalization_success')): ?>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('capitalization_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('capitalization_error')): ?>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('capitalization_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if(validation_errors()) : ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-danger" role="alert">
      <ul>
        <?php echo validation_errors('<li>','</li>'); ?>
      </ul>
    </div>
  </div>
</div>
<?php endif;  ?>
<?php
    $regular_members = isset($capitalization_info->regular_members) ? $capitalization_info->regular_members : "";
    $authorized_share_capital = isset($capitalization_info->authorized_share_capital) ? $capitalization_info->authorized_share_capital : "";
    $par_value = isset($capitalization_info->par_value) ? $capitalization_info->par_value : 0;
    $common_share = isset($capitalization_info->common_share) ? $capitalization_info->common_share : "";
    $total_amount_of_subscribed_capital = isset($capitalization_info->total_amount_of_subscribed_capital) ? $capitalization_info->total_amount_of_subscribed_capital : "";
    $amount_of_common_share_subscribed = isset($capitalization_info->amount_of_common_share_subscribed) ? $capitalization_info->amount_of_common_share_subscribed : "";
    $amount_of_preferred_share_subscribed = isset($capitalization_info->amount_of_preferred_share_subscribed) ? $capitalization_info->amount_of_preferred_share_subscribed : "";
    $amount_of_common_share_paidup = isset($capitalization_info->amount_of_common_share_paidup) ? $capitalization_info->amount_of_common_share_paidup : "";
    $amount_of_preferred_share_paidup = isset($capitalization_info->amount_of_preferred_share_paidup) ? $capitalization_info->amount_of_preferred_share_paidup : "";
    $total_no_of_subscribed_capital = isset($capitalization_info->total_no_of_subscribed_capital) ? $capitalization_info->total_no_of_subscribed_capital : "";
    $total_amount_of_paid_up_capital = isset($capitalization_info->total_amount_of_paid_up_capital) ? $capitalization_info->total_amount_of_paid_up_capital : "";
    $total_no_of_paid_up_capital = isset($capitalization_info->total_no_of_paid_up_capital) ? $capitalization_info->total_no_of_paid_up_capital : "";
    $minimum_subscribed_share_regular = isset($capitalization_info->minimum_subscribed_share_regular) ? $capitalization_info->minimum_subscribed_share_regular : "";
    $minimum_paid_up_share_regular = isset($capitalization_info->minimum_paid_up_share_regular) ? $capitalization_info->minimum_paid_up_share_regular : "";
    $associate_members = isset($capitalization_info->associate_members) ? $capitalization_info->associate_members : "";
    $preferred_share = isset($capitalization_info->preferred_share) ? $capitalization_info->preferred_share : "";
    $minimum_subscribed_share_associate = isset($capitalization_info->minimum_subscribed_share_associate) ? $capitalization_info->minimum_subscribed_share_associate : "";
    $minimum_paid_up_share_associate = isset($capitalization_info->minimum_paid_up_share_associate) ? $capitalization_info->minimum_paid_up_share_associate : "";
    $total_members = strlen($regular_members) > 0 ? ($regular_members + (strlen($associate_members)>0 ? $associate_members : 0)) : "";
?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <?php echo form_open('cooperatives/'.$encrypted_id.'/capitalization',array('id'=>'capitalizationForm','name'=>'capitalizationForm')); ?>
         <input type="hidden" class="form-control" id="cooperativesID" name="cooperativesID" value="<?=$encrypted_id ?>">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <tr>
                        <td>No. of Members</td>
                        <td>
                            <input type="number" class="form-control" id="total_members" disabled="disabled" value="<?=$total_members?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Regular</td>
                        <td>
                            <input type="number" name="item[regular_members]" id="regular_members" class="form-control" min="15" value="<?=$regular_members;?>"/>
                            <br/>
                            <span id="regular_members_note" class="err-message-note"></span>
                        </td>
                    </tr>
                    <?php if($bylaw_info->kinds_of_members ==2) : ?>
                    <tr>
                        <td>Associate</td>
                        <td>
                            <input type="number" name="item[associate_members]" id="associate_members" class="form-control" value="<?=$associate_members;?>"/>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <td>Authorized Share Capital</td>
                        <td>
                            <input type="number" name="item[authorized_share_capital]" id="authorized_share_capital" min="15000" class="form-control" value="<?=$authorized_share_capital;?>"/>
                            <br/>
                            <span id="authorized_share_capital_note" class="err-message-note"></span>
                        </td>
                        <td>Par Value</td>
                        <td><?php if($par_value>0 && $par_value!=""){$par_value = (int)$par_value;}?>
                            <input type="number" name="item[par_value]" id="par_value" class="form-control" value="<?=$par_value?>"/>
                        
                        </td>
                    </tr>
                    <tr>
                        <td>Common Share</td> 
                        <td>
                            <input type="number" name="item[common_share]" min="180000" max="180000" id="common_share" class="form-control" value="<?=$common_share?>" required/>
                            <br/>
                            <span id="common_share_note" class="err-message-note"></span>
                        </td>
                    </tr>
                    <?php if($bylaw_info->kinds_of_members ==2) : ?>
                    <tr>
                        <td>Preferred Shared</td>
                        <td>
                            <input type="number" name="item[preferred_share]" id="preferred_share" class="form-control" value="<?=$preferred_share;?>"/>
                            <br/>
                            <span id="preferred_share_note" class="err-message-note"></span>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <td>Total amount of subscribed capital </td>
                        <td>
                        <?php
                    
                            if($total_amount_of_subscribed_capital>0 && $total_amount_of_subscribed_capital!= "")
                            {
                                $total_amount_of_subscribed_capital = (int)$total_amount_of_subscribed_capital  ; 
                            }

                            
                        ?>
                            <input type="number" name="item[total_amount_of_subscribed_capital]" id="total_amount_of_subscribed_capital" class="form-control" value="<?=$total_amount_of_subscribed_capital;?>"/>
                            <br/>
                            <span id="total_amount_of_subscribed_capital_note" class="err-message-note"></span>
                        </td>
                        <td>Total no of subscribed capital</td>
                        <td>
                            <input type="number" name="item[total_no_of_subscribed_capital]" id="total_no_of_subscribed_capital" class="form-control" readonly="readonly" value="<?=$total_no_of_subscribed_capital;?>"/>
                            <br/>
                            <span id="total_no_of_subscribed_capital_note" class="err-message-note"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Amount of Common Share </td>
                        <td>
                            <?php 
                            $tot_comon_share = '';
                            if($total_regular['total_subscribed']<=0 )
                            {
                                $total_regular['total_subscribed']=0;
                            }
                            if($par_value<=0 )
                            {
                                $par_value=0;
                            }
                            ?>
                            <input type="text" name="item[amount_of_common_share_subscribed]" id="amount_of_common_share_subscribed" class="form-control" value="<?=$total_regular['total_subscribed'] * $par_value?>" readonly=""/>
                            <br/>
                            <span id="amount_of_common_share_subscribed_note" class="err-message-note"></span>
                        </td>
                        <td></td>
                        <td>
                            <input type="text" name="item[amount_of_common_share_subscribed_pervalue]" id="amount_of_common_share_subscribed_pervalue" class="form-control" value="<?=$total_regular['total_subscribed']?>" readonly=""/>
                            <br/>
                            <!--<span id="amount_of_common_share_subscribed_note" class="err-message-note"></span>-->  
                        </td>
                    </tr>
                    <?php if($bylaw_info->kinds_of_members ==2) : ?>
                        <tr>
                            <td>Amount of Preferred Share</td>
                            <td>
                                <input type="text" name="item[amount_of_preferred_share_subscribed]" id="amount_of_preferred_share_subscribed" class="form-control" value="<?=$total_associate['total_subscribed'] * $par_value;?>" readonly=""/>
                                <br/>
                                <!--<span id="amount_of_preferred_share_subscribed_note" class="err-message-note"></span>-->
                            </td>
                            <td></td>
                            <td>
                                <input type="text" name="item[amount_of_preferred_share_subscribed_pervalue]" id="amount_of_preferred_share_subscribed_pervalue" class="form-control" value="<?=$total_associate['total_subscribed'];?>" readonly=""/>
                                <br/>
                                <!--<span id="amount_of_preferred_share_subscribed_note" class="err-message-note"></span>-->
                            </td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td>Total amount of paid-up capital</td>
                        <td>
                            <input type="number" name="item[total_amount_of_paid_up_capital]" id="total_amount_of_paid_up_capital" class="form-control" value="<?=$total_amount_of_paid_up_capital;?>"/>
                            <br/>
                            <span id="total_amount_of_paid_up_capital_note"class="err-message-note"></span>
                        </td>
                        <td>Total no of paid-up capital</td>
                        <td>
                            <input type="number" name="item[total_no_of_paid_up_capital]" id="total_no_of_paid_up_capital" class="form-control" readonly="readonly" value="<?=$total_no_of_paid_up_capital;?>"/>
                            <br/>
                            <span id="total_no_of_paid_up_capital_note"class="err-message-note"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Amount of Common Share</td>
                        <td>
                            <input type="text" name="item[amount_of_common_share_paidup]" id="amount_of_common_share_paidup" class="form-control" value="<?=$total_regular['total_paid'] * $par_value;?>" readonly=""/>
                            <br/>
                            <!--<span id="amount_of_common_share_paidup_note" class="err-message-note"></span>-->
                        </td>
                        <td></td>
                        <td>
                            <input type="text" name="item[amount_of_common_share_paidup_pervalue]" id="amount_of_common_share_paidup" class="form-control" value="<?=$total_regular['total_paid'];?>" readonly=""/>
                            <br/>
                            <!--<span id="amount_of_common_share_paidup_note" class="err-message-note"></span>-->
                        </td>
                    </tr>
                    <?php if($bylaw_info->kinds_of_members ==2) : ?>
                        <tr>
                            <td>Amount of Preferred Share</td>
                            <td>
                                <input type="text" name="item[amount_of_preferred_share_paidup]" id="amount_of_preferred_share_paidup" class="form-control" value="<?=$total_associate['total_paid'] * $par_value;?>" readonly=""/>
                                <br/>
                                <!--<span id="amount_of_preferred_share_paidup_note" class="err-message-note"></span>-->
                            </td>
                            <td></td>
                            <td>
                                <input type="text" name="item[amount_of_preferred_share_paidup_pervalue]" id="amount_of_preferred_share_paidup" class="form-control" value="<?=$total_associate['total_paid'];?>" readonly=""/>
                                <br/>
                                <!--<span id="amount_of_preferred_share_paidup_note" class="err-message-note"></span>-->
                            </td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                    <tr>
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <td>Minimum No. of subscribed share (individual regular)</td>
                        <td>
                            <input type="number" name="item[minimum_subscribed_share_regular]" id="" class="form-control" value="<?=$minimum_subscribed_share_regular;?>"/>
                            <br/>
                            <span id="minimum_subscribed_share_regular_note"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Minimum No. of paid up share (individual regular)</td>
                        <td>
                            <input type="number" name="item[minimum_paid_up_share_regular]" id="" class="form-control" value="<?=$minimum_paid_up_share_regular;?>"/>
                        </td>
                    </tr>
                    <?php if($bylaw_info->kinds_of_members ==2) : ?>
                    <tr>
                        <td>Minimum subscribed share (individual associate)</td>
                        <td>
                            <input type="number" name="item[minimum_subscribed_share_associate]" id="" class="form-control" value="<?=$minimum_subscribed_share_associate;?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Minimum paid up share (individual associate)</td>
                        <td>
                            <input type="number" name="item[minimum_paid_up_share_associate]" id="" class="form-control" value="<?=$minimum_paid_up_share_associate;?>"/>
                        </td>
                    </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
      </div>
      <div class="card-footer capitalizationPrimaryFooter">
        <?php if(($is_client && ($coop_info->status==11||$coop_info->status<=1))): ?>
            <input class="btn btn-color-blue btn-block" type="submit" id="capitalizationPrimaryBtn" name="capitalizationPrimaryBtn" value="Submit">
        <?php endif; ?>
      </div>
    </form>
    </div>
  </div>
</div>
<?php $type_of_members = $bylaw_info->kinds_of_members ==2 ? "associate" : "regular" ?>
<script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){

var type_of_members = "<?php echo $type_of_members?>";
var regular_members = $("#regular_members").val().length>0 ? $("#regular_members").val() : 0;
var associate_members = type_of_members == "associate" && $("#associate_members").val().length>0 ? $("#associate_members").val() : 0;
var authorized_share_capital = $("#authorized_share_capital").val().length>0 ? $("#authorized_share_capital").val() : 0;
var par_value = $("#par_value").val().length>0 ? $("#par_value").val() : 0;

$("#regular_members").change(function(){
    computeCapital();
});
if($("#associate_members").length>0) {
    $("#associate_members").change(function(){
        computeCapital();
    });
}
$("#authorized_share_capital").change(function(){
    computeCapital();
});
$("#par_value").change(function(){
    computeCapital();
});
$("#common_share").change(function(){
    computeCapital();
});
if($("#preferred_share").length>0) {}
    $("#preferred_share").change(function(){
        computeCapital();
    });
$("#total_amount_of_subscribed_capital").change(function(){
    computeCapital();
});
$("#total_amount_of_paid_up_capital").change(function(){
    computeCapital();
});
function computeCapital() {
    var type_of_members = "<?php echo $type_of_members?>";
    var regular_members = $("#regular_members").val().length>0 ? parseInt($("#regular_members").val()) : 0;
    var associate_members = type_of_members == "associate" && $("#associate_members").val().length>0 ? parseInt($("#associate_members").val()) : 0;
    var authorized_share_capital = $("#authorized_share_capital").val().length>0 ? parseFloat($("#authorized_share_capital").val()) : 0;
    var par_value = $("#par_value").val().length>0 ? parseFloat($("#par_value").val()) : 0;
    var authorized_share;
    var minimum_percentage = 0.25;
    var common_share;
    var maximum_common_share;
    var minimum_common_share;
    var preferred_share;
    var maximum_preferred_share;
    var minimum_preferred_share;
    var common_share_percentage = 1;
    var preferred_share_percentage = 0;
    var minimum_common_share_percentage = common_share_percentage;
    var maximum_preferred_share_percentage = 1-common_share_percentage;
    var minimum_preferred_share_percentage = 1-common_share_percentage;
    var amount_of_subscribed_capital;
    var maximum_amount_of_subscribed_capital;
    var minimum_amount_of_subscribed_capital;
    var no_of_subscribed_capital;
    var maximum_no_of_subscribed_capital;
    var minimum_no_of_subscribed_capital;
    var amount_of_paid_up_capital;
    var maximum_amount_of_paid_up_capital;
    var minimum_amount_of_paid_up_capital;
    var no_of_paid_up_capital;
    var maximum_no_of_paid_up_capital;
    var minimum_no_of_paid_up_capital;
    var minimum_no_of_subscribed_share_regular;
    var minimum_no_of_paid_up_share_regular;
    var minimum_no_of_subscribed_share_associate;
    var minimum_no_of_paid_up_share_associate;
    
    var total_members = parseInt(regular_members) + parseInt(associate_members);
    if($("#regular_members").length>0) {
        $("#regular_members_note").removeClass("err-message-note-error");
        if(regular_members < 15) {
            $("#regular_members_note").html("Should be at least 15 members");
            $("#regular_members_note").addClass("err-message-note-error");
        }
        $("#total_members").val(total_members);
    }
    /*get subscribed and paid-up capital*/
    if($("#total_amount_of_subscribed_capital").val().length>0) {
        amount_of_subscribed_capital = parseFloat($("#total_amount_of_subscribed_capital").val());
        minimum_amount_of_subscribed_capital = Math.ceil(authorized_share_capital * minimum_percentage);
        minimum_amount_of_paid_up_capital = Math.ceil(amount_of_subscribed_capital * minimum_percentage);
        if(minimum_amount_of_subscribed_capital<15000) {
            minimum_amount_of_subscribed_capital = 15000;
        }
       if(minimum_amount_of_paid_up_capital<15000) {
            minimum_amount_of_paid_up_capital = 15000;
        }
        no_of_subscribed_capital = Math.ceil(amount_of_subscribed_capital/par_value);
        minimum_no_of_subscribed_capital = Math.ceil(minimum_amount_of_subscribed_capital/par_value);
        minimum_no_of_paid_up_capital = Math.ceil(minimum_no_of_subscribed_capital * minimum_percentage);
        if(amount_of_subscribed_capital > authorized_share_capital) {
            maximum_amount_of_subscribed_capital = authorized_share_capital;
            maximum_amount_of_paid_up_capital = Math.ceil(amount_of_paid_up_capital * minimum_percentage);
            maximum_no_of_subscribed_capital = Math.ceil((authorized_share_capital * minimum_percentage)/par_value);
            maximum_no_of_paid_up_capital = Math.ceil(no_of_subscribed_capital * minimum_percentage);
        }
    } else {
        amount_of_subscribed_capital = Math.ceil(authorized_share_capital * minimum_percentage);
        minimum_amount_of_subscribed_capital = amount_of_subscribed_capital;
        minimum_amount_of_paid_up_capital = Math.ceil(amount_of_subscribed_capital * minimum_percentage);
        if(minimum_amount_of_subscribed_capital<15000) {
            minimum_amount_of_subscribed_capital = 15000;
        }
       if(minimum_amount_of_paid_up_capital<15000) {
            minimum_amount_of_paid_up_capital = 15000;
        }
        no_of_subscribed_capital = Math.ceil(amount_of_subscribed_capital/par_value);
        minimum_no_of_subscribed_capital = Math.ceil(minimum_amount_of_subscribed_capital/par_value);
        minimum_no_of_paid_up_capital = Math.ceil(minimum_no_of_subscribed_capital * minimum_percentage);
        if(amount_of_subscribed_capital > authorized_share_capital) {
            maximum_amount_of_subscribed_capital = authorized_share_capital;
            maximum_amount_of_paid_up_capital = Math.ceil(amount_of_paid_up_capital * minimum_percentage);
            maximum_no_of_subscribed_capital = Math.ceil((authorized_share_capital * minimum_percentage)/par_value);
            maximum_no_of_paid_up_capital = Math.ceil(no_of_subscribed_capital * minimum_percentage);
        }
    }
   
    if($("#total_amount_of_paid_up_capital").val().length>0) {
        amount_of_paid_up_capital = parseFloat($("#total_amount_of_paid_up_capital").val());
        no_of_paid_up_capital = Math.ceil(amount_of_paid_up_capital/par_value);
    } else {
       amount_of_paid_up_capital = minimum_amount_of_paid_up_capital;
        no_of_paid_up_capital = Math.ceil(amount_of_paid_up_capital/par_value);
    }
    
    /*get common and preferred share*/
    if(type_of_members=="regular") {
        common_share = $("#common_share").val().length>0 ? parseFloat($("#common_share").val()) : Math.ceil(authorized_share_capital / par_value);
        maximum_common_share = authorized_share_capital / par_value;
        minimum_common_share = authorized_share_capital / par_value;
        
        minimum_no_of_subscribed_share_regular = Math.ceil((common_share * 0.25)/regular_members);
        minimum_no_of_paid_up_share_regular = Math.ceil(minimum_no_of_subscribed_share_regular * 0.25);
    } else {
        common_share_percentage = 0.75;
        minimum_common_share_percentage = common_share_percentage;
        authorized_share = Math.ceil(authorized_share_capital / par_value);
        if($("#common_share").val().length>0) {
            common_share = parseFloat($("#common_share").val());
            maximum_common_share = authorized_share;
            minimum_common_share = Math.ceil(authorized_share*minimum_common_share_percentage);
            common_share_percentage = parseFloat(common_share / authorized_share);

            maximum_preferred_share_percentage = 1-common_share_percentage;
            minimum_preferred_share_percentage = 1-common_share_percentage;
            preferred_share = $("#preferred_share").val().length>0 ? parseFloat($("#preferred_share").val()) : (authorized_share_capital / par_value)*maximum_preferred_share_percentage;
            maximum_preferred_share = Math.ceil((authorized_share_capital / par_value)*maximum_preferred_share_percentage);
            minimum_preferred_share = Math.ceil((authorized_share_capital / par_value)*minimum_preferred_share_percentage);
        } else {
            common_share = authorized_share*minimum_common_share_percentage;
            maximum_common_share = authorized_share;
            minimum_common_share = Math.ceil(authorized_share*minimum_common_share_percentage);
            common_share_percentage = parseFloat(common_share / authorized_share);

            maximum_preferred_share_percentage = 1-common_share_percentage;
            minimum_preferred_share_percentage = 1-common_share_percentage;
            preferred_share = $("#preferred_share").val().length>0 ? ParseFloat($("#preferred_share").val()) : (authorized_share_capital / par_value)*maximum_preferred_share_percentage;
            maximum_preferred_share = Math.ceil(authorized_share*maximum_preferred_share_percentage);
            minimum_preferred_share = Math.ceil(authorized_share*minimum_preferred_share_percentage);
        }
        
        minimum_no_of_subscribed_share_regular = Math.ceil((common_share * 0.25)/regular_members);
        minimum_no_of_paid_up_share_regular = Math.ceil(minimum_no_of_subscribed_share_regular * 0.25);
        
        /*preferred share*/
        minimum_no_of_subscribed_share_associate = Math.ceil((preferred_share * 0.25)/associate_members);
        minimum_no_of_paid_up_share_associate = Math.ceil(minimum_no_of_subscribed_share_associate * 0.25);
    }
    if($("#authorized_share_capital").val().length>0) {
        $("#authorized_share_capital_note").removeClass("err-message-note-error");
        $("#authorized_share_capital_note").html("");
        if(authorized_share_capital < 15000) {
            $("#authorized_share_capital_note").html("Should be at least 15000");
            $("#authorized_share_capital_note").addClass("err-message-note-error");
        }
//        $("#total_amount_of_subscribed_capital").val(amount_of_subscribed_capital);
        $("#total_amount_of_subscribed_capital").attr("min",minimum_amount_of_subscribed_capital);
        $("#total_amount_of_subscribed_capital_note").removeClass("err-message-note-error");
        if(minimum_amount_of_subscribed_capital>amount_of_subscribed_capital || (amount_of_subscribed_capital>maximum_amount_of_subscribed_capital && authorized_share_capital > 15000)) {
            $("#total_amount_of_subscribed_capital_note").addClass("err-message-note-error");
        }
        if(amount_of_subscribed_capital>maximum_amount_of_subscribed_capital && authorized_share_capital >= 15000) {
            $("#total_amount_of_subscribed_capital_note").html("Should NOT be higher than "+maximum_amount_of_subscribed_capital +" and should be at least "+minimum_amount_of_subscribed_capital);
        } else {
            $("#total_amount_of_subscribed_capital_note").html("Should be at least "+minimum_amount_of_subscribed_capital);
        }
        $("#total_no_of_subscribed_capital").val(no_of_subscribed_capital);
        $("#total_no_of_subscribed_capital").attr("min",minimum_no_of_subscribed_capital);
        if(par_value.length>0 && par_value>0) {
            $("#total_no_of_subscribed_capital_note").html("Should be at least "+minimum_no_of_subscribed_capital);
        }
            $("#total_no_of_subscribed_capital_note").removeClass("err-message-note-error");
        if(minimum_no_of_subscribed_capital>no_of_subscribed_capital) {
            $("#total_no_of_subscribed_capital_note").addClass("err-message-note-error");
        }

//        $("#total_amount_of_paid_up_capital").val(amount_of_paid_up_capital);
        $("#total_amount_of_paid_up_capital").attr("min",1000000);
        $("#total_amount_of_paid_up_capital_note").html("Should be at least "+1000000);
        $("#total_amount_of_paid_up_capital_note").removeClass("err-message-note-error");
        if(minimum_amount_of_paid_up_capital>amount_of_paid_up_capital) {
            $("#total_amount_of_paid_up_capital_note").addClass("err-message-note-error");
        }
        $("#total_no_of_paid_up_capital").val(no_of_paid_up_capital);
        $("#total_no_of_paid_up_capital").attr("min",minimum_no_of_paid_up_capital);
        if(par_value.length>0 && par_value>0) {
            $("#total_no_of_paid_up_capital_note").html("Should be at least "+minimum_no_of_paid_up_capital);
        }
        $("#total_no_of_paid_up_capital_note").removeClass("err-message-note-error");
        if(minimum_no_of_paid_up_capital>no_of_paid_up_capital) {
            $("#total_no_of_paid_up_capital_note").addClass("err-message-note-error");
        }

        
        if($("#par_value").val().length>0) {
//            console.log("xxx");
//            $("#common_share").val(common_share);
            $("#minimum_subscribed_share_regular").val(minimum_no_of_subscribed_share_regular);
            $("#minimum_paid_up_share_regular").val(minimum_no_of_paid_up_share_regular);
            $("#common_share").removeAttr("min");
            $("#common_share").removeAttr("max");
            $("#common_share_note").removeClass("err-message-note-error");
            if(minimum_common_share>common_share || common_share>maximum_common_share) {
                $("#common_share_note").addClass("err-message-note-error");
            }
            if(type_of_members=="associate") {
                $("#preferred_share").val(preferred_share);
                $("#minimum_subscribed_share_associate").val(minimum_no_of_subscribed_share_associate);
                $("#minimum_paid_up_share_associate").val(minimum_no_of_paid_up_share_associate);
                $("#preferred_share").removeAttr("min");
                $("#preferred_share").removeAttr("max");
                $("#preferred_share_note").removeClass("err-message-note-error");
                if(minimum_preferred_share>preferred_share || preferred_share>maximum_preferred_share) {
                    $("#preferred_share_note").addClass("err-message-note-error");
                }
                if(common_share>maximum_common_share) {
                    $("#common_share").attr("min",minimum_common_share);
                    $("#common_share").attr("max",maximum_common_share);
                    $("#common_share_note").html("Should NOT be higher than "+maximum_common_share +" and should be at least "+minimum_common_share);
                } else {
                    $("#common_share").attr("min",minimum_common_share);
                    $("#common_share").attr("max",maximum_common_share);
                    $("#common_share_note").html("Should be at least "+minimum_common_share);
                }
                    $("#preferred_share_note").html("Should be "+maximum_preferred_share);
//                if(preferred_share>maximum_preferred_share) {
//                    $("#preferred_share").attr("min",minimum_preferred_share);
//                    $("#preferred_share").attr("max",maximum_preferred_share);
//                    $("#preferred_share_note").html("Should NOT be higher than "+maximum_preferred_share +" and should be at least "+minimum_preferred_share);
//                } else {
//                    $("#preferred_share").attr("min",minimum_preferred_share);
//                    $("#preferred_share").attr("max",maximum_preferred_share);
//                    $("#preferred_share_note").html("Should be at least "+minimum_preferred_share);
//                }
            } else {
                $("#common_share").attr("min",minimum_common_share);
                $("#common_share").attr("max",maximum_common_share);
                $("#common_share_note").html("Should be "+maximum_common_share);
            }
        }

        $("#preferred_share").val(preferred_share);
        $("#minimum_share_associate").val(minimum_no_of_subscribed_share_associate);
        $("#minimum_paid_up_associate").val(minimum_no_of_paid_up_share_associate);

        console.log("type: "+type_of_members);
        console.log("authorized_share_capital: "+authorized_share_capital);
        console.log("par value: "+par_value);
        console.log("amount of subscribed: "+amount_of_subscribed_capital);
        console.log("miminum amount of subscribed: "+minimum_amount_of_subscribed_capital);
        console.log("no_of_subscribed_capital: "+minimum_amount_of_subscribed_capital);
        console.log("common_share: "+common_share);
        console.log("common_share_percentage: "+common_share_percentage);
        console.log("preferred_share_percentage: "+maximum_preferred_share_percentage);
    }
}
  
  });
</script>
