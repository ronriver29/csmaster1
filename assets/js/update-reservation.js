  $(function(){
    
  $('#reserveUpdateForm #categoryOfCooperative').on('change', function(){
      var categorycoop = $(this).val();
  //      alert(categorycoop);
      if(categorycoop=="Primary"){
          $('#reserveUpdateForm #coopbank').hide();
      } else {
          $('#reserveUpdateForm #coopbank').show();
      }
  });
    if($('#termsAndConditionModal').length){
      $('#termsAndConditionModal').modal('show');
    }
      $('#reserveUpdateForm #commonBondOfMembership').on('change',function(){
          if($(this).val()=="Institutional"){
              $('#reserveUpdateForm select[name="compositionOfMembers[]"').hide();
              $('#reserveUpdateForm #fieldmembershipmemofficname').hide();
              $('#reserveUpdateForm #commonbondname').hide();
              $('#reserveUpdateForm #addMoreComBtn').hide();
              $('#reserveUpdateForm #name_associational_label').hide();
              $('#reserveUpdateForm #name_associational').hide();
              $('#reserveUpdateForm #addMoreAssocBtn').hide();
              $('#reserveUpdateForm #field_membership').show();
              $('#reserveUpdateForm #name_institution_label').show();
              $('#reserveUpdateForm #name_institution').show();
              $('#reserveUpdateForm #addMoreInsBtn').show();
              $('#reserveUpdateForm #fieldmembershipname').show();
              $('#reserveUpdateForm #name_associational').prop("required",false);
              $('#reserveUpdateForm #field_membership').prop("required",true);
              $('#reserveUpdateForm #name_institution').prop("required",true);
              $('#reserveUpdateForm #composition_of_members_label').hide();
              $('#reserveUpdateForm #compositionOfMembers1').hide();
          } else if($(this).val()=="Associational"){
              $('#reserveUpdateForm select[name="compositionOfMembers[]"').hide();
              $('#reserveUpdateForm #addMoreComBtn').hide();
              $('#reserveUpdateForm #commonbondname').hide();
              $('#reserveUpdateForm #name_institution_label').hide();
              $('#reserveUpdateForm #name_institution').show();
              $('#reserveUpdateForm #addMoreInsBtn').show();
              $('#reserveUpdateForm #fieldmembershipname').hide();
              $('#reserveUpdateForm #name_associational_label').show();
              $('#reserveUpdateForm #name_associational').show();
              $('#reserveUpdateForm #addMoreAssocBtn').show();
              $('#reserveUpdateForm #field_membership').show();
              $('#reserveUpdateForm #fieldmembershipmemofficname').show();
              $('#reserveUpdateForm #name_institution').prop("required",false);
              $('#reserveUpdateForm #field_membership').prop("required",true);
              $('#reserveUpdateForm #name_associational').prop("required",true);
              $('#reserveUpdateForm #composition_of_members_label').hide();
              $('#reserveUpdateForm #compositionOfMembers1').hide();
          } else if($(this).val()=="Residential"){
              $('#reserveUpdateForm #fieldmembershipmemofficname').hide();
              $('#reserveUpdateForm #field_membership').hide();
              $('#reserveUpdateForm #name_institution_label').hide();
              $('#reserveUpdateForm #name_associational_label').hide();
              $('#reserveUpdateForm #name_institution').hide();
              $('#reserveUpdateForm #name_associational').hide();
              $('#reserveUpdateForm #addMoreInsBtn').hide();
              $('#reserveUpdateForm #fieldmembershipname').hide();
              $('#reserveUpdateForm #addMoreAssocBtn').hide();
              $('#reserveUpdateForm select[name="compositionOfMembers[]"').hide();
              $('#reserveUpdateForm #commonbondname').hide();
              $('#reserveUpdateForm #addMoreComBtn').hide();
              $('#reserveUpdateForm #compositionOfMembers1').hide();
              $('#reserveUpdateForm #composition_of_members_label').hide();
              $('#reserveUpdateForm #name_institution').prop("required",false);
              $('#reserveUpdateForm #field_membership').prop("required",false);
              $('#reserveUpdateForm #name_associational').prop("required",false);
          } else {
              $('#reserveUpdateForm #fieldmembershipmemofficname').hide();
              $('#reserveUpdateForm #field_membership').hide();
              $('#reserveUpdateForm #name_institution_label').hide();
              $('#reserveUpdateForm #name_associational_label').hide();
              $('#reserveUpdateForm #name_institution').hide();
              $('#reserveUpdateForm #name_associational').hide();
              $('#reserveUpdateForm #addMoreInsBtn').hide();
              $('#reserveUpdateForm #fieldmembershipname').hide();
              $('#reserveUpdateForm #addMoreAssocBtn').hide();
              $('#reserveUpdateForm #commonbondname').show();
              $('#reserveUpdateForm #compositionOfMembers1').show();
              $('#reserveUpdateForm #composition_of_members_label').show();
              $('#reserveUpdateForm select[name="compositionOfMembers[]"').show();
              $('#reserveUpdateForm #addMoreComBtn').show();
              $('#reserveUpdateForm #name_institution').prop("required",false);
              $('#reserveUpdateForm #field_membership').prop("required",false);
              $('#reserveUpdateForm #name_associational').prop("required",false);
          }
      });

    var id = $("#reserveUpdateForm #cooperativeID").val();
    var userid = $("#reserveUpdateForm #userID").val();
    $.ajax({
      type : "POST",
      url  : "../get_cooperative_info",
      dataType: "json",
      data : {
        id: id,
        user_id: userid
      },
      success: function(data){
          var cbom = data.common_bond_of_membership;
        
          if(cbom=='Institutional'){
              $('#reserveUpdateForm #fieldmembershipname').show();
              $('#reserveUpdateForm #field_membership').show();
              $('#reserveUpdateForm #name_institution_label').show();
              $('#reserveUpdateForm #name_institution').show();
              $('#reserveUpdateForm #addMoreInsBtn').show();
              $('#reserveUpdateForm #fieldmembershipmemofficname').hide();
              $('#reserveUpdateForm #composition_of_members_label').hide();
              $('#reserveUpdateForm #addMoreAssocBtn').hide();
              $('#reserveUpdateForm #addMoreComBtn').hide();
              $('#reserveUpdateForm #name_associational_label').hide();
              $('#reserveUpdateForm #compositionOfMembers').hide();
              $('#reserveUpdateForm #compositionOfMembers1').hide();
              $('#reserveUpdateForm .compositionRemoveBtn').hide();
          } else if(cbom=="Associational"){
              $('#reserveUpdateForm #fieldmembershipname').hide();
              $('#reserveUpdateForm #fieldmembershipmemofficname').show();
              $('#reserveUpdateForm #field_membership').show();
              $('#reserveUpdateForm #name_institution_label').hide();
              $('#reserveUpdateForm #name_institution').show();
  //            $('#reserveUpdateForm #addMoreAssocBtn').show();
              $('#reserveUpdateForm #name_associational_label').show();
              $('#reserveUpdateForm #composition_of_members_label').hide();
              $('#reserveUpdateForm #addMoreInsBtn').show();
              $('#reserveUpdateForm #addMoreComBtn').hide();
              $('#reserveUpdateForm #compositionOfMembers').hide();
              $('#reserveUpdateForm #compositionOfMembers1').hide();
              $('#reserveUpdateForm .compositionRemoveBtn').hide();
          } else if (cbom=="Occupational"){
              $('#reserveUpdateForm #fieldmembershipname').hide();
              $('#reserveUpdateForm #fieldmembershipmemofficname').hide();
              $('#reserveUpdateForm #field_membership').hide();
              $('#reserveUpdateForm #name_institution_label').hide();
              $('#reserveUpdateForm #name_institution').hide();
              $('#reserveUpdateForm #addMoreAssocBtn').hide();
              $('#reserveUpdateForm #composition_of_members_label').show();
              $('#reserveUpdateForm #addMoreInsBtn').hide();
              $('#reserveUpdateForm #name_associational_label').hide();
              $('#reserveUpdateForm #compositionOfMembers1').show();
              $('#reserveUpdateForm .compositionRemoveBtn').hide();
              $('#reserveUpdateForm #addMoreComBtn').show();
              $('#reserveUpdateForm select[name="compositionOfMembers[]"').show();
          } else {
              $('#reserveUpdateForm #fieldmembershipname').hide();
              $('#reserveUpdateForm #fieldmembershipmemofficname').hide();
              $('#reserveUpdateForm #field_membership').hide();
              $('#reserveUpdateForm #name_institution_label').hide();
              $('#reserveUpdateForm #name_institution').hide();
              $('#reserveUpdateForm #addMoreAssocBtn').hide();
              $('#reserveUpdateForm #composition_of_members_label').hide();
              $('#reserveUpdateForm #addMoreInsBtn').hide();
              $('#reserveUpdateForm #addMoreComBtn').hide();
              $('#reserveUpdateForm #name_associational_label').hide();
              $('#reserveUpdateForm #compositionOfMembers1').hide();
              $('#reserveUpdateForm #compositionOfMembers').hide();
          }
        if(data!=null){
          var tempCount = 0;
  //        alert(data.common_bond_of_membership);
       
          setTimeout( function(){
            $('#reserveUpdateForm #region').val(data.rCode);
            $('#reserveUpdateForm #region').trigger('change');
          },300);
          setTimeout( function(){
              $('#reserveUpdateForm #province').val(data.pCode);
              $('#reserveUpdateForm #province').trigger('change');
          },900);
          setTimeout(function(){
            $('#reserveUpdateForm #city').val(data.cCode);
            $('#reserveUpdateForm #city').trigger('change');
          },1500);
          setTimeout(function(){
            $('#reserveUpdateForm #barangay').val(data.bCode);
          },2500);
        
          $('#reserveUpdateForm #streetName').val(data.street);
          $('#reserveUpdateForm #blkNo').val(data.house_blk_no);
          // $('#reserveUpdateForm #categoryOfCooperative').val(data.category_of_cooperative);
          // $('#reserveUpdateForm #majorIndustry').trigger('change');
          // $('#reserveUpdateForm select[name="proposedBusinessActivity[]"').trigger('change');
          $('#reserveUpdateForm #commonBondOfMembership').val(data.common_bond_of_membership);
          $('#reserveUpdateForm #areaOfOperation').val(data.area_of_operation);
          /*if(data.composition_of_members =="Others"){
            $('#reserveUpdateForm #compositionOfMembers').val(data.composition_of_members);
            $('#reserveUpdateForm #compositionOfMembers').trigger('change');
            $('#reserveUpdateForm #compositionOfMembersSpecify').val(data.composition_of_members_others);
          }else{
            $('#reserveUpdateForm #compositionOfMembers').val(data.composition_of_members);
          }*/
        

          $('#reserveUpdateForm select[name="majorIndustry[]"').each(function(){
            if($(this).val() && ($(this).val()).length > 0){
              $(this).trigger('change');
              tempCount++;
            }
          });
          if(tempCount == $('#reserveUpdateForm select[name="majorIndustry[]"').length){
            $.ajax({
              type : "POST",
              url  : "../get_business_activities_of_coop",
              dataType: "json",
              data : {
                id: id
              },
              success: function(data){
                $('#reserveUpdateForm select[name="subClass[]"').each(function(index){
                  var temp = $(this);
                  setTimeout(function(){
                    $(temp).val(data[index].id);
                    $(temp).trigger('change');
                  },800);
                });
              }
            });
          }
        
          $("#reserveUpdateForm #proposedName").focus();
        
        }
      }
    });

    //end cooperative Update reservation validation
  });
    $('#reserveUpdateForm #addMoreInsBtn').on('click', function(){
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
      $("#reserveUpdateForm .col-com").append(divFormGroup);
    });
  $('#reserveUpdateForm #addMoreComBtn').on('click', function(){
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
    

      $(divFormGroup).append("<table width='100%'><tr><td width='90%'>",selectComposition,"</td><td width='10%'>",deleteSpan,"</td></tr></table>");
      $("#reserveUpdateForm .col-com").append(divFormGroup);
    });
  
 //     // START LABORATORY UPDATE

    var id = $("#reserveUpdateFormLaboratories #cooperativeID").val();
    var userid = $("#reserveUpdateFormLaboratories #userID").val();
    $.ajax({
      type : "POST",
      url  : "../get_cooperative_info",
      dataType: "json",
      data : {
        id: id,
        user_id: userid
      },
      success: function(data){
        //start
        console.log(data.area_of_operation);
          if(data!=null){
          var tempCount = 0;
          setTimeout( function(){
            $('#reserveUpdateFormLaboratories #region').val(data.rCode);
            $('#reserveUpdateFormLaboratories #region').trigger('change');
          },100);
          setTimeout( function(){
              $('#reserveUpdateFormLaboratories #province').val(data.pCode);
              $('#reserveUpdateFormLaboratories #province').trigger('change');
          },500);
          setTimeout(function(){
            $('#reserveUpdateFormLaboratories #city').val(data.cCode);
            $('#reserveUpdateFormLaboratories #city').trigger('change');
          },1000);
          setTimeout(function(){
            $('#reserveUpdateFormLaboratories #barangay').val(data.bCode);
            if(data.area_of_operation=='Barangay'){
              // alert(data.area_of_operation);
              $('#reserveUpdateFormLaboratories #barangay').prop("disabled",true);
              $('#reserveUpdateFormLaboratories #city').prop("disabled",true);
              $('#reserveUpdateFormLaboratories #province').prop("disabled",true);
              $('#reserveUpdateFormLaboratories #region').prop("disabled",true);
            }else if(data.area_of_operation=='Municipality/City'){
              // alert(data.area_of_operation);
              $('#reserveUpdateFormLaboratories #city').prop("disabled",true);
              $('#reserveUpdateFormLaboratories #province').prop("disabled",true);
              $('#reserveUpdateFormLaboratories #region').prop("disabled",true);
              $('#reserveUpdateFormLaboratories #barangay').prop("disabled",false);
            }else if(data.area_of_operation=='Provincial'){
                 // alert('Provincial');
              $('#reserveUpdateFormLaboratories #province').prop("disabled",true);
              $('#reserveUpdateFormLaboratories #region').prop("disabled",true);
              $('#reserveUpdateFormLaboratories #city').prop("disabled",false);
              $('#reserveUpdateFormLaboratories #barangay').prop("disabled",false);
            }else if(data.area_of_operation=='Regional'){

                // alert(data.area_of_operation);
              $('#reserveUpdateFormLaboratories #region').prop("disabled",true);
              $('#reserveUpdateFormLaboratories #province').prop("disabled",false);
              $('#reserveUpdateFormLaboratories #city').prop("disabled",false);
              $('#reserveUpdateFormLaboratories #barangay').prop("disabled",false);
            }else if(data.area_of_operation=='National'){
              // alert(data.area_of_operation);
              $('#reserveUpdateFormLaboratories #region').prop("disabled",false);
              $('#reserveUpdateFormLaboratories #province').prop("disabled",false);
              $('#reserveUpdateFormLaboratories #city').prop("disabled",false);
              $('#reserveUpdateFormLaboratories #barangay').prop("disabled",false);
            }

          },1700); 


        } //end if
        //end

        // if(data!=null){
        //   var tempCount = 0;
        //   setTimeout( function(){
        //     $('#reserveUpdateFormLaboratories #region').val(data.rCode);
        //     $('#reserveUpdateFormLaboratories #region').trigger('change');
        //   },300);
        //   setTimeout( function(){
        //       $('#reserveUpdateFormLaboratories #province').val(data.pCode);
        //       $('#reserveUpdateFormLaboratories #province').trigger('change');
        //   },900);
        //   setTimeout(function(){
        //     $('#reserveUpdateFormLaboratories #city').val(data.cCode);
        //     $('#reserveUpdateFormLaboratories #city').trigger('change');
        //   },1500);
        //   setTimeout(function(){
        //     $('#reserveUpdateFormLaboratories #barangay').val(data.bCode);
        //   },2500);
        
        //   $('#reserveUpdateFormLaboratories #streetName').val(data.street);
        //   $('#reserveUpdateFormLaboratories #blkNo').val(data.house_blk_no);
        //   // $('#reserveUpdateForm #categoryOfCooperative').val(data.category_of_cooperative);
        //   // $('#reserveUpdateForm #majorIndustry').trigger('change');
        //   // $('#reserveUpdateForm select[name="proposedBusinessActivity[]"').trigger('change');
        //   $('#reserveUpdateFormLaboratories #commonBondOfMembership').val(data.common_bond_of_membership);
        //   $('#reserveUpdateFormLaboratories #areaOfOperation').val(data.area_of_operation);
        //   if(data.composition_of_members =="Others"){
        //     $('#reserveUpdateForm #compositionOfMembers').val(data.composition_of_members);
        //     $('#reserveUpdateForm #compositionOfMembers').trigger('change');
        //     $('#reserveUpdateForm #compositionOfMembersSpecify').val(data.composition_of_members_others);
        //   }else{
        //     $('#reserveUpdateForm #compositionOfMembers').val(data.composition_of_members);
        //   }
        

        //   $('#reserveUpdateFormLaboratories select[name="majorIndustry[]"').each(function(){
        //     if($(this).val() && ($(this).val()).length > 0){
        //       $(this).trigger('change');
        //       tempCount++;
        //     }
        //   });
        //   if(tempCount == $('#reserveUpdateFormLaboratories select[name="majorIndustry[]"').length){
        //     $.ajax({
        //       type : "POST",
        //       url  : "../get_business_activities_of_coop",
        //       dataType: "json",
        //       data : {
        //         id: id
        //       },
        //       success: function(data){
        //         $('#reserveUpdateFormLaboratories select[name="subClass[]"').each(function(index){
        //           var temp = $(this);
        //           setTimeout(function(){
        //             $(temp).val(data[index].id);
        //             $(temp).trigger('change');
        //           },800);
        //         });
        //       }
        //     });
        //   }
        
        //   $("#reserveUpdateFormLaboratories #proposedName").focus();
        // }
      }//end of success function
    });


  $('#reserveUpdateFormLaboratories #region').on('change',function(){
      $('#reserveUpdateFormLaboratories #province').empty();
      $("#reserveUpdateFormLaboratories #province").prop("disabled",true);
      $('#reserveUpdateFormLaboratories #city').empty();
      $("#reserveUpdateFormLaboratories #city").prop("disabled",true);
      $('#reserveUpdateFormLaboratories #barangay').empty();
      $("#reserveUpdateFormLaboratories #barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#reserveUpdateForm #province").prop("disabled",false);
        var region = $(this).val();
          $.ajax({
          type : "POST",
          url  : "../../api/provinces",
          dataType: "json",
          data : {
            region: region
          },
          success: function(data){
            $('#reserveUpdateFormLaboratories #province').append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $('#reserveUpdateFormLaboratories #province').append($('<option></option>').attr('value',value.provCode).text(value.provDesc));
            });
          }
        });
      }
    });

    $('#reserveUpdateFormLaboratories #province').on('change',function(){
      $('#reserveUpdateFormLaboratories #city').empty();
      $("#reserveUpdateFormLaboratories #city").prop("disabled",true);
      $('#reserveUpdateFormLaboratories #barangay').empty();
      $("#reserveUpdateFormLaboratories #barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#reserveUpdateForm #city").prop("disabled",false);
        var province = $(this).val();
          $.ajax({
          type : "POST",
          url  : "../../api/cities",
          dataType: "json",
          data : {
            province: province
          },
          success: function(data){
            $('#reserveUpdateFormLaboratories #city').append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $('#reserveUpdateFormLaboratories #city').append($('<option></option>').attr('value',value.citymunCode).text(value.citymunDesc));
            });
          }
        });
      }
    });

    $('#reserveUpdateFormLaboratories #city').on('change',function(){
      $('#reserveUpdateFormLaboratories #barangay').empty();
      $("#reserveUpdateFormLaboratories #barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#reserveUpdateFormLaboratories #barangay").prop("disabled",false);
        var cities = $(this).val();
          $.ajax({
          type : "POST",
          url  : "../../api/barangays",
          dataType: "json",
          data : {
            cities: cities
          },
          success: function(data){
            $('#reserveUpdateFormLaboratories #barangay').append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $('#reserveUpdateFormLaboratories #barangay').append($('<option></option>').attr('value',value.brgyCode).text(value.brgyDesc));
            });
          }
        });
      }
    });


    $("#reserveUpdateFormLaboratories #reserveUpdateAgree").click(function(){
      if($(this).is(':checked')){
        $('#reserveUpdateFormLaboratories #reserveUpdateBtn').removeAttr('disabled');
      }else{
        $('#reserveUpdateFormLaboratories #reserveUpdateBtn').attr('disabled','disabled');
      }
    });
  
    // END LABORATORY UPDATE

