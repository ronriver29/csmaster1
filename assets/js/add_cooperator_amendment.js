$(function(){
    $("#subscribed-note").hide().html('');
    $("#paid-note").hide().html('');
  $('#addCooperatorFormAmendment #amd_subscribedShares').on('change', function(){
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
  $('#addCooperatorFormAmendment #amd_paidShares').on('change', function(){
      var val = parseInt($(this).val());
        var available_paid_up_capital = $("#available_paid_up_capital").val().length>0 ? $("#available_paid_up_capital").val() : ''; 
      $("#paid-note").hide().html('');
      if(val > available_paid_up_capital) {
         $(".paidSharesformError").hide().html();
          $("#paid-note").show().html('Should not exceed the remaining no of paid up share: '+available_paid_up_capital);
      }
  });
  $('#addCooperatorFormAmendment #membershipType').on('change', function(){

    var tempType  = $.trim($(this).val());
    var available_subscribed_capital = $("#available_subscribed_capital").val().length>0 ? parseInt($("#available_subscribed_capital").val()) : '';
    var available_paid_up_capital = $("#available_paid_up_capital").val().length>0 ? $("#available_paid_up_capital").val() : ''; 
    if(tempType.length > 0 && tempType=="Regular"){
        var minimum_subscribed_share_regular = $("#minimum_subscribed_share_regular").val().length>0 ? $("#minimum_subscribed_share_regular").val() : '';
        // alert(minimum_subscribed_share_regular);
        // alert(available_subscribed_capital);
        var minimum_paid_up_share_regular = $("#minimum_paid_up_share_regular").val().length>0 ? $("#minimum_paid_up_share_regular").val() : '';
      $('#addCooperatorFormAmendment #amd_subscribedShares').prop('readonly',false);
      $('#addCooperatorFormAmendment #amd_paidShares').prop('readonly',false);
//      $('#addCooperatorFormAmendment #subscribedShares').val(minimum_subscribed_share_regular);
//      $('#addCooperatorFormAmendment #paidShares').val(minimum_paid_up_share_regular);
      $('#addCooperatorFormAmendment #amd_subscribedShares').attr('min',minimum_subscribed_share_regular);
      $('#addCooperatorFormAmendment #amd_paidShares').attr('min',minimum_paid_up_share_regular);
      $('#addCooperatorFormAmendment #amd_subscribedShares').attr({'class':'form-control validate[required,min[1],custom[integer],ajax[ajaxMinimumRegularSubscriptionAmendmentCallPhp]]'});
      $('#addCooperatorFormAmendment #amd_paidShares').attr({'class':'form-control validate[required,min[1],custom[integer],funcCall[validateAddNumberOfPaidUpGreaterCustom],,ajax[ajaxMinimumRegularPayCallPhpAmendment]]'});

      if(minimum_subscribed_share_regular > available_subscribed_capital) {

          $(".subscribedSharesformError").hide().html('');
          $("#subscribed-note").show().html('Should not exceed the remaining no of subscribed share: '+available_subscribed_capital);
      }
      if(minimum_paid_up_share_regular > available_paid_up_capital) {
         $(".paidSharesformError").hide().html();
          $("#paid-note").show().html('Should not exceed the remaining no of paid up share: '+available_paid_up_capital);
      }
      
    }else if(tempType.length > 0 && tempType=="Associate"){ 
      // alert( $("#minimum_subscribed_share_associate").val());
      // alert($("#membershipType").val());
        var minimum_subscribed_share_associate = $("#minimum_subscribed_share_associate").val().length>0 ? $("#minimum_subscribed_share_associate").val() : '';
        var minimum_paid_up_share_associate = $("#minimum_paid_up_share_associate").val().length>0 ? $("#minimum_paid_up_share_associate").val() : '';
      $('#addCooperatorFormAmendment #amd_subscribedShares').prop('readonly',false);
      $('#addCooperatorFormAmendment #amd_paidShares').prop('readonly',false);
//      $('#addCooperatorFormAmendment #subscribedShares').val(minimum_subscribed_share_associate);
//      $('#addCooperatorFormAmendment #paidShares').val(minimum_paid_up_share_associate);
      $('#addCooperatorFormAmendment #amd_subscribedShares').attr('min',minimum_subscribed_share_associate);
      $('#addCooperatorFormAmendment #amd_paidShares').attr('min',minimum_paid_up_share_associate);
      $('#addCooperatorFormAmendment #amd_subscribedShares').attr({'class':'form-control validate[required,min[1],custom[integer],ajax[ajaxMinimumAssociateSubscriptionAmendmentCallPhp]]'});
      $('#addCooperatorFormAmendment #amd_paidShares').attr({'class':'form-control validate[required,min[1],custom[integer],funcCall[validateAddNumberOfPaidUpGreaterCustomAmendment],ajax[ajaxMinimumAssociatePayEditAmendmentCallPhp]]'});
      if(minimum_subscribed_share_associate > available_subscribed_capital) {
          $(".subscribedSharesformError").hide().html('');
          $("#subscribed-note").show().html('Should not exceed the remaining no of subscribed share: '+available_subscribed_capital);
      }
      if(minimum_paid_up_share_associate > available_paid_up_capital) {
         $(".paidSharesformError").hide().html();
          $("#paid-note").show().html('Should not exceed the remaining no of paid up share: '+available_paid_up_capital);
      }
    }else{
      $('#addCooperatorFormAmendment #amd_subscribedShares').prop('readonly',true);
      $('#addCooperatorFormAmendment #amd_paidShares').prop('readonly',true);
      $('#addCooperatorFormAmendment #amd_subscribedShares').val('');
      $('#addCooperatorFormAmendment #amd_paidShares').val('');
      $('#addCooperatorFormAmendment #amd_subscribedShares').attr('min',1);
      $('#addCooperatorFormAmendment #amd_paidShares').attr('min',1);
      $('#addCooperatorFormAmendment #amd_subscribedShares').attr({'class':'form-control validate[required,min[1],custom[integer]]'});
      $('#addCooperatorFormAmendment #amd_paidShares').attr({'class':'form-control validate[required,min[1],custom[integer],funcCall[validateAddNumberOfPaidUpGreaterCustom]]'});
    }
      
  });

  $('#addCooperatorFormAmendment #region').on('change',function(){
    $('#addCooperatorFormAmendment #province').empty();
    $("#addCooperatorFormAmendment #province").prop("disabled",true);
    $('#addCooperatorFormAmendment #city').empty();
    $("#addCooperatorFormAmendment #city").prop("disabled",true);
    $('#addCooperatorFormAmendment #barangay').empty();
    $("#addCooperatorFormAmendment #barangay").prop("disabled",true);
    if($(this).val() && ($(this).val()).length > 0){
      $("#addCooperatorFormAmendment #province").prop("disabled",false);
      var region = $(this).val();
        $.ajax({
        type : "POST",
        url  : "../api/provinces",
        dataType: "json",
        data : {
          region: region
        },
        success: function(data){
          $('#addCooperatorFormAmendment #province').append($('<option></option>').attr('value',"").text(""));
          $.each(data, function(key,value){
            $('#addCooperatorFormAmendment #province').append($('<option></option>').attr('value',value.provCode).text(value.provDesc));
          });
        }
      });
    }
  });

  //json
   $('#addCooperatorFormAmendment #position').on('change',function(){
      if($(this).val() =='Member')
      {
         $('#addCooperatorFormAmendment #B').prop('disabled',false);
      }
      else
      {
         $('#addCooperatorFormAmendment #B').prop('disabled',true);
      }
   });
  //end json

  $('#addCooperatorFormAmendment #province').on('change',function(){
    $('#addCooperatorFormAmendment #city').empty();
    $("#addCooperatorFormAmendment #city").prop("disabled",true);
    $('#addCooperatorFormAmendment #barangay').empty();
    $("#addCooperatorFormAmendment #barangay").prop("disabled",true);
    if($(this).val() && ($(this).val()).length > 0){
      $("#addCooperatorFormAmendment #city").prop("disabled",false);
      var province = $(this).val();
        $.ajax({
        type : "POST",
        url  : "../api/cities",
        dataType: "json",
        data : {
          province: province
        },
        success: function(data){
          $('#addCooperatorFormAmendment #city').append($('<option></option>').attr('value',"").text(""));
          $.each(data, function(key,value){
            $('#addCooperatorFormAmendment #city').append($('<option></option>').attr('value',value.citymunCode).text(value.citymunDesc));
          });
        }
      });
    }
  });

  $('#addCooperatorFormAmendment #city').on('change',function(){
    $('#addCooperatorFormAmendment #barangay').empty();
    $("#addCooperatorFormAmendment #barangay").prop("disabled",true);
    if($(this).val() && ($(this).val()).length > 0){
      $("#addCooperatorFormAmendment #barangay").prop("disabled",false);
      var cities = $(this).val();
        $.ajax({
        type : "POST",
        url  : "../api/barangays",
        dataType: "json",
        data : {
          cities: cities
        },
        success: function(data){
          $('#addCooperatorFormAmendment #barangay').append($('<option></option>').attr('value',"").text(""));
          $.each(data, function(key,value){
            $('#addCooperatorFormAmendment #barangay').append($('<option></option>').attr('value',value.brgyCode).text(value.brgyDesc));
          });
        }
      });
    }
  });

  var id = $("#addCooperatorFormAmendment #amd_id").val();
  var userid = $("#addCooperatorFormAmendment #userID").val();
  var coop_ids = $("#addCooperatorFormAmendment #coopids").val();
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
    console.log(data);
    // alert(data.area_of_operation);
         if(data!=null){
        // var tempCount = 0;
        // setTimeout( function(){
        //   $('#addCooperatorFormAmendment #region').val(data.rCode);
        //   $('#addCooperatorFormAmendment #region').trigger('change');
        // },300);
        // setTimeout( function(){
        //     $('#addCooperatorFormAmendment #province').val(data.pCode);
        //     $('#addCooperatorFormAmendment #province').trigger('change');
        // },1000);
        // setTimeout(function(){
        //   $('#addCooperatorFormAmendment #city').val(data.cCode);
        //   $('#addCooperatorFormAmendment #city').trigger('change');
        // },2000);
        setTimeout(function(){
          $('#addCooperatorFormAmendment #barangay').val(data.bCode);
          if(data.area_of_operation=='Barangay'){
          
            $('#addCooperatorFormAmendment #barangay').prop("disabled",true);
            $('#addCooperatorFormAmendment #city').prop("disabled",true);
            $('#addCooperatorFormAmendment #province').prop("disabled",true);
            $('#addCooperatorFormAmendment #region').prop("disabled",true);
          }else if(data.area_of_operation=='Municipality/City'){
            
            $('#addCooperatorFormAmendment #city').prop("disabled",true);
            $('#addCooperatorFormAmendment #province').prop("disabled",true);
            $('#addCooperatorFormAmendment #region').prop("disabled",true);
              $('#addCooperatorFormAmendment #barangay').prop("disabled",false);
          }else if(data.area_of_operation=='Provincial'){
              // alert('fire');
            $('#addCooperatorFormAmendment #province').prop("disabled",true);
            $('#addCooperatorFormAmendment #region').prop("disabled",true);
            $('#addCooperatorFormAmendment #barangay').prop("disabled",false);
            $('#addCooperatorFormAmendment #city').prop("disabled",false);
          }else if(data.area_of_operation=='Regional'){
            $('#addCooperatorFormAmendment #region').prop("disabled",true);
            $('#addCooperatorFormAmendment #province').prop("disabled",false);
            $('#addCooperatorFormAmendment #city').prop("disabled",false);
            $('#addCooperatorFormAmendment #barangay').prop("disabled",false);
          }else if(data.area_of_operation=='National'){
           
            $('#addCooperatorFormAmendment #region').prop("disabled",false);
            $('#addCooperatorFormAmendment #province').prop("disabled",false);
            $('#addCooperatorFormAmendment #barangay').prop("disabled",false);
            $('#addCooperatorFormAmendment #city').prop("disabled",false);
          }
          else if(data.area_of_operation == 'Interregional')
          {
            $('#addCooperatorFormAmendment #region').prop("disabled",false);
            $('#addCooperatorFormAmendment #province').prop("disabled",false);
            $('#addCooperatorFormAmendment #barangay').prop("disabled",false);
            $('#addCooperatorFormAmendment #city').prop("disabled",false);
          }

        },1100); 
      } //end if

    }//end of success
  });//end of ajax
});
