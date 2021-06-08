$(function(){
  if($('#termsAndConditionModal').length){
    $('#termsAndConditionModal').modal('show');
  }


  $('#amendmentAddForm select[name="majorIndustry[]"').each(function(index){
    $(this).on('change',function(){ 
      $('#amendmentAddForm #subClass'+(index+1)).empty();
      $('#amendmentAddForm #subClass'+(index+1)).prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        var subClassTemp =   $('#amendmentAddForm #subClass'+(index+1));
        $(subClassTemp).prop("disabled",false);
        var major_industry = $(this).val();
        var coop_type = $('#amendmentAddForm #typeOfCooperative').val();
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

  

//modify occupational
  $('#amendmentAddForm #addMoreComBtn').on('click', function(){ 
  var x =1; 
  var htmlFielda = '<div class="col-md-12 list-compositions"> <select name="compositionOfMembersa[]" id="compositionOfMembersa" class="custom-select composition-of-members" required="required" ></select><a class="customDeleleBtn compositionRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a></div> ';
              

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

      $(".occupational-wrappera").append(htmlFielda);  
          $('.compositionRemoveBtn').on('click',function(){ 
                $(this).closest('.list-compositions').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
          });
    
             
    // $(divFormGroup).append("<table width='100%'><tr><td width='90%'>",selectComposition,"</td><td width='10%'>",deleteSpan,"</td></tr></table>");
    // $("#reserveUpdateForm .col-com").append(divFormGroup);
  });

  //for non dynamic
     
  $('.compositionRemoveBtn').on('click',function(){
                $(this).closest('.list-compositions').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
  });

//end modify

  function autoload_existing_coop()
  {
    var regNo = $("#amendmentAddForm #regNo").val();
    $.ajax({
        type : "POST",
        url  : "coop_info/"+regNo ,
        dataType: "json",
        data : {
          regNo: regNo 
        },
        success: function(data)
        {
          var cooperativeID = data.application_id;
          $("#cooperative_idss").val(cooperativeID);
          $("#typeOfCooperative_value").val(data.type_id);

          if (data.coopTypes=='Multipurpose'){
              count_id=1
              var label = $('<label></label>').attr({'for': 'typeCooperative '}).text("Type of Cooperativeddd");
              var typestr = data.type_id;
              var ctype = typestr.split(',');  
            $.each(ctype, function(i,row) {
              
                var c = count_id++;
                var htmlc= $('<div></div>').attr({'class':'col-md-6 list-cooptype'});
                var divFormGroup= $('<div></div>').attr({'class':'form-group'});
                // var divCol = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
                var divRow = $('<div></div>').attr({'class':'row col-md-12'});
                
                var selectCoop = $('<select></select>').attr({'class': 'custom-select form-control coop-type validate[required]','name': 'typeOfCooperative[]', 'id': 'typeOfCooperative' + c}); 
                var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn float-right text-danger'}).click(function(e){
                 $(this).parent().remove();
                }); //end delete

                $(divFormGroup).append(label,selectCoop,deleteSpan);
                // $(divRow).css({"border":"1px solid red"});
                // $(divCol).append(divFormGroup);
                $(htmlc).append(divFormGroup);
                $(divRow).append(htmlc);

                $('#amendmentAddForm .type-coop-row').append(divRow);  
                loadCoopType(selectCoop,row,data.category_of_cooperative);
            });
          }else{

            //COOPERATIVE TYPE 
            count_id=1
            var c = count_id++;
            var htmlc= $('<div></div>').attr({'class':'col-md-6 list-cooptype'});
            var divFormGroup= $('<div></div>').attr({'class':'form-group'});
            // var divCol = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
             var divRow = $('<div></div>').attr({'class':'row col-md-12'});
            var label = $('<label></label>').attr({'for': 'typeCooperative '}).text("Type of Cooperative");
            var selectCoop = $('<select></select>').attr({'class': 'custom-select coop-type form-control  validate[required]','name': 'typeOfCooperative[]', 'id': 'typeOfCooperative' + c}); 
            // var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn float-right text-danger'}).click(function(e){
            //  $(this).parent().remove();
            // }); //end delete

            $(divFormGroup).append(label,selectCoop);
            // $(divRow).css({"border":"1px solid red"});
            // $(divCol).append(divFormGroup);
            $(htmlc).append(divFormGroup);
            $(divRow).append(htmlc);
            $('#amendmentAddForm .type-coop-row').append(divRow);  
            loadCoopType(selectCoop,data.type_id,data.category_of_cooperative); //load list of  cooperative type
          }

          if (data.category_of_cooperative=='Primary')
          {  
              $('#amendmentAddForm #categoryOfCooperative').val(data.category_of_cooperative);  
          }
          else
          {
             $('#amendmentAddForm #categoryOfCooperative').val(data.category_of_cooperative+' - '+data.grouping);
          }  
             
          $('#amendmentAddForm #coopName').val(data.coopName);
          $('#amendmentAddForm #acronym_names').val(data.acronym_name);
          $('#amendmentAddForm #areaOfOperation').val(data.areaOfOperation);
          $('#amendmentAddForm #commonBondOfMembership').val(data.commonBond);

           if(data.commonBond == 'Occupational')
           {
            $("#occupational-wrappers").show();   
            $("#associational-wrappers").hide(); 
          //      intLastCount = 0;//parseInt(lastCountOfcoop.substr(-1)); 
              
          //       $.ajax({
          //         type : "POST",
          //         url  : "composition_of_members_",
          //         async:false,
          //         dataType: "json",
          //         data : {
          //           coop_ids:cooperativeID  
          //         },
          //         success: function(dataa){
          //       // console.log(dataa);
          //            $.each(dataa, function(u,composition){
                    
          //            var idsss = parseInt(intLastCount++); 
          //             //load dynamic html
                    
          //             var htmlc= $('<div></div>').attr({'class':'col-md-12 list-compositions'});
          //             // var divRow = $('<div></div>').attr({'class':'row col-md-12'});
          //             var divFormGroup= $('<div></div>').attr({'class':'form-group'});
          //             // var labelCompo = $('<label></label>').attr({'for': 'Composition of Members'}).text("Composition of Members");
          //             var selectCompo = $('<select></select>').attr({'class': 'custom-select compositions form-control validate[required]','name': 'compositionOfMembersa[]', 'id': 'compositionOfMembers'+idsss}).prop("disabled",false);
          //             var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn float-right text-danger'}).click(function(e){

          //             });//end delete

          //             $(divFormGroup).append(selectCompo,deleteSpan);
          //             // $(divRow).append(divFormGroup);
          //             $(htmlc).append(divFormGroup);
          //             $("#wrappera").append(htmlc);
          //             $.ajax({
          //                 type : "POST",
          //                 url  : "composition",
          //                 'async' : false,
          //                 dataType: "json",
          //                 success: function(data){
          //                      $('#compositionOfMembersa').append($('<option></option>').attr('value',"").text(""));
          //                     $.each(data, function(key,value){
          //                       $('.compositions').append($('<option></option>').attr('value',value.id).text(value.composition));   
                                
          //                   }); 
          //                 }
          //               });

          //             //end load dynamic html
          //             var the_compositon = composition['id'];
                  
          //            // alert(the_compositon);
                  
          //              $("#compositionOfMembers"+idsss+ " option[value='"+the_compositon+"']").attr("selected", "selected");
          //              // $("#compositionOfMembers"+idsss+" > [value='"+the_compositon+"']").attr("selected", "true"); 
                    
          //            }); //end each

          //         } //end success
          //       });
          // }
         
          // if(data.commonBond == 'Institutional')
          // {
          //   // $("#institutional-wrapper").show();
          //    $("#associational-wrapper").remove();
          //   $("#occupational-wrapper").remove();
          //   $("#ins_field_membership").val(data.field_of_membership);
          //   var ustr = data.name_of_ins_assoc;
          //   var astr = ustr.split(',');  
          //   $.each(astr, function(i,row) {
          //     var x =1;
          //     var htmlField = '<div class="list_product"><input type="text" name="name_ins_assoc[]" id="name_ins_assoc" class="form-control" style="margin-bottom:3px;" value="'+row+'"> <a class="customDeleleBtn compositionRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a></div> ';
          //         $(".con-wrapper").append(htmlField);   
          //     $('.compositionRemoveBtn').on('click',function(){
          //       $(this).closest('.list_product').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
          //     });
         
          //   });
          //      $("#name_institutional").val(data.name_of_ins_assoc); 
           }

           else if(data.commonBond == 'Associational' || data.commonBond == 'Institutional')
           {
             $("#occupational-wrappers").hide();   
             $("#associational-wrappers").show();
          //   // $("#associational-wrapper").show()
          //   $("#institutional-wrapper").remove();
          //   $("#occupational-wrapper").remove();
          //   // $("#").remove();
          //   $("#assoc_field_membership").val(data.field_of_membership);
          //   var ustr = data.name_of_ins_assoc;
          //   var astr = ustr.split(',');  
          //   $.each(astr, function(i,row) {
          //     var x =1;
          //     var htmlField = '<div class="list_assoc"><input type="text" name="name_associational[]" id="name_associational" class="form-control" style="margin-bottom:3px;" value="'+row+'"> <a class="customDeleleBtn compositionRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a></div> ';
          //     $(".assoc-wrapper").append(htmlField);   
          //     $('.compositionRemoveBtn').on('click',function(){
          //       $(this).closest('.list_assoc').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
          //     });
         
          //   });
          //      $("#name_institutional").val(data.name_of_ins_assoc); 
          }
          else
          {
               $("#occupational-wrappers").hide();   
             $("#associational-wrappers").hide();
          }

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

          // setTimeout(function(){
          //   // $('#amendmentAddForm #barangay').val(data.bCode);
          //   if(data.area_of_operation=='Barangay'){
          //     // alert(data.areaOfOperation);
          //     $('#amendmentAddForm #barangay').prop("disabled",true);
          //     $('#amendmentAddForm #city').prop("disabled",true);
          //     $('#amendmentAddForm #province').prop("disabled",true);
          //     $('#amendmentAddForm #region').prop("disabled",true);
          //   }else if(data.areaOfOperation=='Municipality/City'){
          //     // alert(data.areaOfOperation);
          //     $('#amendmentAddForm #city').prop("disabled",true);
          //     $('#amendmentAddForm #province').prop("disabled",true);
          //     $('#amendmentAddForm #region').prop("disabled",true);
          //     $('#amendmentAddForm #barangay').prop("disabled",false);
          //   }else if(data.areaOfOperation=='Provincial'){
          //        // alert('Provincial');
          //     $('#amendmentAddForm #province').prop("disabled",true);
          //     $('#amendmentAddForm #region').prop("disabled",true);
          //     $('#amendmentAddForm #city').prop("disabled",false);
          //     $('#amendmentAddForm #barangay').prop("disabled",false);
          //   }else if(data.areaOfOperation=='Regional'){

          //       // alert(data.areaOfOperation);
          //     $('#amendmentAddForm #region').prop("disabled",true);
          //     $('#amendmentAddForm #province').prop("disabled",false);
          //     $('#amendmentAddForm #city').prop("disabled",false);
          //     $('#amendmentAddForm #barangay').prop("disabled",false);
          //   }else if(data.areaOfOperation=='National'){
          //     // alert(data.areaOfOperation);
          //     $('#amendmentAddForm #region').prop("disabled",false);
          //     $('#amendmentAddForm #province').prop("disabled",false);
          //     $('#amendmentAddForm #city').prop("disabled",false);
          //     $('#amendmentAddForm #barangay').prop("disabled",false);
          //   }

          // },1700); 

          
          $('#amendmentAddForm #newNamess').val(data.proposed_name);
          $('#amendmentAddForm #newName2').val(data.proposed_name);
          $('#amendmentAddForm #acronym_name').val(data.acronym);
          $('#amendmentAddForm #blkNo').val(data.noStreet);
          $('#amendmentAddForm #streetName').val(data.Street);
          var coop_types = "";
          // $('#amendmentAddForm .coop-type').each(function(){
          //    if($(this).val().length>0) {
          //        coop_types += $(this).val()+"|";
          //    } 
          // });

        //business activity
          var count_id = 1;
          var business_act = data.business_activities;
          // alert(count_array.length);
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
          if(business_act.length>1)
           { 
            var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn businessActivityRemoveBtn float-right text-danger'}).click(function(){
                // $(this).parent().remove();
                var lastCountOfSubclass = $('select[name="subClass[]"').last().attr('id'); 
                var totalCountOFSubclass = $('select[name="subClass[]"').length;
                var intLastCount = parseInt(lastCountOfSubclass.substr(-1));
                // alert(intLastCount);
               
                 $(this).closest('.list-major').remove();
                $('#amendmentAddForm select[name="majorIndustry[]"]').each(function(index){
                  $(this).siblings('label').text("Major Industry Classification No. "+(index+1));
                });
                $('#amendmentAddForm select[name="subClass[]"]').each(function(index){
                  $(this).siblings('label').text("Major Industry Classification No. Subclass "+(index+1));
                });
              });
          }
          $(divFormGroupMajorIndustry).append(divColMajorIndustry,labelMajorIndustry,selectMajorIndustry);
          $(divFormGroupSubclass).append(divColSubclass,labelSubClass,selectSubClass);
           
          console.log(business_activy);
          $(htmls).append(divFormGroupMajorIndustry,divFormGroupSubclass,deleteSpan);
          $('.row-cis').append(htmls);
           $(selectMajorIndustry).append($('<option selected></option>').attr('value',business_activy['bactivity_id']).text(business_activy['bactivity_name']));
           $(selectSubClass).append($('<option selected></option>').attr('value',business_activy['bactivitysubtype_id']).text(business_activy['bactivitysubtype_name']));
           $(selectSubClass).prop("disabled",false);
           // console.log(business_activy['bactivitysubtype_id']);
        }); //end each loop
       
          //end business

         var type_coperative_array = $('#typeOfCooperative_value').val();
          var splite_str = type_coperative_array.split(',');
          $.each(splite_str, function(n, cooperative_typeIDs){
              $.ajax({
                type : "POST",
                url  : "../api/major_industries",
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
                      url  : "../api/industry_subclasses",
                      dataType: "json",
                      data : {
                        coop_type: cooperative_typeIDs,
                        major_industry: major_industry
                      },
                      success: function(datai){
                          // $('.subclass-in').append($('<option></option>').attr('value',"").text(""));
                          $.each(datai, function(key,value){
                             var $selected = "";
                                  $('.subclass-in').append($("<option></option>").attr('value',value.id).text(value.description));
                           

                              // var $selected = "";
                              // console.log(data.business_activities);
                              // $.each(data.business_activities, function(i,rowd) {
                              //     if(rowd.bactivitysubtype_id==value.id) {
                              //         $selected = "Selected = 'Selected'";
                              //     }
                              //   // console.log(rowd);
                              //     $('.subclass-in').append($("<option></option>").attr('value',rowd['bactivitysubtype_id']).text(rowd['bactivitysubtype_name']));
                              // });
                            //  $('.sublcass-ins').append($("<option></option>").attr('value',value.id).text(rowd.bactivitysubtype_name));
                          });
                      }
                    });
                }
              }); //end ajax
          }); //end of $.each

          

          no_of_members = $(".composition-of-members").length;
          $x = 0;
          $(".composition-of-members").each(function(){
              $.each(data.composition_of_members, function(i,rowc) {
                
                      $(this).find("option[value=" + rowc.composition +"]").attr('selected', true);;
                  if(i==$x) {
                  }
              });
              $x++;
          });

          // modified
         
          
          
               
            
          // load type coop modified
          if($("#typeOfCooperative1").val() && ($("#typeOfCooperative1").val()!=null) )
          {
            var val1=[]; 
              $('select[name="typeOfCooperative[]"] option:selected').each(function() {
                 val1.push($(this).val());
        
             $('#typeOfCooperative_value').val(val1);
            });
          }
          // end load coop type array
          
        }//end success
      });

       

      
        
        var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn businessActivityRemoveBtn float-right text-danger'}).click(function(){
            $(this).parent().parent().parent().remove(); 
            $('#amendmentAddForm select[name="majorIndustry[]"]').each(function(index){
              $(this).siblings('label').text("Major Industry Classification No. " + (index+1));
            });
            $('#amendmentAddForm select[name="subClass[]"]').each(function(index){
              $(this).siblings('label').text("Major Industry Classification No. " + (index+1) + " Subclass ");
            });
          });

        $("#newNamess").focus();


  }//end function autoload
   autoload_existing_coop();



   $('#amendmentAddForm select[name="majorIndustry[]"').each(function(index){
            $(this).on('change',function(){ 
              $('#amendmentAddForm #subClass'+(index+1)).empty();
              $('#amendmentAddForm #subClass'+(index+1)).prop("disabled",true);
              if($(this).val() && ($(this).val()).length > 0){
                var subClassTemp =   $('#amendmentAddForm #subClass'+(index+1));
                $(subClassTemp).prop("disabled",false);
                var major_industry = $(this).val();
                // var coop_type = $('#amendmentAddForm .coop_type').val(); 
               var coop_type=$('select[name="typeOfCooperative[]"] option:selected').val();
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

    $("#amendmentAddForm #acronym_names").on("change",function()
    {
        $("#newNamess").focus();
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
           $("#proposed_name_msg").html('* Do not include the word Cooperative in proposed name');
      }
      
        if($(this).val() && ($(this).val()).length > 0)
        {
        $("#amendmentAddForm #addMoreSubclassBtn").prop("disabled",false);
          document.getElementById("newNamess").maxLength = "61";

          $('#amendmentAddForm #newNamess').on('change',function(){
            document.getElementById('acronym_names').value = '';
            var value = document.getElementById("newNamess").value;
            var totalval = 61 - value.length; 
            // alert(totalval+ value.length);
            if(totalval == 0){ 
              $("#amendmentAddForm #acronym_names").prop("disabled",true);
              $('#amendmentAddForm #acronymnameerr').show();
            } else {
              $('#amendmentAddForm #acronymnameerr').hide();
              $("#amendmentAddForm #acronym_names").prop("disabled",false);
            }
            document.getElementById("acronym_names").maxLength = totalval;
          });
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

  



  
  



  //start function modified
  function less_count_updateName($num_value)
  {
    if($num_value<=1){
             console.log($num_value);
             var orig_name = $("#newName2").val();
             // console.log(orig_name);
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

    

   
      //modified by json
      // $(".coop-type").on('change',function(){
      //         var cooptype_value = this.value;
      //        // alert('dddd');
      //         var typeCoop_arraysa=[]; 
      //      $('select[name="typeOfCooperative[]"] option:selected').each(function() {
      //      typeCoop_arraysa.push($(this).val());
      //     alert(typeCoop_arraysa);
      //       $('#typeOfCooperative_value').val(typeCoop_arraysa);
      //      });

      //             $.ajax({
      //              type : "POST",
      //              url  : "get_coopTypeID_ajax",
      //              dataType: "json",
      //              data: {cooptype_:cooptype_value},
      //              success: function(responsetxt){
      //               // console.log(responsetxt['desciption']);
      //               $.each(responsetxt,function(a,major_industry){
      //                  $('.select-major').append($('<option></option>').attr('value',major_industry['id']).text(major_industry['description']));

      //               });
      //              }
      //             }); 
      //         }); 
      // //endo modified

    $("#amendmentAddForm #amendmentAddAgree").click(function(){
      if($(this).is(':checked')){
        $('#amendmentAddForm #amendmentAddBtn').removeAttr('disabled');
      }else{
        $('#amendmentAddForm #amendmentAddBtn').attr('disabled','disabled');
      }
    });


    

}); //end of $function


   
    //commond bond of membership
      $('#amendmentAddForm #commonBondOfMembership').on('change', function(){
     // alert($(this).val());
        if($(this).val()=="Associational" || $(this).val()=="Institutional")
        { 
          $("#associational-wrappers").show();
          $('#occupational-wrappers').hide();
              var x =1;
          // if($("#commonbond").val()=='Occupational')
          // {
          //    $('#associational-wrappers').show();
          // }
          // else
          // {    
          //     var div= $('<div></div>').attr({'class':'col-md-12 associational-wrappers'});
          //     var div_row_f =  $('<div></div>').attr({'class':'col-md-6'});
          //     var divFormGroup_f= $('<div></div>').attr({'class':'form-group'});
          //     // var divCol = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
          //     var label_f = $('<label></label>').attr({'for': 'subClass '}).text("Field of Membership (Note: Employees/Retirees)");
          //     var input_f = $('<input>').attr({'class': 'custom-select form-control validate[required]','name': 'assoc_field_membership', 'id': 'ins_field_membership'}).prop("disabled",false);
          //     var html_f =div_row_f.append(divFormGroup_f,label_f,input_f);

          //     var div_row_a = $('<div></div>').attr({'class':'col-md-6 associational-wrappers'});
          //     var divFormGroup_a= $('<div></div>').attr({'class':'form-group'});
          //     var divCol = $('<div></div>').attr({'class':'row col-sm-12 col-md-12 add_custom'});
          //     var label_a = $('<label></label>').attr({'for': 'subClass '}).text("Name of Association");
          //     var input_a = $('<input>').attr({'class': 'custom-select form-control validate[required]','name': 'name_associational[]', 'id': 'name_associational'}).prop("disabled",false);
          //     var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn float-right text-danger'}).click(function(e){
          //            $(this).parent().remove();
          //           }); //
          //     var button_add = $('<button><i class="class="fas fa-plus">Add Additional Name of Associational</i></a>').attr({'class':'btn btn-success btn-sm float-right btn-assoc'}).click(function(a){
          //           a.preventDefault();
          //           var divwrapper =  $('<div></div>').attr({'class':'col-md-12 associational-add'});
          //           $(divwrapper).css({'margin-top':"20px"})
          //            var input_add = $('<input>').attr({'class': 'custom-select form-control validate[required]','name': 'name_associational[]', 'id': 'name_associational'}).prop("disabled",false);
          //            var deleteSpan_add = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn float-right text-danger'}).click(function(e){
          //            $(this).closest('.associational-add').remove();
          //           }); //
          //            divwrapper.append(input_add,deleteSpan_add)
          //             var div = divCol.append(divwrapper);
          //           }); //
             
          //     $(button_add).css({"margin-top":"30px"});
          //     var html_a = div_row_a.append(divFormGroup_a,label_a,input_a,deleteSpan,divCol,button_add);
          //     div.append(html_f,html_a);
          //     $("#common_bond_wrapper").append(div);
          // }         
             
        }
        // else if($(this).val()=="Institutional")
        // {   
        //   $("#associational-wrapper").hide();
        //   $("#institutional-wrapper").show();
        // }
        else if($(this).val()=="Occupational")
        { 
          $('.occupational-wrappers').show();
          $("#associational-wrappers").hide();
              // if($("#commonBond").val()=="Occupational")
              // { 
              //    $('.occupational-wrappers').show();
              // }
              // else
              // { $("#associational-wrappers").hide();
              //   var div= $('<div></div>').attr({'class':'col-md-12 occupational-wrappers'});
              //   var div_row_o =  $('<div></div>').attr({'class':'col-md-12'});
              //   var label_o = $('<label></label>').attr({'for': 'subClass '}).text("Composition of Members");
              //   var input_o = $('<input>').attr({'class': 'custom-select form-control validate[required]','name': 'name_associational[]', 'id': 'name_associational'}).prop("disabled",false);
              //   var deleteSpan_o = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn float-right text-danger'}).click(function(e){
              //          $(this).parent().remove();
              //         });

              //   var html = div.append(div_row_o,label_o,input_o,deleteSpan_o);
              //   $("#common_bond_wrapper").append(html);
              //   // $("#default-wrapper").hide();  
              // } 
            
           
             // $("#associational-wrapper").show()          
        }
        else{
             // $("#default-wrapper").hide();  
            $(".associational-wrappers").hide();
            $(".occupational-wrappers").hide();
        }
      });
      //end commonbond membership


  //add coop type dynamically modified
  var count_text_input =1;
  $("#amendmentAddForm #addCoop").on('click', function(e){ 
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
      var htmlc= $('<div></div>').attr({'class':'col-md-6 list-cooptype'});
      var divRow = $('<div></div>').attr({'class':'row col-md-12'});
      var divFormGroup= $('<div></div>').attr({'class':'form-group'});
      var selectCoop = $('<select></select>').attr({'class': 'custom-select coop-type form-control validate[required]','name': 'typeOfCooperative[]', 'id': 'typeOfCooperative1' + (intLastCount + 1)}).prop("disabled",false);
      var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn float-right text-danger'}).click(function(e){
            
        //remove coop type      
        $(this).parent().remove(); 
            $('.major-ins').empty();
            $('.subclass-in').empty();
            $('.subclass-in').prop("disabled",true);
            var typeCoop_arrays=[]; 
          $('select[name="typeOfCooperative[]"] option:selected').each(function() {
              typeCoop_arrays.push($(this).val()); 
              // $('#typeOfCooperative_value').val(typeCoop_arrays);
          });      
           // alert(typeCoop_arrays);
            // $('#amendmentAddForm .major-ins').empty();
            $('#amendmentAddForm .major-ins').append($('<option></option').attr({'selected':true}).val(""));
                $.ajax({
                 type : "POST",
                 url  : "../api/major_industries_amendment",
                 dataType: "json",
                 data: {cooptype_:typeCoop_arrays},
                 success: function(responsetxt){
                  $.each(responsetxt,function(a,major_industry){
                   console.log(major_industry);

                     $('.major-ins').append($('<option></option>').attr('value',major_industry['major_industry_id']).text(major_industry['description']));
                     
                     // $('.select-major').append($('<option></option>').attr('value',major_industry['description']).text(major_industry['description']));

                  });
                 }
                }); //end ajax

         });
        //end remove coop type

      
    
      $(divFormGroup).append(selectCoop,deleteSpan);
      $(htmlc).append(divFormGroup);
      $(divRow).append(htmlc);
      $("#amendmentAddForm .type-coop-row").append(divRow);
    
      list_cooperative_type(selectCoop); //load coop type selectbox
      e.preventDefault();
      
    }); //end of addCoop function
    
     //onchge coop type
    $(document).on('change','.coop-type',function(){
      
        var cooptype_value = this.value;
        var typeCoop_arrays=[]; 
          $('select[name="typeOfCooperative[]"] option:selected').each(function() {
              typeCoop_arrays.push($(this).val());
              $('#typeOfCooperative_value').val(typeCoop_arrays);
          });      
           // alert(typeCoop_arrays);
            $('#amendmentAddForm .major-ins').empty();
            $('#amendmentAddForm .subclass-in').empty();
            $('#amendmentAddForm .subclass-in').prop('disable',true);
            $('#amendmentAddForm .major-ins').append($('<option></option').attr({'selected':true}).val(""));
           $.ajax({
                 type : "POST",
                 url  : "../api/major_industries_amendment",
                 dataType: "json",
                 data: {cooptype_:typeCoop_arrays},
                 success: function(responsetxt){
                  $.each(responsetxt,function(a,major_industry){
                     $('.major-ins').append($('<option></option>').attr('value',major_industry['major_industry_id']).text(major_industry['description']));
                  });

                 }
                }); //end ajax

     
      });
     // }); 
    // //end onchange coop type 
   
    //list coopt type
    function list_cooperative_type($select_id)
    {
              // alert($select_id);

                $($select_id).append($('<option></option').attr({'selected':true}).val(""));
                $.ajax({
                  async:false,
                  type : "POST",
                 url  : "cooperative_type_ajax",
                 dataType: "json",
                 success: function(responsetxt){
                  // console.log(responsetxt);
                  $.each(responsetxt,function(a,coop_type){
                     $($select_id).append($('<option></option>').attr('value',coop_type['id']).text(coop_type['name']));

                  });
                 }
                }); 

    }
    //end list coop type

    //start list_coop_type2
  function loadCoopType($select_id,$selected_id,$category)
  {
    $(document).ready(function(){
        $.ajax({
            type : "POST",
            url  : "cooperative_type_ajax",
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
  //end list_coop_type2



   

     $(document).on('change','.major-ins',function(){
        const current_major_id =  $(this).attr('id'); 
        var intLastCount = parseInt(current_major_id.substr(-1));
      $('#amendmentAddForm #subClass'+(intLastCount)).empty();
      $('#amendmentAddForm #subClass'+(intLastCount)).prop("disabled",true);
          if($(this).val() && ($(this).val()).length > 0){
            var subClassTemp =   $('#amendmentAddForm #subClass'+(intLastCount)); 
            $(subClassTemp).prop("disabled",false);
            var major_industry = $(this).val();
          
            // if(coop_type.length > 0 ){ 
                $.ajax({
                type : "POST",
                url  : "../api/subClass",
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

  //modified add major industry dynamically
  let count_major_industry=parseInt($('.major-industry').length);
  $('#amendmentAddForm #addMoreSubclassBtn').on('click', function(){ 
        if($('#amendmentAddForm #typeOfCooperative1').val() && ($('#amendmentAddForm #typeOfCooperative1').val()).length > 0)
        {
          var lastCountOfSubclass = $('select[name="subClass[]"').last().attr('id'); 
          var totalCountOFSubclass = $('select[name="subClass[]"').length;
          var intLastCount = parseInt(lastCountOfSubclass.substr(-1));
        
            var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn businessActivityRemoveBtn float-right text-danger'}).click(function(){
              $(this).closest('.list').remove();
              $('#amendmentAddForm select[name="majorIndustry[]"]').each(function(index){
                $(this).siblings('label').text("Major Industry Classification No. " + (index+1));
              });

              $('#amendmentAddForm select[name="subClass[]"]').each(function(index){
                $(this).siblings('label').text("Major Industry Classification No. " + (index+1) + " Subclass ");
              });
            }); //end delete span

          var divFormGroupSubclass= $('<div></div>').attr({'class':'form-group'});
          var divColSubclass = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
          var labelSubClass = $('<label></label>').attr({'for': 'subClass'+(intLastCount + 1)}).text("Major Industry Classification No. " + (intLastCount+1) + " Subclass ");
          var selectSubClass = $('<select></select>').attr({'class': 'custom-select form-control validate[required]','name': 'subClass[]', 'id': 'subClass' + (intLastCount + 1)}).prop("disabled",true);
          
          var divFormGroupMajorIndustry = $('<div></div>').attr({'class':'form-group'});
          var divColMajorIndustry = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
          var labelMajorIndustry = $('<label></label>').attr({'for': 'majorIndustry'+(intLastCount + 1)}).text("Major Industry Classification No. " + (intLastCount+1));
          var selectMajorIndustry = $('<select></select>').attr({'class': 'custom-select major-ins form-control validate[required]','name': 'majorIndustry[]', 'id': 'majorIndustry' + (intLastCount + 1)}).change(function(){
          //$(this).val() is the value of major industry
            // subclass
            var major_id = $(this).val();
            // alert(major_id);
                  // $(selectSubClass).empty();
                  // $(selectSubClass).prop("disabled",true); 
                  //   var coop_type_val = $('#amendmentAddForm #typeOfCooperative1').val();
                  //       $.ajax({
                  //       type : "POST",
                  //       url  : "major_industry_description_subclass_ajax",
                  //       dataType: "json",
                  //       data : {
                  //         major_types: major_id
                  //       },
                  //       success: function(data){
                  //           $(selectSubClass).append($('<option></option>').attr('value',"").text(""));
                  //           $.each(data, function(key,value){
                  //             $(selectSubClass).append($('<option></option>').attr('value',value.sub_class_id).text(value.subclass_description));
                  //           });
                  //       }
                  //     });
                  
                  //end subclass
          });
          var htmlss= $('<div></div>').attr({'class':'list'});
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
                 url  : "../api/major_industries_amendment",
                 dataType: "json",
                 data: {cooptype_:typeCoop_arrays},
                 success: function(responsetxt){
                  $(selectMajorIndustry).append($('<option></option>').attr('value',"").text(""));
                    $.each(responsetxt,function(a,major_industry){       
                      $(selectMajorIndustry).append($('<option></option>').attr('value',major_industry['major_industry_id']).text(major_industry['description']));
                    });
                    $(divFormGroupSubclass).append(divColSubclass,labelSubClass,selectSubClass,deleteSpan);
                    $(divFormGroupMajorIndustry).append(divColMajorIndustry,labelMajorIndustry,selectMajorIndustry);
                    // $(divInnerRow).append(divColMajorIndustry,divColSubclass);
                    // $("#amendmentAddForm .col-industry-subclass").append(divInnerRow);
                    $(htmlss).append(divFormGroupMajorIndustry,divFormGroupSubclass);
                    $(".row-cis").append(htmlss);
                    $('#amendmentAddForm select[name="majorIndustry[]"').each(function(index){
                      $(this).siblings('label').text("Major Industry Classification No. " + (index+1));
                    });
                    $('#amendmentAddForm select[name="subClass[]"').each(function(index){
                      $(this).siblings('label').text("Major Industry Classification No. " + (index+1) + " Subclass ");
                    });

                    
            
                 }
            }); //end ajax  
                   
        }else{
          $('#amendmentAddForm #typeOfCooperative1').focus();
        }
  }); //end major industry

  
  $("#amendmentAddForm #categoryOfCooperative").on('change',function(){

      $('.coop-type').empty();
      $('.coop-type').prop("disabled",true);
      loadCoopType('.coop-type','',$(this).val());
       $('.coop-type').prop("disabled",false);
      // if($(this).val())
     // if($(this).val() =='Secondary')
     // {
     //     $("#div-tertiary").remove();
     //    var divColSubcategory = $('<div></div>').attr({'class':'col-sm-12 col-md-6','id': 'div-secodary'});
     //    var divFormGroupCategory= $('<div></div>').attr({'class':'form-group'});
     //    var labelSubcategory = $('<label></label>').attr({'for': 'Sub Category'}).text("Sub Category");
     //    var selectSubcategory = $('<select></select>').attr({'class': 'custom-select form-control validate[required]','name': 'subCategory', 'id': 'subCategory'}).prop("disabled",true);
     //    $(selectSubcategory).append($('<option></option').attr({'selected':true}).val(""));
     //    $(selectSubcategory).append($('<option></option>').attr('value','Federation').text('Federation'));
     //    $(selectSubcategory).append($('<option></option>').attr('value','Cooperative Bank').text('Cooperative Bank'));
     //    $(selectSubcategory).append($('<option></option>').attr('value','Insurance').text('Insurance'));
     //    $(selectSubcategory).prop("disabled",false);
     //    $(divColSubcategory).append(divFormGroupCategory,labelSubcategory,selectSubcategory);
     //    $("#subRow").append(divColSubcategory); 
     // }
     // else if($(this).val() =='Tertiary')
     // {
     //  $("#div-secodary").remove();
     //   var divColSubcategory = $('<div></div>').attr({'class':'col-sm-12 col-md-6', 'id': 'div-tertiary'});
     //    var divFormGroupCategory= $('<div></div>').attr({'class':'form-group'});
     //    var labelSubcategory = $('<label></label>').attr({'for': 'Sub Category'}).text("Sub Category");
     //    var selectSubcategory = $('<select></select>').attr({'class': 'custom-select form-control validate[required]','name': 'subCategory', 'id': 'subCategory'}).prop("disabled",true);
     //    $(selectSubcategory).append($('<option></option').attr({'selected':true}).val(""));
     //    $(selectSubcategory).append($('<option></option>').attr('value','Federation').text('Federation'));
     //    $(selectSubcategory).append($('<option></option>').attr('value','Coopbank').text('Coopbank'));
     //    // $(selectSubcategory).append($('<option></option>').attr('value','Insurance').text('Insurance'));
     //    $(selectSubcategory).prop("disabled",false);
     //    $(divColSubcategory).append(divFormGroupCategory,labelSubcategory,selectSubcategory);
     //    $("#subRow").append(divColSubcategory); 
     // }
     // else
     // {
     //  $("#div-secodary").remove();
     //  $("#div-tertiary").remove();
     // }

  });
 
  