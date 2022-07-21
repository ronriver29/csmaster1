$(function(){
  $('#editpositionexists').hide();
  $(".edit-affiliators").change(function(){
  var position = $('.edit-affiliators').val();
  var cooperatorid = $('#cooperatorID').val();
  // position = CryptoJS.AES.encrypt(JSON.stringify(data), position);
  // alert(cooperatorid);
  // position = position.replace(/,/g, '_');

  var myStr = String(position);
  var newStr = myStr.replace(/,/g, '_');
  
// console.log( newStr );  // "this-is-a-test"
//   console.log(position);
    $.ajax({
        url : "affiliators/check_edit_position_not_exist/" + newStr + "/" + cooperatorid,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            console.log(data[1]);

            if(data[1]){
              $('#editpositionexists').show();
              $('#aAddAffiliatorsBtn').prop( "disabled", true );
            } else {
              $('#editpositionexists').hide();
              $('#aAddAffiliatorsBtn').prop( "disabled", false );
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          $('#editpositionexists').hide();
          $('#aAddAffiliatorsBtn').prop( "disabled", false );
          console.log('Error get data from ajax!');
        }
    });
  });

  $(".select-island").each(function(){
        $(this).select2({
            template: "bootstrap",
            multiple: true,
            tagging: true,
            allowClear: true,
            placeholder: "Select Position"
        });
    });
  
    $("#subscribed-note2").hide().html('');
    $("#paid-note2").hide().html('');
  $('#subscribedShares2').on('ready', function(){
      var val = parseInt($(this).val());
      var available_subscribed_capital2 = $("#available_subscribed_capital2").val().length>0 ? parseInt($("#available_subscribed_capital2").val()) : '';
      var str = $('#maxvalue_asc').val();
      var str2 = $('#maxvalue').val();
      $("#subscribed-note2").hide().html('');
      if(str == 0){
        if(val > str2) {
            $(".subscribedSharesformError2").hide().html('');
            $("#subscribed-note2").show().html('Should not exceed the remaining no of subscribed share: '+str2);
        }
      } else {
        if(val > available_subscribed_capital2) {
            $(".subscribedSharesformError2").hide().html('');
            $("#subscribed-note2").show().html('Should not exceed the remaining no of subscribed share: '+available_subscribed_capital2);
        }
      }

      // console.log(val);
      // console.log(available_subscribed_capital2);
      // console.log(str);
      // console.log(str2);
      $('#editAffiliatorForm #subscribedShares2').attr({'class':'form-control validate[required,min[1],max['+str2+'],custom[integer],funcCall[validateAddNumberOfSubsribedGreaterCustom],ajax[ajaxMinimumRegularSubscriptionCallPhp]]'});
  });
  $('#editAffiliatorForm #paidShares2').on('change', function(){
      var val = parseInt($(this).val());
        var available_paid_up_capital2 = $("#available_paid_up_capital2").val().length>0 ? $("#available_paid_up_capital2").val() : ''; 
        var str3 = $('#maxvalue_apuc').val();
        var str4 = $('#maxvalue2').val();
      $("#paid-note2").hide().html('');
      if(str3 == 0){
        if(val > str3) {
            $(".paidSharesformError2").hide().html();
            $("#paid-note2").show().html('Should not exceed the remaining no of paid up share: '+str3);
        } else {
        if(val > available_paid_up_capital2) {
            $(".paidSharesformError2").hide().html();
            $("#paid-note2").show().html('Should not exceed the remaining no of paid up share: '+available_paid_up_capital2);
          }
        }
        $('#editAffiliatorForm #paidShares2').attr({'class':'form-control validate[required,min[1],max['+str4+'],custom[integer],funcCall[validateAddNumberOfPaidUpGreaterCustom],ajax[ajaxMinimumRegularPayCallPhp]]'});
      }
      console.log(str3);
  });
  // $('#editAffiliatorForm #membershipType').on('change', function(){
    
    // var tempType  = $.trim($(this).val());
    var available_subscribed_capital2 = $("#available_subscribed_capital2").val().length >0 ? parseInt($("#available_subscribed_capital2").val()) : '';
    var available_paid_up_capital2 = $("#available_paid_up_capital2").val().length>0 ? $("#available_paid_up_capital2").val() : ''; 

    // console.log(available_subscribed_capital2);
    // if(tempType.length > 0 && tempType=="Regular"){ 
        var minimum_subscribed_share_regular2 = $("#minimum_subscribed_share_regular2").val().length>0 ? $("#minimum_subscribed_share_regular2").val() : '';
        var minimum_paid_up_share_regular2 = $("#minimum_paid_up_share_regular2").val().length>0 ? $("#minimum_paid_up_share_regular2").val() : '';
      $('#editAffiliatorForm #subscribedShares2').prop('readonly',false);
      $('#editAffiliatorForm #paidShares2').prop('readonly',false);
//      $('#editAffiliatorForm #subscribedShares').val(minimum_subscribed_share_regular2);
//      $('#editAffiliatorForm #paidShares').val(minimum_paid_up_share_regular2);
      // $('#editAffiliatorForm #subscribedShares2').attr('min',minimum_subscribed_share_regular2);
      $('#editAffiliatorForm #paidShares2').attr('min',minimum_paid_up_share_regular2);
      // $('#editAffiliatorForm #subscribedShares2').attr({'class':'form-control validate[required,min[1],custom[integer],ajax[ajaxMinimumRegularSubscription2CallPhp]]'});
      // $('#editAffiliatorForm #paidShares2').attr({'class':'form-control validate[required,min[1],custom[integer],funcCall[validateAddNumberOfPaidUpGreaterCustom],ajax[ajaxMinimumRegularPayCallPhp]]'});
       $('#editAffiliatorForm #subscribedShares2').attr({'class':'form-control validate[required,min[1],custom[integer]]'});
      $('#editAffiliatorForm #paidShares2').attr({'class':'form-control validate[required,min[1],custom[integer]]'});
      if(minimum_subscribed_share_regular2 > available_subscribed_capital2) {
          $(".subscribedSharesformError2").hide().html('');
          $("#subscribed-note2").show().html('Should not exceed the remaining no of subscribed share: '+available_subscribed_capital2);
      }
      if(minimum_paid_up_share_regular2 > available_paid_up_capital2) {
         $(".paidSharesformError2").hide().html();
          $("#paid-note2").show().html('Should not exceed the remaining no of paid up share: '+available_paid_up_capital2);
      }
      
//     }else if(tempType.length > 0 && tempType=="Associate"){
//         var minimum_subscribed_share_associate = $("#minimum_subscribed_share_associate").val().length>0 ? $("#minimum_subscribed_share_associate").val() : '';
//         var minimum_paid_up_share_associate = $("#minimum_paid_up_share_associate").val().length>0 ? $("#minimum_paid_up_share_associate").val() : '';
//       $('#editAffiliatorForm #subscribedShares').prop('readonly',false);
//       $('#editAffiliatorForm #paidShares').prop('readonly',false);
// //      $('#editAffiliatorForm #subscribedShares').val(minimum_subscribed_share_associate);
// //      $('#editAffiliatorForm #paidShares').val(minimum_paid_up_share_associate);
//       $('#editAffiliatorForm #subscribedShares').attr('min',minimum_subscribed_share_associate);
//       $('#editAffiliatorForm #paidShares').attr('min',minimum_paid_up_share_associate);
//       $('#editAffiliatorForm #subscribedShares').attr({'class':'form-control validate[required,min[1],custom[integer],ajax[ajaxMinimumAssociateSubscriptionCallPhp]]'});
//       $('#editAffiliatorForm #paidShares').attr({'class':'form-control validate[required,min[1],custom[integer],funcCall[validateAddNumberOfPaidUpGreaterCustom],ajax[ajaxMinimumAssociatePayCallPhp]]'});
//       if(minimum_subscribed_share_associate > available_subscribed_capital2) {
//           $(".subscribedSharesformError").hide().html('');
//           $("#subscribed-note").show().html('Should not exceed the remaining no of subscribed share: '+available_subscribed_capital2);
//       }
//       if(minimum_paid_up_share_associate > available_paid_up_capital2) {
//          $(".paidSharesformError").hide().html();
//           $("#paid-note").show().html('Should not exceed the remaining no of paid up share: '+available_paid_up_capital2);
//       }
//     }else{
//       $('#editAffiliatorForm #subscribedShares').prop('readonly',true);
//       $('#editAffiliatorForm #paidShares').prop('readonly',true);
//       $('#editAffiliatorForm #subscribedShares').val('');
//       $('#editAffiliatorForm #paidShares').val('');
//       $('#editAffiliatorForm #subscribedShares').attr('min',1);
//       $('#editAffiliatorForm #paidShares').attr('min',1);
//       $('#editAffiliatorForm #subscribedShares').attr({'class':'form-control validate[required,min[1],custom[integer]]'});
//       $('#editAffiliatorForm #paidShares').attr({'class':'form-control validate[required,min[1],custom[integer],funcCall[validateAddNumberOfPaidUpGreaterCustom]]'});
//     }
      
  // });

  $('#editAffiliatorForm #region').on('change',function(){
    $('#editAffiliatorForm #province').empty();
    $("#editAffiliatorForm #province").prop("disabled",true);
    $('#editAffiliatorForm #city').empty();
    $("#editAffiliatorForm #city").prop("disabled",true);
    $('#editAffiliatorForm #barangay').empty();
    $("#editAffiliatorForm #barangay").prop("disabled",true);
    if($(this).val() && ($(this).val()).length > 0){
      $("#editAffiliatorForm #province").prop("disabled",false);
      var region = $(this).val();
        $.ajax({
        type : "POST",
        url  : "../api/provinces",
        dataType: "json",
        data : {
          region: region
        },
        success: function(data){
          $('#editAffiliatorForm #province').append($('<option></option>').attr('value',"").text(""));
          $.each(data, function(key,value){
            $('#editAffiliatorForm #province').append($('<option></option>').attr('value',value.provCode).text(value.provDesc));
          });
        }
      });
    }
  });

  $('#editAffiliatorForm #province').on('change',function(){
    $('#editAffiliatorForm #city').empty();
    $("#editAffiliatorForm #city").prop("disabled",true);
    $('#editAffiliatorForm #barangay').empty();
    $("#editAffiliatorForm #barangay").prop("disabled",true);
    if($(this).val() && ($(this).val()).length > 0){
      $("#editAffiliatorForm #city").prop("disabled",false);
      var province = $(this).val();
        $.ajax({
        type : "POST",
        url  : "../api/cities",
        dataType: "json",
        data : {
          province: province
        },
        success: function(data){
          $('#editAffiliatorForm #city').append($('<option></option>').attr('value',"").text(""));
          $.each(data, function(key,value){
            $('#editAffiliatorForm #city').append($('<option></option>').attr('value',value.citymunCode).text(value.citymunDesc));
          });
        }
      });
    }
  });

  $('#editAffiliatorForm #city').on('change',function(){
    $('#editAffiliatorForm #barangay').empty();
    $("#editAffiliatorForm #barangay").prop("disabled",true);
    if($(this).val() && ($(this).val()).length > 0){
      $("#editAffiliatorForm #barangay").prop("disabled",false);
      var cities = $(this).val();
        $.ajax({
        type : "POST",
        url  : "../api/barangays",
        dataType: "json",
        data : {
          cities: cities
        },
        success: function(data){
          $('#editAffiliatorForm #barangay').append($('<option></option>').attr('value',"").text(""));
          $.each(data, function(key,value){
            $('#editAffiliatorForm #barangay').append($('<option></option>').attr('value',value.brgyCode).text(value.brgyDesc));
          });
        }
      });
    }
  });
});
