$(function(){
  if($('#termsAndConditionModal').length){
    $('#termsAndConditionModal').modal('show');
  }
  // $('#termsAndConditionModal #btnTermsAgree');
  //start cooperative add reservation validation
  // $('#reserveAddForm #addMoreActivityBtn').on('click', function(){
  //   var lastCountOfActivities = $('select[name="proposedBusinessActivity[]"').last().attr('id');
  //   var intLastCount = parseInt(lastCountOfActivities.substr(-1));
  //   var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn businessActivityRemoveBtn float-right text-danger'}).click(function(){
  //     $(this).parent().parent().parent().remove();
  //     $('#reserveAddForm #proposedBusinessActivitySubtype1').trigger('change');
  //     $('#reserveAddForm select[name="proposedBusinessActivitySubtype[]"').each(function(index){
  //       $(this).siblings('label').text("Proposed Business Activity Subtype " + (index+1));
  //     });
  //     $('#reserveAddForm select[name="proposedBusinessActivity[]"').each(function(index){
  //       $(this).siblings('label').text("Proposed Business Activity " + (index+1));
  //     });
  //   });
  //   var labelActivity = $('<label></label>').attr({'for': 'proposedBusinessActivity'+(intLastCount + 1)}).text('Major Industry ' + (intLastCount + 1));
  //   var selectActivity = $('<select></select>').attr({'class': 'custom-select form-control validate[required]','name': 'proposedBusinessActivity[]', 'id': 'proposedBusinessActivity' + (intLastCount + 1)}).change(function(){
  //     $('#reserveAddForm #proposedBusinessActivitySubtype' + (intLastCount+1)).empty();
  //     $("#reserveAddForm #proposedBusinessActivitySubtype" + (intLastCount+1)).prop("disabled",true);
  //     $('#reserveAddForm #typeOfCooperative').val("");
  //     if($(this).val() && ($(this).val()).length > 0){
  //       $("#reserveAddForm #proposedBusinessActivitySubtype" + (intLastCount+1)).prop("disabled",false);
  //       var business_activity = $(this).val();
  //         $.ajax({
  //         type : "POST",
  //         url  : "../api/business_activity_subtypes",
  //         dataType: "json",
  //         data : {
  //           business_activity_id: business_activity
  //         },
  //         success: function(data){
  //           $('#reserveAddForm #proposedBusinessActivitySubtype' + (intLastCount+1)).append($('<option></option>').attr('value',"").text(""));
  //           $.each(data, function(key,value){
  //             $('#reserveAddForm #proposedBusinessActivitySubtype' + (intLastCount+1)).append($('<option></option>').attr('value',value.id).text(value.name));
  //           });
  //         }
  //       });
  //     }
  //   });
  //   var labelSubtype = $('<label></label>').attr({'for': 'proposedBusinessActivitySubtype'+(intLastCount + 1)}).text('Proposed Business Activity Subtype ' + (intLastCount + 1));
  //   var selectSubtype = $('<select></select>').attr({'class': 'custom-select form-control validate[required]','name': 'proposedBusinessActivitySubtype[]', 'id': 'proposedBusinessActivitySubtype' + (intLastCount + 1), 'disabled': 'true'}).change(function(){
  //     var activityCount = 0;
  //     var hasValueCount = 0;
  //     $('#reserveAddForm select[name="proposedBusinessActivitySubtype[]"').each(function(){
  //       activityCount++;
  //       if(this.value.length > 0){
  //         hasValueCount++;
  //       }
  //     });
  //     if(hasValueCount === activityCount){
  //         $('#reserveAddForm #typeOfCooperative').val("Multi-Purpose");
  //     }else{
  //       $('#reserveAddForm #typeOfCooperative').val("");
  //     }
  //   });
  //   var divFormGroupActivity = $('<div></div>').attr({'class':'form-group'});
  //   var divFormGroupSubtype = $('<div></div>').attr({'class':'form-group'});
  //   var divColActivity = $('<div></div>').attr({'class':'col-sm-12 col-md-6'});
  //   var divColSubtype = $('<div></div>').attr({'class':'col-sm-12 col-md-6'});
  //   var divRow = $('<div></div>').attr({'class':'row'});
  //   $.ajax({
  //     type : "GET",
  //     url  : "../api/business_activity_types",
  //     dataType: "json",
  //     success: function(data){
  //       $(selectActivity).append($('<option></option').attr({'selected':true}).val(""));
  //       $.each(data, function (i, activity) {
  //           $(selectActivity).append($('<option>', {
  //               value: activity.id,
  //               text : activity.name
  //           }));
  //       });
  //       $(divFormGroupActivity).append(labelActivity,selectActivity);
  //       $(divColActivity).append(divFormGroupActivity);
  //       $(divFormGroupSubtype).append(deleteSpan,labelSubtype,selectSubtype);
  //       $(divColSubtype).append(divFormGroupSubtype);
  //       $(divRow).append(divColActivity,divColSubtype);
  //       $('.col-addreserve-activites').append(divRow);
  //       $('#reserveAddForm #proposedBusinessActivitySubtype1').trigger('change');
  //       $('#reserveAddForm select[name="proposedBusinessActivitySubtype[]"').each(function(index){
  //         $(this).siblings('label').text("Subclass " + (index+1));
  //       });
  //       $('#reserveAddForm select[name="proposedBusinessActivity[]"').each(function(index){
  //         $(this).siblings('label').text("Major Industry " + (index+1));
  //       });
  //     },
  //     error: function(error){
  //       alert(error + '<br> there was an error getting the list of business activities')
  //     }
  //   });
  // });
  //
  //
  // $('#reserveAddForm #proposedBusinessActivity1').on('change',function(){
  //   $('#reserveAddForm #proposedBusinessActivitySubtype1').empty();
  //   $("#reserveAddForm #proposedBusinessActivitySubtype1").prop("disabled",true);
  //   $('#reserveAddForm #typeOfCooperative').val("");
  //   if($(this).val() && ($(this).val()).length > 0){
  //     $("#reserveAddForm #proposedBusinessActivitySubtype1").prop("disabled",false);
  //     var business_activity = $(this).val();
  //       $.ajax({
  //       type : "POST",
  //       url  : "../api/business_activity_subtypes",
  //       dataType: "json",
  //       data : {
  //         business_activity_id: business_activity
  //       },
  //       success: function(data){
  //         $('#reserveAddForm #proposedBusinessActivitySubtype1').append($('<option></option>').attr('value',"").text(""));
  //         $.each(data, function(key,value){
  //           $('#reserveAddForm #proposedBusinessActivitySubtype1').append($('<option></option>').attr('value',value.id).text(value.name));
  //         });
  //       }
  //     });
  //   }
  // });
  // $('#reserveAddForm #proposedBusinessActivitySubtype1').on('change',function(){
  //   var activityCount = 0;
  //   var hasValueCount = 0;
  //   $('#reserveAddForm select[name="proposedBusinessActivitySubtype[]"').each(function(){
  //     activityCount++;
  //     if(this.value.length > 0){
  //       hasValueCount++;
  //     }
  //   });
  //   if(activityCount<=1){
  //     $('#reserveAddForm #typeOfCooperative').val("");
  //     if($(this).val() && ($(this).val()).length > 0){
  //       var business_activity_subtype = $(this).val();
  //         $.ajax({
  //         type : "POST",
  //         url  : "../api/cooperative_types",
  //         dataType: "json",
  //         data : {
  //           business_activity_subtype_id: business_activity_subtype
  //         },
  //         success: function(data){
  //           $('#reserveAddForm #typeOfCooperative').val(data.coop_name);
  //         }
  //       });
  //     }
  //   }else{
  //     if(hasValueCount === activityCount){
  //         $('#reserveAddForm #typeOfCooperative').val("Multi-Purpose");
  //     }else{
  //       $('#reserveAddForm #typeOfCooperative').val("");
  //     }
  //   }
  // });

    $('#branchAddForm #region').on('change',function(){
      $('#branchAddForm #province').empty();
      $("#branchAddForm #province").prop("disabled",true);
      $('#branchAddForm #city').empty();
      $("#branchAddForm #city").prop("disabled",true);
      $('#branchAddForm #barangay').empty();
      $("#branchAddForm #barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#branchAddForm #province").prop("disabled",false);
        var region = $(this).val();
          $.ajax({
          type : "POST",
          url  : "../api/provinces",
          dataType: "json",
          data : {
            region: region
          },
          success: function(data){
            $('#branchAddForm #province').append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $('#branchAddForm #province').append($('<option></option>').attr('value',value.provCode).text(value.provDesc));
            });
          }
        });
      }
    });

    $('#branchAddForm #province').on('change',function(){
      $('#branchAddForm #city').empty();
      $("#branchAddForm #city").prop("disabled",true);
      $('#branchAddForm #barangay').empty();
      $("#branchAddForm #barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#branchAddForm #city").prop("disabled",false);
        var province = $(this).val();
          $.ajax({
          type : "POST",
          url  : "../api/cities",
          dataType: "json",
          data : {
            province: province
          },
          success: function(data){
            $('#branchAddForm #city').append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $('#branchAddForm #city').append($('<option></option>').attr('value',value.citymunCode).text(value.citymunDesc));
            });
          }
        });
      }
    });

    $('#branchAddForm #city').on('change',function(){
      $('#branchAddForm #barangay').empty();
      $("#branchAddForm #barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#branchAddForm #barangay").prop("disabled",false);
        var cities = $(this).val();
          $.ajax({
          type : "POST",
          url  : "../api/barangays",
          dataType: "json",
          data : {
            cities: cities
          },
          success: function(data){
            $('#branchAddForm #barangay').append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $('#branchAddForm #barangay').append($('<option></option>').attr('value',value.brgyCode).text(value.brgyDesc));
            });
          }
        });
      }
    });

  $("#branchAddForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
          if(status==true){
            if($("#branchAddLoadingBtn").length <= 0){
              $("#branchAddForm #branchAddBtn").hide();
              $("#branchAddForm .col-branch-btn").append($('<button></button>').attr({'id':'branchAddLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
            }else{
              return false;
            }
          }else{
            return false;
          }
        }
  });

  $('#branchAddForm #regNo').ready(function(){

    var coopName = $('#coopName').val();
    var regNo = $('#regNo').val();

    $("#branchAddForm .-row-your-boat").remove();


    var divRow1 = $('<div></div>').attr({'class':'row -row-your-boat'});

     

    $.ajax({
      type : "POST",
      url  : "business_activity/"+regNo ,
      dataType: "json",
      data : {
        regNo: regNo
      },
      success: function(data){
        if (data!=null) {
         
          $.each(data, function(index,value) { 
            var divColMajor = $('<div></div>').attr({'class':'col-sm-12 col-md-12 '+(index+1)});
            var divFormMajor = $('<div></div>').attr({'class':'form-group '+(index+1)});
            var divFormSub = $('<div></div>').attr({'class':'form-group'+(index+1)});
            var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn businessRemoveBtn float-right text-danger'}).click(function(){
              $(this).parent().remove();
              $('#branchAddForm input[name="MI[]"').each(function(index){
                $(this).siblings('label').text("Major Industry Classification No. " + (index+1));
              });
              $('#branchAddForm input[name="SC[]"').each(function(index){
                $(this).siblings('label').text("Major Industry Classification No. " + (index+1) +' Subclass');
              });
            });

            var hiddenBAC =$('<input type="hidden" class="form-control" name="BAC[]"/>').attr('value',value.BAC_id);
            var inputMajor=$('<input type="text" class="form-control" name="MI[]" readonly/>').attr('value',value.mdesc);
            var inputSub=  $('<input type="text" class="form-control" name="SC[]" readonly/>').attr('value',value.sdesc);
            var labelMajor=$('<label>Major Industry Classification No. '+(index+1)+'</label>');
            var labelSub=  $('<label>Major Industry Classification No. '+(index+1)+' Subclass</label>');

            $(divFormMajor).append(labelMajor,inputMajor);
            $(divFormSub).append(labelSub,inputSub);
            $(divColMajor).append(deleteSpan,hiddenBAC,divFormMajor,divFormSub);
            $(divRow1).append(divColMajor);
          });
            
            $("#branchAddForm .col-industry-subclass").append(divRow1);
//            $("#branchAddForm .col-industry-subclass").prop("disabled",true);
            

        }
      }
    });

    $.ajax({
      type : "POST",
      url  : "coop_info/"+regNo ,
      dataType: "json",
      data : {
        regNo: regNo
      },
      success: function(data){
       
        $('#branchAddForm #blkNo').val(data.noStreet);
        $('#branchAddForm #streetName').val(data.Street);
        $('#branchAddForm #coopName').val(data.coopName);
        setTimeout( function(){
          $('#branchAddForm #region').val(data.rCode);
          $('#branchAddForm #region').trigger('change');
        },300);
        setTimeout( function(){
            $('#branchAddForm #province').val(data.pCode);
            $('#branchAddForm #province').trigger('change');
//if(data.areaOfOperation=='Provincial'){
//	$("#branchAddForm #region").prop("disabled",true);
//} else {
//	$("#branchAddForm #province").prop("disabled",true);
//$("#branchAddForm #region").prop("disabled",true);
//}
        },900);
        setTimeout(function(){
          $('#branchAddForm #city').val(data.cCode);
          $('#branchAddForm #city').trigger('change');
        },1500);
        setTimeout(function(){
          $('#branchAddForm #barangay').val(data.bCode);
          $('#branchAddForm #barangay2').val(data.bCode);
          $('#branchAddForm #areaOfOperation').empty();  
        if(data.areaOfOperation=='Barangay'){
          $('#branchAddForm #areaOfOperation').val(data.areaOfOperation);
          $('#branchAddForm #areaOfOperation').append($('<option></option>').attr('value',"Barangay").text("Barangay"));
          $("#branchAddForm #barangay").prop("disabled",true);
          $("#branchAddForm #barangay2").prop("disabled",false);
          $("#branchAddForm #city").prop("disabled",true);
          $("#branchAddForm #province").prop("disabled",true);
          $("#branchAddForm #region").prop("disabled",true);
        }else if (data.areaOfOperation=='Municipality/City') {
          $('#branchAddForm #areaOfOperation').val(data.areaOfOperation);
          $('#branchAddForm #areaOfOperation').append($('<option></option>').attr('value',"Barangay").text("Barangay"));
          $('#branchAddForm #areaOfOperation').append($('<option></option>').attr('value',"Municipality/City").text("Municipality/City"));
          $("#branchAddForm #city").prop("disabled",true);
          $("#branchAddForm #province").prop("disabled",true);
          $("#branchAddForm #region").prop("disabled",true);   
        }else if (data.areaOfOperation=='Provincial'){
          $('#branchAddForm #areaOfOperation').val(data.areaOfOperation);
          $('#branchAddForm #areaOfOperation').append($('<option></option>').attr('value',"Barangay").text("Barangay"));
          $('#branchAddForm #areaOfOperation').append($('<option></option>').attr('value',"Municipality/City").text("Municipality/City"));
          $('#branchAddForm #areaOfOperation').append($('<option></option>').attr('value',"Provincial").text("Provincial"));
          $("#branchAddForm #province").prop("disabled",true);
          $("#branchAddForm #region").prop("disabled",true);
        }else if(data.areaOfOperation=='Regional'){
          $('#branchAddForm #areaOfOperation').val(data.areaOfOperation);
          $('#branchAddForm #areaOfOperation').append($('<option></option>').attr('value',"Barangay").text("Barangay"));
          $('#branchAddForm #areaOfOperation').append($('<option></option>').attr('value',"Municipality/City").text("Municipality/City"));
          $('#branchAddForm #areaOfOperation').append($('<option></option>').attr('value',"Provincial").text("Provincial"));
          $('#branchAddForm #areaOfOperation').append($('<option></option>').attr('value',"Regional").text("Regional"));
          $("#branchAddForm #region").prop("disabled",true);
        }else{
          $('#branchAddForm #areaOfOperation').val(data.areaOfOperation);
          $('#branchAddForm #areaOfOperation').append($('<option></option>').attr('value',"Barangay").text("Barangay"));
          $('#branchAddForm #areaOfOperation').append($('<option></option>').attr('value',"Municipality/City").text("Municipality/City"));
          $('#branchAddForm #areaOfOperation').append($('<option></option>').attr('value',"Provincial").text("Provincial"));
          $('#branchAddForm #areaOfOperation').append($('<option></option>').attr('value',"Regional").text("Regional"));
          $('#branchAddForm #areaOfOperation').append($('<option></option>').attr('value',"National").text("National"));
        }
        },2500);
      }
    });
  });

  $('#branchAddForm #areaOfOperation').on('change', function(){
    area=$('#areaOfOperation').val();
    if(area=='Barangay'){
      $("#branchAddForm #barangay").prop("disabled",true);
      $("#branchAddForm #city").prop("disabled",true);
      $("#branchAddForm #province").prop("disabled",true);
      $("#branchAddForm #region").prop("disabled",true);
    }else if (area=='Municipality/City') {
      $("#branchAddForm #barangay").prop("disabled",false);
      $("#branchAddForm #city").prop("disabled",true);
      $("#branchAddForm #province").prop("disabled",true);
      $("#branchAddForm #region").prop("disabled",true);   
    }else if (area=='Provincial'){
      $("#branchAddForm #barangay").prop("disabled",false);
      $("#branchAddForm #city").prop("disabled",false);
      $("#branchAddForm #province").prop("disabled",true);
      $("#branchAddForm #region").prop("disabled",true);
    }else if(area=='Regional'){
      $("#branchAddForm #barangay").prop("disabled",false);
      $("#branchAddForm #city").prop("disabled",false);
      $("#branchAddForm #province").prop("disabled",false);
      $("#branchAddForm #region").prop("disabled",true);
    }else{
      $("#branchAddForm #barangay").prop("disabled",false);
      $("#branchAddForm #city").prop("disabled",false);
      $("#branchAddForm #province").prop("disabled",false);
      $("#branchAddForm #region").prop("disabled",false);
    }
  });
  
  $("#branchAddForm #branchAddAgree").click(function(){
    if($(this).is(':checked')){
      $('#branchAddForm #branchAddBtn').removeAttr('disabled');
    }else{
      $('#branchAddForm #branchAddBtn').attr('disabled','disabled');
    }
  });
});
