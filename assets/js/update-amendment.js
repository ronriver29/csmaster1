$(function(){
    
 
 $("#reserveUpdateForm #reserveUpdateAgree").click(function(event){
  // event.preventDefault();
    if($(this).is(':checked')){
      // $('#reserveUpdateForm #reserveUpdateBtn2').removeAttr('disabled');
      $('#reserveUpdateBtn').prop("disabled", false); // Element(s) are now enabled.
    }else{
      $('#reserveUpdateForm #reserveUpdateBtn').attr('disabled','disabled');
    }
  });


  
 
  // load type coop modified
  if($("#reserveUpdateForm #typeOfCooperatives1").val().length>0)
        {
          var val1=[]; 
            $('select[name="typeOfCooperative[]"] option:selected').each(function() {
               val1.push($(this).val());
      
           $('#reserveUpdateForm #typeOfCooperative_value').val(val1);
          });
  }
  //end load modified 


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
    var business_activities = data.business_activities;
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
              $('#reserveUpdateForm .occupation-wrapper').hide();
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
               $('#reserveUpdateForm .compositionRemoveBtn').show();
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

        //commond bond
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
                $("#reserveUpdateForm .compositionRemoveBtn").hide();
                $('#reserveUpdateForm .occupation-wrapper').hide();
                 $("#reserveUpdateForm .insti_div").show();
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
                $("#reserveUpdateForm .compositionRemoveBtn").hide();
                $('#reserveUpdateForm .occupation-wrapper').hide();
                 $("#reserveUpdateForm .insti_div").show();
                 $("#compositionOfMembers2").hide();
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
                $("#reserveUpdateForm .compositionRemoveBtn").hide();
                $("#reserveUpdateForm .div-ins-assoc-occu").hide();
                 $("#reserveUpdateForm .insti_div").hide();
                $("#reserveUpdateForm .occupation-wrapper").hide(); 
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
                $("#reserveUpdateForm .institutionRemoveBtn").hide();
                $("#reserveUpdateForm .occupation-wrapper").show();
                $("#reserveUpdateForm .insti_div").show();
                $("#reserveUpdateForm .compositionRemoveBtn").show();
                $("reserveUpdateForm #occupation-div").show();
          
            }
        });

        //common bond

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


        // if(tempCount == $('#reserveUpdateForm select[name="majorIndustry[]"').length){
         
        //   $.ajax({
        //     type : "POST",
        //     url  : "../get_business_activities_of_coop",
        //     dataType: "json",
        //     data : {
        //       id: id
        //     },
        //     success: function(data){
        //       console.log(data);
        //       $('#reserveUpdateForm select[name="subClass[]"').each(function(index){
        //         var temp = $(this);
        //         setTimeout(function(){
        //           $(temp).val(data[index].id);
        //           $(temp).trigger('change');
        //         },800);
        //       });
        //     }
        //   });
        // }
        //business activity
          var count_id = 1;
          console.log(data);
          $.each(data.business_activities, function(x,business_activy){
        
          var c = count_id++;
          var htmls= $('<div></div>').attr({'class':'list-major'});
          var divFormGroupSubclass= $('<div></div>').attr({'class':'form-group'});
          var divColSubclass = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
          var labelSubClass = $('<label></label>').attr({'for': 'subClass '+c}).text("Major Industry Classification No. " + c +" Subclass ");
          var selectSubClass = $('<select></select>').attr({'class': 'custom-select form-control subclass-in validate[required]','name': 'subClass[]', 'id': 'subClass' + c}).prop("disabled",true);
        
          // var divFormGroupSubclass= $('<div></div>').attr({'class':'form-group'});
          // var divColSubclass = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
          // var labelSubClass = $('<label></label>').attr({'for': 'subClass'}).text("Major Industry Classification No.  Subclass "+c);
          // var selectSubClass = $('<select></select>').attr({'class': 'custom-select form-control validate[required]','name': 'subClass[]', 'id': 'subClass'+c}).prop("disabled",true);
          
          var divFormGroupMajorIndustry = $('<div></div>').attr({'class':'form-group'});
          var divColMajorIndustry = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
          var labelMajorIndustry = $('<label></label>').attr({'for': 'majorIndustry'}).text("Major Industry Classification No. " +c);
          var selectMajorIndustry = $('<select></select>').attr({'class': 'custom-select major-ins form-control validate[required]','name': 'majorIndustry[]', 'id': 'majorIndustry'+c });
          
          //remove major class and subclass
          var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn businessActivityRemoveBtn float-right text-danger'}).click(function(){
             
               $(this).closest('.list-major').remove();
              $('#reserveUpdateForm select[name="majorIndustry[]"]').each(function(index){
                $(this).siblings('label').text("Major Industry Classification No. "+(index+1));
              });
              $('#reserveUpdateForm select[name="subClass[]"]').each(function(index){
                $(this).siblings('label').text("Major Industry Classification No. Subclass "+(index+1));
              });
            });
          $(divFormGroupMajorIndustry).append(divColMajorIndustry,labelMajorIndustry,selectMajorIndustry);
          $(divFormGroupSubclass).append(divColSubclass,labelSubClass,selectSubClass);
           
          if(data.business_activities.length>1)
          {
             $(htmls).append(divFormGroupMajorIndustry,divFormGroupSubclass,deleteSpan);
          }
          else
          {
             $(htmls).append(divFormGroupMajorIndustry,divFormGroupSubclass);
          }
         
          
          $('.row-cis').append(htmls);
           $(selectMajorIndustry).append($('<option selected></option>').attr('value',business_activy['bactivity_id']).text(business_activy['bactivity_name']));
           $(selectSubClass).append($('<option selected></option>').attr('value',business_activy['bactivitysubtype_id']).text(business_activy['bactivitysubtype_name']));
           $(selectSubClass).prop("disabled",false);
        }); //end each loop
       
          //end business
        $("#reserveUpdateForm #newNamess").focus();
        
      }//end if data null

      var type_coperative_array = $('#typeOfCooperative_value').val(); 
          var splite_str = type_coperative_array.split(',');
          $.each(splite_str, function(n, cooperative_typeIDs){
              $.ajax({
                type : "POST",
                url  : "../../api/major_industries",
                dataType: "json",
                data : {
                  coop_type: cooperative_typeIDs
                },
                success: function(datam)
                {
                    var major_industry = "";
                    // $('.major-ins').append($('<option></option>').attr('value',"").text(""));
                    $.each(datam, function(key,value){
                      var $selected = "";
                      $.each(data.business_activities, function(i,rowd) {
                          if(rowd.bactivity_id==value.id) {
                              major_industry = rowd.bactivity_id;
                              $selected = "Selected = 'Selected'";
                              // console.log("id: "+value.id+"  selid: "+rowd.bactivity_id+"  "+$selected);
                          }
                      });
                      $('.major-ins').append($("<option></option>").attr('value',value.id).text(value.description));
                    });
                   // alert("subclass naman!" +major_industry);
                    //subclass
                    $.ajax({
                      type : "POST",
                      url  : "../../api/industry_subclasses",
                      dataType: "json",
                      data : {
                        coop_type: cooperative_typeIDs,
                        major_industry: major_industry
                      },
                      success: function(datai){
                          // $(selectSubClass).append($('<option></option>').attr('value',"").text(""));
                          $.each(datai, function(key,value){
                              var $selected = "";
                              $.each(data.business_activities, function(i,rowd) {
                                  if(rowd.bactivitysubtype_id==value.id) {
                                      $selected = "Selected = 'Selected'";
                                  }
                                  // console.log(rowd['bactivitysubtype_name']);
                                  $('.subclass-in').append($("<option></option>").attr('value',rowd['bactivitysubtype_id']).text(rowd['bactivitysubtype_name']));
                              });
                            //  $('.sublcass-ins').append($("<option></option>").attr('value',value.id).text(rowd.bactivitysubtype_name));
                          });
                      }
                    });
                }
              }); //end ajax
          }); //end of $.each

    } //end success
  }); //end ajax get_cooperative info

  //START Common Bond of Membership
  //start
  $("#reserveUpdateForm #remove_ins").on('click',function(){ 
     $(this).closest('.ins-div').remove();
  });
  //end

    $('#reserveUpdateForm #addMoreInsBtn').on('click', function(){
      var lastCountOfcom = $('#name_institution').last().attr('id');
      intLastCount = parseInt(lastCountOfcom.substr(-1)); 
      var divFormGroup= $('<div></div>').attr({'class':'form-group'});
      var selectComposition = $('<input>').attr({'class': 'custom-select form-control validate[required]','name': 'name_institution[]', 'id': 'name_institution' + (intLastCount + 1)}).prop("disabled",false);
  
      var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn institutionRemoveBtn float-right text-danger'}).click(function(){
          $(this).parent().remove();
        });

      $(divFormGroup).append("<table><tr><td>",selectComposition,"</td><td>",deleteSpan,"</td></tr></table>");
      $("#reserveUpdateForm .col-com").append(divFormGroup);
    });
  //END Common Bond of Membership
  

    //composition of membership btn
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
              // $(selectComposition).append($('<option></option>').attr('value',value.composition).text(value.composition));
               $(selectComposition).append($('<option></option>').attr('value',value.id).text(value.composition));
            });
        }
      });
    

      $(divFormGroup).append("<table width='100%'><tr><td width='90%'>",selectComposition,"</td><td width='10%'>",deleteSpan,"</td></tr></table>");
      $("#reserveUpdateForm .occupation-wrapper").append(divFormGroup);
    });
    //end  composition of membersip btn

}); //end of $ Function




//composition 
function load_composition($select_class)
{
  $.ajax({
    type : "POST",
    url  : "composition",
    dataType: "json",
    success: function(data){
    // $('#compositionOfMembersa').append($('<option></option>').attr('value',"").text(""));
    $.each(data, function(key,value){ 

    $select_class.append($('<option></option>').attr('value',value.id).text(value.composition));
    // $("#compositionOfMembersa option[value='"+data.comp_of_membership+"']").attr("selected", "selected");
    });
    // $(".omposition-cof-members option[value='"+data.comp_of_membership+"']").attr("selected", "selected")
    }
  }); //end ajax
}

//end compositon

//major industry populate subclass
// $("#reserveUpdateForm #majorIndustry1").bind('change',function(){
//     // $("select").change(function () {

// var majorType = this.value;
//    // alert(majorType);
//   $.ajax({
//     type : "POST",
//     url  : "major_industry_description_subclass_ajax",
//     dataType: "json",
//     data: {major_types:majorType},
//     success: function(responseSubclass){
//     // console.log(responseSubclass.sub_class_id);
//       $.each(responseSubclass,function(b,sub_class){    
//         // console.log(sub_class['subclass_description']);
//        $('#reserveUpdateForm .select-subclass').append($('<option></option>').attr('value',sub_class['sub_class_id']).text(sub_class['subclass_description']));
      
//       });
//       get_specific_subclass_desc($("#Amendment_ID").val());
//     }
//   }); //end ajax
// }); //end onchange
//end of major industry populate subclass

//get specific subclass
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
//end specifi subclass

  //name
    $("#reserveUpdateForm #newNamess").bind("keyup change",function(){
      // alert('a');
      var val = $(this).val();
      var count_coop_type =$('#reserveUpdateForm select[name="typeOfCooperative[]"').length;
      if(count_coop_type>1)
      {
        $("#type_of_coop").html(val+' Multipurpose Cooperative');
        $("#proposed_name_msg").html('* Do not include the word Multipurpose Cooperative in proposed name');
        
      }
      else
      {
         $("#type_of_coop").html(val);
           $("#proposed_name_msg").html('* Do not include the word Cooperative in proposed name');
      }
        if($(this).val() && ($(this).val()).length > 0)
        {
        $("#reserveUpdateForm #addMoreSubclassBtn").prop("disabled",false);
          document.getElementById("newNamess").maxLength = "61";

          $('#reserveUpdateForm #newNamess').on('change',function(){
            document.getElementById('acronym_name').value = '';
            var value = document.getElementById("newNamess").value;
            var totalval = 61 - value.length; 
            // alert(value.length);
            if(totalval == 0){ 
              $("#reserveUpdateForm #acronym_name").prop("disabled",true);
              $('#reserveUpdateForm #acronymnameerr').show();
            } else {
              $('#reserveUpdateForm #acronymnameerr').hide();
              $("#reserveUpdateForm #acronym_name").prop("disabled",false);
            }
            document.getElementById("acronym_name").maxLength = totalval;
          });
        }   

     
    });
  //end name
//add coop type dynamically modified
  var count_text_input =1;
  $('#reserveUpdateForm #addCoop').on('click', function(e){ 
    var name_origin =  $("#newName2").val(); 
    var category = $("#categoryOfCooperative").val();
    count_text_input++;
    $('#count_type').text(count_text_input );
    if(count_text_input>1)
    {
      var proposeName = $("#newNamess").val();
      $("#type_of_coop").html(proposeName+' Multipurpose Cooperative');
    }else{

       $("#type_of_coop").html(proposeName);
    }

    var lastCountOfcoop = $('select[name="typeOfCooperative[]"]').last().attr('id');
    intLastCount = parseInt(lastCountOfcoop.substr(-1));
    var divFormGroup= $('<div></div>').attr({'class':'form-group'});
    var selectCoop = $('<select></select>').attr({'class': 'custom-select coop-type form-control validate[required]','name': 'typeOfCooperative[]', 'id': 'typeOfCooperatives' + (intLastCount + 1)}).prop("disabled",false);
    var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn float-right text-danger'}).click(function(e){
    $(this).parent().remove();
    }); //end function delete
         
            $('.major-ins').empty();
            $('.subclass-in').empty();
            $('.subclass-in').prop("disabled",true);
            var typeCoop_arrays=[]; 
            $('select[name="typeOfCooperative[]"] option:selected').each(function() {
              typeCoop_arrays.push($(this).val()); 
              // $('#typeOfCooperative_value').val(typeCoop_arrays);
            });
                $('#reserveUpdateForm .major-ins').append($('<option></option').attr({'selected':true}).val(""));
                $.ajax({
                 type : "POST",
                 url  : "../../api/major_industries_amendment",
                 dataType: "json",
                 data: {cooptype_:typeCoop_arrays},
                 success: function(responsetxt){
                  $.each(responsetxt,function(a,major_industry){
                   // console.log(major_industry);
                     $('.major-ins').append($('<option></option>').attr('value',major_industry['major_industry_id']).text(major_industry['description']));
                  });
                 }
                }); //end ajax


         
      $(divFormGroup).append("<table><tr><td>",selectCoop,"</td><td>",deleteSpan,"</td></tr></table>");
      $("#reserveUpdateForm .coop-col").append(divFormGroup);

       list_cooperative_type(selectCoop,category);
    

      e.preventDefault();
    });


//modified by json
   $(document).on('change','.coop-type',function(){
        var cooptype_value = this.value;
        var typeCoop_arrays=[]; 
          $('select[name="typeOfCooperative[]"] option:selected').each(function() {
              typeCoop_arrays.push($(this).val());
              $('#typeOfCooperative_value').val(typeCoop_arrays);
          });      
           // alert(typeCoop_arrays);
            $('#reserveUpdateForm .major-ins').empty();
            $('#reserveUpdateForm .subclass-in').empty();
            $('#reserveUpdateForm .subclass-in').prop('disable',true);
            $('#reserveUpdateForm .major-ins').append($('<option></option').attr({'selected':true}).val(""));
           $.ajax({
                 type : "POST",
                 url  : "../../api/major_industries_amendment",
                 dataType: "json",
                 data: {cooptype_:typeCoop_arrays},
                 success: function(responsetxt){
                  $.each(responsetxt,function(a,major_industry){
                     $('.major-ins').append($('<option></option>').attr('value',major_industry['major_industry_id']).text(major_industry['description']));
                  });

                 }
                }); //end ajax    
    }); 

  //major
  $(document).on('change','.major-ins',function(){
        const current_major_id =  $(this).attr('id');
        var intLastCount = parseInt(current_major_id.substr(-1));
      $('#reserveUpdateForm #subClass'+(intLastCount)).empty();
      $('#reserveUpdateForm #subClass'+(intLastCount)).prop("disabled",true);
          if($(this).val() && ($(this).val()).length > 0){
            var subClassTemp =   $('#reserveUpdateForm #subClass'+(intLastCount)); 
            $(subClassTemp).prop("disabled",false);
            var major_industry = $(this).val();
 
            // if(coop_type.length > 0 ){ 
                $.ajax({
                type : "POST",
                url  : "../../api/subClass",
                // url  : "../api/SubClass",
                dataType: "json",
                data : {
                  major_industry: major_industry
                },
                success: function(data){
                    

                    $(subClassTemp).append($('<option></option').attr({'selected':true}).val(""));
                    $.each(data, function(key,value){
                      $(subClassTemp).append($('<option></option>').attr('value',value.id).text(value.description));
                    });
                }
              });
            // }
          }

     });
  //end major
     // $('#reserveUpdateForm select[name="typeOfCooperative[]"').each(function(index){ alert("success");
     //    $('#reserveUpdateForm #addMoreSubclassBtn').prop("disabled",true);
     //    $("#reserveUpdateForm #proposedName").prop("disabled",true);
     //    $('#reserveUpdateForm select[name="majorIndustry[]"').each(function(index){
     //      $(this).empty();
     //      $(this).prop("disabled",true);
     //    });
     //    $('#reserveUpdateForm select[name="subClass[]"').each(function(index){
     //      $(this).empty();
     //      $(this).prop("disabled",true);
     //    });
     //    if($(this).val() && ($(this).val()).length > 0){
     //      $("#reserveUpdateForm #addMoreSubclassBtn").prop("disabled",false);
     //      $("#reserveUpdateForm #proposedName").prop("disabled",false);
     //      var coop_type = $(this).val();
     //        $.ajax({
     //        type : "POST",
     //        url  : "../api/major_industries",
     //        dataType: "json",
     //        data : {
     //          coop_type: coop_type
     //        },
     //        success: function(data){
     //          $('#reserveUpdateForm select[name="majorIndustry[]"').each(function(index){
     //            var majorIndustry = $(this);
     //            $(majorIndustry).prop("disabled",false);
     //            $(majorIndustry).append($('<option></option>').attr('value',"").text(""));
     //            $.each(data, function(key,value){
     //              $(majorIndustry).append($('<option></option>').attr('value',value.id).text(value.description));
     //            });
     //          });
     //        }
     //      });
     //    }
     //  });

//endo modified

//modified add major industry dynamically
  let count_major_industry=parseInt($('.major-industry').length);
  $('#reserveUpdateForm #addMoreSubclassBtn').on('click', function(){
  
     var origin_name =  $("#newName2").val();
     // var start_counting_major = ++count_major_industry;
     // // alert(start_counting_major);
     // if(start_counting_major>1)
     // {  
     //    $("#newNamess").val(origin_name+' Multipurpose');
     // }
    if($('#reserveUpdateForm #typeOfCooperatives1').val() && ($('#reserveUpdateForm #typeOfCooperatives1').val()).length > 0){
      var lastCountOfSubclass = $('select[name="subClass[]"').last().attr('id'); 
      var totalCountOFSubclass = $('select[name="subClass[]"').length;
     
      var intLastCount = parseInt(lastCountOfSubclass.substr(-1)); 
      var coop_types = "";
        $('#reserveUpdateForm .coop-type').each(function(){
           if($(this).val().length>0) {
               coop_types += $(this).val()+"|";
           } 
        });
        // alert(intLastCount);
        // console.log("cooptypes: "+coop_types);
      var deleteSpanss = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn businessActivityRemoveBtn float-right text-danger'}).click(function(){

           // start_counting_major--;
           // if(start_counting_major<=1)
           // {  
           //    $("#newNamess").val(origin_name);
           // }
          // $(this).parent().remove();
           $(this).closest('.major-wrapper').remove();
          $('#reserveUpdateForm select[name="majorIndustry[]"]').each(function(index){
            $(this).siblings('label').text("Major Industry Classification No. " + (index+1));
          });

          $('#reserveUpdateForm select[name="subClass[]"]').each(function(index){
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
      var selectMajorIndustry = $('<select></select>').attr({'class': 'custom-select major-ins form-control validate[required]','name': 'majorIndustry[]', 'id': 'majorIndustry' + (intLastCount + 1)}).change(function(){
      
        $(selectSubClass).empty();
        $(selectSubClass).prop("disabled",true);
        
      }); //end delete

      var divInnerRow = $('<div></div>').attr({'class':'row'});
      var typeCoop_arrays=[]; 
          $('select[name="typeOfCooperative[]"] option:selected').each(function() {
              typeCoop_arrays.push($(this).val()); 
              // $('#typeOfCooperative_value').val(typeCoop_arrays);
          });      
           // alert(typeCoop_arrays);
            $(selectMajorIndustry).empty();
            $(selectMajorIndustry).append($('<option></option').attr({'selected':true}).val(""));

      $.ajax({
          type : "POST",
          url  : "../../api/major_industries_amendment",
          dataType: "json",
          data: {cooptype_:typeCoop_arrays},
          success: function(data){
             // alert('fire');
              $.each(data, function(key,value){
                $(selectMajorIndustry).append($('<option></option>').attr('value',value.major_industry_id).text(value.description));
              });
              $(divFormGroupSubclass).append(labelSubClass,selectSubClass,deleteSpanss);
              $(divColSubclass).append(divFormGroupSubclass);
              $(divFormGroupMajorIndustry).append(labelMajorIndustry,selectMajorIndustry);
              $(divColMajorIndustry).append(divFormGroupMajorIndustry);
              $(divInnerRow).append(divColMajorIndustry,divColSubclass);
              $("#reserveUpdateForm .col-industry-subclass").append(divInnerRow);
              $('#reserveUpdateForm select[name="majorIndustry[]"').each(function(index){
                $(this).siblings('label').text("Major Industry Classification No. " + (index+1));
              });
              $('#reserveUpdateForm select[name="subClass[]"').each(function(index){
                $(this).siblings('label').text("Major Industry Classification No. " + (index+1) + " Subclass ");
              });
          }
        });
    }else{
      $('#reserveUpdateForm #typeOfCooperatives1').focus();
    }
  });
  //end modified add major industry dynamically



  //major
  function get_major_()
  {
    

    var id =$("#Amendment_ID").val();
     $.ajax({
          type : "POST",
          url  : "../major_industry_ajax_",
          dataType: "json",
          data : {
            ids:id
          },
          success: function(data){
            $.each(data, function($a,b){
            //    var htmlField = '<div class="list_major_industry"><label>Major Industry Classification No. </label> <select class="custom-select form-control select-major" name="majorIndustry[]" id="majorIndustry" style="margin-bottom:20px;"></select> <label>Major Industry Classification No.  Subclass</label><select class="custom-select form-control select-subclass validate[required]" name="subClass[]" id="subClass"> </select><a class="customDeleleBtn SubclassRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a></div> ';
            // $(".major-wrapper").append(htmlField);  

              console.log(b['major_industry_id']);
              // $(".select-major").append($('<option></option>').attr('value',b['major_industry_id']).text(b['major_description']));
            });
          }
      });//end ajax    

    
     
  }get_major_();
  //end major

  //cooperative type list
function list_cooperative_type($select_id,$category)
{
  $($select_id).append($('<option></option').attr({'selected':true}).val(""));
                $.ajax({
                  async:false,
                  type : "POST",
                 url  : "../cooperative_type_ajax",
                 dataType: "json",
                 data:{category:$category},
                 success: function(responsetxt){
                  // console.log(responsetxt);
                  $.each(responsetxt,function(a,coop_type){
                     $($select_id).append($('<option></option>').attr('value',coop_type['id']).text(coop_type['name']));

                  });
                 }
                }); 
}
 //end cooperative type list

 //delete cooptype
$('.customDeleleBtn').on('click', function(){
  $(this).parent().remove(); 
});
 //end delete coop typ

  //start
 $('#reserveUpdateForm #addMoreInsBtn_insti').on('click', function(){
     var htmlField = '<div class="list_product"><input type="text" name="name_ins_assoc[]" id="name_ins_assoc" class="form-control" style="margin-bottom:3px;" value=""> <a class="customDeleleBtn compositionRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a></div> ';
                $(".con-wrapper").append(htmlField);   
            $('.compositionRemoveBtn').on('click',function(){
              $(this).closest('.list_product').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
            });
    
  });
  //end 
  function loadCoopType($select_id,$seelcted_id,$category)
  {
    $(document).ready(function(){
        $.ajax({
            type : "POST",
            url  : "../cooperative_type_ajax",
            dataType: "json",
            data : {
                category: $category,
            },
            success: function(responsetxt){
              $.each(responsetxt,function(a,coop_type){
                var selected="";
                $($select_id).append($('<option'+selected+'></option>').attr('value',coop_type['id']).text(coop_type['name']));
                if($selected_id == coop_type['id'] )
                {
                  var val = coop_type['id'];
                  var c_name = coop_type['name'];
                  $selected ="selected";
                  $($select_id).val(val).prop('selected', true);
                    // $($select_id).append($('<option selected></option>').attr('value',val).text(c_name));
                    // $($select_id).append($('<option'+selected+'></option>').attr('value',coop_type['id']).text(coop_type['name']));
                }  
              });
            }
        }); //end ajax
    }); //end document ready        
  }
  $("#reserveUpdateForm #categoryOfCooperative").on('change',function(){

      $('.coop-type').empty();
      $('.coop-type').prop("disabled",true);
      loadCoopType('.coop-type','',$(this).val());
       $('.coop-type').prop("disabled",false);

  });





  


  

   

