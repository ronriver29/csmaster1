$(function(){
  if($('#termsAndConditionModal').length){
    $('#termsAndConditionModal').modal('show');
  }

  $('#reserveBranchUpdateForm #regNo').ready(function(){

    var coopName = $('#coopName').val();
    var regNo = $('#regNo').val();

    $("#reserveBranchUpdateForm .-row-your-boat").remove();


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
            var deleteSpan = $().attr({'class':'customDeleleBtn businessRemoveBtn float-right text-danger'}).click(function(){
              $(this).parent().remove();
              $('#reserveBranchUpdateForm input[name="MI[]"').each(function(index){
                $(this).siblings('label').text("Major Industry Classification No. " + (index+1));
              });
              $('#reserveBranchUpdateForm input[name="SC[]"').each(function(index){
                $(this).siblings('label').text("Major Industry Classification No. " + (index+1) +' Subclass');
              });
            });
            // alert(value.mdesc);
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
            
            $("#reserveBranchUpdateForm .col-industry-subclass").append(divRow1);
//            $("#branchAddForm .col-industry-subclass").prop("disabled",true);
            

        }
      }
    });
  });

  var id = $("#reserveBranchUpdateForm #cooperativeID").val();
  var userid = $("#reserveBranchUpdateForm #userID").val();
  $.ajax({
    type : "POST",
    url : $('body').attr('data-baseurl') + "get_branch_info",
    dataType: "json",
    data : {
      id: id,
      user_id: userid
    },
    success: function(data){
      if(data!=null){
        var tempCount = 0;
        // setTimeout( function(){
        //   $('#reserveBranchUpdateForm #region').val(data.rCode);
        //   $('#reserveBranchUpdateForm #region2').val(data.rCode);
        //   $('#reserveBranchUpdateForm #region').trigger('change');
        // },500);
        // setTimeout( function(){
        //     $('#reserveBranchUpdateForm #province').val(data.pCode);
        //     $('#reserveBranchUpdateForm #province').trigger('change');
        // },1500);
        // setTimeout(function(){
        //   $('#reserveBranchUpdateForm #city').val(data.cCode);
        //   $('#reserveBranchUpdateForm #city').trigger('change');
        // },2500);
        // setTimeout(function(){
        //   $('#reserveBranchUpdateForm #barangay').val(data.bCode);
        // },3500);
        
        $('#reserveBranchUpdateForm #streetName').val(data.street);
        $('#reserveBranchUpdateForm #blkNo').val(data.house_blk_no);
        // $('#reserveBranchUpdateForm #categoryOfCooperative').val(data.category_of_cooperative);
        // $('#reserveBranchUpdateForm #majorIndustry').trigger('change');
        // $('#reserveBranchUpdateForm select[name="proposedBusinessActivity[]"').trigger('change');
        $('#reserveBranchUpdateForm #commonBondOfMembership').val(data.common_bond_of_membership);
        $('#reserveBranchUpdateForm #areaOfOperation').val(data.area_of_operation);
        /*if(data.composition_of_members =="Others"){
          $('#reserveBranchUpdateForm #compositionOfMembers').val(data.composition_of_members);
          $('#reserveBranchUpdateForm #compositionOfMembers').trigger('change');
          $('#reserveBranchUpdateForm #compositionOfMembersSpecify').val(data.composition_of_members_others);
        }else{
          $('#reserveBranchUpdateForm #compositionOfMembers').val(data.composition_of_members);
        }*/
        var area = data.aoo;
//        $('#reserveBranchUpdateForm #areaOfOperation').on('change', function(){
//          area=$('#areaOfOperation').val();
          if(area=='Barangay'){
            $("#reserveBranchUpdateForm #barangay").prop("disabled",true);
            $("#reserveBranchUpdateForm #city").prop("disabled",true);
            $("#reserveBranchUpdateForm #province").prop("disabled",true);
            $("#reserveBranchUpdateForm #region").prop("disabled",true);
          }else if (area=='Municipality/City') {
            $("#reserveBranchUpdateForm #barangay").prop("disabled",false);
            $("#reserveBranchUpdateForm #city").prop("disabled",true);
            $("#reserveBranchUpdateForm #province").prop("disabled",true);
            $("#reserveBranchUpdateForm #region").prop("disabled",true);   
          }else if (area=='Provincial'){
            $("#reserveBranchUpdateForm #barangay").prop("disabled",false);
            $("#reserveBranchUpdateForm #city").prop("disabled",false);
            $("#reserveBranchUpdateForm #province").prop("disabled",true);
            $("#reserveBranchUpdateForm #region").prop("disabled",true);
          }else if(area=='Regional'){
            $("#reserveBranchUpdateForm #barangay").prop("disabled",false);
            $("#reserveBranchUpdateForm #city").prop("disabled",false);
            $("#reserveBranchUpdateForm #province").prop("disabled",false);
            $("#reserveBranchUpdateForm #region").prop("disabled",true);
          }else{
            $("#reserveBranchUpdateForm #barangay").prop("disabled",false);
            $("#reserveBranchUpdateForm #city").prop("disabled",false);
            $("#reserveBranchUpdateForm #province").prop("disabled",false);
            $("#reserveBranchUpdateForm #region").prop("disabled",false);
          }
//        });

        $('#reserveBranchUpdateForm select[name="majorIndustry[]"').each(function(){
          if($(this).val() && ($(this).val()).length > 0){
            $(this).trigger('change');
            tempCount++;
          }
        });
        // if(tempCount == $('#reserveBranchUpdateForm select[name="majorIndustry[]"').length){
        //   $.ajax({
        //     type : "POST",
        //     url  : "../get_business_activities_of_coop",
        //     dataType: "json",
        //     data : {
        //       id: id
        //     },
        //     success: function(data){
        //       $('#reserveBranchUpdateForm select[name="subClass[]"').each(function(index){
        //         var temp = $(this);
        //         setTimeout(function(){
        //           $(temp).val(data[index].id);
        //           $(temp).trigger('change');
        //         },800);
        //       });
        //     }
        //   });
        // }
        
        $("#reserveBranchUpdateForm #proposedName").focus();
      }
    }
  });

  //end cooperative Update reservation validation
});

// Anj
$('#reserveBranchUpdateForm #region').on('change',function(){
  $('#reserveBranchUpdateForm #province').empty();
  $('#reserveBranchUpdateForm #city').empty();
  $('#reserveBranchUpdateForm #barangay').empty();
});

$('#reserveBranchUpdateForm #province').on('change',function(){
  $('#reserveBranchUpdateForm #city').empty();
  $('#reserveBranchUpdateForm #barangay').empty();
});

$('#reserveBranchUpdateForm #city').on('change',function(){
  $('#reserveBranchUpdateForm #barangay').empty();
});
// End Anj

$('#reserveBranchUpdateForm #addMoreComBtn').on('click', function(){
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
    $("#reserveBranchUpdateForm .col-com").append(divFormGroup);
  });


