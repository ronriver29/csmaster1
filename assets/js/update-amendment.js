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
      $("#cooperative_idss").val(data.cooperative_id);
         if(data.common_bond_of_membership == 'Occupational')
        {
      
            $("#occupational-div").show();
            $("#institutional-wrapper").remove();
            $("#associational-wrapper").remove();

            // var htmlFielda = '<div class="com-div"> <select class="custom-select composition-of-members" name="compositionOfMembersa[]" id="compositionOfMembersa required="required" ></select><a class="customDeleleBtn compositionRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a></div> ';
            
            // $.ajax({
            //     type : "POST",
            //     url  : "composition",
            //     dataType: "json",
            //     success: function(data){
            //          $('#compositionOfMembersa').append($('<option></option>').attr('value',"").text(""));
            //         $.each(data, function(key,value){
                   

            //           $('.composition-of-members').append($('<option></option>').attr('value',value.id).text(value.composition));
            //          $("#compositionOfMembersa option[value='"+data.comp_of_membership+"']").attr("selected", "selected");
            //         });

            //       // $(".omposition-cof-members option[value='"+data.comp_of_membership+"']").attr("selected", "selected")
            //     }

            //   }); //end ajax
            //   $(".composition_").append(htmlFielda);

              cid =data.comp_of_membership;
              var composition_arr = data.comp_of_membership.split(',');;
              // console.log(composition_arr);
              var countedID = 1;
              $.each(composition_arr ,function(ac,compo){

                var cin_id = countedID++;
                 var htmlFielda = '<div class="com-div"> <select class="custom-select composition-of-members" name="compositionOfMembersa[]" id="compositionOfMembersa'+cin_id+'" required="required" ></select><a class="customDeleleBtn compositionRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a></div> ';
                 $(".composition_").append(htmlFielda);
            $('#reserveUpdateForm .compositionRemoveBtn').on('click',function(){
              $(this).closest('.com-div').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
            }); //end remove

                  // load_composition($('.composition-of-members')); //load composition

                  $.ajax({
                    type : "POST",
                    url  : "composition",
                    dataType: "json",
                    success: function(data){
                    // $('#compositionOfMembersa').append($('<option></option>').attr('value',"").text(""));
                    $.each(data, function(key,value){

                    $('.composition-of-members').append($('<option></option>').attr('value',value.id).text(value.composition));
                    // $("#compositionOfMembersa option[value='"+data.comp_of_membership+"']").attr("selected", "selected");
                    });
                    // $(".omposition-cof-members option[value='"+data.comp_of_membership+"']").attr("selected", "selected")
                    }
                  }); //end ajax

                 //get specifi compostion
                  $.ajax({
                    type : "POST",
                    url  : "../get_specific_CompositionOfmembers",
                    dataType: "json",
                    data: {comp_id : compo},
                    success: function(datab){
                     // console.log(datab.composition);
                    // $("#compositionOfMembersa"+cin_id).val(datab.id);
                    $("#compositionOfMembersa"+cin_id+" > [value='"+datab.id+"']").attr("selected", "true"); 
                      // if(compo===datab.id)
                      // {
                      //  // alert('compositionOfMembersa'+cin_id);
                      //     // $('#compositionOfMembersa'+cin_id).val(datab.id).prop('selected', true);
                            
                      //      $("#compositionOfMembersa"+cin_id+" > [value='"+datab.id+"']").attr("selected", "true"); 
                           
                      //       // $('#compositionOfMembersa1 option[value='+datab.id+']').attr('selected', 'selected');
                      //       // document.querySelector("#compositionOfMembersa"+cin_id+ " option[value='"+datab.id+"']").setAttribute('selected',true);
                      // }//end if     
                   
                    }//end success

                  }); //end ajax
                  
                  //end specifi composition
              }); //end each composition array
               // $(".omposition-cof-members option[value='"+cid+"']").attr("selected", "selected")
            
             
        } //occupational
        else if(data.common_bond_of_membership == 'Institutional')
        {
          $("#institutional-wrapper").show();
          $("#occupational-div").remove();
          $("#associational-wrapper").remove();
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
          $("#reserveUpdateForm #occupational-div").remove();
          $("#reserveUpdateForm #institutional-wrapper").remove();

          $("#assoc_field_membership").val(data.field_of_membership);
          var ustr = data.name_of_ins_assoc;
          var astr = ustr.split(',');  
          $.each(astr, function(i,row) {
            var x =1;
            var htmlField = '<div class="list_assoc"><input type="text" name="name_associational[]" id="name_associational" class="form-control" style="margin-bottom:3px;" value="'+row+'"> <a class="customDeleleBtn compositionRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a></div> ';
                $("#reserveUpdateForm .assoc-wrapper").append(htmlField);   
            $('#reserveUpdateForm .compositionRemoveBtn').on('click',function(){
              $(this).closest('.list_assoc').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
            });
       
          });
             $("#reserveUpdateForm #name_institutional").val(data.name_of_ins_assoc); 
        }
        else
        {
          $("#reserveUpdateForm #associational-wrapper").remove();
          $("#occupational-div").remove();
          $("#institutional-wrapper").remove();
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
          // console.log(data.business_activities);
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
           
         
          $(htmls).append(divFormGroupMajorIndustry,divFormGroupSubclass,deleteSpan);
          
          $('.row-cis').append(htmls);
           $(selectMajorIndustry).append($('<option selected></option>').attr('value',business_activy['bactivity_id']).text(business_activy['bactivity_name']));
           $(selectSubClass).append($('<option selected></option>').attr('value',business_activy['bactivitysubtype_id']).text(business_activy['bactivitysubtype_name']));
           $(selectSubClass).prop("disabled",false);
        }); //end each loop
       
          //end business
        $("#reserveUpdateForm #proposedName").focus();
        
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
    $("#reserveUpdateForm #proposedName").bind("keyup change",function(){
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
     
    });
  //end name
//add coop type dynamically modified
  var count_text_input =1;
  $('#reserveUpdateForm #addCoop').on('click', function(e){ 
    var name_origin =  $("#newName2").val();
    count_text_input++;
    $('#count_type').text(count_text_input );
    if(count_text_input>1)
    {
      var proposeName = $("#proposedName").val();
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
        // count_text_input--;
        // less_count_updateName(count_text_input);
      
      });
          list_cooperative_type(selectCoop);
    
         
      $(divFormGroup).append("<table><tr><td>",selectCoop,"</td><td>",deleteSpan,"</td></tr></table>");
      $("#reserveUpdateForm .coop-col").append(divFormGroup);

//modified by json
      $(".coop-type").on('change',function(){
        var cooptype_value = this.value;

     var typeCoop_arrays=[]; 
     $('select[name="typeOfCooperative[]"] option:selected').each(function() {
     typeCoop_arrays.push($(this).val());
      console.log(typeCoop_arrays);
      $('#typeOfCooperative_value').val(typeCoop_arrays);
     });
  
        // alert(cooptype_value);
            $.ajax({
             type : "POST",
             url  : "get_major_industry_ajax",
             dataType: "json",
             data: {cooptype_:cooptype_value},
             success: function(responsetxt){
               // alert("success");
              $.each(responsetxt,function(a,major_industry){
                // console.log(major_industry['description']);
                 // $('.major-industry').append($('<option></option>').attr('value',major_industry['id']).text(major_industry['description']));
                  $('.major-ins').append($('<option></option>').attr('value',major_industry['id']).text(major_industry['description']));

                 // $('.select-major').append($('<option></option>').attr('value',major_industry['description']).text(major_industry['description']));

              });
             }
            }); //end ajax
        }); 
      e.preventDefault();
    });


//modified by json
$(".coop-type").on('change',function(){
        var cooptype_value = this.value;
        // alert(cooptype_value);
        var typeCoop_arraysa=[]; 
     $('select[name="typeOfCooperative[]"] option:selected').each(function() {
     typeCoop_arraysa.push($(this).val());
    // alert(typeCoop_arraysa);
      $('#typeOfCooperative_value').val(typeCoop_arraysa);
     });
          
            $.ajax({
             type : "POST",
             url  : "get_major_industry_ajax",
             dataType: "json",
             data: {cooptype_:cooptype_value},
             success: function(responsetxt){
              // console.log(responsetxt['desciption']);
              $.each(responsetxt,function(a,major_industry){
                 $('.major-industry').append($('<option></option>').attr('value',major_industry['description']).text(major_industry['description']));

              });
             }
            }); 
        }); 
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
      var selectMajorIndustry = $('<select></select>').attr({'class': 'custom-select form-control validate[required]','name': 'majorIndustry[]', 'id': 'majorIndustry' + (intLastCount + 1)}).change(function(){
      
        $(selectSubClass).empty();
        $(selectSubClass).prop("disabled",true);
        if($(this).val() && ($(this).val()).length > 0){
          $(selectSubClass).prop("disabled",false);
          var major_industry = $(this).val(); 
          // var coop_type_val = $('#reserveUpdateForm #typeOfCooperatives1').val();
              $.ajax({
              type : "POST",
              url  : "../../api/industry_subclasses",
              dataType: "json",
              data : {
                coop_type: coop_types,
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
      var coop_type_val = $('#reserveUpdateForm #typeOfCooperatives1').val();
      $.ajax({
          type : "POST",
          url  : "../../api/major_industries",
          dataType: "json",
          data : {
            coop_type: coop_types
          },
          success: function(data){
              $(selectMajorIndustry).append($('<option></option>').attr('value',"").text(""));
              $.each(data, function(key,value){
                $(selectMajorIndustry).append($('<option></option>').attr('value',value.id).text(value.description));
              });
              $(divFormGroupSubclass).append(labelSubClass,selectSubClass);
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
function list_cooperative_type($select_id)
{
 
            $.ajax({
             type : "POST",
             url  : "../cooperative_type_ajax",
             dataType: "json",
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
 //end delete coop type

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
              
            $('.composition-of-members').append($('<option></option>').attr('value',value.id).text(value.composition));
           
          });
        
      }

    });

      $("#reserveUpdateForm .occupational-div").append(htmlFielda);   
            $('.compositionRemoveBtn').on('click',function(){
              $(this).closest('.com-div').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
            });
  });
//end modify
  

   

