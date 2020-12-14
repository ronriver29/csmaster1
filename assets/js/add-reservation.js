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
  $('#reserveAddForm #categoryOfCooperative').on('change', function(){
        var categorycoop = $(this).val();
//      alert(categorycoop);
        if(categorycoop=="Primary"){
            $('#reserveAddForm #coopbank').hide();
        } else {
            $('#reserveAddForm #coopbank').show();
        }
  });
  $('#reserveAddForm #typeOfCooperative').on('change', function(){
    $('#reserveAddForm #addMoreSubclassBtn').prop("disabled",true);
    $("#reserveAddForm #proposedName").prop("disabled",true);
    $('#reserveAddForm select[name="majorIndustry[]"').each(function(index){
      $(this).empty();
      $(this).prop("disabled",true);
    });
    $('#reserveAddForm select[name="subClass[]"').each(function(index){
      $(this).empty();
      $(this).prop("disabled",true);
    });
    if($(this).val() && ($(this).val()).length > 0){
      $("#reserveAddForm #addMoreSubclassBtn").prop("disabled",false);
      $("#reserveAddForm #proposedName").prop("disabled",false);
      var coop_type = $(this).val();
        $.ajax({
        type : "POST",
        url  : "../api/major_industries",
        dataType: "json",
        data : {
          coop_type: coop_type
        },
        success: function(data){
          $('#reserveAddForm select[name="majorIndustry[]"').each(function(index){
            var majorIndustry = $(this);
            $(majorIndustry).prop("disabled",false);
            $(majorIndustry).append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $(majorIndustry).append($('<option></option>').attr('value',value.id).text(value.description));
            });
          });
        }
      });
    }
  });

  $('#reserveAddForm select[name="majorIndustry[]"').each(function(index){
    $(this).on('change',function(){ 
      $('#reserveAddForm #subClass'+(index+1)).empty();
      $('#reserveAddForm #subClass'+(index+1)).prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        var subClassTemp =   $('#reserveAddForm #subClass'+(index+1));
        $(subClassTemp).prop("disabled",false);
        var major_industry = $(this).val();
        var coop_type = $('#reserveAddForm #typeOfCooperative').val();
        if(coop_type.length > 0 ){
            $.ajax({
            type : "POST",
            url  : "../api/industry_subclasses",
            dataType: "json",
            data : {
              coop_type: coop_type,
              major_industry: major_industry
            },
            success: function(data){
                $(subClassTemp).append($('<option></option>').attr('value',"").text(""));
                $.each(data, function(key,value){
                  $(subClassTemp).append($('<option></option>').attr('value',value.id).text(value.description));
                });
            }
          });
        }
      }
    });
  });
 
  $('#reserveAddForm #addMoreSubclassBtn').on('click', function(){
    if($('#reserveAddForm #typeOfCooperative').val() && ($('#reserveAddForm #typeOfCooperative').val()).length > 0){
      var lastCountOfSubclass = $('select[name="subClass[]"').last().attr('id'); 
      var totalCountOFSubclass = $('select[name="subClass[]"').length;
      var intLastCount = parseInt(lastCountOfSubclass.substr(-1));
      var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn businessActivityRemoveBtn float-right text-danger'}).click(function(){
          $(this).parent().parent().parent().remove();
          $('#reserveAddForm select[name="majorIndustry[]"]').each(function(index){
            $(this).siblings('label').text("Major Industry Classification No. " + (index+1));
          });
          $('#reserveAddForm select[name="subClass[]"]').each(function(index){
            $(this).siblings('label').text("Major Industry Classification No. " + (index+1) + " Subclass ");
          });
        });
      var divFormGroupSubclass= $('<div></div>').attr({'class':'form-group'});
      var divColSubclass = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
      var labelSubClass = $('<label></label>').attr({'for': 'subClass'+(intLastCount + 1)}).text("Major Industry Classification No. " + (intLastCount+1) + " Subclass ");
      var selectSubClass = $('<select></select>').attr({'class': 'custom-select form-control validate[required]','name': 'subClass[]', 'id': 'subClass' + (intLastCount + 1)}).prop("disabled",true);
      
      var divFormGroupMajorIndustry = $('<div></div>').attr({'class':'form-group'});
      var divColMajorIndustry = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
      var labelMajorIndustry = $('<label></label>').attr({'for': 'majorIndustry'+(intLastCount + 1)}).text("Major Industry Classification No. " + (intLastCount+1));
      var selectMajorIndustry = $('<select></select>').attr({'class': 'custom-select form-control validate[required]','name': 'majorIndustry[]', 'id': 'majorIndustry' + (intLastCount + 1)}).change(function(){
      
        $(selectSubClass).empty();
        $(selectSubClass).prop("disabled",true);
        if($(this).val() && ($(this).val()).length > 0){
          $(selectSubClass).prop("disabled",false);
          var major_industry = $(this).val();
            var coop_type_val = $('#reserveAddForm #typeOfCooperative').val();
              $.ajax({
              type : "POST",
              url  : "../api/industry_subclasses",
              dataType: "json",
              data : {
                coop_type: coop_type_val,
                major_industry: major_industry
              },
              success: function(data){
                  $(selectSubClass).append($('<option></option>').attr('value',"").text(""));
                  $.each(data, function(key,value){
                    $(selectSubClass).append($('<option></option>').attr('value',value.id).text(value.description));
                  });
              }
            });
        }
      });
      var divInnerRow = $('<div></div>').attr({'class':'row'});
      var coop_type_val = $('#reserveAddForm #typeOfCooperative').val();
      $.ajax({
          type : "POST",
          url  : "../api/major_industries", 
          dataType: "json",
          data : {
            coop_type: coop_type_val
          },
          success: function(data){
              $(selectMajorIndustry).append($('<option></option>').attr('value',"").text(""));
              $.each(data, function(key,value){
                $(selectMajorIndustry).append($('<option></option>').attr('value',value.id).text(value.description));
              });
              $(divFormGroupSubclass).append(labelSubClass,selectSubClass);
              $(divColSubclass).append(divFormGroupSubclass);
              $(divFormGroupMajorIndustry).append(deleteSpan,labelMajorIndustry,selectMajorIndustry);
              $(divColMajorIndustry).append(divFormGroupMajorIndustry);
              $(divInnerRow).append(divColMajorIndustry,divColSubclass);
              $("#reserveAddForm .col-industry-subclass").append(divInnerRow);
              $('#reserveAddForm select[name="majorIndustry[]"').each(function(index){
                $(this).siblings('label').text("Major Industry Classification No. " + (index+1));
              });
              $('#reserveAddForm select[name="subClass[]"').each(function(index){
                $(this).siblings('label').text("Major Industry Classification No. " + (index+1) + " Subclass ");
              });
          }
        });
    }else{
      $('#reserveAddForm #typeOfCooperative').focus();
    }
  });

  $('#reserveAddForm select[name="compositionOfMembers[]"').on('change', function(){

    if(($(this).val()).length>0)
      $("#reserveAddForm #addMoreComBtn").prop("disabled",false);
    else
      $("#reserveAddForm #addMoreComBtn").prop("disabled",true);

    if($(this).val()=="Others"){
      var compositionOfMembersSpecify = $('<div class="col-sm-12 col-md-6 col-composition-specify">' +
                '<div class="form-group"><label for="compositionOfMembersSpecify">Specify Others:</label>' +
                '<input type="text" class="form-control validate[required]" name="compositionOfMembersSpecify" id="compositionOfMembersSpecify">' +
                '</div></div>');
      $('#reserveAddForm .rd-row').append(compositionOfMembersSpecify);
    }else{
      $('#reserveAddForm .col-composition-specify').remove();
    }
  });

  $('#reserveAddForm #addMoreComBtn').on('click', function(){
    var lastCountOfcom = $('select[name="compositionOfMembers[]"').last().attr('id');
    intLastCount = parseInt(lastCountOfcom.substr(-1));
    var divFormGroup= $('<div></div>').attr({'class':'form-group'});
    var selectComposition = $('<select></select>').attr({'class': 'custom-select form-control validate[required]','name': 'compositionOfMembers[]', 'id': 'compositionOfMembers' + (intLastCount + 1)}).prop("disabled",false);
    var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn compositionRemoveBtn float-right text-danger'}).click(function(){
        $(this).parent().remove();
      });

    $.ajax({
      type : "POST",
      url  : "composition",
      dataType: "json",
      
      success: function(data){
          $(selectComposition).append($('<option></option>').attr('value',"").text(""));
          $.each(data, function(key,value){
            $(selectComposition).append($('<option></option>').attr('value',value.composition).text(value.composition));
          });
      }
    });
    

    $(divFormGroup).append("<table><tr><td>",selectComposition,"</td><td>",deleteSpan,"</td></tr></table>");
    $("#reserveAddForm .col-com").append(divFormGroup);
  });
  
  $('#reserveAddForm #addMoreInsBtn').on('click', function(){
    var lastCountOfcom = $('#name_institution').last().attr('id');
    intLastCount = parseInt(lastCountOfcom.substr(-1));
    var divFormGroup= $('<div></div>').attr({'class':'form-group'});
    var selectComposition = $('<input>').attr({'class': 'custom-select form-control validate[required]','name': 'name_institution[]', 'id': 'name_institution' + (intLastCount + 1)}).prop("disabled",false);
    var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn institutionRemoveBtn float-right text-danger'}).click(function(){
        $(this).parent().remove();
      });

//    $.ajax({
//      type : "POST",
//      url  : "composition",
//      dataType: "json",
//      
//      success: function(data){
//          $(selectComposition).append($('<option></option>').attr('value',"").text(""));
//          $.each(data, function(key,value){
//            $(selectComposition).append($('<option></option>').attr('value',value.composition).text(value.composition));
//          });
//      }
//    });
    

    $(divFormGroup).append("<table><tr><td>",selectComposition,"</td><td>",deleteSpan,"</td></tr></table>");
    $("#reserveAddForm .col-com").append(divFormGroup);
  });
  
  $('#reserveAddForm #addMoreAssocBtn').on('click', function(){
    var lastCountOfcom = $('#name_associational').last().attr('id');
    intLastCount = parseInt(lastCountOfcom.substr(-1));
    var divFormGroup= $('<div></div>').attr({'class':'form-group'});
    var selectComposition = $('<input>').attr({'class': 'custom-select form-control validate[required]','name': 'name_associational[]', 'id': 'name_associational' + (intLastCount + 1)}).prop("disabled",false);
    var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn institutionRemoveBtn float-right text-danger'}).click(function(){
        $(this).parent().remove();
      });

//    $.ajax({
//      type : "POST",
//      url  : "composition",
//      dataType: "json",
//      
//      success: function(data){
//          $(selectComposition).append($('<option></option>').attr('value',"").text(""));
//          $.each(data, function(key,value){
//            $(selectComposition).append($('<option></option>').attr('value',value.composition).text(value.composition));
//          });
//      }
//    });
    

    $(divFormGroup).append("<table><tr><td>",selectComposition,"</td><td>",deleteSpan,"</td></tr></table>");
    $("#reserveAddForm .col-com").append(divFormGroup);
  });
    
    $('#reserveAddForm #field_membership').hide();
    $('#reserveAddForm #name_institution_label').hide();
    $('#reserveAddForm #name_associational_label').hide();
    $('#reserveAddForm #name_institution').hide();
    $('#reserveAddForm #name_associational').hide();
    $('#reserveAddForm #addMoreInsBtn').hide();
    $('#reserveAddForm #fieldmembershipname').hide();
    $('#reserveAddForm #addMoreAssocBtn').hide();
    
    $('#reserveAddForm #commonBondOfMembership').on('change',function(){
        if($(this).val()=="Institutional"){
            $('#reserveAddForm select[name="compositionOfMembers[]"').hide();
            $('#reserveAddForm #fieldmembershipmemofficname').hide();
            $('#reserveAddForm #commonbondname').hide();
            $('#reserveAddForm #addMoreComBtn').hide();
            $('#reserveAddForm #name_associational_label').hide();
            $('#reserveAddForm #name_associational').hide();
            $('#reserveAddForm #addMoreAssocBtn').hide();
            $('#reserveAddForm #field_membership').show();
            $('#reserveAddForm #name_institution_label').show();
            $('#reserveAddForm #name_institution').show();
            $('#reserveAddForm #addMoreInsBtn').show();
            $('#reserveAddForm #fieldmembershipname').show();
            $('#reserveAddForm #name_associational').prop("required",false);
            $('#reserveAddForm #field_membership').prop("required",true);
            $('#reserveAddForm #name_institution').prop("required",true);
        } else if($(this).val()=="Associational"){
            $('#reserveAddForm select[name="compositionOfMembers[]"').hide();
            $('#reserveAddForm #addMoreComBtn').hide();
            $('#reserveAddForm #commonbondname').hide();
            $('#reserveAddForm #name_institution_label').hide();
            $('#reserveAddForm #name_institution').hide();
            $('#reserveAddForm #addMoreInsBtn').hide();
            $('#reserveAddForm #fieldmembershipname').hide();
            $('#reserveAddForm #name_associational_label').show();
            $('#reserveAddForm #name_associational').show();
            $('#reserveAddForm #addMoreAssocBtn').show();
            $('#reserveAddForm #field_membership').show();
            $('#reserveAddForm #fieldmembershipmemofficname').show();
            $('#reserveAddForm #name_institution').prop("required",false);
            $('#reserveAddForm #field_membership').prop("required",true);
            $('#reserveAddForm #name_associational').prop("required",true);
        } else if($(this).val()=="Residential"){
            $('#reserveAddForm #fieldmembershipmemofficname').hide();
            $('#reserveAddForm #field_membership').hide();
            $('#reserveAddForm #name_institution_label').hide();
            $('#reserveAddForm #name_associational_label').hide();
            $('#reserveAddForm #name_institution').hide();
            $('#reserveAddForm #name_associational').hide();
            $('#reserveAddForm #addMoreInsBtn').hide();
            $('#reserveAddForm #fieldmembershipname').hide();
            $('#reserveAddForm #addMoreAssocBtn').hide();
            $('#reserveAddForm select[name="compositionOfMembers[]"').hide();
            $('#reserveAddForm #commonbondname').hide();
            $('#reserveAddForm #addMoreComBtn').hide();
            $('#reserveAddForm #name_institution').prop("required",false);
            $('#reserveAddForm #field_membership').prop("required",false);
            $('#reserveAddForm #name_associational').prop("required",false);
        } else {
            $('#reserveAddForm #fieldmembershipmemofficname').hide();
            $('#reserveAddForm #field_membership').hide();
            $('#reserveAddForm #name_institution_label').hide();
            $('#reserveAddForm #name_associational_label').hide();
            $('#reserveAddForm #name_institution').hide();
            $('#reserveAddForm #name_associational').hide();
            $('#reserveAddForm #addMoreInsBtn').hide();
            $('#reserveAddForm #fieldmembershipname').hide();
            $('#reserveAddForm #addMoreAssocBtn').hide();
            $('#reserveAddForm #commonbondname').show();
            $('#reserveAddForm select[name="compositionOfMembers[]"').show();
            $('#reserveAddForm #addMoreComBtn').show();
            $('#reserveAddForm #name_institution').prop("required",false);
            $('#reserveAddForm #field_membership').prop("required",false);
            $('#reserveAddForm #name_associational').prop("required",false);
        }
    });
  
    $('#reserveAddForm #region').on('change',function(){
      $('#reserveAddForm #province').empty();
      $("#reserveAddForm #province").prop("disabled",true);
      $('#reserveAddForm #city').empty();
      $("#reserveAddForm #city").prop("disabled",true);
      $('#reserveAddForm #barangay').empty();
      $("#reserveAddForm #barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#reserveAddForm #province").prop("disabled",false);
        var region = $(this).val();
          $.ajax({
          type : "POST",
          url  : "../api/provinces",
          dataType: "json",
          data : {
            region: region
          },
          success: function(data){
            $('#reserveAddForm #province').append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $('#reserveAddForm #province').append($('<option></option>').attr('value',value.provCode).text(value.provDesc));
            });
          }
        });
      }
    });

    $('#reserveAddForm #province').on('change',function(){
      $('#reserveAddForm #city').empty();
      $("#reserveAddForm #city").prop("disabled",true);
      $('#reserveAddForm #barangay').empty();
      $("#reserveAddForm #barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#reserveAddForm #city").prop("disabled",false);
        var province = $(this).val();
          $.ajax({
          type : "POST",
          url  : "../api/cities",
          dataType: "json",
          data : {
            province: province
          },
          success: function(data){
            $('#reserveAddForm #city').append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $('#reserveAddForm #city').append($('<option></option>').attr('value',value.citymunCode).text(value.citymunDesc));
            });
          }
        });
      }
    });

    $('#reserveAddForm #city').on('change',function(){
      $('#reserveAddForm #barangay').empty();
      $("#reserveAddForm #barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#reserveAddForm #barangay").prop("disabled",false);
        var cities = $(this).val();
          $.ajax({
          type : "POST",
          url  : "../api/barangays",
          dataType: "json",
          data : {
            cities: cities
          },
          success: function(data){
            $('#reserveAddForm #barangay').append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $('#reserveAddForm #barangay').append($('<option></option>').attr('value',value.brgyCode).text(value.brgyDesc));
            });
          }
        });
      }
    });

  $("#reserveAddForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
          if(status==true){
            if($("#reserveAddLoadingBtn").length <= 0){
              $("#reserveAddForm #reserveAddBtn").hide();
              $("#reserveAddForm .col-reserve-btn").append($('<button></button>').attr({'id':'reserveAddLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
            }else{
              return false;
            }
          }else{
            return false;
          }
        }
  });
  $("#reserveAddForm #reserveAddAgree").click(function(){
    if($(this).is(':checked')){
      $('#reserveAddForm #reserveAddBtn').removeAttr('disabled');
    }else{
      $('#reserveAddForm #reserveAddBtn').attr('disabled','disabled');
    }
  });
  
});
