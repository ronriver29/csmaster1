<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>laboratories_update/<?= $encrypted_id ?>/laboratories_cooperators_update" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">Edit Member/Cooperator</h5>
  </div>
</div>

<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
    <?php echo form_open('laboratories_update/'.$encrypted_id.'/laboratories_cooperators_update/'.$encrypted_cooperator_id.'/edit',array('id'=>'editCooperatorForm','name'=>'editCooperatorForm')); ?>
      <div class="card-body">
        <div class="row">
          <input type="hidden" class="form-control" name="coop_ids" id="coopids" value="<?=$encrypted_coop_id?>"/>
          <input type="hidden" class="form-control" id="cooperativesID" name="item[cooperatives_id]" value="<?= $encrypted_id?>">
          <?php if($is_client) : ?>
                    <input type="hidden" class="form-control validate[required]" id="userID" name="userID" value="<?= $encrypted_user_id ?>">
          <?php endif; ?>
          <input type="hidden" class="form-control" id="cooperatorID" name="item[id]" value="<?= $encrypted_cooperator_id?>">
         <!--  <input type="hidden" class="form-control" id="regCode" name="regCode" value="<?= $cooperator_info->rCode ?>">
          <input type="hidden" class="form-control" id="provCode" name="provCode" value="<?= $cooperator_info->pCode ?>">
          <input type="hidden" class="form-control" id="cityCode" name="cityCode" value="<?= $cooperator_info->cCode ?>">
          <input type="hidden" class="form-control" id="brgyCode" name="brgyCode" value="<?= $cooperator_info->bCode ?>"> -->

  

           <div class="col-sm-12 col-md-2">
            <div class="form-group">
              <label for="fName">First Name:</label>
              <input type="text" value="<?= $cooperator_info->full_name ?>"  class="form-control validate[required]" id="fName" name="item[full_name]">
            </div>
          </div>

           <div class="col-sm-12 col-md-2">
            <div class="form-group">
              <label for="fName">Middlename:</label>
              <input type="text" class="form-control" id="middle_name" name="item[middle_name]" value="<?= $cooperator_info->middle_name ?>">
            </div>
          </div>

           <div class="col-sm-12 col-md-2">
            <div class="form-group">
              <label for="fName">Lastname:</label>
              <input type="text" class="form-control" value="<?= $cooperator_info->last_name ?>" id="lant_name" name="item[last_name]">
            </div>
          </div>




          <div class="col-sm-12 col-md-2">
            <div class="form-group">
              <label for="gender">Gender:</label>
              <select class="custom-select validate[required]" name="item[gender]">
                <?php if($cooperator_info->gender == 'Male'): ?>
                <option value="Male" selected>Male</option>
                <?php else: ?>
                  <option value="Male">Male</option>
                <?php endif; ?>  

                <?php if($cooperator_info->gender =='Femake'): ?>
                <option value="Female" selected>Female</option>
              <?php else: ?>
                <option value="Female">Female</option>
              <?php endif;?>
              </select>
            </div>
      		</div>
        <div class="col-sm-12 col-md-2">
            <div class="form-group">
              <label for="gender">Age:</label>
              <input class="form-control validate[required,custom[integer],funcCall[validateLabAge]]" id="age_" name="item[age]" value="<?=$cooperator_info->age ?>">
            </div>
          </div> 
        
</div> <!-- end of rows -->
  <hr>
      <div class="row">
          <div class="col-sm-12 col-md-12 col-com" class="form-control">  
              <strong><label>Educational Background </label></strong>
              <br>
              <select id="edb" name="item[educational_bg]" class="form-control">
                <option value="college"<?=($cooperator_info->educational_bg=='college' ?'selected':'') ?>>College</option>
                <option value="seniorhigh"  <?=($cooperator_info->educational_bg=='seniorhigh' ?'selected':'') ?>>Senior High</option>
                <option value="juniorhigh"  <?=($cooperator_info->educational_bg=='juniorhigh' ?'selected':'') ?>>Junior High</option>
                <option value="gradeschool" <?=($cooperator_info->educational_bg=='gradeschool' ?'selected':'')?> >Grade School</option>
                <option value="outofschoolyouth"<?=($cooperator_info->educational_bg=='outofschoolyouth' ?'selected':'') ?>>Out of School Youth</option>
              </select>
          </div>
        </div>
 

    <br />
</div>
<hr>
<div class="rows">
          <div class="col-sm-12 col-md-12">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <strong>Address of the Cooperator</strong>
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="blkNo">House/Lot & Blk No.</label>
                  <input type="text" class="form-control" name="item[blkNo]" id="blkNo" placeholder="" value="<?= $cooperator_info->house_blk_no?>">
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="streetName">Street Name</label>
                  <input type="text" class="form-control" name="item[streetName]" id=""  value="<?php echo $cooperator_info->streetName?>">
                </div>
              </div>
            
            <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="region">Regions</label>
                  <select class="custom-select validate[required]" name="region" id="region">
                    <option value="" selected></option>
                    <?php foreach ($regions_list as $region_list) : ?>
                      <option value ="<?php echo $region_list['regCode'];?>" <?=($coop_info->rCode == $region_list['regCode'] ? 'selected' : '')?>><?php echo $region_list['regDesc']?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

                  <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="province">Province</label>
                  <select class="custom-select validate[required]" name="province" id="province" >
                    <?php 
                      foreach($list_of_provinces as $province_list)
                      {
                        ?>
                        <option value="<?=$province_list['provCode']?>" <?=($province_list['provCode']== $coop_info->pCode? 'selected' : '')?>><?=$province_list['provDesc']?></option>
                        <?php
                      }
                    ?>
                  </select>
                </div>
              </div>

            
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="city">City/Municipality</label>
                  <select class="custom-select validate[required]" name="city" id="city">
                    <?php
                    foreach($list_of_cities as $city_list)
                    {
                      ?>
                      <option value="<?=$city_list['citymunCode']?>" <?=($city_list['citymunCode'] == $coop_info->cCode ?'selected' :'')?>><?=$city_list['citymunDesc']?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
          
                <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="barangay">Barangay</label>
                  <select class="custom-select validate[required]" name="item[addrCode]" id="barangay">
                    <?php
                    foreach($list_of_brgys as $brgy_list)
                    {
                      ?>
                      <option value="<?=$brgy_list['brgyCode']?>" <?=($brgy_list['brgyCode'] == $coop_info->bCode ? 'selected' :'')?>> <?=($brgy_list['brgyDesc'])?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              
            </div>
          </div>


        </div>
      </div>
      <div class="card-footer editCooperatorFooter">
        <input class="btn btn-color-blue btn-block" type="submit" id="editCooperatorBtn" name="editCooperatorBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>

<!-- modify by jayson -->
<script src="<?=base_url();?>assets/js/jquery-3.7.1.min.js"></script>
<script type="text/javascript">
  $(function(){
  // if($('#termsAndConditionModal').length){
  //   $('#termsAndConditionModal').modal('show');
  // }

  var id = $("#editCooperatorForm #cooperatorID").val();
  var userid = $("#editCooperatorForm #userID").val();
  $.ajax({
    type : "POST",
    url : $('body').attr('data-baseurl') + "get_cooperative_info_edit",
    dataType: "json",
    data : {
      id: id,
      user_id: userid
    },
    success: function(data){
      if(data!=null){
        var tempCount = 0;
        // setTimeout( function(){
        //   $('#editCooperatorForm #region').val(data.regional_code);
        //   $('#editCooperatorForm #region').trigger('change');
        // },300);
        // setTimeout( function(){
        //     $('#editCooperatorForm #province').val(data.province_code);
        //     $('#editCooperatorForm #province').trigger('change');
        // },900);
        // setTimeout(function(){
        //   $('#editCooperatorForm #city').val(data.city_code);
        //   $('#editCooperatorForm #city').trigger('change');
        // },1500);
        // setTimeout(function(){
        //   $('#editCooperatorForm #barangay').val(data.brgy_code);
        // },2500);
        
        $('#editCooperatorForm #streetName').val(data.street);
        $('#editCooperatorForm #blkNo').val(data.house_blk_no);
       
        $('#editCooperatorForm #commonBondOfMembership').val(data.common_bond_of_membership);
        $('#editCooperatorForm #areaOfOperation').val(data.area_of_operation);
         
        // $("#reserveUpdateForm #proposedName").focus();
      }
    }
  });
// api autoload
 $('#editCooperatorForm #region').on('change',function(){
    $('#editCooperatorForm #province').empty();
    $("#editCooperatorForm #province").prop("disabled",true);
    $('#editCooperatorForm #city').empty();
    $("#editCooperatorForm #city").prop("disabled",true);
    $('#editCooperatorForm #barangay').empty();
    $("#editCooperatorForm #barangay").prop("disabled",true);
    if($(this).val() && ($(this).val()).length > 0){
      $("#editCooperatorForm #province").prop("disabled",false);
      var region = $(this).val();
        $.ajax({
        type : "POST",
        url : $('body').attr('data-baseurl') + "api/provinces",
        dataType: "json",
        data : {
          region: region
        },
        success: function(data){
          $('#editCooperatorForm #province').append($('<option></option>').attr('value',"").text(""));
          $.each(data, function(key,value){
            $('#editCooperatorForm #province').append($('<option></option>').attr('value',value.provCode).text(value.provDesc));
          });
        }
      });
    }
  });



  $('#editCooperatorForm #province').on('change',function(){
    $('#editCooperatorForm #city').empty();
    $("#editCooperatorForm #city").prop("disabled",true);
    $('#editCooperatorForm #barangay').empty();
    $("#editCooperatorForm #barangay").prop("disabled",true);
    if($(this).val() && ($(this).val()).length > 0){
      $("#editCooperatorForm #city").prop("disabled",false);
      var province = $(this).val();
        $.ajax({
        type : "POST",
        url : $('body').attr('data-baseurl') + "api/cities",
        dataType: "json",
        data : {
          province: province
        },
        success: function(data){
          $('#editCooperatorForm #city').append($('<option></option>').attr('value',"").text(""));
          $.each(data, function(key,value){
            $('#editCooperatorForm #city').append($('<option></option>').attr('value',value.citymunCode).text(value.citymunDesc));
          });
        }
      });
    }
  });

  $('#editCooperatorForm #city').on('change',function(){
    $('#editCooperatorForm #barangay').empty();
    $("#editCooperatorForm #barangay").prop("disabled",true);
    if($(this).val() && ($(this).val()).length > 0){
      $("#editCooperatorForm #barangay").prop("disabled",false);
      var cities = $(this).val();
        $.ajax({
        type : "POST",
        url : $('body').attr('data-baseurl') + "api/barangays",
        dataType: "json",
        data : {
          cities: cities
        },
        success: function(data){
          $('#editCooperatorForm #barangay').append($('<option></option>').attr('value',"").text(""));
          $.each(data, function(key,value){
            $('#editCooperatorForm #barangay').append($('<option></option>').attr('value',value.brgyCode).text(value.brgyDesc));
          });
        }
      });
    }
  });


  var id = $("#editCooperatorForm #cooperativesID").val();
  var userid = $("#editCooperatorForm #userID").val();
  var coop_ids = $("#editCooperatorForm #coopids").val();
  
  $.ajax({

    type : "POST",
    url : $('body').attr('data-baseurl') + "cooperative_info_details",
    dataType: "json",
    data : {
      id: id,
      user_id: userid,
      coop_ids:coop_ids
    },
    success: function(data){
     console.log(data.area_of_operation);
         if(data!=null){
        var tempCount = 0;
        // setTimeout(function(){
        //   // alert(data.region);
        //   // $('#addCooperatorForm #barangay').val(data.bCode);
        // setTimeout( function(){
        //   $('#addCooperatorForm #region').val(data.rCode);
        //   $('#addCooperatorForm #region').trigger('change');
        // },500);
        // setTimeout( function(){
        //     $('#addCooperatorForm #province').val(data.pCode);
        //     $('#addCooperatorForm #province').trigger('change');
        // },1000);
        // setTimeout(function(){
        //   $('#addCooperatorForm #city').val(data.cCode);
        //   $('#addCooperatorForm #city').trigger('change');
        // },1500);
        // setTimeout(function(){
        //   $('#addCooperatorForm #barangay').val(data.bCode);
        //   // $('#addCooperatorForm #barangay').trigger('change');
        // },2000);
          if(data.area_of_operation=='Barangay'){
            $('#editCooperatorForm #barangay').prop("disabled",true);
            $('#editCooperatorForm #city').prop("disabled",true);
            $('#editCooperatorForm #province').prop("disabled",true);
            $('#editCooperatorForm #region').prop("disabled",true);

          }else if(data.area_of_operation=='Municipality/City'){
            $('#editCooperatorForm #barangay').prop("disabled",false);
            $('#editCooperatorForm #city').prop("disabled",true);
            $('#editCooperatorForm #province').prop("disabled",true);
            $('#editCooperatorForm #region').prop("disabled",true);

          }else if(data.area_of_operation=='Provincial'){
            $('#editCooperatorForm #barangay').prop("disabled",false);
            $('#editCooperatorForm #city').prop("disabled",false);
            $('#editCooperatorForm #province').prop("disabled",true);
            $('#editCooperatorForm #region').prop("disabled",true);

          }else if(data.area_of_operation=='Regional'){
            $('#editCooperatorForm #barangay').prop("disabled",false);
            $('#editCooperatorForm #city').prop("disabled",false);
            $('#editCooperatorForm #province').prop("disabled",false);
            $('#editCooperatorForm #region').prop("disabled",true);

          }else if(data.area_of_operation=='National'){
            $('#editCooperatorForm #region').prop("disabled",false);
            $('#editCooperatorForm #province').prop("disabled",false);
            $('#editCooperatorForm #city').prop("disabled",false);
            $('#editCooperatorForm #barangay').prop("disabled",false);
          }else if(data.area_of_operation=='Interregional'){
            $('#editCooperatorForm #region').prop("disabled",false);
            $('#editCooperatorForm #province').prop("disabled",false);
            $('#editCooperatorForm #city').prop("disabled",false);
            $('#editCooperatorForm #barangay').prop("disabled",false);
          }
        // },2500);
      } //end if

      // if(data!=null){
      //   var tempCount = 0;
      //   setTimeout( function(){
      //     $('#addCooperatorForm #region').val(data.regional_code);
      //     $('#addCooperatorForm #region').trigger('change');
      //   },100);
      //   setTimeout( function(){
      //       $('#addCooperatorForm #province').val(data.province_code);
      //       $('#addCooperatorForm #province').trigger('change');
      //   },500);
      //   setTimeout(function(){
      //     $('#addCooperatorForm #city').val(data.city_code);
      //     $('#addCooperatorForm #city').trigger('change');
      //   },1000);
      //   setTimeout(function(){
      //     $('#addCooperatorForm #barangay').val(data.brgy_code);
      //     if(data.area_of_operation=='Barangay'){
          
      //       $('#addCooperatorForm #barangay').prop("disabled",true);
      //       $('#addCooperatorForm #city').prop("disabled",true);
      //       $('#addCooperatorForm #province').prop("disabled",true);
      //       $('#addCooperatorForm #region').prop("disabled",true);
      //     }else if(data.area_of_operation=='Municipality/City'){
            
      //       $('#addCooperatorForm #city').prop("disabled",true);
      //       $('#addCooperatorForm #province').prop("disabled",true);
      //       $('#addCooperatorForm #region').prop("disabled",true);
      //     }else if(data.area_of_operation=='Provincial'){
            
      //       $('#addCooperatorForm #province').prop("disabled",true);
      //       $('#addCooperatorForm #region').prop("disabled",true);
      //     }else if(data.area_of_operation=='Regional'){
            
      //       $('#addCooperatorForm #region').prop("disabled",true);
      //     }
      //   },1700); 
      // } //end if
    }//end of success
  });//end of ajax
 
}); //end fo function 


</script>