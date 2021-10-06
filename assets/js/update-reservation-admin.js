$(function(){

$('#reserveUpdateForm #acronymnameerr').hide();
    document.getElementById("proposedName").maxLength = "61";
   
  $('#reserveUpdateForm #proposedName').on('change',function(){
    document.getElementById('acronymname').value = '';
    var value = document.getElementById("proposedName").value;
    var totalval = 61 - value.length; 
    if(totalval == 0){
      $("#reserveUpdateForm #acronymname").prop("disabled",true);
      $('#reserveUpdateForm #acronymnameerr').show();
    } else {
      $('#reserveUpdateForm #acronymnameerr').hide();
      $("#reserveUpdateForm #acronymname").prop("disabled",false);
    }
    document.getElementById("acronymname").maxLength = totalval;
  });
  
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
    url  : "../get_cooperative_info_by_admin",
    dataType: "json",
    data : {
      id: id
    },
    success: function(data){
        var cbom = data.common_bond_of_membership;
        if(data.grouping =='Federation' || (data.grouping == 'Union' && data.type_of_cooperative == 'Union')){
          $('#reserveUpdateForm .col-industry-subclass').hide();
          $('#reserveUpdateForm #addMoreSubclassBtn').hide();
        } else {
          $('#reserveUpdateForm .col-industry-subclass').show();
          $('#reserveUpdateForm #addMoreSubclassBtn').show();
        }
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
        // $('#reserveUpdateForm #categoryOfCooperative').val(data.category_of_cooperative);
        // $('#reserveUpdateForm #majorIndustry').trigger('change');
        // $('#reserveUpdateForm select[name="proposedBusinessActivity[]"').trigger('change');
        $('#reserveUpdateForm #commonBondOfMembership').val(data.common_bond_of_membership);
        $('#reserveUpdateForm #areaOfOperation').val(data.area_of_operation);
        if(data.composition_of_members =="Others"){
          $('#reserveUpdateForm #compositionOfMembers').val(data.composition_of_members);
          $('#reserveUpdateForm #compositionOfMembers').trigger('change');
          $('#reserveUpdateForm #compositionOfMembersSpecify').val(data.composition_of_members_others);
        }else{
          $('#reserveUpdateForm #compositionOfMembers').val(data.composition_of_members);
        }
        // setTimeout( function(){
        //   $('#reserveUpdateForm #region').val(data.rCode);
        //   $('#reserveUpdateForm #region').trigger('change');
        // },300);
        // setTimeout( function(){
        //     $('#reserveUpdateForm #province').val(data.pCode);
        //     $('#reserveUpdateForm #province').trigger('change');
        // },700);
        // setTimeout(function(){
        //   $('#reserveUpdateForm #city').val(data.cCode);
        //   $('#reserveUpdateForm #city').trigger('change');
        // },1000);
        // setTimeout(function(){
        //   $('#reserveUpdateForm #barangay').val(data.bCode);
        //   $('#reserveUpdateForm #barangay').trigger('change');
        // },1400);
        $('#reserveUpdateForm #streetName').val(data.street);
        $('#reserveUpdateForm #blkNo').val(data.house_blk_no);

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
                },400);
              });
              $("#reserveUpdateForm #proposedName").focus();
            }
          });
        }
      }
    }
  });
  //end cooperative Update reservation validation
});


// $(function(){
//   var id = $("#reserveUpdateForm #cooperativeID").val();
//   $.ajax({
//     type : "POST",
//     url  : "../get_cooperative_info_by_admin",
//     dataType: "json",
//     data : {
//       id: id
//     },
//     success: function(data){
//     if(data!=null){
//         var tempCount = 0;
//         $('#reserveUpdateForm #categoryOfCooperative').val(data.category_of_cooperative);
//         $('#reserveUpdateForm select[name="proposedBusinessActivity[]"').trigger('change');
//         $('#reserveUpdateForm #commonBondOfMembership').val(data.common_bond_of_membership);
//         $('#reserveUpdateForm #areaOfOperation').val(data.area_of_operation);
//         if(data.composition_of_members =="Others"){
//           $('#reserveUpdateForm #compositionOfMembers').val(data.composition_of_members);
//           $('#reserveUpdateForm #compositionOfMembers').trigger('change');
//           $('#reserveUpdateForm #compositionOfMembersSpecify').val(data.composition_of_members_others);
//         }else{
//           $('#reserveUpdateForm #compositionOfMembers').val(data.composition_of_members);
//         }
//         setTimeout( function(){
//           $('#reserveUpdateForm #region').val(data.rCode);
//           $('#reserveUpdateForm #region').trigger('change');
//         },300);
//         setTimeout( function(){
//             $('#reserveUpdateForm #province').val(data.pCode);
//             $('#reserveUpdateForm #province').trigger('change');
//         },700);
//         setTimeout(function(){
//           $('#reserveUpdateForm #city').val(data.cCode);
//           $('#reserveUpdateForm #city').trigger('change');
//         },1000);
//         setTimeout(function(){
//           $('#reserveUpdateForm #barangay').val(data.bCode);
//           $('#reserveUpdateForm #barangay').trigger('change');
//         },1400);
//         $('#reserveUpdateForm #streetName').val(data.street);
//         $('#reserveUpdateForm #blkNo').val(data.house_blk_no);
//
//         $('#reserveUpdateForm select[name="proposedBusinessActivity[]"').each(function(){
//           if($(this).val() && ($(this).val()).length > 0){
//             tempCount++;
//           }
//         });
//         if(tempCount == $('#reserveUpdateForm select[name="proposedBusinessActivity[]"').length){
//           console.log("equal");
//           $.ajax({
//             type : "POST",
//             url  : "../get_business_activities_of_coop",
//             dataType: "json",
//             data : {
//               id: id
//             },
//             success: function(data){
//               $('#reserveUpdateForm select[name="proposedBusinessActivitySubtype[]"').each(function(index){
//                 var temp = $(this);
//                 setTimeout(function(){
//                   $(temp).val(data[index].bactivitysubtype_id);
//                   $(temp).trigger('change');
//                 },400);
//               });
//               $("#reserveUpdateForm #proposedName").focus();
//             }
//           });
//         }
//       }
//     }
//   });
//   //end cooperative Update reservation validation
// });

// Jiee
    var areaOfOperation = $("#reserveUpdateForm #areaOfOperation2").val();
    // alert(areaOfOperation);
    if(areaOfOperation == 'Interregional'){
      $('#reserveUpdateForm #interregional').show();
      $('#reserveUpdateForm #regions').show();
      $('#reserveUpdateForm #selectisland').show();
      $('#reserveUpdateForm #selectregion').show();
      $(".select-island").each(function(){
          $(this).select2({
                template: "bootstrap",
                multiple: true,
                tagging: true,
                allowClear: true,
                placeholder: "Select island"
            });
          });
      $(".select-region").each(function(){
          $(this).select2({
              template: "bootstrap",
              multiple: true,
              tagging: true,
              allowClear: true,
              placeholder: "Select region"
          });
      });
    } else {
      $('#reserveUpdateForm #interregional').hide();
      $('#reserveUpdateForm #regions').hide();
      $('#reserveUpdateForm #selectisland').hide();
      $('#reserveUpdateForm #selectregion').hide();
    }
    

    $('#reserveUpdateForm #areaOfOperation').on('change',function(){
      $('#reserveUpdateForm #region').empty();
      $('#reserveUpdateForm #regions').empty();
      var areaOfOperation = $(this).val();
      if(areaOfOperation == "Interregional"){
        $('#reserveUpdateForm #region').empty();
        $('#reserveUpdateForm #interregional').show();
        $('#reserveUpdateForm #regions').show();
        $('#reserveUpdateForm #selectisland').show();
        $('#reserveUpdateForm #selectregion').show();
        $(".select-island").each(function(){
          $(this).select2({
                template: "bootstrap",
                multiple: true,
                tagging: true,
                allowClear: true,
                placeholder: "Select island"
            });
          });
        $(".select-region").each(function(){
          $(this).select2({
              template: "bootstrap",
              multiple: true,
              tagging: true,
              allowClear: true,
              placeholder: "Select region"
          });
      });
      } else {
        $('#reserveUpdateForm #region').empty();
        $('#reserveUpdateForm #interregional').hide();
        $('#reserveUpdateForm #regions').hide();
        $('#reserveUpdateForm #selectisland').hide();
        $('#reserveUpdateForm #selectregion').hide();

        $.ajax({
              type : "GET",
              url  : "../../api/regions",
              dataType: "json",
              success: function(data){
                $('#reserveUpdateForm #region').append($('<option></option>').attr('value',"").text(""));
                $.each(data, function(key,value){
                  $('#reserveUpdateForm #region').append($('<option></option>').attr('value',value.regCode).text(value.regDesc));
                });
            }
          });
      }
    });

    $('#reserveUpdateForm #interregional').on('change',function(){
      // alert($(this).val().length);
      if($(this).val().length <= 2){
        // alert($(this).val());
        $('#reserveUpdateForm #region').empty();
        $('#reserveUpdateForm #regions').empty();
        $('#reserveUpdateForm #province').empty();
        $("#reserveUpdateForm #province").prop("disabled",true);
        $('#reserveUpdateForm #city').empty();
        $("#reserveUpdateForm #city").prop("disabled",true);
        $('#reserveUpdateForm #barangay').empty();
        $("#reserveUpdateForm #barangay").prop("disabled",true);
        if($(this).val() && ($(this).val()).length > 0){
          $("#reserveUpdateForm #province").prop("disabled",false);
          var interregional = $(this).val();
            $.ajax({
            type : "POST",
            url  : "../../api/islands",
            dataType: "json",
            data : {
              interregional: interregional
            },
            success: function(data){
              // $('#reserveAddForm #regions').append($('<option></option>').attr('value',"").text(""));
              $.each(data, function(key,value){
                $('#reserveUpdateForm #regions').append($('<option></option>').attr('value',value.region_code).text(value.regDesc));
              });
            }
          });
        }
      } else {
        $('#reserveUpdateForm #interregional').removeAttr("selected");;
        alert("Maximum of 2 Island.");
      }
    });

    $('#reserveUpdateForm #regions').on('change',function(){
      // alert($(this).val());
      $('#reserveUpdateForm #region').empty();
      $("#reserveUpdateForm #province").prop("disabled",true);
      $('#reserveUpdateForm #city').empty();
      $("#reserveUpdateForm #city").prop("disabled",true);
      $('#reserveUpdateForm #barangay').empty();
      $("#reserveUpdateForm #barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#reserveUpdateForm #province").prop("disabled",false);
        var regions = $(this).val();
          $.ajax({
          type : "POST",
          url  : "../../api/regions",
          dataType: "json",
          data : {
            regions: regions
          },
          success: function(data){
            $('#reserveUpdateForm #region').append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $('#reserveUpdateForm #region').append($('<option></option>').attr('value',value.regCode).text(value.regDesc));
            });
          }
        });
      }
    });
  // End Jiee

