$(function(){
  $('#addCooperatorForm #membershipType').on('change', function(){
    var tempType  = $.trim($(this).val());
    if(tempType.length > 0 && tempType=="Regular"){
      $('#addCooperatorForm #subscribedShares').prop('readonly',false);
      $('#addCooperatorForm #paidShares').prop('readonly',false);
      $('#addCooperatorForm #subscribedShares').attr({'class':'form-control validate[required,min[1],custom[integer],ajax[ajaxMinimumRegularSubscriptionCallPhp]]'});
      $('#addCooperatorForm #paidShares').attr({'class':'form-control validate[required,min[1],custom[integer],funcCall[validateAddNumberOfPaidUpGreaterCustom],ajax[ajaxMinimumRegularPayCallPhp]]'});
    }else if(tempType.length > 0 && tempType=="Associate"){
      $('#addCooperatorForm #subscribedShares').prop('readonly',false);
      $('#addCooperatorForm #paidShares').prop('readonly',false);
      $('#addCooperatorForm #subscribedShares').attr({'class':'form-control validate[required,min[1],custom[integer],ajax[ajaxMinimumAssociateSubscriptionCallPhp]]'});
      $('#addCooperatorForm #paidShares').attr({'class':'form-control validate[required,min[1],custom[integer],funcCall[validateAddNumberOfPaidUpGreaterCustom],ajax[ajaxMinimumAssociatePayCallPhp]]'});
    }else{
      $('#addCooperatorForm #subscribedShares').prop('readonly',true);
      $('#addCooperatorForm #paidShares').prop('readonly',true);
      $('#addCooperatorForm #subscribedShares').attr({'class':'form-control validate[required,min[1],custom[integer]]'});
      $('#addCooperatorForm #paidShares').attr({'class':'form-control validate[required,min[1],custom[integer],funcCall[validateAddNumberOfPaidUpGreaterCustom]]'});
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

  var id = $("#addCooperatorForm #cooperativesID").val();
  var userid = $("#addCooperatorForm #userID").val();
  
  $.ajax({

    type : "POST",
    url  : "./get_cooperative_info",
    dataType: "json",
    data : {
      id: id,
      user_id: userid
    },
    success: function(data){
      
      if(data!=null){
        var tempCount = 0;
        setTimeout( function(){
          $('#addCooperatorForm #region').val(data.rCode);
          $('#addCooperatorForm #region').trigger('change');
        },100);
        setTimeout( function(){
            $('#addCooperatorForm #province').val(data.pCode);
            $('#addCooperatorForm #province').trigger('change');
        },500);
        setTimeout(function(){
          $('#addCooperatorForm #city').val(data.cCode);
          $('#addCooperatorForm #city').trigger('change');
        },1000);
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
          }
        },1700);

        
        
      }
    }
  });
});
