$(function(){
  $('#positionexists').hide();
  $(".add-affiliators").change(function(){
  var position = $('.add-affiliators').val();
  // position = CryptoJS.AES.encrypt(JSON.stringify(data), position);
  // alert(md5(position));
  // position = position.replace(/,/g, '_');

  var myStr = String(position);
  var newStr = myStr.replace(/,/g, '_');
  
// console.log( newStr );  // "this-is-a-test"
//   console.log(position);
    $.ajax({
        url : "affiliators/check_position_not_exist/" + newStr,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            console.log(data[1]);

            if(data[1]){
              $('#positionexists').show();
              $('#aAddAffiliatorsBtn').prop( "disabled", true );
            } else {
              $('#positionexists').hide();
              $('#aAddAffiliatorsBtn').prop( "disabled", false );
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          $('#positionexists').hide();
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

    $("#subscribed-note").hide().html('');
    $("#paid-note").hide().html('');
  $('#subscribedShares').on('change', function(){
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
  
  // $('#deleteCooperatorForm #membershipType').on('change', function(){
    
    // var tempType  = $.trim($(this).val());
    var available_subscribed_capital = $("#available_subscribed_capital").val().length>0 ? parseInt($("#available_subscribed_capital").val()) : '';
    var available_paid_up_capital = $("#available_paid_up_capital").val().length>0 ? $("#available_paid_up_capital").val() : ''; 
    // if(tempType.length > 0 && tempType=="Regular"){ 
        var minimum_subscribed_share_regular = $("#minimum_subscribed_share_regular").val().length>0 ? $("#minimum_subscribed_share_regular").val() : '';
        var minimum_paid_up_share_regular = $("#minimum_paid_up_share_regular").val().length>0 ? $("#minimum_paid_up_share_regular").val() : '';
      $('#deleteCooperatorForm #subscribedShares').prop('readonly',false);
      $('#deleteCooperatorForm #paidShares').prop('readonly',false);
//      $('#deleteCooperatorForm #subscribedShares').val(minimum_subscribed_share_regular);
//      $('#deleteCooperatorForm #paidShares').val(minimum_paid_up_share_regular);
      $('#deleteCooperatorForm #subscribedShares').attr('min',minimum_subscribed_share_regular);
      $('#deleteCooperatorForm #paidShares').attr('min',minimum_paid_up_share_regular);
      $('#deleteCooperatorForm #subscribedShares').attr({'class':'form-control validate[required,min[1],custom[integer],ajax[ajaxMinimumRegularSubscription2CallPhp]]'});
      $('#deleteCooperatorForm #paidShares').attr({'class':'form-control validate[required,min[1],custom[integer],funcCall[validateAddNumberOfPaidUpGreaterCustom],ajax[ajaxMinimumRegularPayCallPhp]]'});
      if(minimum_subscribed_share_regular > available_subscribed_capital) {
          $(".subscribedSharesformError").hide().html('');
          $("#subscribed-note").show().html('Should not exceed the remaining no of subscribed share: '+available_subscribed_capital);
      }
      if(minimum_paid_up_share_regular > available_paid_up_capital) {
         $(".paidSharesformError").hide().html();
          $("#paid-note").show().html('Should not exceed the remaining no of paid up share: '+available_paid_up_capital);
      }

      $('#deleteCooperatorForm #paidShares').on('change', function(){
        var val = parseInt($(this).val());
        var minimum_subscribed_share_regular = $("#minimum_subscribed_share_regular").val().length>0 ? $("#minimum_subscribed_share_regular").val() : '';
        var available_paid_up_capital = $("#available_paid_up_capital").val().length>0 ? $("#available_paid_up_capital").val() : ''; 
          $("#paid-note").hide().html('');
          if(val > minimum_subscribed_share_regular) {
            $('#deleteCooperatorForm #paidShares').attr('max',minimum_subscribed_share_regular);
             $(".paidSharesformError").hide().html();
              $("#paid-note").show().html('Should not exceed the no of subscribed shares: '+minimum_subscribed_share_regular);
          } else if(val > available_paid_up_capital) {
            $('#deleteCooperatorForm #paidShares').attr('max',available_paid_up_capital);
             $(".paidSharesformError").hide().html();
              $("#paid-note").show().html('Should not exceed the remaining no of paid up share: '+available_paid_up_capital);
          }
      });
//     }else if(tempType.length > 0 && tempType=="Associate"){
//         var minimum_subscribed_share_associate = $("#minimum_subscribed_share_associate").val().length>0 ? $("#minimum_subscribed_share_associate").val() : '';
//         var minimum_paid_up_share_associate = $("#minimum_paid_up_share_associate").val().length>0 ? $("#minimum_paid_up_share_associate").val() : '';
//       $('#deleteCooperatorForm #subscribedShares').prop('readonly',false);
//       $('#deleteCooperatorForm #paidShares').prop('readonly',false);
// //      $('#deleteCooperatorForm #subscribedShares').val(minimum_subscribed_share_associate);
// //      $('#deleteCooperatorForm #paidShares').val(minimum_paid_up_share_associate);
//       $('#deleteCooperatorForm #subscribedShares').attr('min',minimum_subscribed_share_associate);
//       $('#deleteCooperatorForm #paidShares').attr('min',minimum_paid_up_share_associate);
//       $('#deleteCooperatorForm #subscribedShares').attr({'class':'form-control validate[required,min[1],custom[integer],ajax[ajaxMinimumAssociateSubscriptionCallPhp]]'});
//       $('#deleteCooperatorForm #paidShares').attr({'class':'form-control validate[required,min[1],custom[integer],funcCall[validateAddNumberOfPaidUpGreaterCustom],ajax[ajaxMinimumAssociatePayCallPhp]]'});
//       if(minimum_subscribed_share_associate > available_subscribed_capital) {
//           $(".subscribedSharesformError").hide().html('');
//           $("#subscribed-note").show().html('Should not exceed the remaining no of subscribed share: '+available_subscribed_capital);
//       }
//       if(minimum_paid_up_share_associate > available_paid_up_capital) {
//          $(".paidSharesformError").hide().html();
//           $("#paid-note").show().html('Should not exceed the remaining no of paid up share: '+available_paid_up_capital);
//       }
//     }else{
//       $('#deleteCooperatorForm #subscribedShares').prop('readonly',true);
//       $('#deleteCooperatorForm #paidShares').prop('readonly',true);
//       $('#deleteCooperatorForm #subscribedShares').val('');
//       $('#deleteCooperatorForm #paidShares').val('');
//       $('#deleteCooperatorForm #subscribedShares').attr('min',1);
//       $('#deleteCooperatorForm #paidShares').attr('min',1);
//       $('#deleteCooperatorForm #subscribedShares').attr({'class':'form-control validate[required,min[1],custom[integer]]'});
//       $('#deleteCooperatorForm #paidShares').attr({'class':'form-control validate[required,min[1],custom[integer],funcCall[validateAddNumberOfPaidUpGreaterCustom]]'});
//     }
      
  // });

  $('#deleteCooperatorForm #region').on('change',function(){
    $('#deleteCooperatorForm #province').empty();
    $("#deleteCooperatorForm #province").prop("disabled",true);
    $('#deleteCooperatorForm #city').empty();
    $("#deleteCooperatorForm #city").prop("disabled",true);
    $('#deleteCooperatorForm #barangay').empty();
    $("#deleteCooperatorForm #barangay").prop("disabled",true);
    if($(this).val() && ($(this).val()).length > 0){
      $("#deleteCooperatorForm #province").prop("disabled",false);
      var region = $(this).val();
        $.ajax({
        type : "POST",
        url : $('body').attr('data-baseurl') + "api/provinces",
        dataType: "json",
        data : {
          region: region
        },
        success: function(data){
          $('#deleteCooperatorForm #province').append($('<option></option>').attr('value',"").text(""));
          $.each(data, function(key,value){
            $('#deleteCooperatorForm #province').append($('<option></option>').attr('value',value.provCode).text(value.provDesc));
          });
        }
      });
    }
  });

  $('#deleteCooperatorForm #province').on('change',function(){
    $('#deleteCooperatorForm #city').empty();
    $("#deleteCooperatorForm #city").prop("disabled",true);
    $('#deleteCooperatorForm #barangay').empty();
    $("#deleteCooperatorForm #barangay").prop("disabled",true);
    if($(this).val() && ($(this).val()).length > 0){
      $("#deleteCooperatorForm #city").prop("disabled",false);
      var province = $(this).val();
        $.ajax({
        type : "POST",
        url : $('body').attr('data-baseurl') + "api/cities",
        dataType: "json",
        data : {
          province: province
        },
        success: function(data){
          $('#deleteCooperatorForm #city').append($('<option></option>').attr('value',"").text(""));
          $.each(data, function(key,value){
            $('#deleteCooperatorForm #city').append($('<option></option>').attr('value',value.citymunCode).text(value.citymunDesc));
          });
        }
      });
    }
  });

  $('#deleteCooperatorForm #city').on('change',function(){
    $('#deleteCooperatorForm #barangay').empty();
    $("#deleteCooperatorForm #barangay").prop("disabled",true);
    if($(this).val() && ($(this).val()).length > 0){
      $("#deleteCooperatorForm #barangay").prop("disabled",false);
      var cities = $(this).val();
        $.ajax({
        type : "POST",
        url : $('body').attr('data-baseurl') + "api/barangays",
        dataType: "json",
        data : {
          cities: cities
        },
        success: function(data){
          $('#deleteCooperatorForm #barangay').append($('<option></option>').attr('value',"").text(""));
          $.each(data, function(key,value){
            $('#deleteCooperatorForm #barangay').append($('<option></option>').attr('value',value.brgyCode).text(value.brgyDesc));
          });
        }
      });
    }
  });
});

