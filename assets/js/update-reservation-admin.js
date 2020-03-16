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
    url  : "../get_cooperative_info_by_admin",
    dataType: "json",
    data : {
      id: id
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
        $('#reserveUpdateForm #categoryOfCooperative').val(data.category_of_cooperative);
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
        setTimeout( function(){
          $('#reserveUpdateForm #region').val(data.rCode);
          $('#reserveUpdateForm #region').trigger('change');
        },300);
        setTimeout( function(){
            $('#reserveUpdateForm #province').val(data.pCode);
            $('#reserveUpdateForm #province').trigger('change');
        },700);
        setTimeout(function(){
          $('#reserveUpdateForm #city').val(data.cCode);
          $('#reserveUpdateForm #city').trigger('change');
        },1000);
        setTimeout(function(){
          $('#reserveUpdateForm #barangay').val(data.bCode);
          $('#reserveUpdateForm #barangay').trigger('change');
        },1400);
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
