$(function(){
  if($('#termsAndConditionModal').length){
    $('#termsAndConditionModal').modal('show');
  }
    var mcount =0;
   $("#amendmentAddForm #amendmentAddAgree").click(function(){
      if($(this).is(':checked')){
        $('#amendmentAddForm #amendmentAddBtn').removeAttr('disabled');
      }else{
        $('#amendmentAddForm #amendmentAddBtn').attr('disabled','disabled');
      }
    });
   
    // var category =  $("#amendmentAddForm #categoryOfCooperative").val(); //alert(category);
    //   $('.coop-type').empty();
    //   // $('.coop-type').prop("disabled",true);
    //   // loadCoopType('.coop-type','',$(this).val());
    //   list_cooperative_type('.coop-type',$category);
    //   $('.coop-type').prop("disabled",false);
   
      // $('.coop-type').empty();
      // $('.coop-type').prop("disabled",true);
      // // loadCoopType('.coop-type','',$(this).val());
      // list_cooperative_type('.coop-type', $category);
      // $('.coop-type').prop("disabled",false);

 
  $("#amendmentAddForm #categoryOfCooperative").on('change',function(){
      // var lastCountOfSubclass = $('select[name="typeOfCooperative[]"').last().attr('id');
      // var totalCountOFSubclass = $('select[name="typeOfCooperative[]"').length;
      // var intLastCount = parseInt(lastCountOfSubclass.substr(-1));
      // var firstCount = $('select[name="typeOfCooperative[]"').first().attr('id'); 
      // alert(firstCount.substr(-1));
      // if($('select[name="typeOfCooperative[]"').attr('id').substr(-1) !=firstCount)
      // {
      //   $('select[name="typeOfCooperative[]"')..attr('id')remove();
      // }

      $('.coop-type').empty();
      $('.coop-type').prop("disabled",true);
      // loadCoopType('.coop-type','',$(this).val());
      list_cooperative_type('.coop-type',$(this).val());
      $('.coop-type').prop("disabled",false);
       $("#addCoop").hide();
      if($(this).val()=='Primary')
      {
        $("#addCoop").show();
      }
     
  });

  function list_cooperative_type($select_id,$category)
 {
  $($select_id).append($('<option></option').attr({'selected':true}).val(""));
  $.ajax({
  async:false,
  type : "POST",
  url  : "cooperative_type_ajax",
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


  var id = $("#amendmentAddForm #amendment_id").val();
  // var userid = $("#amendmentAddForm #userID").val();
  $.ajax({
    type : "POST",
    url  : "coop_info",
    dataType: "json",
    data : {
      id: id,
    },
    success: function(data){ 
     var business_activities = data.business_activities; 
     var cbom = data.common_bond_of_membership; 
     
          if(cbom=='Institutional'){
              $('#amendmentAddForm #fieldmembershipname').show();
              $('#amendmentAddForm #field_membership').show();
              $('#amendmentAddForm #name_institution_label').show();
              $('#amendmentAddForm #name_institution').show();
              $('#amendmentAddForm #addMoreInsBtn').show();
              $('#amendmentAddForm #fieldmembershipmemofficname').hide();
              $('#amendmentAddForm #composition_of_members_label').hide();
              $('#amendmentAddForm #addMoreAssocBtn').hide();
              $('#amendmentAddForm #addMoreComBtn').hide();
              $('#amendmentAddForm #name_associational_label').hide();
              // $('#amendmentAddForm #compositionOfMembers').hide();
              // $('#amendmentAddForm #compositionOfMembers1').hide();
               $('#amendmentAddForm select[name="compositionOfMembers[]"').hide();
              $('#amendmentAddForm .compositionRemoveBtn').hide();
          } else if(cbom=="Associational"){

              $('#amendmentAddForm #fieldmembershipname').show();
              $('#amendmentAddForm #fieldmembershipmemofficname').show();
              $('#amendmentAddForm #field_membership').show();
              $('#amendmentAddForm #name_institution_label').show();
              $('#amendmentAddForm #name_institution').show();
  //            $('#amendmentAddForm #addMoreAssocBtn').show();
              $('#amendmentAddForm #name_associational_label').show();
              $('#amendmentAddForm #composition_of_members_label').hide();
              $('#amendmentAddForm #addMoreInsBtn').show();
              $('#amendmentAddForm #addMoreComBtn').hide();
               $('#amendmentAddForm select[name="compositionOfMembers[]"').hide();
              // $('#amendmentAddForm #compositionOfMembers1').hide();
              $('#amendmentAddForm .compositionRemoveBtn').hide();
              $('#amendmentAddForm .occupation-wrapper').hide();
          } else if (cbom=="Occupational"){ 
              $("#name_associational").hide();
              $("#amendmentAddForm #assoc_field_membership").hide()
              $('#amendmentAddForm #commonBond2').val('Occupational');
              $('#amendmentAddForm #fieldmembershipname').hide();
              $('#amendmentAddForm #fieldmembershipmemofficname').hide();
              $('#amendmentAddForm #field_membership').hide();
              $('#amendmentAddForm #name_institution_label').hide();
              $('#amendmentAddForm #name_institution').hide();
              $('#amendmentAddForm #addMoreAssocBtn').hide();
              $('#amendmentAddForm #composition_of_members_label').show();
              $('#amendmentAddForm #addMoreInsBtn').hide();
              $('#amendmentAddForm #name_associational_label').hide();
              // $('#amendmentAddForm #compositionOfMembers1').show();
              $('#amendmentAddForm .compositionRemoveBtn').hide();
              $('#amendmentAddForm #addMoreComBtn').show();
              $('#amendmentAddForm select[name="compositionOfMembers[]"').show();
               $('#amendmentAddForm .compositionRemoveBtn').show();
          } else {
              $("#name_associational").hide();
              $("#amendmentAddForm #assoc_field_membership").hide()
              $('#amendmentAddForm #fieldmembershipname').hide();
              $('#amendmentAddForm #fieldmembershipmemofficname').hide();
              $('#amendmentAddForm #field_membership').hide();
              $('#amendmentAddForm #name_institution_label').hide();
              $('#amendmentAddForm #name_institution').hide();
              $('#amendmentAddForm #addMoreAssocBtn').hide();
              $('#amendmentAddForm #composition_of_members_label').hide();
              $('#amendmentAddForm #addMoreInsBtn').hide();
              $('#amendmentAddForm #addMoreComBtn').hide();
              $('#amendmentAddForm #name_associational_label').hide();
              // $('#amendmentAddForm #compositionOfMembers1').hide();
              $('#amendmentAddForm select[name="compositionOfMembers[]"').hide();


          }

           var business_activities = data.business_activities;
          if (typeof business_activities !== 'undefined') 
          { 
               // console.log(business_activities);
               var count_id = 1;
              // console.log(data);
              $.each(data.business_activities, function(x,business_activy){
              mcount++;
              var c = count_id++;
              var htmls= $('<div></div>').attr({'class':'list-major'});
              var divFormGroupSubclass= $('<div></div>').attr({'class':'form-group'});
              var divColSubclass = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
              var labelSubClass = $('<label></label>').attr({'for': 'subClass '+c}).text("Major Industry Classification No. " + c +" Subclass ");
              var selectSubClass = $('<select></select>').attr({'class': 'custom-select form-control subclass-in ','name': 'majorIndustry['+mcount+'][subclass_id]', 'id': 'subClass' + c}).prop("disabled",true);
            
              // var divFormGroupSubclass= $('<div></div>').attr({'class':'form-group'});
              // var divColSubclass = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
              // var labelSubClass = $('<label></label>').attr({'for': 'subClass'}).text("Major Industry Classification No.  Subclass "+c);
              // var selectSubClass = $('<select></select>').attr({'class': 'custom-select form-control validate[required]','name': 'subClass[]', 'id': 'subClass'+c}).prop("disabled",true);
              
              var divFormGroupMajorIndustry = $('<div></div>').attr({'class':'form-group'});
              var divColMajorIndustry = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
              var labelMajorIndustry = $('<label></label>').attr({'for': 'majorIndustry'}).text("Major Industry Classification No. " +c);
              var selectMajorIndustry = $('<select></select>').attr({'class': 'custom-select major-ins form-control','name': 'majorIndustry['+mcount+'][major_id]', 'id': 'majorIndustry'+c });
              
              //remove major class and subclass
              var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn businessActivityRemoveBtn float-right text-danger'}).click(function(){
                 
                   $(this).closest('.list-major').remove();
                  $('#amendmentAddForm select[name="majorIndustry[]"]').each(function(index){
                    $(this).siblings('label').text("Major Industry Classification No. "+(index+1));
                  });
                  $('#amendmentAddForm select[name="subClass[]"]').each(function(index){
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
            }); //end ea
          }
          else
          {
            mcount++;
              var htmls= $('<div></div>').attr({'class':'list-major'});
              var divFormGroupSubclass= $('<div></div>').attr({'class':'form-group'});
              var divColSubclass = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
              var labelSubClass = $('<label></label>').attr({'for': 'subClass 1'}).text("Major Industry Classification No. 1 Subclass ");
              var selectSubClass = $('<select></select>').attr({'class': 'custom-select form-control subclass-in','name': 'majorIndustry['+mcount+'][subclass_id]', 'id': 'subClass1'}).prop("disabled",true);
              
              var divFormGroupMajorIndustry = $('<div></div>').attr({'class':'form-group'});
              var divColMajorIndustry = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
              var labelMajorIndustry = $('<label></label>').attr({'for': 'majorIndustry'}).text("Major Industry Classification No. 1");
              var selectMajorIndustry = $('<select></select>').attr({'class': 'custom-select major-ins form-control','name': 'majorIndustry['+mcount+'][major_id]', 'id': 'majorIndustry1' });
              
              //remove major class and subclass
              var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn businessActivityRemoveBtn float-right text-danger'}).click(function(){
                 
                   $(this).closest('.list-major').remove();
                  $('#amendmentAddForm select[name="majorIndustry[]"]').each(function(index){
                    $(this).siblings('label').text("Major Industry Classification No. 1");
                  });
                  $('#amendmentAddForm select[name="subClass[]"]').each(function(index){
                    $(this).siblings('label').text("Major Industry Classification No. Subclass 1");
                  });
                });
              $(divColMajorIndustry).append(divFormGroupMajorIndustry,labelMajorIndustry,selectMajorIndustry);
              $(divColSubclass).append(divFormGroupSubclass,labelSubClass,selectSubClass);
            
               $(htmls).append(divColMajorIndustry,divColSubclass);
               $('.row-cis').append(htmls);
               $(selectMajorIndustry).append($('<option selected></option>').attr('value','').text(''));
               $(selectSubClass).append($('<option selected></option>').attr('value','').text(''));
               $(selectSubClass).prop("disabled",false);

               // var divInnerRow = $('<div></div>').attr({'class':'row'});
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
                  url : $('body').attr('data-baseurl') + "api/major_industries_amendment",
                  dataType: "json",
                  data: {cooptype_:typeCoop_arrays},
                  success: function(data){
                     
                      $.each(data, function(key,value){
                        $(selectMajorIndustry).append($('<option></option>').attr('value',value.major_industry_id).text(value.description));
                      });
                      // $(divFormGroupSubclass).append(labelSubClass,selectSubClass);
                      // $(divColSubclass).append(divFormGroupSubclass);
                      // $(divFormGroupMajorIndustry).append(labelMajorIndustry,selectMajorIndustry);
                      // $(divColMajorIndustry).append(divFormGroupMajorIndustry);
                      // $(divInnerRow).append(divColMajorIndustry,divColSubclass);
                      // $("#amendmentAddForm .col-industry-subclass").append(divInnerRow);
                      $('#amendmentAddForm select[name="majorIndustry[]"').each(function(index){
                        $(this).siblings('label').text("Major Industry Classification No. " + (index+1));
                      });
                      $('#amendmentAddForm select[name="subClass[]"').each(function(index){
                        $(this).siblings('label').text("Major Industry Classification No. " + (index+1) + " Subclass ");
                      });
                  }
                });

          }      
      }    
  });//end ajax        
  

  //load sublcass
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
                url : $('body').attr('data-baseurl') + "api/subClass",
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
          }
     });
  //end subclass 


      //add coop type dynamically modified
        var count_text_input =1;
        $('#amendmentAddForm #addCoop').on('click', function(e){ 
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
                      $('#amendmentAddForm .major-ins').append($('<option></option').attr({'selected':true}).val(""));
                      $.ajax({
                       type : "POST",
                       url : $('body').attr('data-baseurl') + "api/major_industries_amendment",
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
            $("#amendmentAddForm .coop-col").append(divFormGroup);
         
             list_cooperative_type(selectCoop,category);
          

            e.preventDefault();
        });


        //COOP TYPE TRIGGER
         $(document).on('change','.coop-type',function(){
          var typeCoop_array=[]; 

            $('select[name="typeOfCooperative[]"] option:selected').each(function() {
                typeCoop_array.push($(this).val());
                
            });
            if($(this).val() == 26)
            {
              $("#amendmentAddForm .businesActivity-row").hide();
              $("#amendmentAddForm .bussiness-btn").hide();
            }
            else
            {
               $("#amendmentAddForm .businesActivity-row").show();
               $("#amendmentAddForm .bussiness-btn").show();
            }
            // var cooptype_array = typeCoop_array.split(',');  
           console.log(typeCoop_array.includes('21'));
          // if($(this).val()==19 || $(this).val()==21)
           if(typeCoop_array.includes('19') || typeCoop_array.includes('21'))
              { 
                // alert("The bond of membership for both labor service and workers cooperative shall be occupational.");
                // $('#amendmentAddForm #commonBond2').val('Occupational')
                // $('#amendmentAddForm #commonBondOfMembership').attr("disabled", 'disabled');
                //  setTimeout( function(){
              
                //   $('#amendmentAddForm #commonBondOfMembership').val('Occupational');
                //   $('#amendmentAddForm #commonBondOfMembership').trigger('change');

                // },300);
                  
              }
              else
              {
                 $('#amendmentAddForm #commonBond2').val('');
                $('#amendmentAddForm #commonBondOfMembership').removeAttr('disabled');
              }

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
                       url : $('body').attr('data-baseurl') + "api/major_industries_amendment",
                       dataType: "json",
                       data: {cooptype_:typeCoop_arrays},
                       success: function(responsetxt){
                        $.each(responsetxt,function(a,major_industry){
                           $('.major-ins').append($('<option></option>').attr('value',major_industry['major_industry_id']).text(major_industry['description']));
                        });

                       }
                      }); //end ajax    
          }); 
        //ccop type trigger

        $('#amendmentAddForm #commonBondOfMembership').on('change',function(){
           
            if($(this).val()=="Institutional"){
                 $("#amendmentAddForm .ins-div").show();
                $('#amendmentAddForm #addMoreInsBtn_Associational').show();
                $('#amendmentAddForm #assoc_field_membership').show();
                $('#amendmentAddForm select[name="compositionOfMembers[]"').hide();
                $('#amendmentAddForm #fieldmembershipmemofficname').hide();
                $('#amendmentAddForm #commonbondname').hide();
                $('#amendmentAddForm #addMoreComBtn').hide();
                $('#amendmentAddForm #name_associational_label').hide();
                // $('#amendmentAddForm #name_associational').hide();
                $('#amendmentAddForm #addMoreAssocBtn').hide();
                $('#amendmentAddForm #field_membership').show();
                $('#amendmentAddForm #name_institution_label').show();
                $('#amendmentAddForm #name_institution').show();
                $('#amendmentAddForm #addMoreInsBtn').show();
                $('#amendmentAddForm #fieldmembershipname').show();
                // $('#amendmentAddForm #name_associational').prop("required",false);
                $('#amendmentAddForm #field_membership').prop("required",true);
                $('#amendmentAddForm #name_institution').prop("required",true);
                $('#amendmentAddForm #composition_of_members_label').hide();
                // $('#amendmentAddForm #compositionOfMembers1').hide();
                $("#amendmentAddForm .compositionRemoveBtn").hide();
                $('#amendmentAddForm .occupation-wrapper').hide();
                 $("#amendmentAddForm .insti_div").show();
            } else if($(this).val()=="Associational"){
               $("#amendmentAddForm .ins-div").show();
               $('#amendmentAddForm #addMoreInsBtn_Associational').show();
                 $('#amendmentAddForm #assoc_field_membership').show();
                $('#amendmentAddForm select[name="compositionOfMembers[]"').hide();
                $('#amendmentAddForm #addMoreComBtn').hide();
                $('#amendmentAddForm #commonbondname').hide();
                $('#amendmentAddForm #name_institution_label').hide();
                $('#amendmentAddForm #name_institution').show();
                $('#amendmentAddForm #addMoreInsBtn').show();
                $('#amendmentAddForm #fieldmembershipname').show();
                $('#amendmentAddForm #name_associational_label').show();
                $('#amendmentAddForm #name_associational').show();
                $('#amendmentAddForm #addMoreAssocBtn').show();
                $('#amendmentAddForm #field_membership').show();
                $('#amendmentAddForm #fieldmembershipmemofficname').show();
                $('#amendmentAddForm #name_institution').prop("required",false);
                $('#amendmentAddForm #field_membership').prop("required",true);
                $('#amendmentAddForm #name_associational').prop("required",true);
                $('#amendmentAddForm #composition_of_members_label').hide();
                // $('#amendmentAddForm #compositionOfMembers1').hide();
                $("#amendmentAddForm .compositionRemoveBtn").hide();
                $('#amendmentAddForm .occupation-wrapper').hide();
                 $("#amendmentAddForm .insti_div").show();
                 $("#compositionOfMembers2").hide();
            } else if($(this).val()=="Residential"){
               $("#amendmentAddForm .ins-div").hide();
               $('#amendmentAddForm #addMoreInsBtn_Associational').hide();
               $('#amendmentAddForm #assoc_field_membership').hide();
                $('#amendmentAddForm #fieldmembershipmemofficname').hide();
                $('#amendmentAddForm #field_membership').hide();
                $('#amendmentAddForm #name_institution_label').hide();
                $('#amendmentAddForm #name_associational_label').hide();
                $('#amendmentAddForm #name_institution').hide();
                $('#amendmentAddForm #name_associational').hide();
                $('#amendmentAddForm #addMoreInsBtn').hide();
                $('#amendmentAddForm #fieldmembershipname').hide();
                $('#amendmentAddForm #addMoreAssocBtn').hide();
                $('#amendmentAddForm select[name="compositionOfMembers[]"').hide();
                $('#amendmentAddForm #commonbondname').hide();
                $('#amendmentAddForm #addMoreComBtn').hide();
                // $('#amendmentAddForm #compositionOfMembers1').hide();
                $('#amendmentAddForm #composition_of_members_label').hide();
                $('#amendmentAddForm #name_institution').prop("required",false);
                $('#amendmentAddForm #field_membership').prop("required",false);
                $('#amendmentAddForm #name_associational').prop("required",false);
                $("#amendmentAddForm .compositionRemoveBtn").hide();
                $("#amendmentAddForm .div-ins-assoc-occu").hide();
                 $("#amendmentAddForm .insti_div").hide();
                $("#amendmentAddForm .occupation-wrapper").hide(); 
            } else { 
                $("#amendmentAddForm .ins-div").hide();
                 $('#amendmentAddForm #addMoreInsBtn_Associational').hide();
                 $('#amendmentAddForm #assoc_field_membership').hide();
                $('#amendmentAddForm #fieldmembershipmemofficname').hide();
                $('#amendmentAddForm #field_membership').hide();
                $('#amendmentAddForm #name_institution_label').hide();
                $('#amendmentAddForm #name_associational_label').hide();
                $('#amendmentAddForm #name_institution').hide();
                $('#amendmentAddForm #name_associational').hide();
                $('#amendmentAddForm #addMoreInsBtn').hide();
                $('#amendmentAddForm #fieldmembershipname').hide();
                $('#amendmentAddForm #addMoreAssocBtn').hide();
                $('#amendmentAddForm #commonbondname').show();
                // $('#amendmentAddForm #compositionOfMembers1').show();
                $('#amendmentAddForm #composition_of_members_label').show();
                $('#amendmentAddForm select[name="compositionOfMembers[]"').show();
                $('#amendmentAddForm #addMoreComBtn').show();
                $('#amendmentAddForm #name_institution').prop("required",false);
                $('#amendmentAddForm #field_membership').prop("required",false);
                $('#amendmentAddForm #name_associational').prop("required",false);
                $("#amendmentAddForm .institutionRemoveBtn").hide();
                $("#amendmentAddForm .occupation-wrapper").show();
                $("#amendmentAddForm .insti_div").show();
                $("#amendmentAddForm .compositionRemoveBtn").show();
                $("amendmentAddForm #occupation-div").show();
          
            }
        });


    //area of operation
      var AreaOperation =  $('#amendmentAddForm #areaOfOperation').val(); 
          if( AreaOperation == "Interregional"){
                $('.opt').each(function() {
                      if(!this.selected) {
                          $(this).attr('disabled', true);
                      }
                  });
            $('#amendmentAddForm #allisland').show();
            $('#amendmentAddForm #allregions').show();
            $('#amendmentAddForm #interregional').show();
            $('#amendmentAddForm #regions').show();
            $('#amendmentAddForm #selectisland').show();
            $('#amendmentAddForm #selectregion').show();

            $("#amendmentAddForm #region").prop("disabled",false);
            $("#amendmentAddForm #province").prop("disabled",false);
            $("#amendmentAddForm #city").prop("disabled",false);
            $("#amendmentAddForm #barangay").prop("disabled",false);

            $(".select-island").each(function(){
                $(this).select2({
                      template: "bootstrap",
                      multiple: true,
                      tagging: true,
                      allowClear: true,
                      placeholder: "Select island"
                  });
                });
              $(".select-region").each(function(){
                $(this).select2({
                    template: "bootstrap",
                    multiple: true,
                    tagging: true,
                    allowClear: true,
                    placeholder: "Select region"
                });
            });
          }
          else if(AreaOperation == "National")
          {
            $('#amendmentAddForm #allisland').hide();
            $('#amendmentAddForm #allregions').hide();
            $('#amendmentAddForm #interregional').hide();
            $('#amendmentAddForm #regions').hide();
            $('#amendmentAddForm #selectisland').hide();
            $('#amendmentAddForm #selectregion').hide();

            $("#amendmentAddForm #region").prop("disabled",false);
            $("#amendmentAddForm #province").prop("disabled",false);
            $("#amendmentAddForm #city").prop("disabled",false);
            $("#amendmentAddForm #barangay").prop("disabled",false);

          }
          else if(AreaOperation == "Regional")
          {
            $('#amendmentAddForm #allisland').hide();
            $('#amendmentAddForm #allregions').hide();
            $('#amendmentAddForm #interregional').hide();
            $('#amendmentAddForm #regions').hide();
            $('#amendmentAddForm #selectisland').hide();
            $('#amendmentAddForm #selectregion').hide();

            // $("#amendmentAddForm #region").prop("disabled",true);
            $("#amendmentAddForm #province").prop("disabled",false);
            $("#amendmentAddForm #city").prop("disabled",false);
            $("#amendmentAddForm #barangay").prop("disabled",false);

          }
          else if(AreaOperation == "Provincial")
          {
            $('#amendmentAddForm #allisland').hide();
            $('#amendmentAddForm #allregions').hide();
            $('#amendmentAddForm #interregional').hide();
            $('#amendmentAddForm #regions').hide();
            $('#amendmentAddForm #selectisland').hide();
            $('#amendmentAddForm #selectregion').hide();

            // $("#amendmentAddForm #province").prop("disabled",true);
            // $("#amendmentAddForm #region").prop("disabled",true);
            $("#amendmentAddForm #city").prop("disabled",false);
            $("#amendmentAddForm #barangay").prop("disabled",false);

          }
          else if(AreaOperation == "Municipality/City")
          {
            $('#amendmentAddForm #allisland').hide();
            $('#amendmentAddForm #allregions').hide();
            $('#amendmentAddForm #interregional').hide();
            $('#amendmentAddForm #regions').hide();
            $('#amendmentAddForm #selectisland').hide();
            $('#amendmentAddForm #selectregion').hide();

            // $("#amendmentAddForm #province").prop("disabled",true);
            // $("#amendmentAddForm #region").prop("disabled",true);
            // $("#amendmentAddForm #city").prop("disabled",true);
            $("#amendmentAddForm #barangay").prop("disabled",false);

          }
          else
          {
            $('#amendmentAddForm #allisland').hide();
            $('#amendmentAddForm #allregions').hide();
            $('#amendmentAddForm #interregional').hide();
            $('#amendmentAddForm #regions').hide();
            $('#amendmentAddForm #selectisland').hide();
            $('#amendmentAddForm #selectregion').hide();

            // $("#amendmentAddForm #province").prop("disabled",true);
            // $("#amendmentAddForm #region").prop("disabled",true);
            // $("#amendmentAddForm #city").prop("disabled",true);
            // $("#amendmentAddForm #barangay").prop("disabled",true);\

             $("#amendmentAddForm #province").prop("disabled",false);
            // $("#amendmentAddForm #region").prop("disabled",true);
            $("#amendmentAddForm #city").prop("disabled",false);
            $("#amendmentAddForm #barangay").prop("disabled",false);

          } 

       $('#amendmentAddForm #areaOfOperation').on('change',function(){
      // $('#amendmentAddForm #regions').empty();
      var areaOfOperation = $(this).val();
      if(areaOfOperation == "Interregional"){
        
        // $('#amendmentAddForm #region').empty();
        $('#amendmentAddForm #allisland').show();
        $('#amendmentAddForm #allregions').show();
        $('#amendmentAddForm #interregional').show();
        $('#amendmentAddForm #regions').show();
        $('#amendmentAddForm #selectisland').show();
        $('#amendmentAddForm #selectregion').show();

        $(".select-island").each(function(){
          $(this).select2({
                template: "bootstrap",
                multiple: true,
                tagging: true,
                allowClear: true,
                placeholder: "Select island"
            });
          });
        $(".select-region").each(function(){
            $(this).select2({
                template: "bootstrap",
                multiple: true,
                tagging: true,
                allowClear: true,
                placeholder: "Select region"
            });
        });

         $('#amendmentAddForm #regions').on('change',function(){
          // alert($(this).val());
          $('#amendmentAddForm #region').empty();
           $('#amendmentAddForm #region').prop("disabled",false);
          // $("#amendmentAddForm #province").prop("disabled",true);
          $('#amendmentAddForm #city').empty();
          // $("#amendmentAddForm #city").prop("disabled",true);
          $('#amendmentAddForm #barangay').empty();
          // $("#amendmentAddForm #barangay").prop("disabled",true);
          if($(this).val() && ($(this).val()).length > 0){
            $("#amendmentAddForm #province").prop("disabled",false);
            var regions = $(this).val();
              $.ajax({
              type : "POST",
              url : $('body').attr('data-baseurl') + "api/regions",
              dataType: "json",
              data : {
                regions: regions
              },
              success: function(data){
                $('#amendmentAddForm #region').append($('<option></option>').attr('value',"").text(""));
                $.each(data, function(key,value){
                  $('#amendmentAddForm #region').append($('<option></option>').attr('value',value.regCode).text(value.regDesc));
                });
              }
            });
          }
        });

      }
      else if(areaOfOperation == "National")
      {
      $('#amendmentAddForm #allisland').hide();
      $('#amendmentAddForm #allregions').hide();
      $('#amendmentAddForm #interregional').hide();
      $('#amendmentAddForm #regions').hide();
      $('#amendmentAddForm #selectisland').hide();
      $('#amendmentAddForm #selectregion').hide();
      $("#amendmentAddForm #region").prop("disabled",false);
      $("#amendmentAddForm #province").prop("disabled",false);
      $("#amendmentAddForm #city").prop("disabled",false);
      $("#amendmentAddForm #barangay").prop("disabled",false);
      }
      else if(areaOfOperation == "Regional")
      {
      $('#amendmentAddForm #allisland').hide();
      $('#amendmentAddForm #allregions').hide();
      $('#amendmentAddForm #interregional').hide();
      $('#amendmentAddForm #regions').hide();
      $('#amendmentAddForm #selectisland').hide();
      $('#amendmentAddForm #selectregion').hide();
      // $("#amendmentAddForm #region").prop("disabled",true);
      $("#amendmentAddForm #province").prop("disabled",false);
      $("#amendmentAddForm #city").prop("disabled",false);
      $("#amendmentAddForm #barangay").prop("disabled",false);
      }
      else if(areaOfOperation == "Provincial")
      {
      $('#amendmentAddForm #allisland').hide();
      $('#amendmentAddForm #allregions').hide();
      $('#amendmentAddForm #interregional').hide();
      $('#amendmentAddForm #regions').hide();
      $('#amendmentAddForm #selectisland').hide();
      $('#amendmentAddForm #selectregion').hide();
      // $("#amendmentAddForm #province").prop("disabled",true);
      // $("#amendmentAddForm #region").prop("disabled",true);
      $("#amendmentAddForm #city").prop("disabled",false);
      $("#amendmentAddForm #barangay").prop("disabled",false);
      }
      else if(areaOfOperation == "Municipality/City")
      {
      $('#amendmentAddForm #allisland').hide();
      $('#amendmentAddForm #allregions').hide();
      $('#amendmentAddForm #interregional').hide();
      $('#amendmentAddForm #regions').hide();
      $('#amendmentAddForm #selectisland').hide();
      $('#amendmentAddForm #selectregion').hide();
      // $("#amendmentAddForm #province").prop("disabled",true);
      // $("#amendmentAddForm #region").prop("disabled",true);
      // $("#amendmentAddForm #city").prop("disabled",true);
      $("#amendmentAddForm #barangay").prop("disabled",false);
      }
      else
      {
      $('#amendmentAddForm #allisland').hide();
      $('#amendmentAddForm #allregions').hide();
      $('#amendmentAddForm #interregional').hide();
      $('#amendmentAddForm #regions').hide();
      $('#amendmentAddForm #selectisland').hide();
      $('#amendmentAddForm #selectregion').hide();
      // $("#amendmentAddForm #province").prop("disabled",true);
      // $("#amendmentAddForm #region").prop("disabled",true);
      // $("#amendmentAddForm #city").prop("disabled",true);
      $("#amendmentAddForm #barangay").prop("disabled",false);
      }
    });

    $('#amendmentAddForm #interregional').on('change',function(){
      
      if($(this).val().length <= 2){
        // alert($(this).val());
          if($(this).val().length != 2){
            $('.opt').each(function() {
                if(!this.selected) {
                    $(this).attr('disabled', false);
                }
            });
          } else {
            $('.opt').each(function() {
              if(!this.selected) {
                  $(this).attr('disabled', true);
              }
            });
          }
        $('#amendmentAddForm #region').empty();
        $('#amendmentAddForm #regions').empty();
        $('#amendmentAddForm #province').empty();
        // $("#amendmentAddForm #province").prop("disabled",true);
        $('#amendmentAddForm #city').empty();
        // $("#amendmentAddForm #city").prop("disabled",true);
        $('#amendmentAddForm #barangay').empty();
        // $("#amendmentAddForm #barangay").prop("disabled",true);
        if($(this).val() && ($(this).val()).length > 0){
          $("#amendmentAddForm #province").prop("disabled",false);
          var interregional = $(this).val();
            $.ajax({
            type : "POST",
            url : $('body').attr('data-baseurl') + "api/islands",
            dataType: "json",
            data : {
              interregional: interregional
            },
            success: function(data){
              // $('#reserveAddForm #regions').append($('<option></option>').attr('value',"").text(""));
              $.each(data, function(key,value){
                $('#amendmentAddForm #regions').append($('<option></option>').attr('value',value.region_code).text(value.regDesc));
              });
            }
          });
        }
      } else {
        // $('#amendmentAddForm #interregional').removeAttr("selected");;
        // alert("Maximum of 2 Island.");
        $('.opt').each(function() {
            if(!this.selected) {
                $(this).attr('disabled', true);
            }
        });
      }
    });

    $('#amendmentAddForm #regions').on('change',function(){
      // alert($(this).val());
      $('#amendmentAddForm #region').empty();
      // $("#amendmentAddForm #province").prop("disabled",true);
      $('#amendmentAddForm #city').empty();
      // $("#amendmentAddForm #city").prop("disabled",true);
      $('#amendmentAddForm #barangay').empty();
      // $("#amendmentAddForm #barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#amendmentAddForm #province").prop("disabled",false);
        var regions = $(this).val();
          $.ajax({
          type : "POST",
          url : $('body').attr('data-baseurl') + "api/regions",
          dataType: "json",
          data : {
            regions: regions
          },
          success: function(data){
            $('#amendmentAddForm #region').append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $('#amendmentAddForm #region').append($('<option></option>').attr('value',value.regCode).text(value.regDesc));
            });
          }
        });
      }
    });

    $('#amendmentAddForm #city').on('change',function(){
      $('#amendmentAddForm #barangay').empty(); 
      $('#amendmentAddForm #barangay_').empty(); 
      // $("#amendmentAddForm #barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#amendmentAddForm #barangay").prop("disabled",false);
        var cities = $(this).val();
          $.ajax({
          type : "POST",
          url : $('body').attr('data-baseurl') + "api/barangays",
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
           $('#v #barangay_').val($('#amendmentAddForm #barangay').val()); 
      }
    });

    $('#amendmentAddForm #barangay').on('change',function(){
      $('#amendmentAddForm #barangay_').empty(); 
      
      if($(this).val() && ($(this).val()).length > 0){
        $('#amendmentAddForm #barangay_').val($(this).val());
      }
    });

    //en area of operation

    //address code
    $('#amendmentAddForm #region').on('change',function(){ 
      $('#amendmentAddForm #province').empty(); 
      // $("#amendmentAddForm #province").prop("disabled",true);
      $('#amendmentAddForm #city').empty();
      // $("#amendmentAddForm #city").prop("disabled",true);
      $('#amendmentAddForm #barangay').empty();
      // $("#amendmentAddForm #barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#amendmentAddForm #province").prop("disabled",false);
        var region = $(this).val();
          $.ajax({
          type : "POST",
          url : $('body').attr('data-baseurl') + "api/provinces",
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
      // $("#amendmentAddForm #city").prop("disabled",true);
      $('#amendmentAddForm #barangay').empty();
      // $("#amendmentAddForm #barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#amendmentAddForm #city").prop("disabled",false);
        var province = $(this).val();
          $.ajax({
          type : "POST",
          url : $('body').attr('data-baseurl') + "api/cities",
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
      $('#amendmentAddForm #barangay_').empty(); 
      $("#amendmentAddForm #barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#amendmentAddForm #barangay").prop("disabled",false);
        var cities = $(this).val();
          $.ajax({
          type : "POST",
          url : $('body').attr('data-baseurl') + "api/barangays",
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
           $('#amendmentAddForm #barangay_').val($('#amendmentAddForm #barangay').val()); 
      }
    });

    $('#amendmentAddForm #barangay').on('change',function(){
      $('#amendmentAddForm #barangay_').empty(); 
      
      if($(this).val() && ($(this).val()).length > 0){
        $('#amendmentAddForm #barangay_').val($(this).val());
      }
    });

    //end address code

     let count_major_industry=parseInt($('.major-industry').length);
  $('#amendmentAddForm #addMoreSubclassBtn').on('click', function(){
  
     var origin_name =  $("#newName2").val();
     // var start_counting_major = ++count_major_industry;
     // // alert(start_counting_major);
     // if(start_counting_major>1)
     // {  
     //    $("#newNamess").val(origin_name+' Multipurpose');
     // }
    if($('#amendmentAddForm #typeOfCooperatives1').val() && ($('#amendmentAddForm #typeOfCooperatives1').val()).length > 0){
      var lastCountOfSubclass = $('select[name="majorIndustry['+mcount+'][major_id]"').last().attr('id'); 
      var totalCountOFSubclass = $('select[name="majorIndustry['+mcount+'][subclass_id]"').length;
      mcount++;
      var intLastCount = parseInt(lastCountOfSubclass.substr(-1)); 
      var coop_types = "";
        $('#amendmentAddForm .coop-type').each(function(){
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
          $('#amendmentAddForm select[name="majorIndustry[]"]').each(function(index){
            $(this).siblings('label').text("Major Industry Classification No. " + (index+1));
          });

          $('#amendmentAddForm select[name="subClass[]"]').each(function(index){
            $(this).siblings('label').text("Major Industry Classification No. " + (index+1) + " Subclass ");
          });
        });
     var htmls= $('<div></div>').attr({'class':'list-major'});
      var divFormGroupSubclass= $('<div></div>').attr({'class':'form-group'});
      var divColSubclass = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
      var labelSubClass = $('<label></label>').attr({'for': 'subClass'+(intLastCount + 1)}).text("Major Industry Classification No. " + (intLastCount+1) + " Subclass ");
      var selectSubClass = $('<select></select>').attr({'class': 'custom-select form-control validate[required]','name': 'majorIndustry['+mcount+'][subclass_id]', 'id': 'subClass' + (intLastCount + 1)}).prop("disabled",true);
      
      var divFormGroupMajorIndustry = $('<div></div>').attr({'class':'form-group'});
      var divColMajorIndustry = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
      var labelMajorIndustry = $('<label></label>').attr({'for': 'majorIndustry'+(intLastCount + 1)}).text("Major Industry Classification No. " + (intLastCount+1));
      var selectMajorIndustry = $('<select></select>').attr({'class': 'custom-select major-ins form-control validate[required]','name': 'majorIndustry['+mcount+'][major_id]', 'id': 'majorIndustry' + (intLastCount + 1)}).change(function(){
      
        $(selectSubClass).empty();
        $(selectSubClass).prop("disabled",true);
        
      }); //end delete

      // var divInnerRow = $('<div></div>').attr({'class':'list-major'});
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
          url : $('body').attr('data-baseurl') + "api/major_industries_amendment",
          dataType: "json",
          data: {cooptype_:typeCoop_arrays},
          success: function(data){
             
              $.each(data, function(key,value){
                $(selectMajorIndustry).append($('<option></option>').attr('value',value.major_industry_id).text(value.description));
              });
              $(divFormGroupSubclass).append(labelSubClass,selectSubClass,deleteSpanss);
              $(divColSubclass).append(divFormGroupSubclass);
              $(divFormGroupMajorIndustry).append(labelMajorIndustry,selectMajorIndustry);
              $(divColMajorIndustry).append(divFormGroupMajorIndustry);
              $(htmls).append(divColMajorIndustry,divColSubclass);
              $("#amendmentAddForm .col-industry-subclass").append(htmls);
              $('#amendmentAddForm select[name="majorIndustry[]"').each(function(index){
                $(this).siblings('label').text("Major Industry Classification No. " + (index+1));
              });
              $('#amendmentAddForm select[name="subClass[]"').each(function(index){
                $(this).siblings('label').text("Major Industry Classification No. " + (index+1) + " Subclass ");
              });
          }
        });
    }else{
      $('#amendmentAddForm #typeOfCooperatives1').focus();
    }
  });
  //end modified add major industry dynamically

    $('#amendmentAddForm #addMoreInsBtn').on('click', function(){
      var lastCountOfcom = $('#name_institution').last().attr('id');
      intLastCount = parseInt(lastCountOfcom.substr(-1));
      var divFormGroup= $('<div></div>').attr({'class':'form-group'});
      var selectComposition = $('<input>').attr({'class': 'custom-select form-control validate[required]','name': 'name_institution[]', 'id': 'name_institution' + (intLastCount + 1)}).prop("disabled",false);

      var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn institutionRemoveBtn float-right text-danger'}).click(function(){
       $(this).parent().remove(); 
      });

      $(divFormGroup).append("<table><tr><td>",selectComposition,"</td><td>",deleteSpan,"</td></tr></table>");
      $("#amendmentAddForm .col-com").append(divFormGroup);
    });

    $('#amendmentAddForm .institutionRemoveBtn').on('click', function(){ 
         $(this).parent().remove(); 
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
             $(selectComposition).append($('<option></option>').attr('value',value.id).text(value.composition));
            });
          }
        });

        $(divFormGroup).append("<table width='100%'><tr><td width='90%'>",selectComposition,"</td><td width='10%'>",deleteSpan,"</td></tr></table>");

        $("#amendmentAddForm .col-com").append(divFormGroup);

    });

    //delete type of coop
     $('.customDeleleBtn').on('click',function(){ 
                $(this).closest('.list_cooptype').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();
          });


      $(document).on('click','.businessActivityRemoveBtn',function(){
                    
                   $(this).closest('.list-major').remove();
                  $('#amendmentAddForm select[name="majorIndustry['+mcount+'][major_id]"').each(function(index){
                    $(this).siblings('label').text("Major Industry Classification No. "+(index+1));
                  });
                  $('#amendmentAddForm select[name="majorIndustry['+mcount+'][subclass_id]]').each(function(index){
                    $(this).siblings('label').text("Major Industry Classification No. Subclass "+(index+1));
                  });
                  mcount--;
            });     
            

});//end s function

