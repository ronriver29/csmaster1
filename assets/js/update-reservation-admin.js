$(function(){
  if($('#termsAndConditionModal').length){
    $('#termsAndConditionModal').modal('show');
  }
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
