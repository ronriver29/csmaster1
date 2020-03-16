$(function(){
    $("#subscribed-note").hide().html('');
    $("#paid-note").hide().html('');
  $('#addCooperatorForm #amd_subscribedShares').on('change', function(){
      var val = parseInt($(this).val());
      var available_subscribed_capital = $("#available_subscribed_capital").val().length>0 ? parseInt($("#available_subscribed_capital").val()) : '';
      $("#subscribed-note").hide().html('');
      if(val > available_subscribed_capital) {
          $(".subscribedSharesformError").hide().html('');
          $("#subscribed-note").show().html('Should not exceed the remaining no of subscribed share: '+available_subscribed_capital);
      }
      console.log(val);
      console.log(available_subscribed_capital);
  });
  $('#addCooperatorForm #amd_paidShares').on('change', function(){
      var val = parseInt($(this).val());
        var available_paid_up_capital = $("#available_paid_up_capital").val().length>0 ? $("#available_paid_up_capital").val() : ''; 
      $("#paid-note").hide().html('');
      if(val > available_paid_up_capital) {
         $(".paidSharesformError").hide().html();
          $("#paid-note").show().html('Should not exceed the remaining no of paid up share: '+available_paid_up_capital);
      }
  });
  $('#addCooperatorForm #membershipType').on('change', function(){

    var tempType  = $.trim($(this).val());
    var available_subscribed_capital = $("#available_subscribed_capital").val().length>0 ? parseInt($("#available_subscribed_capital").val()) : '';
    var available_paid_up_capital = $("#available_paid_up_capital").val().length>0 ? $("#available_paid_up_capital").val() : ''; 
    if(tempType.length > 0 && tempType=="Regular"){
        var minimum_subscribed_share_regular = $("#minimum_subscribed_share_regular").val().length>0 ? $("#minimum_subscribed_share_regular").val() : '';
        var minimum_paid_up_share_regular = $("#minimum_paid_up_share_regular").val().length>0 ? $("#minimum_paid_up_share_regular").val() : '';
      $('#addCooperatorForm #amd_subscribedShares').prop('readonly',false);
      $('#addCooperatorForm #amd_paidShares').prop('readonly',false);
//      $('#addCooperatorForm #subscribedShares').val(minimum_subscribed_share_regular);
//      $('#addCooperatorForm #paidShares').val(minimum_paid_up_share_regular);
      $('#addCooperatorForm #amd_subscribedShares').attr('min',minimum_subscribed_share_regular);
      $('#addCooperatorForm #amd_paidShares').attr('min',minimum_paid_up_share_regular);
      $('#addCooperatorForm #amd_subscribedShares').attr({'class':'form-control validate[required,min[1],custom[integer],ajax[ajaxMinimumRegularSubscriptionAmendmentCallPhp]]'});
      $('#addCooperatorForm #amd_paidShares').attr({'class':'form-control validate[required,min[1],custom[integer],funcCall[validateAddNumberOfPaidUpGreaterCustom]]'});
      if(minimum_subscribed_share_regular > available_subscribed_capital) {
          $(".subscribedSharesformError").hide().html('');
          $("#subscribed-note").show().html('Should not exceed the remaining no of subscribed share: '+available_subscribed_capital);
      }
      if(minimum_paid_up_share_regular > available_paid_up_capital) {
         $(".paidSharesformError").hide().html();
          $("#paid-note").show().html('Should not exceed the remaining no of paid up share: '+available_paid_up_capital);
      }
      
    }else if(tempType.length > 0 && tempType=="Associate"){
        var minimum_subscribed_share_associate = $("#minimum_subscribed_share_associate").val().length>0 ? $("#minimum_subscribed_share_associate").val() : '';
        var minimum_paid_up_share_associate = $("#minimum_paid_up_share_associate").val().length>0 ? $("#minimum_paid_up_share_associate").val() : '';
      $('#addCooperatorForm #amd_subscribedShares').prop('readonly',false);
      $('#addCooperatorForm #amd_paidShares').prop('readonly',false);
//      $('#addCooperatorForm #subscribedShares').val(minimum_subscribed_share_associate);
//      $('#addCooperatorForm #paidShares').val(minimum_paid_up_share_associate);
      $('#addCooperatorForm #amd_subscribedShares').attr('min',minimum_subscribed_share_associate);
      $('#addCooperatorForm #amd_paidShares').attr('min',minimum_paid_up_share_associate);
      $('#addCooperatorForm #amd_subscribedShares').attr({'class':'form-control validate[required,min[1],custom[integer],ajax[ajaxMinimumRegularSubscriptionAmendmentCallPhp]]'});
      $('#addCooperatorForm #amd_paidShares').attr({'class':'form-control validate[required,min[1],custom[integer],funcCall[validateAddNumberOfPaidUpGreaterCustom],ajax[ajaxMinimumAssociatePayCallPhp]]'});
      if(minimum_subscribed_share_associate > available_subscribed_capital) {
          $(".subscribedSharesformError").hide().html('');
          $("#subscribed-note").show().html('Should not exceed the remaining no of subscribed share: '+available_subscribed_capital);
      }
      if(minimum_paid_up_share_associate > available_paid_up_capital) {
         $(".paidSharesformError").hide().html();
          $("#paid-note").show().html('Should not exceed the remaining no of paid up share: '+available_paid_up_capital);
      }
    }else{
      $('#addCooperatorForm #amd_subscribedShares').prop('readonly',true);
      $('#addCooperatorForm #amd_paidShares').prop('readonly',true);
      $('#addCooperatorForm #amd_subscribedShares').val('');
      $('#addCooperatorForm #amd_paidShares').val('');
      $('#addCooperatorForm #amd_subscribedShares').attr('min',1);
      $('#addCooperatorForm #amd_paidShares').attr('min',1);
      $('#addCooperatorForm #amd_subscribedShares').attr({'class':'form-control validate[required,min[1],custom[integer]]'});
      $('#addCooperatorForm #amd_paidShares').attr({'class':'form-control validate[required,min[1],custom[integer],funcCall[validateAddNumberOfPaidUpGreaterCustom]]'});
    }
      
  });

  $('#addCooperatorForm #region').on('change',function(){
    $('#addCooperatorForm #province').empty();
    $("#addCooperatorForm #province").prop("disabled",true);
    $('#addCooperatorForm #city').empty();
    $("#addCooperatorForm #city").prop("disabled",true);
    $('#addCooperatorForm #barangay').empty();
    $("#addCooperatorForm #barangay").prop("disabled",true);
    if($(this).val() && ($(this).val()).length > 0){
      $("#addCooperatorForm #province").prop("disabled",false);
      var region = $(this).val();
        $.ajax({
        type : "POST",
        url  : "../api/provinces",
        dataType: "json",
        data : {
          region: region
        },
        success: function(data){
          $('#addCooperatorForm #province').append($('<option></option>').attr('value',"").text(""));
          $.each(data, function(key,value){
            $('#addCooperatorForm #province').append($('<option></option>').attr('value',value.provCode).text(value.provDesc));
          });
        }
      });
    }
  });

  $('#addCooperatorForm #province').on('change',function(){
    $('#addCooperatorForm #city').empty();
    $("#addCooperatorForm #city").prop("disabled",true);
    $('#addCooperatorForm #barangay').empty();
    $("#addCooperatorForm #barangay").prop("disabled",true);
    if($(this).val() && ($(this).val()).length > 0){
      $("#addCooperatorForm #city").prop("disabled",false);
      var province = $(this).val();
        $.ajax({
        type : "POST",
        url  : "../api/cities",
        dataType: "json",
        data : {
          province: province
        },
        success: function(data){
          $('#addCooperatorForm #city').append($('<option></option>').attr('value',"").text(""));
          $.each(data, function(key,value){
            $('#addCooperatorForm #city').append($('<option></option>').attr('value',value.citymunCode).text(value.citymunDesc));
          });
        }
      });
    }
  });

  $('#addCooperatorForm #city').on('change',function(){
    $('#addCooperatorForm #barangay').empty();
    $("#addCooperatorForm #barangay").prop("disabled",true);
    if($(this).val() && ($(this).val()).length > 0){
      $("#addCooperatorForm #barangay").prop("disabled",false);
      var cities = $(this).val();
        $.ajax({
        type : "POST",
        url  : "../api/barangays",
        dataType: "json",
        data : {
          cities: cities
        },
        success: function(data){
          $('#addCooperatorForm #barangay').append($('<option></option>').attr('value',"").text(""));
          $.each(data, function(key,value){
            $('#addCooperatorForm #barangay').append($('<option></option>').attr('value',value.brgyCode).text(value.brgyDesc));
          });
        }
      });
    }
  });

  var id = $("#addCooperatorForm #amd_id").val();
  var userid = $("#addCooperatorForm #userID").val();
  var coop_ids = $("#addCooperatorForm #coopids").val();
  // alert(id);
  $.ajax({

    type : "POST",
    // url  : "./cooperative_info_details",
    url  : "./get_cooperative_info",
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
        setTimeout( function(){
          $('#addCooperatorForm #region').val(data.rCode);
          $('#addCooperatorForm #region').trigger('change');
        },300);
        setTimeout( function(){
            $('#addCooperatorForm #province').val(data.pCode);
            $('#addCooperatorForm #province').trigger('change');
        },1000);
        setTimeout(function(){
          $('#addCooperatorForm #city').val(data.cCode);
          $('#addCooperatorForm #city').trigger('change');
        },2000);
        setTimeout(function(){
          $('#addCooperatorForm #barangay').val(data.bCode);
          if(data.area_of_operation=='Barangay'){
          
            $('#addCooperatorForm #barangay').prop("disabled",true);
            $('#addCooperatorForm #city').prop("disabled",true);
            $('#addCooperatorForm #province').prop("disabled",true);
            $('#addCooperatorForm #region').prop("disabled",true);
          }else if(data.area_of_operation=='Municipality/City'){
            
            $('#addCooperatorForm #city').prop("disabled",true);
            $('#addCooperatorForm #province').prop("disabled",true);
            $('#addCooperatorForm #region').prop("disabled",true);
          }else if(data.area_of_operation=='Provincial'){
            
            $('#addCooperatorForm #province').prop("disabled",true);
            $('#addCooperatorForm #region').prop("disabled",true);
          }else if(data.area_of_operation=='Regional'){
            
            $('#addCooperatorForm #region').prop("disabled",true);
          }else if(data.area_of_operation=='National'){
            
            $('#addCooperatorForm #region').prop("disabled",false);
          }

        },3500); 
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
});
