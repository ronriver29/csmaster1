$(function(){
     $("#subscribed-note").hide().html('');
    $("#paid-note").hide().html('');
    $('#editCooperatorForm #subscribedShares').on('change', function(){
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
  $('#editCooperatorForm #paidShares').on('change', function(){
      var val = parseInt($(this).val());
        var available_paid_up_capital = $("#available_paid_up_capital").val().length>0 ? $("#available_paid_up_capital").val() : ''; 
      $("#paid-note").hide().html('');
      if(val > available_paid_up_capital) {
         $(".paidSharesformError").hide().html();
          $("#paid-note").show().html('Should not exceed the remaining no of paid up share: '+available_paid_up_capital);
      }
  });
  $('#editCooperatorForm #membershipType').on('change', function(){
    var tempType  = $.trim($(this).val());
    var available_subscribed_capital = $("#available_subscribed_capital").val().length>0 ? parseInt($("#available_subscribed_capital").val()) : '';
    var available_paid_up_capital = $("#available_paid_up_capital").val().length>0 ? parseInt($("#available_paid_up_capital").val()) : '';    
    var subscribed = $('#editCooperatorForm #subscribedShares').val().length>0 ? parseInt($('#editCooperatorForm #subscribedShares').val()) : 0;
    var paid = $('#editCooperatorForm #paidShares').val().length>0 ? parseInt($('#editCooperatorForm #paidShares').val()) : 0;
    if(tempType.length > 0 && tempType=="Regular"){
      $('#editCooperatorForm #subscribedShares').prop('readonly',false);
      $('#editCooperatorForm #paidShares').prop('readonly',false);
      $('#editCooperatorForm #subscribedShares').attr({'class':'form-control validate[required,min[1],custom[integer],ajax[ajaxMinimumRegularSubscriptionEditCallPhp]]'});
      $('#editCooperatorForm #paidShares').attr({'class':'form-control validate[required,min[1],custom[integer],funcCall[validateEditNumberOfPaidUpGreaterCustom],ajax[ajaxMinimumRegularPayEditCallPhp]]'});
      var minimum_subscribed_share_regular = $("#minimum_subscribed_share_regular").val().length>0 ? $("#minimum_subscribed_share_regular").val() : '';
      var minimum_paid_up_share_regular = $("#minimum_paid_up_share_regular").val().length>0 ? $("#minimum_paid_up_share_regular").val() : '';
      $('#editCooperatorForm #subscribedShares').attr('min',minimum_subscribed_share_regular);
      $('#editCooperatorForm #paidShares').attr('min',minimum_paid_up_share_regular);
      if(subscribed > available_subscribed_capital) {
          $(".subscribedSharesformError").hide().html('');
          $("#subscribed-note").show().html('Should not exceed the remaining no of subscribed share: '+available_subscribed_capital);
      }
      if(paid > available_paid_up_capital) {
         $(".paidSharesformError").hide().html();
          $("#paid-note").show().html('Should not exceed the remaining no of paid up share: '+available_paid_up_capital);
      }
    }else if(tempType.length > 0 && tempType=="Associate"){
      $('#editCooperatorForm #subscribedShares').prop('readonly',false);
      $('#editCooperatorForm #paidShares').prop('readonly',false);
      $('#editCooperatorForm #subscribedShares').attr({'class':'form-control validate[required,min[1],custom[integer],ajax[ajaxMinimumAssociateSubscriptionEditCallPhp]]'});
      $('#editCooperatorForm #paidShares').attr({'class':'form-control validate[required,min[1],custom[integer],funcCall[validateEditNumberOfPaidUpGreaterCustom],ajax[ajaxMinimumAssociatePayEditCallPhp]]'});
      var minimum_subscribed_share_associate = $("#minimum_subscribed_share_associate").val().length>0 ? $("#minimum_subscribed_share_associate").val() : '';
      var minimum_paid_up_share_associate = $("#minimum_paid_up_share_associate").val().length>0 ? $("#minimum_paid_up_share_associate").val() : '';
      $('#editCooperatorForm #subscribedShares').attr('min',minimum_subscribed_share_associate);
      $('#editCooperatorForm #paidShares').attr('min',minimum_paid_up_share_associate);
      if(subscribed > available_subscribed_capital) {
          $(".subscribedSharesformError").hide().html('');
          $("#subscribed-note").show().html('Should not exceed the remaining no of subscribed share: '+available_subscribed_capital);
      }
      if(paid > available_paid_up_capital) {
         $(".paidSharesformError").hide().html();
          $("#paid-note").show().html('Should not exceed the remaining no of paid up share: '+available_paid_up_capital);
      }
    }else{
      $('#editCooperatorForm #subscribedShares').prop('readonly',true);
      $('#editCooperatorForm #paidShares').prop('readonly',true);
      $('#editCooperatorForm #subscribedShares').attr({'class':'form-control validate[required,min[1],custom[integer]]'});
      $('#editCooperatorForm #paidShares').attr({'class':'form-control validate[required,min[1],custom[integer],funcCall[validateEditNumberOfPaidUpGreaterCustom]]'});
    }
    console.log('subscribed: '+subscribed);
    console.log('available_subscribed_capital: '+available_subscribed_capital);
    console.log('paid: '+paid);
    console.log('available_paid_up_capital: '+available_paid_up_capital);
  });

  $('#editCooperatorForm #membershipType').change();
  $('#editCooperatorForm #region').change();
  $('#editCooperatorForm #subscribedShares').blur();
  $('#editCooperatorForm #paidShares').blur();
  $('#editCooperatorForm #validIdType').on('change',function(){
    if($(this).val() && ($(this).val()).length > 0){
      $('#editCooperatorForm #validIdNo').prop('disabled',false);
    }else{
      $('#editCooperatorForm #validIdNo').prop('disabled',true);
    }
  });
  var w=$('#editCooperatorForm #regCode').val();
  setTimeout( function(){
    $('#editCooperatorForm #region').val(w);
    $('#editCooperatorForm #region').trigger('change');
  },300);
  var x=$('#editCooperatorForm #provCode').val();
  setTimeout( function(){
    $('#editCooperatorForm #province').val(x);
    $('#editCooperatorForm #province').trigger('change');
  },1000);
  var y=$('#editCooperatorForm #cityCode').val();
  setTimeout( function(){
    $('#editCooperatorForm #city').val(y);
    $('#editCooperatorForm #city').trigger('change');
  },2000);
  var z=$('#editCooperatorForm #brgyCode').val();
  setTimeout( function(){
    $('#editCooperatorForm #barangay').val(z);
    $('#editCooperatorForm #barangay').trigger('change');
  },3000);

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
        url  : "../api/provinces",
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
        url  : "../api/cities",
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
        url  : "../api/barangays",
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


});
