$(function(){
  if($('#termsAndConditionModal').length){
    $('#termsAndConditionModal').modal('show');
  }



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

  // $("#amendmentAddForm").validationEngine('attach',
  //     {promptPosition: 'inline',
  //     scroll: false,
  //     focusFirstField : false,
  //     onValidationComplete: function(form,status){
  //         if(status==true){
  //           if($("#amendmentAddLoadingBtn").length <= 0){
  //             $("#amendmentAddForm #amendmentAddBtn").hide();
  //             $("#amendmentAddForm .col-branch-btn").append($('<button></button>').attr({'id':'branchAddLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
  //             return true;
  //           }else{
  //             return false;
  //           }
  //         }else{
  //           return false;
  //         }
  //       }
  // });

//modify occupational
$('#amendmentAddForm #addMoreComBtn').on('click', function(){ 
var x =1;
var htmlFielda = '<div class="list_occup"> <select name="compositionOfMembersa[]" id="compositionOfMembersa" class="custom-select composition-of-members" required="required" ></select><a class="customDeleleBtn compositionRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a></div> ';
              

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

      $(".occupational-wrappera").append(htmlFielda);   
            $('.compositionRemoveBtn').on('click',function(){
              $(this).closest('.list_occup').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
            });
    

    // $(divFormGroup).append("<table width='100%'><tr><td width='90%'>",selectComposition,"</td><td width='10%'>",deleteSpan,"</td></tr></table>");
    // $("#reserveUpdateForm .col-com").append(divFormGroup);
  });

//end modify
  $('#amendmentAddForm #regNo').on('change', function(){
    
    var coopName = $('#coopName').val();
    var regNo = $('#regNo').val();

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
        $('#amendmentAddForm #acronym_names').val(data.acronym_name);
        $('#amendmentAddForm #areaOfOperation').val(data.areaOfOperation);
        $('#amendmentAddForm #commonBondOfMembership').val(data.commonBond);
        if(data.commonBond == 'Occupational')
        {
            $("#occupational-wrapper").show();   
             $("#institutional-wrapper").remove();
           $("#associational-wrapper").remove(); 
        }
        else if(data.commonBond == 'Institutional')
        {
          // $("#institutional-wrapper").show();
           $("#associational-wrapper").remove();
          $("#occupational-wrapper").remove();
          $("#ins_field_membership").val(data.field_of_membership);
          var ustr = data.name_of_ins_assoc;
          var astr = ustr.split(',');  
          $.each(astr, function(i,row) {
            var x =1;
            var htmlField = '<div class="list_product"><input type="text" name="name_ins_assoc[]" id="name_ins_assoc" class="form-control" style="margin-bottom:3px;" value="'+row+'"> <a class="customDeleleBtn compositionRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a></div> ';
                $(".con-wrapper").append(htmlField);   
            $('.compositionRemoveBtn').on('click',function(){
              $(this).closest('.list_product').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
            });
       
          });
             $("#name_institutional").val(data.name_of_ins_assoc); 
        }

        else if(data.commonBond == 'Associational')
        {

          // $("#associational-wrapper").show()
          $("#institutional-wrapper").remove();
          $("#occupational-wrapper").remove();
          // $("#").remove();
          $("#assoc_field_membership").val(data.field_of_membership);
          var ustr = data.name_of_ins_assoc;
          var astr = ustr.split(',');  
          $.each(astr, function(i,row) {
            var x =1;
            var htmlField = '<div class="list_assoc"><input type="text" name="name_associational[]" id="name_associational" class="form-control" style="margin-bottom:3px;" value="'+row+'"> <a class="customDeleleBtn compositionRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a></div> ';
                $(".assoc-wrapper").append(htmlField);   
            $('.compositionRemoveBtn').on('click',function(){
              $(this).closest('.list_assoc').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
            });
       
          });
             $("#name_institutional").val(data.name_of_ins_assoc); 
        }


        $('#amendmentAddForm #newNamess').val(data.proposed_name);
         $('#amendmentAddForm #newName2').val(data.proposed_name);
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
              console.log(rowc)
                    $(this).find("option[value=" + rowc.composition +"]").attr('selected', true);;
                if(i==$x) {
                }
            });
            $x++;
        });

        // modified
        var cooperativeID = data.application_id;
        $("#cooperative_idss").val(cooperativeID);
        $.ajax({
                type : "POST",
                url  : "composition_of_members_",
                async:false,
                dataType: "json",
                data : {
                  coop_ids:cooperativeID  
                },
                success: function(dataa){
                  // alert(dataa.composition);
                   $.each(dataa, function(u,composition){
                    var the_compositon = composition['id'];
                   // var_dump(composition);
                     $("#compositionOfMembersa option[value='"+the_compositon+"']").attr("selected", "selected");
                    // $("#comp_sition").val(composition['composition']);
                   })

                }
              });
        
        // load type coop modified
        if($("#typeOfCooperative1").val().length>0)
        {
          var val1=[]; 
            $('select[name="typeOfCooperative[]"] option:selected').each(function() {
               val1.push($(this).val());
      
           $('#typeOfCooperative_value').val(val1);
          });
        }
        
        // end load coop type array


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

$("#amendmentAddForm #newNamess").bind("keyup change",function(){

  var val = $(this).val();
  var count_coop_type =$('#amendmentAddForm select[name="typeOfCooperative[]"').length;
  if(count_coop_type>1)
  {
    $("#type_of_coop").html(val+' Multipurpose Cooperative');
    $("#proposed_name_msg").html('* Do not include the word Multipurpose Cooperative in proposed name');
    
  }
  else
  {
     $("#type_of_coop").html(val);
       $("#proposed_name_msg").html('* Do not include the word Multipurpose Cooperative in proposed name');
  }
 
});

  
  $('#amendmentAddForm #typeOfCooperative1').on('change', function(){
    $('#amendmentAddForm #addMoreSubclassBtn').prop("disabled",true);
    $("#amendmentAddForm #newNamess").prop("disabled",true);
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
      $("#amendmentAddForm #newNamess").prop("disabled",false);
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
  
  //modified add major industry dynamically
  let count_major_industry=parseInt($('.major-industry').length);
  $('#amendmentAddForm #addMoreSubclassBtn').on('click', function(){
// alert("asdfa")
     // var origin_name =  $("#newName2").val();
     // var start_counting_major = ++count_major_industry;
     // // alert(start_counting_major);
     // if(start_counting_major>1)
     // {  
     //    $("#newNamess").val(origin_name+' Multipurpose');
     // }
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
        // console.log("cooptypes: "+coop_types);
      var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn businessActivityRemoveBtn float-right text-danger'}).click(function(){
         
           // start_counting_major--;
           // if(start_counting_major<=1)
           // {  
           //    $("#newNamess").val(origin_name);
           // }
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

//add coop type dynamically modified
  var count_text_input =1;
  $('#amendmentAddForm #addCoop').on('click', function(e){
    var name_origin =  $("#newName2").val();
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
    var selectCoop = $('<select></select>').attr({'class': 'custom-select coop-type form-control validate[required]','name': 'typeOfCooperative[]', 'id': 'typeOfCooperative1' + (intLastCount + 1)}).prop("disabled",false);
    var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn float-right text-danger'}).click(function(e){
       
        $(this).parent().remove();
        // count_text_input--;
        // less_count_updateName(count_text_input);
      
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
                 $('.major-industry').append($('<option></option>').attr('value',major_industry['id']).text(major_industry['description']));

                 // $('.select-major').append($('<option></option>').attr('value',major_industry['description']).text(major_industry['description']));

              });
             }
            }); //end ajax
        }); 
      e.preventDefault();
    });
  
  

  //start
 $('#amendmentAddForm #addMoreInsBtn_insti').on('click', function(){
     var htmlField = '<div class="list_product"><input type="text" name="name_ins_assoc[]" id="name_ins_assoc" class="form-control" style="margin-bottom:3px;" value=""> <a class="customDeleleBtn compositionRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a></div> ';
                $(".con-wrapper").append(htmlField);   
            $('.compositionRemoveBtn').on('click',function(){
              $(this).closest('.list_product').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
            });
    
  });
  //end 

//start function modified
function less_count_updateName($num_value)
{
  if($num_value<=1){
           console.log($num_value);
           var orig_name = $("#newName2").val();
           console.log(orig_name);
            $("#newNamess").val(orig_name);
        }
}

//end function modified
    //start
 $('#amendmentAddForm #addMoreInsBtn_Associational').on('click', function(){
     var htmlField = '<div class="list_assoc"><input type="text" name="name_associational[]" id="name_associational" class="form-control" style="margin-bottom:3px;" value=""> <a class="customDeleleBtn compositionRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a></div> ';
                $(".assoc-wrapper").append(htmlField);   
            $('.compositionRemoveBtn').on('click',function(){
              $(this).closest('.list_assoc').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
            });
    
  });

  //end 

 // $('#amendmentAddForm #addMoreComBtn').on('click', function(){
 //    var lastCountOfcom = $('select[name="compositionOfMembers[]"').last().attr('id');
 //    intLastCount = parseInt(lastCountOfcom.substr(-1));
 //    var divFormGroup= $('<div></div>').attr({'class':'form-group'});
 //    var selectComposition = $('<select></select>').attr({'class': 'custom-select form-control validate[required]','name': 'compositionOfMembers[]', 'id': 'compositionOfMembers' + (intLastCount + 1)}).prop("disabled",false);
 //    var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn compositionRemoveBtn float-right text-danger'}).click(function(){
 //        $(this).parent().remove();
 //      });

 //    $.ajax({
 //      type : "POST",
 //      url  : "composition",
 //      dataType: "json",
      
 //      success: function(data){
 //          $(selectComposition).append($('<option></option>').attr('value',"").text(""));
 //          $.each(data, function(key,value){
 //            $(selectComposition).append($('<option></option>').attr('value',value.composition).text(value.composition));
 //          });
 //      }
 //    });
 //     $(divFormGroup).append("<table><tr><td>",selectComposition,"</td><td>",deleteSpan,"</td></tr></table>");
 //     $("#amwndmwnrAddForm .col-com").append(divFormGroup);
 //  });

//commond bond of membership
 $('#amendmentAddForm #commonBondOfMembership').on('change', function(){
 
    if($(this).val()=="Associational")
    {
      // $("#default-wrapper").hide();
        $("#associational-wrapper").show();
        // $("#institutional-wrapper").hide();
    }
    else if($(this).val()=="Institutional")
    {   
      // $("#default-wrapper").hide();
          $("#associational-wrapper").remove();
         $("#institutional-wrapper").show();
    }
    else if($(this).val()=="Occupational")
    {
        // $("#default-wrapper").hide();  
          $("#associational-wrapper").remove();
         $("#institutional-wrapper").remove();  
        // $("#occupational-wrapper").show();
         // $("#associational-wrapper").show()
      
    }
    else{
         // $("#default-wrapper").hide();  
        //   $("#associational-wrapper").hide();
        //  $("#institutional-wrapper").hide();  
        // $("#occupational-wrapper").hide();
    }

 });

 $("#amendmentAddForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
       // alert( $("#amendmentAddForm").validationEngine('validate'));
          if(status==true){
            if($("#reserveAddLoadingBtn").length <= 0){
              $("#amendmentAddForm #amendmentAddBtn").hide();
              $("#amendmentAddForm .col-reserve-btn").append($('<button></button>').attr({'id':'reserveAddLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
            }else{
              return false;
            }
          }else{
            return false;
          }
        }
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
             url  : "get_coopTypeID_ajax",
             dataType: "json",
             data: {cooptype_:cooptype_value},
             success: function(responsetxt){
              console.log(responsetxt['desciption']);
              $.each(responsetxt,function(a,major_industry){
                 $('.select-major').append($('<option></option>').attr('value',major_industry['description']).text(major_industry['description']));

              });
             }
            }); 
        }); 
//endo modified

   $("#amendmentAddForm #amendmentAddAgree").click(function(){
    if($(this).is(':checked')){
      $('#amendmentAddForm #amendmentAddBtn').removeAttr('disabled');
    }else{
      $('#amendmentAddForm #amendmentAddBtn').attr('disabled','disabled');
    }
  });

 

});





//end form validate

