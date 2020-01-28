$(function(){
  if($('#termsAndConditionModal').length){
    $('#termsAndConditionModal').modal('show');
  }
  
  ///add remove txt
$('#addMoreInsBtn_insti').on('click', function(){
  alert('asdfasd');
    var lastCountOfcom = $('#name_institution').last().attr('id');
    intLastCount = parseInt(lastCountOfcom.substr(-1));
    var divFormGroup= $('<div></div>').attr({'class':'form-group'});
    var selectComposition = $('<input>').attr({'class': 'custom-select form-control validate[required]','name': 'name_institution[]', 'id': 'name_institution' + (intLastCount + 1)}).prop("disabled",false);
    var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn institutionRemoveBtn float-right text-danger'}).click(function(){
        $(this).parent().remove();
      });
  });
//end add remove txt
  
  
    $('#amendmentAddForm #region').on('change',function(){
      $('#amendmentAddForm #province').empty();
      $("#amendmentAddForm #province").prop("disabled",true);
      $('#amendmentAddForm #city').empty();
      $("#amendmentAddForm #city").prop("disabled",true);
      $('#amendmentAddForm #barangay').empty();
      $("#amendmentAddForm #barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#amendmentAddForm #province").prop("disabled",false);
        var region = $(this).val();
          $.ajax({
          type : "POST",
          url  : "../api/provinces",
          dataType: "json",
          data : {
            region: region
          },
          success: function(data){
            $('#amendmentAddForm #province').append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $('#amendmentAddForm #province').append($('<option></option>').attr('value',value.provCode).text(value.provDesc));
            });
          }
        });
      }
    });

    $('#amendmentAddForm #province').on('change',function(){
      $('#amendmentAddForm #city').empty();
      $("#amendmentAddForm #city").prop("disabled",true);
      $('#amendmentAddForm #barangay').empty();
      $("#amendmentAddForm #barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#amendmentAddForm #city").prop("disabled",false);
        var province = $(this).val();
          $.ajax({
          type : "POST",
          url  : "../api/cities",
          dataType: "json",
          data : {
            province: province
          },
          success: function(data){
            $('#amendmentAddForm #city').append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $('#amendmentAddForm #city').append($('<option></option>').attr('value',value.citymunCode).text(value.citymunDesc));
            });
          }
        });
      }
    });

    $('#amendmentAddForm #city').on('change',function(){
      $('#amendmentAddForm #barangay').empty();
      $("#amendmentAddForm #barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#amendmentAddForm #barangay").prop("disabled",false);
        var cities = $(this).val();
          $.ajax({
          type : "POST",
          url  : "../api/barangays",
          dataType: "json",
          data : {
            cities: cities
          },
          success: function(data){
            $('#amendmentAddForm #barangay').append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $('#amendmentAddForm #barangay').append($('<option></option>').attr('value',value.brgyCode).text(value.brgyDesc));
            });
          }
        });
      }
    });

  $("#amendmentAddForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
          if(status==true){
            if($("#amendmentAddLoadingBtn").length <= 0){
              $("#amendmentAddForm #amendmentAddBtn").hide();
              $("#amendmentAddForm .col-branch-btn").append($('<button></button>').attr({'id':'branchAddLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
            }else{
              return false;
            }
          }else{
            return false;
          }
        }
  });

  $('#amendmentAddForm #regNo').on('change', function(){
    
    var coopName = $('#coopName').val();
    var regNo = $('#regNo').val();
//
//    $("#amendmentAddForm .-row-your-boat").remove();
//
//
//    var divRow1 = $('<div></div>').attr({'class':'row -row-your-boat'});
//
//     
//
//    $.ajax({
//      type : "POST",
//      url  : "business_activity/"+regNo ,
//      dataType: "json",
//      data : {
//        regNo: regNo
//      },
//      success: function(data){
//        if (data!=null) {
//         
//          $.each(data, function(index,value) { 
//            var divColMajor = $('<div></div>').attr({'class':'col-sm-12 col-md-12 '+(index+1)});
//            var divFormMajor = $('<div></div>').attr({'class':'form-group '+(index+1)});
//            var divFormSub = $('<div></div>').attr({'class':'form-group'+(index+1)});
//            var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn businessRemoveBtn float-right text-danger'}).click(function(){
//              $(this).parent().remove();
//              $('#amendmentAddForm input[name="majorIndustry[]"').each(function(index){
//                $(this).siblings('label').text("Major Industry Classification No. " + (index+1));
//              });
//              $('#amendmentAddForm input[name="subClass[]"').each(function(index){
//                $(this).siblings('label').text("Major Industry Classification No. " + (index+1) +' Subclass');
//              });
//            });
//
////            var hiddenBAC =$('<input type="hidden" class="form-control" name="BAC[]"/>').attr('value',value.BAC_id);
//            var inputMajor=$('<input type="text" class="form-control" name="majorIndustry[]"/> disabled').attr('value',value.mdesc);
//            var inputSub=  $('<input type="text" class="form-control" name="subClass[]"/> disabled').attr('value',value.sdesc);
//            var labelMajor=$('<label>Major Industry Classification No. '+(index+1)+'</label>');
//            var labelSub=  $('<label>Major Industry Classification No. '+(index+1)+' Subclass</label>');
//
//            $(divFormMajor).append(labelMajor,inputMajor);
//            $(divFormSub).append(labelSub,inputSub);
//            $(divColMajor).append(deleteSpan,divFormMajor,divFormSub);
//            $(divRow1).append(divColMajor);
//          });
//            
//            $("#amendmentAddForm .col-industry-subclass").append(divRow1);
//            
//
//        }
//      }
//    });
    $.ajax({
      type : "POST",
      url  : "coop_info/"+regNo ,
      dataType: "json",
      data : {
        regNo: regNo
      },
      success: function(data){
        if (data.type=='Multi-Purpose'){

        }else{
            $('#amendmentAddForm #typeOfCooperative1').val(data.type_id); 
        }
        if (data.category_of_cooperative=='Primary')
            $('#amendmentAddForm #categoryOfCooperative').val(data.category_of_cooperative);
        else
            $('#amendmentAddForm #categoryOfCooperative').val(data.category_of_cooperative+' - '+data.grouping);
      
        $('#amendmentAddForm #coopName').val(data.coopName);
        $('#amendmentAddForm #areaOfOperation').val(data.areaOfOperation);
        $('#amendmentAddForm #commonBondOfMembership').val(data.commonBond);
        if(data.commonBond == 'Occupational')
        {
            $("#occupational-wrapper").show();    
        }
        else if(data.commonBond == 'Institutional')
        {
          $("#institutional-wrapper").show();
          $("#ins_field_membership").val(data.field_of_membership);
          var ustr = data.name_of_ins_assoc;
          var astr = ustr.split(',');  
          $.each(astr, function(i,row) {
           $("#con-wrapper").append('<input type="text" name="ins_assoc[]" class="form-control" style="margin-bottom:3px;" value="'+row+'">');
           });
             // $("#name_institutional").val(data.name_of_ins_assoc); 
        }

        $('#amendmentAddForm #newName').val(data.proposed_name);
        $('#amendmentAddForm #acronym_name').val(data.acronym);
        $('#amendmentAddForm #blkNo').val(data.noStreet);
        $('#amendmentAddForm #streetName').val(data.Street);
        var coop_types = "";
        $('#amendmentAddForm .coop-type').each(function(){
           if($(this).val().length>0) {
               coop_types += $(this).val()+"|";
           } 
        });

        var selectMajorIndustry = $('#amendmentAddForm #majoreIndustry1');
        var selectSubClass = $('#amendmentAddForm #subClass1');
       
        $.ajax({
          type : "POST",
          url  : "../api/major_industries",
          dataType: "json",
          data : {
            coop_type: coop_types
          },
          success: function(datam){
              var major_industry = "";
              $(selectMajorIndustry).append($('<option></option>').attr('value',"").text(""));
              $.each(datam, function(key,value){
                var $selected = "";
                $.each(data.business_activities, function(i,rowd) {
                    if(rowd.bactivity_id==value.id) {
                        major_industry = rowd.bactivity_id;
                        $selected = "Selected = 'Selected'";
                        console.log("id: "+value.id+"  selid: "+rowd.bactivity_id+"  "+$selected);
                    }
                });
                $(selectMajorIndustry).append($("<option "+$selected+"></option>").attr('value',value.id).text(value.description));
              });
              
              //subclass
              $.ajax({
                type : "POST",
                url  : "../api/industry_subclasses",
                dataType: "json",
                data : {
                  coop_type: coop_types,
                  major_industry: major_industry
                },
                success: function(datai){

                    $(selectSubClass).append($('<option></option>').attr('value',"").text(""));
                    $.each(datai, function(key,value){
                        var $selected = "";
                        $.each(data.business_activities, function(i,rowd) {
                            if(rowd.bactivitysubtype_id==value.id) {
                                $selected = "Selected = 'Selected'";
                            }
                        });
                      $(selectSubClass).append($("<option "+$selected+"></option>").attr('value',value.id).text(value.description));

                    });
                }
              });
          }
        });
        no_of_members = $(".composition-of-members").length;
        $x = 0;
        $(".composition-of-members").each(function(){
            $.each(data.composition_of_members, function(i,rowc) {
//                    $(this).val("Accountants");
//                    $(this).val("Fishery and aquaculture laborers");
//                    console.log("members: "+rowd.composition);
                    $(this).find("option[value=" + rowc.composition +"]").attr('selected', true);;
                if(i==$x) {
                }
            });
            $x++;
        });
        
//        var x = 1;
//        if(data.business_activities.length>0) {
//            $.each(data.business_activities, function(i,rowd) {
//                console.log(rowd.bactivity_id)
//                $('#amendmentAddForm #majoreIndustry'+x).html("<option value='"+rowd.bactivity_id+"' Selected='selected'>"+rowd.bactivity_name+"</option>");
//                $('#amendmentAddForm #subClass'+x).html("<option value='"+rowd.bactivitysubtype_id+"' Selected='selected'>"+rowd.bactivitysubtype_name+"</option>");
//                x++;
//            });
//        }

        setTimeout( function(){
          $('#amendmentAddForm #region').val(data.rCode);
          $('#amendmentAddForm #region').trigger('change');
        },300);
        setTimeout( function(){
            $('#amendmentAddForm #province').val(data.pCode);
            $('#amendmentAddForm #province').trigger('change');
        },900);
        setTimeout(function(){
          $('#amendmentAddForm #city').val(data.cCode);
          $('#amendmentAddForm #city').trigger('change');
        },1500);
        setTimeout(function(){
          $('#amendmentAddForm #barangay').val(data.bCode);         
        },2500);
      }
    });

      var lastCountOfSubclass = $('select[name="subClass[]"').last().attr('id'); 
      var totalCountOFSubclass = $('select[name="subClass[]"').length;
      var intLastCount = parseInt(lastCountOfSubclass.substr(-1));
      
      var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn businessActivityRemoveBtn float-right text-danger'}).click(function(){
          $(this).parent().parent().parent().remove();
          $('#amendmentAddForm select[name="majorIndustry[]"]').each(function(index){
            $(this).siblings('label').text("Major Industry Classification No. " + (index+1));
          });
          $('#amendmentAddForm select[name="subClass[]"]').each(function(index){
            $(this).siblings('label').text("Major Industry Classification No. " + (index+1) + " Subclass ");
          });
        });

      /*var divFormGroupSubclass= $('<div></div>').attr({'class':'form-group'});
      var divColSubclass = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
      var labelSubClass = $('<label></label>').attr({'for': 'subClass'+(intLastCount + 1)}).text("Major Industry Classification No. " + (intLastCount+1) + " Subclass ");
      var selectSubClass = $('<select></select>').attr({'class': 'custom-select form-control validate[required]','name': 'subClass[]', 'id': 'subClass' + (intLastCount + 1)}).prop("disabled",true);
      
      var divFormGroupMajorIndustry = $('<div></div>').attr({'class':'form-group'});
      var divColMajorIndustry = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
      var labelMajorIndustry = $('<label></label>').attr({'for': 'majorIndustry'+(intLastCount + 1)}).text("Major Industry Classification No. " + (intLastCount+1));
      var selectMajorIndustry = $('<select></select>').attr({'class': 'custom-select form-control validate[required]','name': 'majorIndustry[]', 'id': 'majorIndustry' + (intLastCount + 1)}).change(function(){
*/
//var coop_type_val = $('#amendmentAddForm select[name="typeOfCooperative[]"').val();      
//alert(coop_type_val);
  });


  
  $('#amendmentAddForm #typeOfCooperative1').on('change', function(){
    $('#amendmentAddForm #addMoreSubclassBtn').prop("disabled",true);
    $("#amendmentAddForm #newName").prop("disabled",true);
    $('#amendmentAddForm select[name="majorIndustry[]"').each(function(index){
      $(this).empty();
      $(this).prop("disabled",false);
    });
    $('#amendmentAddForm select[name="subClass[]"').each(function(index){
      $(this).empty();
      $(this).prop("disabled",true);
    });
    if($(this).val() && ($(this).val()).length > 0){
      $("#amendmentAddForm #addMoreSubclassBtn").prop("disabled",false);
      $("#amendmentAddForm #newName").prop("disabled",false);
      var coop_type = $(this).val();
        $.ajax({
        type : "POST",
        url  : "../api/major_industries",
        dataType: "json",
        data : {
          coop_type: coop_type
        },
        success: function(data){
          $('#amendmentAddForm select[name="majorIndustry[]"').each(function(index){
            var majorIndustry = $(this);
            $(majorIndustry).prop("disabled",false);
            $(majorIndustry).append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $(majorIndustry).append($('<option></option>').attr('value',value.id).text(value.description));
            });
          });
        }
      });
    }
  });
//  var cooptype=$('#amendmentAddForm #typeOfCooperative1').val();
//  $('#amendmentAddForm .coop-type').each(function(index){
//    $(this).on('change',function(){
//        var newName = $('#amendmentAddForm #newName').val();
//        if($(this).val().length>0 && $(this).val()!=cooptype) {
//            if (!newName.indexOf("Multi-Purpose") >= 0) {
//              $('#amendmentAddForm #newName').val(newName+ " Multi-Purpose");
//          }
//        }
//    });
//});
  $('#amendmentAddForm select[name="majorIndustry[]"').each(function(index){
    $(this).on('change',function(){

      $('#amendmentAddForm #subClass'+(index+1)).empty();
      $('#amendmentAddForm #subClass'+(index+1)).prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        var subClassTemp =   $('#amendmentAddForm #subClass'+(index+1));
        $(subClassTemp).prop("disabled",false);
        var major_industry = $(this).val();
        var coop_type = $('#amendmentAddForm #typeOfCooperative1').val();
        if(coop_type.length > 0 ){
            $.ajax({
            type : "POST",
            url  : "../api/industry_subclasses",
            dataType: "json",
            data : {
              coop_type: coop_type,
              major_industry: major_industry
            },
            success: function(data){
                $(subClassTemp).append($('<option></option>').attr('value',"").text(""));
                $.each(data, function(key,value){
                  $(subClassTemp).append($('<option></option>').attr('value',value.id).text(value.description));
                });
            }
          });
        }
      }
    });
  });
  
  $('#amendmentAddForm #addMoreSubclassBtn').on('click', function(){

    if($('#amendmentAddForm #typeOfCooperative1').val() && ($('#amendmentAddForm #typeOfCooperative1').val()).length > 0){
      var lastCountOfSubclass = $('select[name="subClass[]"').last().attr('id'); 
      var totalCountOFSubclass = $('select[name="subClass[]"').length;
      var intLastCount = parseInt(lastCountOfSubclass.substr(-1));
      var coop_types = "";
        $('#amendmentAddForm .coop-type').each(function(){
           if($(this).val().length>0) {
               coop_types += $(this).val()+"|";
           } 
        });
        console.log("cooptypes: "+coop_types);
      var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn businessActivityRemoveBtn float-right text-danger'}).click(function(){
          $(this).parent().parent().parent().remove();
          $('#amendmentAddForm select[name="majorIndustry[]"]').each(function(index){
            $(this).siblings('label').text("Major Industry Classification No. " + (index+1));
          });
          $('#amendmentAddForm select[name="subClass[]"]').each(function(index){
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
          var coop_type_val = $('#amendmentAddForm #typeOfCooperative1').val();
              $.ajax({
              type : "POST",
              url  : "../api/industry_subclasses",
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
      var coop_type_val = $('#amendmentAddForm #typeOfCooperative1').val();
      $.ajax({
          type : "POST",
          url  : "../api/major_industries",
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
              $(divFormGroupMajorIndustry).append(deleteSpan,labelMajorIndustry,selectMajorIndustry);
              $(divColMajorIndustry).append(divFormGroupMajorIndustry);
              $(divInnerRow).append(divColMajorIndustry,divColSubclass);
              $("#amendmentAddForm .col-industry-subclass").append(divInnerRow);
              $('#amendmentAddForm select[name="majorIndustry[]"').each(function(index){
                $(this).siblings('label').text("Major Industry Classification No. " + (index+1));
              });
              $('#amendmentAddForm select[name="subClass[]"').each(function(index){
                $(this).siblings('label').text("Major Industry Classification No. " + (index+1) + " Subclass ");
              });
          }
        });
    }else{
      $('#amendmentAddForm #typeOfCooperative1').focus();
    }
  });


  $('#amendmentAddForm #addCoop').on('click', function(){
    var lastCountOfcoop = $('select[name="typeOfCooperative[]"]').last().attr('id');
    intLastCount = parseInt(lastCountOfcoop.substr(-1));
    var divFormGroup= $('<div></div>').attr({'class':'form-group'});
    var selectCoop = $('<select></select>').attr({'class': 'custom-select coop-type form-control validate[required]','name': 'typeOfCooperative[]', 'id': 'typeOfCooperative1' + (intLastCount + 1)}).prop("disabled",false);
    var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn float-right text-danger'}).click(function(){
        $(this).parent().remove();
      });

    
          $(selectCoop).append($('<option></option>').attr('value',"").text("--"));
          $(selectCoop).append($('<option></option>').attr('value',"7").text("Advocacy"));
          $(selectCoop).append($('<option></option>').attr('value',"8").text("Agrarian Reform"));
          $(selectCoop).append($('<option></option>').attr('value',"24").text("Agriculture"));
          $(selectCoop).append($('<option></option>').attr('value',"9").text("Bank"));
          $(selectCoop).append($('<option></option>').attr('value',"4").text("Consumers"));
          $(selectCoop).append($('<option></option>').attr('value',"1").text("Credit"));
          $(selectCoop).append($('<option></option>').attr('value',"10").text("Dairy"));
          $(selectCoop).append($('<option></option>').attr('value',"11").text("Education"));
          $(selectCoop).append($('<option></option>').attr('value',"12").text("Electric"));
          $(selectCoop).append($('<option></option>').attr('value',"13").text("Financial Service"));
          $(selectCoop).append($('<option></option>').attr('value',"14").text("Fishermen"));
          $(selectCoop).append($('<option></option>').attr('value',"15").text("Health Service"));
          $(selectCoop).append($('<option></option>').attr('value',"20").text("Housing"));
          $(selectCoop).append($('<option></option>').attr('value',"16").text("Insurance"));
          $(selectCoop).append($('<option></option>').attr('value',"21").text("Labor Service"));
          $(selectCoop).append($('<option></option>').attr('value',"5").text("Marketing"));
          $(selectCoop).append($('<option></option>').attr('value',"22").text("Producers"));
          $(selectCoop).append($('<option></option>').attr('value',"3").text("Professionals"));
          $(selectCoop).append($('<option></option>').attr('value',"23").text("Service"));
          $(selectCoop).append($('<option></option>').attr('value',"17").text("Small Scale Mining"));
          $(selectCoop).append($('<option></option>').attr('value',"18").text("Transport"));
          $(selectCoop).append($('<option></option>').attr('value',"19").text("Water Service"));
          $(selectCoop).append($('<option></option>').attr('value',"").text("Workers"));
         
      $(divFormGroup).append("<table><tr><td>",selectCoop,"</td><td>",deleteSpan,"</td></tr></table>");
      $("#amendmentAddForm .coop-col").append(divFormGroup);
    });
  
  
  $("#amendmentAddForm #amendmentAddAgree").click(function(){
    if($(this).is(':checked')){
      $('#amendmentAddForm #amendmentAddBtn').removeAttr('disabled');
    }else{
      $('#amendmentAddForm #amendmentAddBtn').attr('disabled','disabled');
    }
  });

 $('#amendmentAddForm #addMoreComBtn').on('click', function(){
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
     $(divFormGroup).append("<table><tr><td>",selectComposition,"</td><td>",deleteSpan,"</td></tr></table>");
     $("#amwndmwnrAddForm .col-com").append(divFormGroup);
  });

//commond bond of membership
 $('#amendmentAddForm #commonBondOfMembership').on('change', function(){
    if($(this).val()=="Associational")
    {
      // $("#default-wrapper").hide();
        $("#associational-wrapper").show();
    }
    else if($(this).val()=="Institutional")
    {   
      // $("#default-wrapper").hide();
          $("#associational-wrapper").hide();
         $("#institutional-wrapper").show();
    }
    else if($(this).val()=="Occupational")
    {
        // $("#default-wrapper").hide();  
          $("#associational-wrapper").hide();
         $("#institutional-wrapper").hide();  
        $("#occupational-wrapper").show();
    }
    else{
         // $("#default-wrapper").hide();  
          $("#associational-wrapper").hide();
         $("#institutional-wrapper").hide();  
        $("#occupational-wrapper").hide();
    }

 });

 
});
