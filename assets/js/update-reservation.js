  $(function(){
    
  $('#reserveUpdateForm #acronymnameerr').hide();
   document.getElementById("proposedName").maxLength = "61";
   
  $('#reserveUpdateForm #typeOfCooperative').find('option:contains(Federation)').hide();
  
  
  var categryofcoop = $("#reserveUpdateForm #categoryOfCooperative option:selected").text();
  var typeofcoop = $("#reserveUpdateForm #typeOfCooperative option:selected").text();

  if(categryofcoop == 'Secondary' || categryofcoop == 'Tertiary' || categryofcoop == 'Others'){
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
    if(val == 'Secondary' || val == 'Tertiary' || val == 'Others'){

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
  if(categryofcoop == 'Others'){
    $.each([ 'Federation', 'Advocacy', 'Agrarian Reform', 'Agriculture', 'Consumers', 'Credit', 'Dairy', 'Electric'
    , 'Education', 'Financial Service', 'Fishermen', 'Health Service', 'Housing', 'Labor Service', 'Marketing', 'Producers', 'Professionals', 'Service'
    , 'Small Scale Mining', 'Transport', 'Water Service', 'Workers'], function( index, value ) {
      $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').hide();
    });

    $.each([ 'Cooperative Bank', 'Insurance', 'Union'], function( index, value ) {
      $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').show();
    });
  } else if(categryofcoop == 'Secondary'){
    $.each([ 'Federation', 'Advocacy', 'Agrarian Reform', 'Agriculture', 'Consumers', 'Credit', 'Dairy', 'Electric'
    , 'Education', 'Financial Service', 'Fishermen', 'Health Service', 'Housing', 'Labor Service', 'Marketing', 'Producers', 'Professionals', 'Service'
    , 'Small Scale Mining', 'Transport', 'Water Service', 'Workers'], function( index, value ) {
      $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').show();
    });

    $.each([ 'Cooperative Bank', 'Insurance', 'Union', 'Bank'], function( index, value ) {
      $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').hide();
    });

  } else if(categryofcoop == 'Tertiary'){
    $.each([ 'Federation', 'Advocacy', 'Agrarian Reform', 'Agriculture', 'Consumers', 'Credit', 'Dairy', 'Electric'
    , 'Education', 'Financial Service', 'Fishermen', 'Health Service', 'Housing', 'Labor Service', 'Marketing', 'Producers', 'Professionals', 'Service'
    , 'Small Scale Mining', 'Transport', 'Water Service', 'Workers'], function( index, value ) {
      $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').show();
    });

    $.each([ 'Cooperative Bank', 'Insurance', 'Union', 'Bank'], function( index, value ) {
      $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').hide();
    });
  } else {
    $.each([ 'Advocacy', 'Agrarian Reform', 'Agriculture', 'Consumers', 'Credit', 'Dairy', 'Electric'
    , 'Education', 'Financial Service', 'Fishermen', 'Health Service', 'Housing', 'Labor Service', 'Marketing', 'Producers', 'Professionals', 'Service'
    , 'Small Scale Mining', 'Transport', 'Water Service', 'Workers'], function( index, value ) {
      $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').show();
    });

    $.each([ 'Cooperative Bank', 'Insurance', 'Union', 'Federation', 'Bank'], function( index, value ) {
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

            $.each([ 'Cooperative Bank', 'Insurance', 'Union', 'Federation', 'Bank'], function( index, value ) {
              $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').hide();
            });
        } else if(categorycoop=="Secondary - Federation"){
            $.each([ 'Federation', 'Advocacy', 'Agrarian Reform', 'Agriculture', 'Consumers', 'Credit', 'Dairy', 'Electric'
            , 'Education', 'Financial Service', 'Fishermen', 'Health Service', 'Housing', 'Labor Service', 'Marketing', 'Producers', 'Professionals', 'Service'
            , 'Small Scale Mining', 'Transport', 'Water Service', 'Workers'], function( index, value ) {
              $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').show();
            });

            $.each([ 'Cooperative Bank', 'Insurance', 'Union', 'Bank'], function( index, value ) {
              $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').hide();
            });
        } else if(categorycoop=="Tertiary - Federation"){
            $.each([ 'Federation', 'Advocacy', 'Agrarian Reform', 'Agriculture', 'Consumers', 'Credit', 'Dairy', 'Electric'
            , 'Education', 'Financial Service', 'Fishermen', 'Health Service', 'Housing', 'Labor Service', 'Marketing', 'Producers', 'Professionals', 'Service'
            , 'Small Scale Mining', 'Transport', 'Water Service', 'Workers'], function( index, value ) {
              $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').show();
            });

            $.each([ 'Cooperative Bank', 'Insurance', 'Union', 'Bank'], function( index, value ) {
              $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').hide();
            });
        } else if(categorycoop=="Secondary - Union"){
            $.each([ 'Federation', 'Advocacy', 'Agrarian Reform', 'Agriculture', 'Consumers', 'Credit', 'Dairy', 'Electric'
            , 'Education', 'Financial Service', 'Fishermen', 'Health Service', 'Housing', 'Labor Service', 'Marketing', 'Producers', 'Professionals', 'Service'
            , 'Small Scale Mining', 'Transport', 'Water Service', 'Workers'], function( index, value ) {
              $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').hide();
            });

            $.each([ 'Cooperative Bank', 'Insurance', 'Union', 'Bank'], function( index, value ) {
              $('#reserveUpdateForm #typeOfCooperative').find('option:contains('+value+')').show();
            });
        } else {
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
      if(typeofcoop == 16 || typeofcoop == 26 || typeofcoop == 9){
        var categoryofcoop = $( "#reserveUpdateForm #categoryOfCooperative option:selected").text();
        // alert('wow');
        if(categoryofcoop == 'Primary' || categoryofcoop == 'Secondary' || categoryofcoop == 'Tertiary'){
          $('#reserveUpdateForm #typeOfCooperative').val('');
        } 
      } else {
        var categoryofcoop = $( "#reserveUpdateForm #categoryOfCooperative option:selected").text();
        
        if(categoryofcoop == 'Others'){
          $('#reserveUpdateForm #typeOfCooperative').val('');
        } 
      }
    });

  $('#reserveUpdateForm #proposedName').on('change',function(){
      var val = $(this).val();
      var typeofcoop = $( "#reserveUpdateForm #typeOfCooperative option:selected").text();
      var categoryofcoop = $( "#reserveUpdateForm #categoryOfCooperative option:selected").text();

      // var count_coop_type =$('#reserveAddForm select[name="typeOfCooperative[]"').length;
      // if(count_coop_type>1)
      // {
        // $("#typeOfCooperative").html(val+' Multipurpose Cooperative');
      if(categoryofcoop == 'Secondary' || categoryofcoop == 'Tertiary'){
        $("#proposed_name_msg").html('Proposed Name Preview if submitted: '+val+' Federation of '+typeofcoop);
      } else {
        $("#proposed_name_msg").html('Proposed Name Preview if submitted: '+val+' '+typeofcoop+' Cooperative');
      }
    document.getElementById('acronymname').value = '';
    var value = document.getElementById("proposedName").value;
    var totalval = 61 - value.length; 
    if(totalval == 0){
      $("#reserveUpdateForm #acronymname").prop("disabled",true);
      $('#reserveUpdateForm #acronymnameerr').show();
    } else {
      $('#reserveUpdateForm #acronymnameerr').hide();
      $("#reserveUpdateForm #acronymname").prop("disabled",false);
    }
    document.getElementById("acronymname").maxLength = totalval;
  });

  $("#reserveUpdateForm #acronymname").bind("keyup change",function(){
      var val = $(this).val();
      var typeofcoop = $( "#reserveUpdateForm #typeOfCooperative option:selected").text();
      var categoryofcoop = $( "#reserveUpdateForm #categoryOfCooperative option:selected").text();
      var proposenameinput = $( "#reserveUpdateForm #proposedName").val();

      // var count_coop_type =$('#reserveAddForm select[name="typeOfCooperative[]"').length;
      // if(count_coop_type>1)
      // {
        // $("#typeOfCooperative").html(val+' Multipurpose Cooperative');
      if(categoryofcoop == 'Secondary' || categoryofcoop == 'Tertiary'){
        $("#proposed_name_msg").html('Proposed Name Preview if submitted: '+proposenameinput+' Federation of '+typeofcoop);
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
      }
    });

    var id = $("#reserveUpdateForm #cooperativeID").val();
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
      url  : "../get_cooperative_info",
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
          url  : "../../api/provinces",
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
          url  : "../../api/cities",
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
          url  : "../../api/barangays",
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
              url  : "../../api/regions",
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
            url  : "../../api/islands",
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
          url  : "../../api/regions",
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
  // End Jiee

