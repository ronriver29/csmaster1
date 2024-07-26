$(function(){
  if($('#termsAndConditionModal').length){
    $('#termsAndConditionModal').modal('show');
  }

  var id = $("#reserveUpdateForm #cooperativeID").val();
  var userid = $("#reserveUpdateForm #userID").val();
  $.ajax({
    type : "POST",
    url : $('body').attr('data-baseurl') + "get_cooperative_info",
    dataType: "json",
    data : {
      id: id,
      user_id: userid
    },
    success: function(data){
      if(data!=null){
        var tempCount = 0;
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
            url : $('body').attr('data-baseurl') + "get_business_activities_of_coop",
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


