$(function(){
    
$('#reserveUpdateForm #categoryOfCooperative').on('change', function(){
    var categorycoop = $(this).val();

    if(categorycoop=="Primary"){
        $('#reserveUpdateForm #coopbank').hide();
    } else {
        $('#reserveUpdateForm #coopbank').show();
    }
});

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

// $('#reserveUpdateForm').validationEngine('attach',{
//     onValidationComplete: function(form, status){

//         if (status == true){
//             $("#reserveUpdateForm").submit();
//             return true;
//         }

//     }
// });
//agree
 $("#reserveUpdateForm #reserveUpdateAgree").click(function(event){
  // event.preventDefault();
    if($(this).is(':checked')){
      // alert("adfad")
      $('#reserveUpdateBtn2').removeAttr('disabled');
      // $('#reserveUpdateForm #reserveUpdateBtn2').prop("disabled", false); // Element(s) are now enabled.
    }else{
      $('#reserveUpdateForm #reserveUpdateBtn').attr('disabled','disabled');
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

  var id = $("#reserveUpdateForm #Amendment_ID").val();
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
        //modified by json
         //  var strCoopType =data.type_of_cooperative;
         //  var arrayCooptype = strCoopType.split(',');
         //  var countType =arrayCooptype.length;
          
         //  $("#count_types").val(countType)
         // if($("#count_types").val()>1)
         // {
         //      $name_ = $("#new_name2").val()+' Multipurpose';
         //      $("#proposedName").val($name_);
         //       // $("#type_of_coop").text('Multi-Purpose');
         // }
      // Cooperative type
 
      
     
          // var type_coop = data.type_of_cooperative;
          // var coop_type = type_coop.split(',');  
          // $.each(coop_type, function(a,b) {
          //   var htmlcoopType = '<div class="list_cooptype"><select class="custom-select coop-tpyeOf validate[required]" name="typeOfCooperative[]" id="typeOfCooperative"></select> <a class="customDeleleBtn compositionRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a></div> ';
          //   $(".coop_type-wrapper").append(htmlcoopType);   
          //   $('.TypeCoopRemoveBtn').on('click',function(){
          //   $(this).closest('.list_cooptype').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
          //   });
      
          // });


          

      
     /////END COOPERATIVE TYPE 

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

///remove type coop
   $('#reserveUpdateForm .TypeCoopRemoveBtn').on('click',function(){

            $(this).closest('.list_cooptype').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
            //modified by json
             var count_types = $("#count_types").val();
             var less_count_type = parseInt(count_types-1);
             // alert(less_count_type);       
             $("#reserveUpdateForm #count_types").val(less_count_type);
              if($("#count_types").val()<=1)
               {

               $("#reserveUpdateForm #type_of_coop").text('');
             }
        });
//end remove type coop


function load_option(cooptype)
{
   var optValue='';
             $.ajax({
                  type : "GET",
                  url : $('body').attr('data-baseurl') + "coop_type",
                  dataType: "json",
                  success: function(resCoop)
                  {
                    $.each(resCoop, function(i,j){
                      // console.log(j.coop_type_id);
                      // console.log(j.coop_type_name);
                          optValue +='<option value="'+j.coop_type_name+'">'+j.coop_type_name+' </option>';
                    });
                    
                  }

             });
             cooptype.html(optValue);
}


  $('#reserveUpdateForm #addMoreInsBtn').on('click', function(){
    var lastCountOfcom = $('#reserveUpdateForm #name_institution').last().attr('id');
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
// $('#reserveUpdateForm #addMoreComBtn').on('click', function(){
//     var lastCountOfcom = $('select[name="compositionOfMembers[]"').last().attr('id');
//     intLastCount = parseInt(lastCountOfcom.substr(-1));
//     var divFormGroup= $('<div></div>').attr({'class':'form-group'});
//     var selectComposition = $('<select></select>').attr({'class': 'custom-select form-control validate[required]','name': 'compositionOfMembers[]', 'id': 'compositionOfMembers' + (intLastCount + 1)}).prop("disabled",false);
//     var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn compositionRemoveBtn float-right text-danger'}).click(function(){
//         $(this).parent().remove();
//       });

//     $.ajax({
//       type : "POST",
//       url  : "composition",
//       dataType: "json",
      
//       success: function(data){
//           $(selectComposition).append($('<option></option>').attr('value',"").text(""));
//           $.each(data, function(key,value){
//             $(selectComposition).append($('<option></option>').attr('value',value.composition).text(value.composition));
//           });
//       }
//     });
    

//     $(divFormGroup).append("<table width='100%'><tr><td width='90%'>",selectComposition,"</td><td width='10%'>",deleteSpan,"</td></tr></table>");
//     $("#reserveUpdateForm .col-com").append(divFormGroup);
//   });

//modify by json
$('#reserveUpdateForm .compositionRemoveBtne').on('click',function(){
              $(this).closest('.com-div').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
});
//end modify 


$('#reserveUpdateForm #commonBondOfMembership').on('change', function(){
    var this_value= $(this).val();
  
     if(this_value == 'Occupational')
        {
            $("#occupational-wrapper").show();
            $("#institutional-wrapper").hide();    
            $('.list_product').remove();
            $('#ins_field_membership').remove();
        }
        else if(this_value== 'Institutional')
        {
          $("#reserveUpdateForm #institutional-wrapper").show();
          // $("#ins_field_membership").val(data.field_of_membership);
        
            var htmlField = '<div class="list_product"><input type="text" name="name_ins_assoc[]" id="name_ins_assoc" class="form-control" style="margin-bottom:3px;" value="'+row+'"> <a class="customDeleleBtn compositionRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a></div> ';
                $(".con-wrapper").append(htmlField);   
            $('.compositionRemoveBtn').on('click',function(){
              $(this).closest('.list_product').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
            });
        }
        else if(this_value == 'Associational')
        {

          // $("#associational-wrapper").show()

          // $("#assoc_field_membership").val(data.field_of_membership);
          // var ustr = data.name_of_ins_assoc;
          // var astr = ustr.split(',');  
          // $.each(astr, function(i,row) {
          //   var x =1;
          //   var htmlField = '<div class="list_assoc"><input type="text" name="name_associational[]" id="name_associational" class="form-control" style="margin-bottom:3px;" value="'+row+'"> <a class="customDeleleBtn compositionRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a></div> ';
          //       $(".assoc-wrapper").append(htmlField);   
          //   $('.compositionRemoveBtn').on('click',function(){
          //     $(this).closest('.list_assoc').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
          //   });
       
          // });
          //    // $("#name_institutional").val(data.name_of_ins_assoc); 
        }
});

let count_coop_type = $('select[name="typeOfCooperative[]"').length;
$('#reserveUpdateForm #addCoop').on('click', function(){
// alert(count_coop_type++);

 var htmlField = '<div class="list_coop_type"><select name="typeOfCooperative[]" class="custom-select coop-type"></select> <a class="customDeleleBtn compositionRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a></div> ';
                         
        $("#reserveUpdateForm .coop_type-wrapper").append(htmlField);   
            $('#reserveUpdateForm .compositionRemoveBtn').on('click',function(){

              $(this).closest('.list_coop_type').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
                 //modified by json
               // var count_types = $("#count_types").val();
               // var less_count_type = parseInt(count_types-1);
               // // alert(less_count_type);       
               // $("#count_types").val(less_count_type);
               //  if($("#count_types").val()<=1)
               //   {

               //   $("#type_of_coop").text('');
               // }

            });

          $('#reserveUpdateForm .coop-type').append($('<option></option>').attr('value',"").text("--"));
          $('#reserveUpdateForm .coop-type').append($('<option></option>').attr('value',"1").text("Credit"));
          $('#reserveUpdateForm .coop-type').append($('<option></option>').attr('value',"2").text("Producers"));
          $('#reserveUpdateForm .coop-type').append($('<option></option>').attr('value',"3").text("Service"));
          $('#reserveUpdateForm .coop-type').append($('<option></option>').attr('value',"4").text("Consumers"));
          $('#reserveUpdateForm .coop-type').append($('<option></option>').attr('value',"5").text("Marketing"));
          $('#reserveUpdateForm .coop-type').append($('<option></option>').attr('value',"7").text("Advocacy"));
          $('#reserveUpdateForm .coop-type').append($('<option></option>').attr('value',"8").text("Agrarian Reform"));
          $('#reserveUpdateForm .coop-type').append($('<option></option>').attr('value',"9").text("Bank"));
          $('#reserveUpdateForm .coop-type').append($('<option></option>').attr('value',"10").text("Dairy"));
          $('#reserveUpdateForm .coop-type').append($('<option></option>').attr('value',"11").text("Education"));
          $('#reserveUpdateForm .coop-type').append($('<option></option>').attr('value',"12").text("Electric"));
          $('#reserveUpdateForm .coop-type').append($('<option></option>').attr('value',"13").text("Financial Service"));
          $('#reserveUpdateForm .coop-type').append($('<option></option>').attr('value',"14").text("Fishermen"));
          $('#reserveUpdateForm .coop-type').append($('<option></option>').attr('value',"15").text("Health Service"));
          $('#reserveUpdateForm .coop-type').append($('<option></option>').attr('value',"17").text("Transport"));
          $('#reserveUpdateForm .coop-type').append($('<option></option>').attr('value',"18").text("Water Service"));
          $('#reserveUpdateForm .coop-type').append($('<option></option>').attr('value',"19").text("Workers"));     
          $('#reserveUpdateForm .coop-type').append($('<option></option>').attr('value',"16").text("Insurance"));
          $('#reserveUpdateForm .coop-type').append($('<option></option>').attr('value',"20").text("Housing"));
          $('#reserveUpdateForm.coop-type').append($('<option></option>').attr('value',"21").text("Labor Service"));
          $('#reserveUpdateForm .coop-type').append($('<option></option>').attr('value',"22").text("Professionals"));
          $('#reserveUpdateForm .coop-type').append($('<option></option>').attr('value',"23").text("Small Scale Mining"));
          $('#reserveUpdateForm .coop-type').append($('<option></option>').attr('value',"24").text("Agriculture")); 
   

          // $('.coop-type').append($('<option></option>').attr('value',"").text("--"));
          // $('.coop-type').append($('<option></option>').attr('value',"7").text("Advocacy"));
          // $('.coop-type').append($('<option></option>').attr('value',"8").text("Agrarian Reform"));
          // $('.coop-type').append($('<option></option>').attr('value',"24").text("Agriculture"));
          // $('.coop-type').append($('<option></option>').attr('value',"9").text("Bank"));
          // $('.coop-type').append($('<option></option>').attr('value',"4").text("Consumers"));
          // $('.coop-type').append($('<option></option>').attr('value',"1").text("Credit"));
          // $('.coop-type').append($('<option></option>').attr('value',"10").text("Dairy"));
          // $('.coop-type').append($('<option></option>').attr('value',"11").text("Education"));
          // $('.coop-type').append($('<option></option>').attr('value',"12").text("Electric"));
          // $('.coop-type').append($('<option></option>').attr('value',"13").text("Financial Service"));
          // $('.coop-type').append($('<option></option>').attr('value',"14").text("Fishermen"));
          // $('.coop-type').append($('<option></option>').attr('value',"15").text("Health Service"));
          // $('.coop-type').append($('<option></option>').attr('value',"20").text("Housing"));
          // $('.coop-type').append($('<option></option>').attr('value',"16").text("Insurance"));
          // $('.coop-type').append($('<option></option>').attr('value',"21").text("Labor Service"));
          // $('.coop-type').append($('<option></option>').attr('value',"5").text("Marketing"));
          // $('.coop-type').append($('<option></option>').attr('value',"22").text("Producers"));
          // $('.coop-type').append($('<option></option>').attr('value',"3").text("Professionals"));
          // $('.coop-type').append($('<option></option>').attr('value',"23").text("Service"));
          // $('.coop-type').append($('<option></option>').attr('value',"17").text("Small Scale Mining"));
          // $('.coop-type').append($('<option></option>').attr('value',"18").text("Transport"));
          // $('.coop-type').append($('<option></option>').attr('value',"19").text("Water Service"));
          // $('.coop-type').append($('<option></option>').attr('value',"").text("Workers"));     
;
  
   
   $("#reserveUpdateForm .coop-type").on('change',function(){
          var cooptype_value = this.value;

          //modified by json
     var typeCoop_arrays=[]; 
     $('select[name="typeOfCooperative[]"] option:selected').each(function() {
     typeCoop_arrays.push($(this).val());
      console.log(typeCoop_arrays);
      $('#reserveUpdateForm #typeOfCooperative_value').val(typeCoop_arrays);
     })

            $.ajax({
             type : "POST",
             url  : "get_coopTypeID_ajax",
             dataType: "json",
             data: {cooptype_:cooptype_value},
             success: function(responsetxt){
              $.each(responsetxt,function(a,major_industry){
                 $(' #reserveUpdateForm.select-major').append($('<option></option>').attr('value',major_industry['description']).text(major_industry['description']));
                 $(' .select-major').append($('<option></option>').attr('value',major_industry['description']).text(major_industry['description']));
                 
                 // $.each(major_industry,function(b,sub_class){
                 //    // console.log(sub_class['description']);
                 //    // $('.test').append(sub_class['description']);
                 //     $('.select-subclass').append($('<option></option>').attr('value',sub_class['description']).text(sub_class['description']));
                 // });
              });
           }
          }); 
    });         

  
});

//modified by json existed drop select box
       $(".coop-type").on('change',function(){
        var cooptype_value = this.value;
        // alert('as');
            $.ajax({
             type : "POST",
             url  : "get_coopTypeID_ajax",
             dataType: "json",
             data: {cooptype_:cooptype_value},
             success: function(responsetxt){
              // console.log(responsetxt[0]);
              $.each(responsetxt,function(a,major_industry){
                // console.log(major_industry['id']);
                 $('.select-major').append($('<option></option>').attr('value',major_industry['id']).text(major_industry['description']));

                 // $.each(major_industry,function(b,sub_class){
                  
                 //     $('.select-subclass').append($('<option></option>').attr('value',sub_class['description']).text(sub_class['description']));
                 // });
              });
             }
            }); 
        }); 

//end modified by json existed drop select box 

//major industry populate subclass
$("#reserveUpdateForm #majorIndustry1").bind('change',function(){
    // $("select").change(function () {
var majorType = this.value;
   // alert(majorType);
  $.ajax({
    type : "POST",
    url  : "major_industry_description_subclass_ajax",
    dataType: "json",
    data: {major_types:majorType},
    success: function(responseSubclass){
    // console.log(responseSubclass.sub_class_id);
      $.each(responseSubclass,function(b,sub_class){    
        // console.log(sub_class['subclass_description']);
       $('#reserveUpdateForm .select-subclass').append($('<option></option>').attr('value',sub_class['sub_class_id']).text(sub_class['subclass_description']));
      
      });
      get_specific_subclass_desc($("#Amendment_ID").val());
    }
  }); //end ajax
}); //end onchange
//end of major industry populate subclass

function get_specific_subclass_desc(id)
{
  
   $.ajax({
    type : "POST",
    url  : "get_specific_subclassAjax",
    dataType: "json",
    data: {amd_id:id},
    success: function(responseSubclass){
     $(".select-subclass option[value='"+responseSubclass.ins_subclass_id+"']").attr("selected", "selected")
      // console.log("amendment id : " +responseSubclass.ins_subclass_id);
    }
  });//end ajax
}
 
//start add more subclass
 var insdexing = 0;
$('#reserveUpdateForm #addMoreSubclassBtn').on('click', function(){
  var las_id = $('select[name="majorIndustry[]"').last().attr('id');
  intLastCount = parseInt(las_id.substr(-1));
  var next_id = intLastCount+1;

      var htmlField = '<div class="list_major_industry"><label>Major Industry Classification No.'+next_id+' </label> <select class="custom-select form-control select-major" name="majorIndustry[]" id="majorIndustry'+next_id+'" style="margin-bottom:20px;"></select> <label>Major Industry Classification No.'+next_id+'  Subclass</label><select class="custom-select form-control select-subclass validate[required]" name="subClass[]" id="subClass'+next_id+'"> </select><a class="customDeleleBtn SubclassRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a></div> ';
            $(".major-wrapper").append(htmlField);   
            $('.SubclassRemoveBtn').on('click',function(){
              $(this).closest('.list_major_industry').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
            });

        //from amendment update view file
       var list_major =list_major_array; //from amendment reservation update view
       var last_ids  = $('select[name="majorIndustry[]"').last().attr('id');
       var last_id_subclass  = $('select[name="subClass[]"').last().attr('id');
      $.each(list_major, function(c,major_list){
        // console.log(major_list['description']);
        $("#"+last_ids).append($('<option></option>').attr('value',major_list['id']).text(major_list['description']));
      });

              $("#"+last_ids).on('change',function(){
            // $("select").change(function () {
                  var majorType = this.value;
                    // alert(majorType);
                    $.ajax({
                      type : "POST",
                      url  : "major_industry_description_subclass_ajax",
                      dataType: "json",
                      data: {major_types:majorType},
                      success: function(responseSubclass){
                      // console.log(responseSubclass.sub_class_id);
                        $.each(responseSubclass,function(b,sub_class){    

                        $("#"+last_id_subclass).find('option').remove();

                          $("#"+last_id_subclass).append($('<option></option>').attr('value',sub_class['sub_class_id']).text(sub_class['subclass_description']));
                           // $('.select-subclass').show();
                        });
                      }
                    }); //end ajax
                  }); //end onchange


       $(".coop-type").on('change',function(){
        var cooptype_value = this.value;
            $.ajax({
             type : "POST",
             url  : "get_coopTypeID_ajax",
             dataType: "json",
             data: {cooptype_:cooptype_value},
             success: function(responsetxt){

              $.each(responsetxt,function(a,major_industry){
                 $('.select-major').append($('<option></option>').attr('value',major_industry['description']).text(major_industry['description']));

              });
             }
            }); 
        }); 
      
       
      
});

//add more assoc name
 $('#reserveUpdateForm #addMoreInsBtn_Associational').on('click', function(){
     var htmlField = '<div class="list_assoc"><input type="text" name="name_associational[]" id="name_associational" class="form-control" style="margin-bottom:3px;" value=""> <a class="customDeleleBtn compositionRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a></div> ';
                $(".assoc-wrapper").append(htmlField);   
            $('.compositionRemoveBtn').on('click',function(){
              $(this).closest('.list_assoc').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
            });
    
  });
//end add more assoc name

//end more add more subclass
 //start
 $('#reserveUpdateForm #addMoreInsBtn_insti').on('click', function(){
     var htmlField = '<div class="list_product"><input type="text" name="name_ins_assoc[]" id="name_ins_assoc" class="form-control" style="margin-bottom:3px;" value=""> <a class="customDeleleBtn compositionRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a></div> ';
                $(".con-wrapper").append(htmlField);   
            $('.compositionRemoveBtn').on('click',function(){
              $(this).closest('.list_product').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
            });
    
  });
  //end 


  //modify occupational
$('#reserveUpdateForm #addMoreComBtne').on('click', function(){ 

var htmlFielda = '<div class="com-div"> <select class="custom-select composition-of-members" name="compositionOfMembersa[]" id="compositionOfMembersa required="required" ></select><a class="customDeleleBtn compositionRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a></div> ';
              

    $.ajax({
      type : "POST",
      url  : "composition",
      dataType: "json",
      success: function(data){
           $('#compositionOfMembersa').append($('<option></option>').attr('value',"").text(""));
          $.each(data, function(key,value){
              
            $('.composition-of-members').append($('<option></option>').attr('value',value.composition).text(value.composition));
           
          });
        
      }

    });

      $("#reserveUpdateForm .occupational-div").append(htmlFielda);   
            $('.compositionRemoveBtn').on('click',function(){
              $(this).closest('.com-div').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
            });
  });


//end modify

  

  
