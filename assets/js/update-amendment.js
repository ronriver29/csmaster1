$(function(){
    
// $('#reserveUpdateForm #categoryOfCooperative').on('change', function(){
//     var categorycoop = $(this).val();

//     if(categorycoop=="Primary"){
//         $('#reserveUpdateForm #coopbank').hide();
//     } else {
//         $('#reserveUpdateForm #coopbank').show();
//     }
// });

  $("#reserveUpdateForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
        alert(status);
          if(status==true){
            if($("#reserveUpdateForm #amendmentAddLoadingBtn").length <= 0){
              $("#reserveUpdateForm  #reserveUpdateBtn2").hide();
              $("#reserveUpdateForm  .col-branch-btn").append($('<button></button>').attr({'id':'branchAddLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
            }else{
              return false;
            }
          }else{
            return false;
          }
        }
  });

 $("#reserveUpdateForm #reserveUpdateAgree").click(function(event){
  // event.preventDefault();
    if($(this).is(':checked')){
      // $('#reserveUpdateForm #reserveUpdateBtn2').removeAttr('disabled');
      $('#reserveUpdateBtn2').prop("disabled", false); // Element(s) are now enabled.
    }else{
      $('#reserveUpdateForm #reserveUpdateBtn2').attr('disabled','disabled');
    }
  });


 

  // load type coop modified
  if($("#reserveUpdateForm #typeOfCooperatives").val().length>0)
        {
          var val1=[]; 
            $('select[name="typeOfCooperative[]"] option:selected').each(function() {
               val1.push($(this).val());
      
           $('#reserveUpdateForm #typeOfCooperative_value').val(val1);
          });
  }
  //end load modified


}); //end of $ Function

var id = $("#reserveUpdateForm #Amendment_ID").val();
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
      // alert(data.cooperative_id);
     var cbom = data.common_bond_of_membership;
      $("#cooperative_idss").val(data.cooperative_id);
    if(data.common_bond_of_membership == 'Occupational')
        {
           
            $("#occupational-div").show();
        }
        else if(data.common_bond_of_membership == 'Institutional')
        {
          $("#institutional-wrapper").show();
          $("#ins_field_membership").val(data.field_of_membership);
          var ustr = data.name_of_ins_assoc;
          var astr = ustr.split(',');  
          $.each(astr, function(i,row) {
            var x =1;
            var htmlField = '<div class="list_product"><input type="text" name="name_ins_assoc[]" id="name_ins_assoc" class="form-control" style="margin-bottom:3px;" value="'+row+'"> <a class="customDeleleBtn compositionRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a></div> ';
                $(".con-wrapper").append(htmlField);   
            $('#reserveUpdateForm .compositionRemoveBtn').on('click',function(){
              $(this).closest('.list_product').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
            });
       
          });
             $("#reserveUpdateForm #name_institutional").val(data.name_of_ins_assoc); 
        }

        else if(data.common_bond_of_membership == 'Associational')
        {
          
          $("#reserveUpdateForm #associational-wrapper").show()
          $("#occupational-div").remove();
          $("#institutional-wrapper").remove();

          $("#assoc_field_membership").val(data.field_of_membership);
          var ustr = data.name_of_ins_assoc;
          var astr = ustr.split(',');  
          $.each(astr, function(i,row) {
            var x =1;
            var htmlField = '<div class="list_assoc"><input type="text" name="name_associational[]" id="name_associational" class="form-control" style="margin-bottom:3px;" value="'+row+'"> <a class="customDeleleBtn compositionRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a></div> ';
                $(".assoc-wrapper").append(htmlField);   
            $('#reserveUpdateForm .compositionRemoveBtn').on('click',function(){
              $(this).closest('.list_assoc').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
            });
       
          });
             $("#reserveUpdateForm #name_institutional").val(data.name_of_ins_assoc); 
        }


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
        if(data.composition_of_members =="Others"){
          $('#reserveUpdateForm #compositionOfMembers').val(data.composition_of_members);
          $('#reserveUpdateForm #compositionOfMembers').trigger('change');
          $('#reserveUpdateForm #compositionOfMembersSpecify').val(data.composition_of_members_others);
        }else{
          $('#reserveUpdateForm #compositionOfMembers').val(data.composition_of_members);
        }
        

        $('#reserveUpdateForm select[name="majorIndustry[]"').each(function(){
          if($(this).val() && ($(this).val()).length > 0){
            $(this).trigger('change');
            tempCount++;
          }
        });
        if(tempCount == $('#reserveUpdateForm select[name="majorIndustry[]"').length){
          alert(id);
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
        
      }//end if data null
    } //end success
  }); //end ajax get_cooperative info
