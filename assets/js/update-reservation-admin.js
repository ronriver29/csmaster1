  $(function(){

    

  $('#reserveUpdateForm #acronymnameerr').hide();

   document.getElementById("proposedName").maxLength = "99";

   

  $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Federation)').hide();

  

  

  var categryofcoop = $("#reserveUpdateForm #categoryOfCooperative option:selected").text();

  var typeofcoop = $("#reserveUpdateForm #typeOfCooperative option:selected").text();

  var typeofcoop2 = $("#reserveUpdateForm #typeOfCooperative option:selected").val();
  // alert(typeofcoop2);

  // if(typeofcoop && ($(this).val()).length > 0){
  //     $("#reserveUpdateForm #addMoreSubclassBtn").prop("disabled",false);
  //     $("#reserveUpdateForm #proposedName").prop("disabled",false);
      var coop_type = typeofcoop2;
        $.ajax({
        type : "POST",
        url : $('body').attr('data-baseurl') + "api/major_industries",
        dataType: "json",
        data : {
          coop_type: coop_type
        },
        success: function(data){
          $('#reserveUpdateForm select[name="majorIndustry[]"').each(function(index){
            var majorIndustry = $(this);
            $(majorIndustry).prop("disabled",false);
            $(majorIndustry).append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $(majorIndustry).append($('<option></option>').attr('value',value.id).text(value.description));
            });
          });
        }
      });
    // }



  if(categryofcoop == 'Others' && typeofcoop != 'Technology Service'){ // categryofcoop == 'Secondary' || categryofcoop == 'Tertiary' || 

      $('#reserveUpdateForm #majorIndustry1').hide();

      $('#reserveUpdateForm #subClass1').hide();

      $('#reserveUpdateForm #addMoreSubclassBtn').hide();

      $('#reserveUpdateForm #majorlabel').hide();

      $('#reserveUpdateForm #subclasslabel').hide();

    } else {

      $('#reserveUpdateForm #majorIndustry1').show();

      $('#reserveUpdateForm #subClass1').show();

      $('#reserveUpdateForm #addMoreSubclassBtn').show();

      $('#reserveUpdateForm #majorlabel').show();

      $('#reserveUpdateForm #subclasslabel').show();

    }



  $('#reserveUpdateForm #categoryOfCooperative').on('change', function(){

    var val = $("#reserveUpdateForm #categoryOfCooperative option:selected").text();



    // alert(val);

    if(val == 'Others'){ // val == 'Secondary' || val == 'Tertiary' || 



      $.each([ 'majorIndustry1', 'majorIndustry2', 'majorIndustry3'], function( index, value ) {

        $('#reserveUpdateForm #'+value+'').hide();

      });

      

      $.each([ 'subClass1', 'subClass2', 'subClass3'], function( index, value ) {

        $('#reserveUpdateForm #'+value+'').hide();

      });

      // $('#reserveUpdateForm #subClass1').hide();

      $('#reserveUpdateForm .businessActivityRemoveBtn').hide();

      $('#reserveUpdateForm #addMoreSubclassBtn').hide();

      $('#reserveUpdateForm #majorlabel').hide();

      $('#reserveUpdateForm #subclasslabel').hide();

    } else {

      $.each([ 'majorIndustry1', 'majorIndustry2', 'majorIndustry3'], function( index, value ) {

        $('#reserveUpdateForm #'+value+'').show();

      });

      

      $.each([ 'subClass1', 'subClass2', 'subClass3'], function( index, value ) {

        $('#reserveUpdateForm #'+value+'').show();

      });



      // $('#reserveUpdateForm #majorIndustry1').show();

      // $('#reserveUpdateForm #subClass1').show();

      $('#reserveUpdateForm .businessActivityRemoveBtn').show();

      $('#reserveUpdateForm #addMoreSubclassBtn').show();

      $('#reserveUpdateForm #majorlabel').show();

      $('#reserveUpdateForm #subclasslabel').show();

    }

  });



  // alert(typeofcoop);

  if(typeofcoop == 'Technology Service'){
    $('#reserveUpdateForm #commonbond').hide();
  }

  if(categryofcoop == 'Others'){

    $.each([ 'Federation', 'Advocacy', 'Agrarian Reform', 'Agriculture', 'Consumers', 'Credit', 'Dairy', 'Electric'

    , 'Education', 'Financial Service', 'Fishermen', 'Health Service', 'Housing', 'Labor Service', 'Marketing', 'Producers', 'Professionals', 'Service'

    , 'Small Scale Mining', 'Transport', 'Water Service', 'Workers'], function( index, value ) {

      $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').hide();

    });



    $.each([ 'Cooperative Bank', 'Insurance', 'Union', 'Technology Service'], function( index, value ) {

      $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').show();

    });

  } else if(categryofcoop == 'Secondary'){

    $.each([ 'Federation', 'Advocacy', 'Agrarian Reform', 'Agriculture', 'Consumers', 'Credit', 'Dairy', 'Electric'

    , 'Education', 'Financial Service', 'Fishermen', 'Health Service', 'Housing', 'Labor Service', 'Marketing', 'Producers', 'Professionals', 'Service'

    , 'Small Scale Mining', 'Transport', 'Water Service', 'Workers'], function( index, value ) {

      $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').show();

    });



    $.each([ 'Cooperative Bank', 'Insurance', 'Union', 'Bank', 'Technology Service'], function( index, value ) {

      $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').hide();

    });



  } else if(categryofcoop == 'Tertiary'){

    $.each([ 'Federation', 'Advocacy', 'Agrarian Reform', 'Agriculture', 'Consumers', 'Credit', 'Dairy', 'Electric'

    , 'Education', 'Financial Service', 'Fishermen', 'Health Service', 'Housing', 'Labor Service', 'Marketing', 'Producers', 'Professionals', 'Service'

    , 'Small Scale Mining', 'Transport', 'Water Service', 'Workers'], function( index, value ) {

      $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').show();

    });



    $.each([ 'Cooperative Bank', 'Insurance', 'Union', 'Bank', 'Technology Service'], function( index, value ) {

      $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').hide();

    });

  } else {

    $.each([ 'Advocacy', 'Agrarian Reform', 'Agriculture', 'Consumers', 'Credit', 'Dairy', 'Electric'

    , 'Education', 'Financial Service', 'Fishermen', 'Health Service', 'Housing', 'Labor Service', 'Marketing', 'Producers', 'Professionals', 'Service'

    , 'Small Scale Mining', 'Transport', 'Water Service', 'Workers'], function( index, value ) {

      $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').show();

    });



    $.each([ 'Cooperative Bank', 'Insurance', 'Union', 'Federation', 'Bank', 'Technology Service'], function( index, value ) {

      $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').hide();

    });

}



  $('#reserveUpdateForm #categoryOfCooperative').on('change', function(){

        var categorycoop = $(this).val();



        $('#reserveUpdateForm #typeOfCooperative').val('');

        $("#proposed_name_msg").html('');

     // alert(categorycoop);

        if(categorycoop=="Primary"){

            $.each([ 'Advocacy', 'Agrarian Reform', 'Agriculture', 'Consumers', 'Credit', 'Dairy', 'Electric'

            , 'Education', 'Financial Service', 'Fishermen', 'Health Service', 'Housing', 'Labor Service', 'Marketing', 'Producers', 'Professionals', 'Service'

            , 'Small Scale Mining', 'Transport', 'Water Service', 'Workers'], function( index, value ) {

              $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').show();

            });



            $.each([ 'Cooperative Bank', 'Insurance', 'Union', 'Federation', 'Bank', 'Technology Service'], function( index, value ) {

              $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').hide();

            });

        } else if(categorycoop=="Secondary - Federation"){

            $.each([ 'Federation', 'Advocacy', 'Agrarian Reform', 'Agriculture', 'Consumers', 'Credit', 'Dairy', 'Electric'

            , 'Education', 'Financial Service', 'Fishermen', 'Health Service', 'Housing', 'Labor Service', 'Marketing', 'Producers', 'Professionals', 'Service'

            , 'Small Scale Mining', 'Transport', 'Water Service', 'Workers'], function( index, value ) {

              $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').show();

            });



            $.each([ 'Cooperative Bank', 'Insurance', 'Union', 'Bank', 'Technology Service'], function( index, value ) {

              $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').hide();

            });

        } else if(categorycoop=="Tertiary - Federation"){

            $.each([ 'Federation', 'Advocacy', 'Agrarian Reform', 'Agriculture', 'Consumers', 'Credit', 'Dairy', 'Electric'

            , 'Education', 'Financial Service', 'Fishermen', 'Health Service', 'Housing', 'Labor Service', 'Marketing', 'Producers', 'Professionals', 'Service'

            , 'Small Scale Mining', 'Transport', 'Water Service', 'Workers'], function( index, value ) {

              $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').show();

            });



            $.each([ 'Cooperative Bank', 'Insurance', 'Union', 'Bank', 'Technology Service'], function( index, value ) {

              $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').hide();

            });

        } else if(categorycoop=="Secondary - Union"){

            $.each([ 'Federation', 'Advocacy', 'Agrarian Reform', 'Agriculture', 'Consumers', 'Credit', 'Dairy', 'Electric'

            , 'Education', 'Financial Service', 'Fishermen', 'Health Service', 'Housing', 'Labor Service', 'Marketing', 'Producers', 'Professionals', 'Service'

            , 'Small Scale Mining', 'Transport', 'Water Service', 'Workers'], function( index, value ) {

              $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').hide();

            });



            $.each([ 'Cooperative Bank', 'Insurance', 'Union', 'Bank', 'Technology Service'], function( index, value ) {

              $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').show();

            });

        } else {
            // $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Technology Service )').hide();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Cooperative Bank)').hide();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Insurance)').hide();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Union)').hide();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Federation)').show();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Advocacy)').show();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Agrarian Reform)').show();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Agriculture)').show();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Bank)').hide();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Consumers)').show();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Cooperative Bank)').hide();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Credit)').show();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Dairy)').show();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Electric)').show();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Financial Service)').show();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Fishermen)').show();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Health Service)').show();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Housing)').show();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Insurance)').show();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Labor Service)').show();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Marketing)').show();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Producers)').show();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Professionals)').show();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Service)').show();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Small Scale Mining)').show();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Transport)').show();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Water Service)').show();

            $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Workers)').show();

        }

  });



  $('#reserveUpdateForm #typeOfCooperative').on('change', function(){

      var typeofcoop = $(this).val();

      // alert(typeofcoop);

      if(typeofcoop == 28){
        $('#reserveUpdateForm #commonbond').hide();
        $('#reserveUpdateForm #compositionOfMembers1').hide();
        $('#reserveUpdateForm #addMoreComBtn').hide();
      } else {
        $('#reserveUpdateForm #commonbond').show();
        $('#reserveUpdateForm #compositionOfMembers1').show();
        $('#reserveUpdateForm #addMoreComBtn').show();
      }

      if(typeofcoop == 16 || typeofcoop == 26 || typeofcoop == 27){

        var categoryofcoop = $( "#reserveUpdateForm #categoryOfCooperative option:selected").text();

        // alert('wow');

        if(categoryofcoop == 'Primary' || categoryofcoop == 'Secondary' || categoryofcoop == 'Tertiary'){

          $('#reserveUpdateForm #typeOfCooperative').val('');

        } 

      } else {

        var categoryofcoop = $( "#reserveUpdateForm #categoryOfCooperative option:selected").text();

        

        // if(categoryofcoop == 'Others'){

        //   $('#reserveUpdateForm #typeOfCooperative').val('');

        // } 

      }

      if(typeofcoop == 26){ // val == 'Secondary' || val == 'Tertiary' || 

        $.each([ 'majorIndustry1', 'majorIndustry2', 'majorIndustry3'], function( index, value ) {

          $('#reserveUpdateForm #'+value+'').hide();

        });

        $.each([ 'subClass1', 'subClass2', 'subClass3'], function( index, value ) {

          $('#reserveUpdateForm #'+value+'').hide();

        });

        $('#reserveUpdateForm .businessActivityRemoveBtn').hide();

        $('#reserveUpdateForm #addMoreSubclassBtn').hide();

        $('#reserveUpdateForm #majorlabel').hide();

        $('#reserveUpdateForm #subclasslabel').hide();

      } else {

        $.each([ 'majorIndustry1', 'majorIndustry2', 'majorIndustry3'], function( index, value ) {

          $('#reserveUpdateForm #'+value+'').show();

        });

        $.each([ 'subClass1', 'subClass2', 'subClass3'], function( index, value ) {

          $('#reserveUpdateForm #'+value+'').show();

        });

        $('#reserveUpdateForm .businessActivityRemoveBtn').show();

        $('#reserveUpdateForm #addMoreSubclassBtn').show();

        $('#reserveUpdateForm #majorlabel').show();

        $('#reserveUpdateForm #subclasslabel').show();

      }

    });


  $("#reserveUpdateForm #is_youth").change(function() {
    if(this.checked) {
        // alert('wow');
        $('#reserveUpdateForm #proposedName').on('change click',function(){

        var val = $(this).val();

        var typeofcoop = $( "#reserveUpdateForm #typeOfCooperative option:selected").text();

        var categoryofcoop = $( "#reserveUpdateForm #categoryOfCooperative option:selected").text();

        var acronym = $( "#reserveUpdateForm #acronymname").val();



        if(acronym != ''){

          acronym = ' ('+acronym+')';

        } else {

          acronym = '';

        }

        $("#proposed_name_msg").html('Proposed Name Preview if submitted: '+val+' Youth '+typeofcoop+' Cooperative');

        document.getElementById('acronymname').value = '';

        var value = document.getElementById("proposedName").value;

        var totalval = 99 - value.length; 

        if(totalval == 0){

          $("#reserveUpdateForm #acronymname").prop("disabled",true);

          $('#reserveUpdateForm #acronymnameerr').show();

        } else {

          $('#reserveUpdateForm #acronymnameerr').hide();

          $("#reserveUpdateForm #acronymname").prop("disabled",false);

        }

        document.getElementById("acronymname").maxLength = totalval;

      });
        
    } else {
        $('#reserveUpdateForm #proposedName').on('change click',function(){

        var val = $(this).val();

        var typeofcoop = $( "#reserveUpdateForm #typeOfCooperative option:selected").text();

        var categoryofcoop = $( "#reserveUpdateForm #categoryOfCooperative option:selected").text();

        var acronym = $( "#reserveUpdateForm #acronymname").val();



        if(acronym != ''){

          acronym = ' ('+acronym+')';

        } else {

          acronym = '';

        }

        if(categoryofcoop == 'Secondary' || categoryofcoop == 'Tertiary'){

          $("#proposed_name_msg").html('Proposed Name Preview if submitted: '+val+' Federation of '+typeofcoop + ' Cooperative' +acronym);

        } else {

          $("#proposed_name_msg").html('Proposed Name Preview if submitted: '+val+' '+typeofcoop+' Cooperative');

        }

        document.getElementById('acronymname').value = '';

        var value = document.getElementById("proposedName").value;

        var totalval = 99 - value.length; 

        if(totalval == 0){

          $("#reserveUpdateForm #acronymname").prop("disabled",true);

          $('#reserveUpdateForm #acronymnameerr').show();

        } else {

          $('#reserveUpdateForm #acronymnameerr').hide();

          $("#reserveUpdateForm #acronymname").prop("disabled",false);

        }

        document.getElementById("acronymname").maxLength = totalval;

      });
    }
  });

  // $('#reserveUpdateForm #proposedName').on('change',function(){

  //     var val = $(this).val();

  //     var typeofcoop = $( "#reserveUpdateForm #typeOfCooperative option:selected").text();

  //     var categoryofcoop = $( "#reserveUpdateForm #categoryOfCooperative option:selected").text();

  //     var acronym = $( "#reserveUpdateForm #acronymname").val();



  //     if(acronym != ''){

  //       acronym = ' ('+acronym+')';

  //     } else {

  //       acronym = '';

  //     }



  //     // var count_coop_type =$('#reserveAddForm select[name="typeOfCooperative[]"').length;

  //     // if(count_coop_type>1)

  //     // {

  //       // $("#typeOfCooperative").html(val+' Multipurpose Cooperative');

  //     if(categoryofcoop == 'Secondary' || categoryofcoop == 'Tertiary'){

  //       $("#proposed_name_msg").html('Proposed Name Preview if submitted: '+val+' Federation of '+typeofcoop + ' Cooperative' +acronym);

  //     } else {

  //       $("#proposed_name_msg").html('Proposed Name Preview if submitted: '+val+' '+typeofcoop+' Cooperative');

  //     }

  //   document.getElementById('acronymname').value = '';

  //   var value = document.getElementById("proposedName").value;

  //   var totalval = 99 - value.length; 

  //   if(totalval == 0){

  //     $("#reserveUpdateForm #acronymname").prop("disabled",true);

  //     $('#reserveUpdateForm #acronymnameerr').show();

  //   } else {

  //     $('#reserveUpdateForm #acronymnameerr').hide();

  //     $("#reserveUpdateForm #acronymname").prop("disabled",false);

  //   }

  //   document.getElementById("acronymname").maxLength = totalval;

  // });



  $("#reserveUpdateForm #acronymname").bind("keyup change",function(){

      var val = $(this).val();

      var typeofcoop = $( "#reserveUpdateForm #typeOfCooperative option:selected").text();

      var categoryofcoop = $( "#reserveUpdateForm #categoryOfCooperative option:selected").text();

      var proposenameinput = $( "#reserveUpdateForm #proposedName").val();

      var acronym = $( "#reserveUpdateForm #acronymname").val();



      if(acronym != ''){

        acronym = ' ('+acronym+')';

      } else {

        acronym = '';

      }

      // var count_coop_type =$('#reserveAddForm select[name="typeOfCooperative[]"').length;

      // if(count_coop_type>1)

      // {

        // $("#typeOfCooperative").html(val+' Multipurpose Cooperative');

      if(categoryofcoop == 'Secondary' || categoryofcoop == 'Tertiary'){

        $("#proposed_name_msg").html('Proposed Name Preview if submitted: '+proposenameinput+' Federation of '+typeofcoop + ' Cooperative' +acronym);

      } else {

        $("#proposed_name_msg").html('Proposed Name Preview if submitted: '+proposenameinput+' '+typeofcoop+' Cooperative ('+val+')');

      }

    });



  $('#reserveUpdateForm #categoryOfCooperative').on('change', function(){

      var categorycoop = $(this).val();

  //      alert(categorycoop);

      if(categorycoop=="Primary"){

          $('#reserveUpdateForm #coopbank').hide();

      } else {

          $('#reserveUpdateForm #coopbank').show();

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



    $('#reserveUpdateForm #commonBondOfMembership').on('change', function(){

      var comonbond = $("#reserveUpdateForm #commonBondOfMembership option:selected").text();



      // alert(val);

      if(comonbond=='Institutional'){

          $('#reserveUpdateForm #fieldmembershipname').show();

          $('#reserveUpdateForm #field_membership').show();

          $('#reserveUpdateForm #name_institution_label').show();

          $('#reserveUpdateForm #name_institution').show();

          $('#reserveUpdateForm #addMoreInsBtn').show();

          $('#reserveUpdateForm #remove_ins').show();

          $('#reserveUpdateForm #fieldmembershipmemofficname').hide();

          $('#reserveUpdateForm #composition_of_members_label').hide();

          $('#reserveUpdateForm #addMoreAssocBtn').hide();

          $('#reserveUpdateForm #addMoreComBtn').hide();

          $('#reserveUpdateForm #name_associational_label').hide();

          $('#reserveUpdateForm #compositionOfMembers').hide();

          $('#reserveUpdateForm #compositionOfMembers1').hide();

          $('#reserveUpdateForm .compositionRemoveBtn').hide();

      } else if(comonbond=="Associational"){

          $('#reserveUpdateForm #fieldmembershipname').hide();

          $('#reserveUpdateForm #fieldmembershipmemofficname').show();

          $('#reserveUpdateForm #field_membership').show();

          $('#reserveUpdateForm #name_institution_label').hide();

          $('#reserveUpdateForm #name_institution').show();

//            $('#reserveUpdateForm #addMoreAssocBtn').show();
          $('#reserveUpdateForm #remove_ins').show();

          $('#reserveUpdateForm #name_associational_label').show();

          $('#reserveUpdateForm #composition_of_members_label').hide();

          $('#reserveUpdateForm #addMoreInsBtn').show();

          $('#reserveUpdateForm #addMoreComBtn').hide();

          $('#reserveUpdateForm #compositionOfMembers').hide();

          $('#reserveUpdateForm #compositionOfMembers1').hide();

          $('#reserveUpdateForm .compositionRemoveBtn').hide();

      } else if (comonbond=="Occupational"){

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

          $('#reserveUpdateForm .compositionRemoveBtn').show();

          $('#reserveUpdateForm #addMoreComBtn').show();

          $('#reserveUpdateForm select[name="compositionOfMembers[]"').show();

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

          $('#reserveUpdateForm .compositionRemoveBtn').hide();

          $('#reserveUpdateForm #name_associational_label').hide();

          $('#reserveUpdateForm #compositionOfMembers1').hide();

          $('#reserveUpdateForm #compositionOfMembers').hide();

          $('#reserveUpdateForm #remove_ins').hide();

      }

    });



    var id = $("#reserveUpdateForm #cooperativeID").val();

    var userid = $("#reserveUpdateForm #userID").val();

    $.ajax({

      type : "POST",

      url : $('body').attr('data-baseurl') + "get_cooperative_info_by_admin",

      dataType: "json",

      data : {

        id: id,

        user_id: userid

      },

      success: function(data){

          var cbom = data.common_bond_of_membership;

          // alert(cbom);

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
            }); //end ea
          }
          else
          {
            mcount=0;
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
                  $('#reserveUpdateForm select[name="majorIndustry[]"]').each(function(index){
                    $(this).siblings('label').text("Major Industry Classification No. 1");
                  });
                  $('#reserveUpdateForm select[name="subClass[]"]').each(function(index){
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
                  url : $('body').attr('data-baseurl') + "api/major_industries",
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
                      $('#reserveUpdateForm select[name="majorIndustry[]"').each(function(index){
                        $(this).siblings('label').text("Major Industry Classification No. " + (index+1));
                      });
                      $('#reserveUpdateForm select[name="subClass[]"').each(function(index){
                        $(this).siblings('label').text("Major Industry Classification No. " + (index+1) + " Subclass ");
                      });
                  }
                });

          } 

          if(cbom=='Institutional'){

              $('#reserveUpdateForm #fieldmembershipname').show();

              $('#reserveUpdateForm #field_membership').show();

              $('#reserveUpdateForm #name_institution_label').show();

              $('#reserveUpdateForm #name_institution').show();

              $('#reserveUpdateForm #addMoreInsBtn').show();

              $('#reserveUpdateForm #remove_ins').show();

              $('#reserveUpdateForm #fieldmembershipmemofficname').hide();

              $('#reserveUpdateForm #composition_of_members_label').hide();

              $('#reserveUpdateForm #addMoreAssocBtn').hide();

              $('#reserveUpdateForm #addMoreComBtn').hide();

              $('#reserveUpdateForm #name_associational_label').hide();

              $('#reserveUpdateForm #compositionOfMembers').hide();

              $('#reserveUpdateForm #compositionOfMembers1').hide();

              $('#reserveUpdateForm #compositionOfMembers2').hide();

              $('#reserveUpdateForm #compositionOfMembers3').hide();

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

              $('#reserveUpdateForm #compositionOfMembers2').hide();

              $('#reserveUpdateForm #compositionOfMembers3').hide();

              $('#reserveUpdateForm .compositionRemoveBtn').hide();

              $('#reserveUpdateForm #remove_ins').hide();

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

              $('#reserveUpdateForm #compositionOfMembers2').show();

              $('#reserveUpdateForm #compositionOfMembers3').show();

              $('#reserveUpdateForm .compositionRemoveBtn').show();

              $('#reserveUpdateForm #addMoreComBtn').show();

              $('#reserveUpdateForm select[name="compositionOfMembers[]"').show();

              $('#reserveUpdateForm #remove_ins').hide();

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

              $('#reserveUpdateForm .compositionRemoveBtn').hide();

              $('#reserveUpdateForm #name_associational_label').hide();

              $('#reserveUpdateForm #compositionOfMembers1').hide();

              $('#reserveUpdateForm #compositionOfMembers2').hide();

              $('#reserveUpdateForm #compositionOfMembers3').hide();

              $('#reserveUpdateForm #compositionOfMembers').hide();

              $('#reserveUpdateForm #remove_ins').hide();

              $('#reserveUpdateForm #remove_ins').hide();

          }

        if(data!=null){

          var tempCount = 0;

  //        alert(data.common_bond_of_membership);

       

          // setTimeout( function(){

          //   $('#reserveUpdateForm #region').val(data.rCode);

          //   $('#reserveUpdateForm #region').trigger('change');

          // },300);

          // setTimeout( function(){

          //     $('#reserveUpdateForm #province').val(data.pCode);

          //     $('#reserveUpdateForm #province').trigger('change');

          // },900);

          // setTimeout(function(){

          //   $('#reserveUpdateForm #city').val(data.cCode);

          //   $('#reserveUpdateForm #city').trigger('change');

          // },1500);

          // setTimeout(function(){

          //   $('#reserveUpdateForm #barangay').val(data.bCode);

          // },2500);

        

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

  

 //     // START LABORATORY UPDATE



    var id = $("#reserveUpdateFormLaboratories #cooperativeID").val();

    var userid = $("#reserveUpdateFormLaboratories #userID").val();

    $.ajax({

      type : "POST",

      url : $('body').attr('data-baseurl') + "cooperatives/get_cooperative_info",

      dataType: "json",

      data : {

        id: id,

        user_id: userid

      },

      success: function(data){

        //start

        console.log(data.area_of_operation);

          if(data!=null){

          var tempCount = 0;

          // setTimeout( function(){

          //   $('#reserveUpdateFormLaboratories #region').val(data.rCode);

          //   $('#reserveUpdateFormLaboratories #region').trigger('change');

          // },100);

          // setTimeout( function(){

          //     $('#reserveUpdateFormLaboratories #province').val(data.pCode);

          //     $('#reserveUpdateFormLaboratories #province').trigger('change');

          // },500);

          // setTimeout(function(){

          //   $('#reserveUpdateFormLaboratories #city').val(data.cCode);

          //   $('#reserveUpdateFormLaboratories #city').trigger('change');

          // },1000);

          // setTimeout(function(){

            // $('#reserveUpdateFormLaboratories #barangay').val(data.bCode);

            if(data.area_of_operation=='Barangay'){

              // alert(data.area_of_operation);

              $('#reserveUpdateFormLaboratories #barangay').prop("disabled",true);

              $('#reserveUpdateFormLaboratories #city').prop("disabled",true);

              $('#reserveUpdateFormLaboratories #province').prop("disabled",true);

              $('#reserveUpdateFormLaboratories #region').prop("disabled",true);

            }else if(data.area_of_operation=='Municipality/City'){

              // alert(data.area_of_operation);

              $('#reserveUpdateFormLaboratories #city').prop("disabled",true);

              $('#reserveUpdateFormLaboratories #province').prop("disabled",true);

              $('#reserveUpdateFormLaboratories #region').prop("disabled",true);

              $('#reserveUpdateFormLaboratories #barangay').prop("disabled",false);

            }else if(data.area_of_operation=='Provincial'){

                 // alert('Provincial');

              $('#reserveUpdateFormLaboratories #province').prop("disabled",true);

              $('#reserveUpdateFormLaboratories #region').prop("disabled",true);

              $('#reserveUpdateFormLaboratories #city').prop("disabled",false);

              $('#reserveUpdateFormLaboratories #barangay').prop("disabled",false);

            }else if(data.area_of_operation=='Regional'){



                // alert(data.area_of_operation);

              $('#reserveUpdateFormLaboratories #region').prop("disabled",true);

              $('#reserveUpdateFormLaboratories #province').prop("disabled",false);

              $('#reserveUpdateFormLaboratories #city').prop("disabled",false);

              $('#reserveUpdateFormLaboratories #barangay').prop("disabled",false);

            }else if(data.area_of_operation=='National' || data.area_of_operation=='Interregional'){

              // alert(data.area_of_operation);

              $('.opt').each(function() {

                  if(!this.selected) {

                      $(this).attr('disabled', true);

                  }

              });

              $('#reserveUpdateFormLaboratories #region').prop("disabled",false);

              $('#reserveUpdateFormLaboratories #province').prop("disabled",false);

              $('#reserveUpdateFormLaboratories #city').prop("disabled",false);

              $('#reserveUpdateFormLaboratories #barangay').prop("disabled",false);

            }



          // },100); 





        } //end if

        //end



        // if(data!=null){

        //   var tempCount = 0;

        //   setTimeout( function(){

        //     $('#reserveUpdateFormLaboratories #region').val(data.rCode);

        //     $('#reserveUpdateFormLaboratories #region').trigger('change');

        //   },300);

        //   setTimeout( function(){

        //       $('#reserveUpdateFormLaboratories #province').val(data.pCode);

        //       $('#reserveUpdateFormLaboratories #province').trigger('change');

        //   },900);

        //   setTimeout(function(){

        //     $('#reserveUpdateFormLaboratories #city').val(data.cCode);

        //     $('#reserveUpdateFormLaboratories #city').trigger('change');

        //   },1500);

        //   setTimeout(function(){

        //     $('#reserveUpdateFormLaboratories #barangay').val(data.bCode);

        //   },2500);

        

        //   $('#reserveUpdateFormLaboratories #streetName').val(data.street);

        //   $('#reserveUpdateFormLaboratories #blkNo').val(data.house_blk_no);

        //   // $('#reserveUpdateForm #categoryOfCooperative').val(data.category_of_cooperative);

        //   // $('#reserveUpdateForm #majorIndustry').trigger('change');

        //   // $('#reserveUpdateForm select[name="proposedBusinessActivity[]"').trigger('change');

        //   $('#reserveUpdateFormLaboratories #commonBondOfMembership').val(data.common_bond_of_membership);

        //   $('#reserveUpdateFormLaboratories #areaOfOperation').val(data.area_of_operation);

        //   if(data.composition_of_members =="Others"){

        //     $('#reserveUpdateForm #compositionOfMembers').val(data.composition_of_members);

        //     $('#reserveUpdateForm #compositionOfMembers').trigger('change');

        //     $('#reserveUpdateForm #compositionOfMembersSpecify').val(data.composition_of_members_others);

        //   }else{

        //     $('#reserveUpdateForm #compositionOfMembers').val(data.composition_of_members);

        //   }

        



        //   $('#reserveUpdateFormLaboratories select[name="majorIndustry[]"').each(function(){

        //     if($(this).val() && ($(this).val()).length > 0){

        //       $(this).trigger('change');

        //       tempCount++;

        //     }

        //   });

        //   if(tempCount == $('#reserveUpdateFormLaboratories select[name="majorIndustry[]"').length){

        //     $.ajax({

        //       type : "POST",

        //       url  : "../get_business_activities_of_coop",

        //       dataType: "json",

        //       data : {

        //         id: id

        //       },

        //       success: function(data){

        //         $('#reserveUpdateFormLaboratories select[name="subClass[]"').each(function(index){

        //           var temp = $(this);

        //           setTimeout(function(){

        //             $(temp).val(data[index].id);

        //             $(temp).trigger('change');

        //           },800);

        //         });

        //       }

        //     });

        //   }

        

        //   $("#reserveUpdateFormLaboratories #proposedName").focus();

        // }

      }//end of success function

    });





  $('#reserveUpdateFormLaboratories #region').on('change',function(){

      $('#reserveUpdateFormLaboratories #province').empty();

      $("#reserveUpdateFormLaboratories #province").prop("disabled",false);

      $('#reserveUpdateFormLaboratories #city').empty();

      $("#reserveUpdateFormLaboratories #city").prop("disabled",false);

      $('#reserveUpdateFormLaboratories #barangay').empty();

      $("#reserveUpdateFormLaboratories #barangay").prop("disabled",false);

      if($(this).val() && ($(this).val()).length > 0){

        $("#reserveUpdateForm #province").prop("disabled",false);

        var region = $(this).val();

          $.ajax({

          type : "POST",

          url : $('body').attr('data-baseurl') + "api/provinces",

          dataType: "json",

          data : {

            region: region

          },

          success: function(data){

            $('#reserveUpdateFormLaboratories #province').append($('<option></option>').attr('value',"").text(""));

            $.each(data, function(key,value){

              $('#reserveUpdateFormLaboratories #province').append($('<option></option>').attr('value',value.provCode).text(value.provDesc));

            });

          }

        });

      }

    });



    $('#reserveUpdateFormLaboratories #province').on('change',function(){

      $('#reserveUpdateFormLaboratories #city').empty();

      $("#reserveUpdateFormLaboratories #city").prop("disabled",false);

      $('#reserveUpdateFormLaboratories #barangay').empty();

      $("#reserveUpdateFormLaboratories #barangay").prop("disabled",false);

      if($(this).val() && ($(this).val()).length > 0){

        $("#reserveUpdateForm #city").prop("disabled",false);

        var province = $(this).val();

          $.ajax({

          type : "POST",

          url : $('body').attr('data-baseurl') + "api/cities",

          dataType: "json",

          data : {

            province: province

          },

          success: function(data){

            $('#reserveUpdateFormLaboratories #city').append($('<option></option>').attr('value',"").text(""));

            $.each(data, function(key,value){

              $('#reserveUpdateFormLaboratories #city').append($('<option></option>').attr('value',value.citymunCode).text(value.citymunDesc));

            });

          }

        });

      }

    });



    $('#reserveUpdateFormLaboratories #city').on('change',function(){

      $('#reserveUpdateFormLaboratories #barangay').empty();

      $("#reserveUpdateFormLaboratories #barangay").prop("disabled",false);

      if($(this).val() && ($(this).val()).length > 0){

        $("#reserveUpdateFormLaboratories #barangay").prop("disabled",false);

        var cities = $(this).val();

          $.ajax({

          type : "POST",

          url : $('body').attr('data-baseurl') + "api/barangays",

          dataType: "json",

          data : {

            cities: cities

          },

          success: function(data){

            $('#reserveUpdateFormLaboratories #barangay').append($('<option></option>').attr('value',"").text(""));

            $.each(data, function(key,value){

              $('#reserveUpdateFormLaboratories #barangay').append($('<option></option>').attr('value',value.brgyCode).text(value.brgyDesc));

            });

          }

        });

      }

    });





    $("#reserveUpdateFormLaboratories #reserveUpdateAgree").click(function(){

      if($(this).is(':checked')){

        $('#reserveUpdateFormLaboratories #reserveUpdateBtn').removeAttr('disabled');

      }else{

        $('#reserveUpdateFormLaboratories #reserveUpdateBtn').attr('disabled','disabled');

      }

    });

  

    // END LABORATORY UPDATE



    // Jiee

    var areaOfOperation = $("#reserveUpdateForm #areaOfOperation2").val();

    // alert(areaOfOperation);

    if(areaOfOperation == 'Interregional'){

      $('.opt').each(function() {

            if(!this.selected) {

                $(this).attr('disabled', true);

            }

        });

      $('#reserveUpdateForm #allisland').show();

      $('#reserveUpdateForm #allregions').show();

      $('#reserveUpdateForm #interregional').show();

      $('#reserveUpdateForm #regions').show();

      $('#reserveUpdateForm #selectisland').show();

      $('#reserveUpdateForm #selectregion').show();

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

    } else {

      $('#reserveUpdateForm #allisland').hide();

      $('#reserveUpdateForm #allregions').hide();

      $('#reserveUpdateForm #interregional').hide();

      $('#reserveUpdateForm #regions').hide();

      $('#reserveUpdateForm #selectisland').hide();

      $('#reserveUpdateForm #selectregion').hide();

    }

    



    $('#reserveUpdateForm #areaOfOperation').on('change',function(){

      $('#reserveUpdateForm #region').empty();

      var areaOfOperation = $(this).val();

      if(areaOfOperation == "Interregional"){

        $('#reserveUpdateForm #region').empty();

        $('#reserveUpdateForm #allisland').show();

        $('#reserveUpdateForm #allregions').show();

        $('#reserveUpdateForm #interregional').show();

        $('#reserveUpdateForm #regions').show();

        $('#reserveUpdateForm #selectisland').show();

        $('#reserveUpdateForm #selectregion').show();

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



      } else {

        $('#reserveUpdateForm #allisland').hide();

        $('#reserveUpdateForm #allregions').hide();

        $('#reserveUpdateForm #region').empty();

        $('#reserveUpdateForm #interregional').hide();

        $('#reserveUpdateForm #regions').hide();

        $('#reserveUpdateForm #selectisland').hide();

        $('#reserveUpdateForm #selectregion').hide();



        $.ajax({

              type : "GET",

              url : $('body').attr('data-baseurl') + "api/regions",

              dataType: "json",

              success: function(data){

                $('#reserveUpdateForm #region').append($('<option></option>').attr('value',"").text(""));

                $.each(data, function(key,value){

                  $('#reserveUpdateForm #region').append($('<option></option>').attr('value',value.regCode).text(value.regDesc));

                });

            }

          });

      }

    });



    $('#reserveUpdateForm #interregional').on('change',function(){

      // alert($(this).val().length);

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

      if($(this).val().length <= 2){

        // alert($(this).val());

        $('#reserveUpdateForm #region').empty();

        $('#reserveUpdateForm #regions').empty();

        $('#reserveUpdateForm #province').empty();

        $("#reserveUpdateForm #province").prop("disabled",true);

        $('#reserveUpdateForm #city').empty();

        $("#reserveUpdateForm #city").prop("disabled",true);

        $('#reserveUpdateForm #barangay').empty();

        $("#reserveUpdateForm #barangay").prop("disabled",true);

        if($(this).val() && ($(this).val()).length > 0){

          $("#reserveUpdateForm #province").prop("disabled",false);

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

                $('#reserveUpdateForm #regions').append($('<option></option>').attr('value',value.region_code).text(value.regDesc));

              });

            }

          });

        }



      } else {

        $('.opt').each(function() {

            if(!this.selected) {

                $(this).attr('disabled', true);

            }

        });

      }

    });

    // Multi Purpose
    $(document).on('change','.coop-type',function(){
        var typeCoop_array=[]; 

          $('select[name="typeOfCooperative[]"] option:selected').each(function() {
              typeCoop_array.push($(this).val());
              
          });
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
               $('#reserveUpdateForm #commonBond2').val('');
              $('#reserveUpdateForm #commonBondOfMembership').removeAttr('disabled');
            }

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

      
    $('#reserveUpdateForm #addMoreSubclassBtn').on('click', function(){
  
     // var origin_name =  $("#newName2").val();
     // var start_counting_major = ++count_major_industry;
     // // alert(start_counting_major);
     // if(start_counting_major>1)
     // {  
     //    $("#newNamess").val(origin_name+' Multipurpose');
     // }
    
    var mcount = 0;
      $('#reserveUpdateForm .major-type').each(function(){
           if($(this).val().length>0) {
            mcount++;
               // intLastCount++;
               // mcount++;
           } 
        });
    mcount = mcount;

    console.log(mcount);

    // console.log(($('#reserveUpdateForm #typeOfCooperatives2').val()));
    if($('#reserveUpdateForm #typeOfCooperatives2').val() && ($('#reserveUpdateForm #typeOfCooperatives2').val()).length > 0){
      var lastCountOfSubclass = $('select[name="majorIndustry['+mcount+'][subclass_id]"').last().attr('id'); 
      var totalCountOFSubclass = $('select[name="majorIndustry['+mcount+'][subclass_id]"').length;

      // var lastCountOfSubclass = $('select[name="majorIndustry[]"').last().attr('id'); 
      // var totalCountOFSubclass = $('select[name="majorIndustry[]"').length;
      // alert($('#reserveUpdateForm #typeOfCooperatives1').val());
      // mcount = totalCountOFSubclass;
      // console.log(mcount2);

      // if(mcount == 1){
        mcount++;  
      // } else {
      //   mcount++;mcount++;
      // }
      
      // console.log(totalCountOFSubclass);
      var intLastCount = parseInt(lastCountOfSubclass.substr(-1)); 
      // if(intLastCount != 1){
      //   intLastCount++;
      // }
      var coop_types = "";
        $('#reserveUpdateForm .coop-type').each(function(){
           if($(this).val().length>0) {
               coop_types += $(this).val()+"|";
           } 
        });
        // alert(intLastCount);
        // console.log("cooptypes: "+coop_types);
        // if(coop_types.indexOf('|') != -1){
        //     // console.log("Found");
        //     intLastCount++;
        // }
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
      var selectSubClass = $('<select></select>').attr({'class': 'custom-select form-control validate[required]','name': 'majorIndustry['+mcount+'][subclass_id]', 'id': 'subClass' + (intLastCount + 1)}).prop("disabled",true);
      
      var divFormGroupMajorIndustry = $('<div></div>').attr({'class':'form-group'});
      var divColMajorIndustry = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
      var labelMajorIndustry = $('<label></label>').attr({'for': 'majorIndustry'+(intLastCount + 1)}).text("Major Industry Classification No. " + (intLastCount+1));
      var selectMajorIndustry = $('<select></select>').attr({'class': 'custom-select major-ins major-type form-control validate[required]','name': 'majorIndustry['+mcount+'][major_id]', 'id': 'majorIndustry' + (intLastCount + 1)}).change(function(){
      
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
          url : $('body').attr('data-baseurl') + "api/major_industries_amendment",
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
      $('#reserveUpdateForm #typeOfCooperatives2').focus();
    }
  });

    //load sublcass
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
    // END Multi Purpose

    $('#reserveUpdateForm #regions').on('change',function(){

      // alert($(this).val());

      $('#reserveUpdateForm #region').empty();

      $("#reserveUpdateForm #province").prop("disabled",true);

      $('#reserveUpdateForm #city').empty();

      $("#reserveUpdateForm #city").prop("disabled",true);

      $('#reserveUpdateForm #barangay').empty();

      $("#reserveUpdateForm #barangay").prop("disabled",true);

      if($(this).val() && ($(this).val()).length > 0){

        $("#reserveUpdateForm #province").prop("disabled",false);

        var regions = $(this).val();

          $.ajax({

          type : "POST",

          url : $('body').attr('data-baseurl') + "api/regions",

          dataType: "json",

          data : {

            regions: regions

          },

          success: function(data){

            $('#reserveUpdateForm #region').append($('<option></option>').attr('value',"").text(""));

            $.each(data, function(key,value){

              $('#reserveUpdateForm #region').append($('<option></option>').attr('value',value.regCode).text(value.regDesc));

            });

          }

        });

      }

    });

    $('.customDeleleBtn').on('click', function(){
      $(this).parent().remove(); 
    });

    var count_text_input =1;

    $("#reserveUpdateForm #addCoop").on('click', function(e){ 

      var category = $("#reserveUpdateForm #categoryOfCooperative").val();

      // var name_origin =  $("#newName2").val();

      

      var lastCountOfcoop = $('select[name="typeOfCooperative[]"]').last().attr('id');

      intLastCount = parseInt(lastCountOfcoop.substr(-1)); 

      var htmlc= $('<div></div>').attr({'class':'col-md-6 list-cooptype'});

      var divRow = $('<div></div>').attr({'class':'row col-md-12'});

      var divFormGroup= $('<div></div>').attr({'class':'form-group'});

      var selectCoop = $('<select></select>').attr({'class': 'custom-select coop-type form-control validate[required]','name': 'typeOfCooperative[]', 'id': 'typeOfCooperatives' + (intLastCount + 1)}).prop("disabled",false);

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

            // $('#reserveUpdateForm .major-ins').empty();

            $('#reserveUpdateForm .major-ins').append($('<option></option').attr({'selected':true}).val(""));

                $.ajax({

                 type : "POST",

                 url : $('body').attr('data-baseurl') + "api/major_industries_s",

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

      $("#reserveUpdateForm .type-coop-row").append(divRow);

    

      list_cooperative_type(selectCoop,category); //load coop type selectbox

      e.preventDefault();

      

    }); //end of addCoop function



    let count_major_industry=parseInt($('.major-industry').length);

  $('#reserveUpdateForm #addMoreSubclassBtn').on('click', function(){ 

        if($('#reserveUpdateForm #typeOfCooperatives1').val() && ($('#reserveUpdateForm #typeOfCooperatives1').val()).length > 0)

        {

          // alert($('#reserveUpdateForm #typeOfCooperatives1').val());

          var lastCountOfSubclass = $('select[name="subClass[]"').last().attr('id'); 

          var totalCountOFSubclass = $('select[name="subClass[]"').length;

          var intLastCount = parseInt(lastCountOfSubclass.substr(-1));

        

            var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn businessActivityRemoveBtn float-right text-danger'}).click(function(){

              $(this).closest('.list').remove();

              $('#reserveUpdateForm select[name="majorIndustry[]"]').each(function(index){

                $(this).siblings('label').text("Major Industry Classification No. " + (index+1));

              });



              $('#reserveUpdateForm select[name="subClass[]"]').each(function(index){

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

                 url : $('body').attr('data-baseurl') + "major_industries",

                 dataType: "json",

                 data: {coop_type:typeCoop_arrays},

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

                    $('#reserveUpdateForm select[name="majorIndustry[]"').each(function(index){

                      $(this).siblings('label').text("Major Industry Classification No. " + (index+1));

                    });

                    $('#reserveUpdateForm select[name="subClass[]"').each(function(index){

                      $(this).siblings('label').text("Major Industry Classification No. " + (index+1) + " Subclass ");

                    });



                    

            

                 }

            }); //end ajax  

                   

        }else{

          $('#reserveUpdateForm #typeOfCooperative1').focus();

        }

  }); //end major industry



    function list_cooperative_type($select_id,$category)

    {

      // alert($select_id);

      // alert($category);

        $($select_id).append($('<option></option').attr({'selected':true}).val(""));

        $.ajax({

          async:false,

          type : "POST",

         url  : "cooperative_type_ajax",

         dataType: "json",

         data: {category:$category},

         success: function(responsetxt){

          // console.log(responsetxt);

          $.each(responsetxt,function(a,coop_type){

             $($select_id).append($('<option></option>').attr('value',coop_type['id']).text(coop_type['name']));

          });

         }

        }); 



    }

  // End Jiee



