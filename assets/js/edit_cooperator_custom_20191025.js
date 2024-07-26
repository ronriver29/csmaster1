$(function(){
  $('#editCooperatorForm #membershipType').on('change', function(){
    var tempType  = $.trim($(this).val());
    
    
    if(tempType.length > 0 && tempType=="Regular"){
      $('#editCooperatorForm #subscribedShares').prop('readonly',false);
      $('#editCooperatorForm #paidShares').prop('readonly',false);
      $('#editCooperatorForm #subscribedShares').attr({'class':'form-control validate[required,min[1],custom[integer],ajax[ajaxMinimumRegularSubscriptionEditCallPhp]]'});
      $('#editCooperatorForm #paidShares').attr({'class':'form-control validate[required,min[1],custom[integer],funcCall[validateEditNumberOfPaidUpGreaterCustom],ajax[ajaxMinimumRegularPayEditCallPhp]]'});
    }else if(tempType.length > 0 && tempType=="Associate"){
      $('#editCooperatorForm #subscribedShares').prop('readonly',false);
      $('#editCooperatorForm #paidShares').prop('readonly',false);
      $('#editCooperatorForm #subscribedShares').attr({'class':'form-control validate[required,min[1],custom[integer],ajax[ajaxMinimumAssociateSubscriptionEditCallPhp]]'});
      $('#editCooperatorForm #paidShares').attr({'class':'form-control validate[required,min[1],custom[integer],funcCall[validateEditNumberOfPaidUpGreaterCustom],ajax[ajaxMinimumAssociatePayEditCallPhp]]'});
    }else{
      $('#editCooperatorForm #subscribedShares').prop('readonly',true);
      $('#editCooperatorForm #paidShares').prop('readonly',true);
      $('#editCooperatorForm #subscribedShares').attr({'class':'form-control validate[required,min[1],custom[integer]]'});
      $('#editCooperatorForm #paidShares').attr({'class':'form-control validate[required,min[1],custom[integer],funcCall[validateEditNumberOfPaidUpGreaterCustom]]'});
    }
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
  },100);
  var x=$('#editCooperatorForm #provCode').val();
  setTimeout( function(){
    $('#editCooperatorForm #province').val(x);
    $('#editCooperatorForm #province').trigger('change');
  },800);
  var y=$('#editCooperatorForm #cityCode').val();
  setTimeout( function(){
    $('#editCooperatorForm #city').val(y);
    $('#editCooperatorForm #city').trigger('change');
  },1700);
  var z=$('#editCooperatorForm #brgyCode').val();
  setTimeout( function(){
    $('#editCooperatorForm #barangay').val(z);
    $('#editCooperatorForm #barangay').trigger('change');
  },2500);

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


});
