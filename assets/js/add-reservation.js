$(function(){
  if($('#termsAndConditionModal').length){
    $('#termsAndConditionModal').modal('show');
  }
  // $('#termsAndConditionModal #btnTermsAgree');
  //start cooperative add reservation validation
  // $('#reserveAddForm #addMoreActivityBtn').on('click', function(){
  //   var lastCountOfActivities = $('select[name="proposedBusinessActivity[]"').last().attr('id');
  //   var intLastCount = parseInt(lastCountOfActivities.substr(-1));
  //   var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn businessActivityRemoveBtn float-right text-danger'}).click(function(){
  //     $(this).parent().parent().parent().remove();
  //     $('#reserveAddForm #proposedBusinessActivitySubtype1').trigger('change');
  //     $('#reserveAddForm select[name="proposedBusinessActivitySubtype[]"').each(function(index){
  //       $(this).siblings('label').text("Proposed Business Activity Subtype " + (index+1));
  //     });
  //     $('#reserveAddForm select[name="proposedBusinessActivity[]"').each(function(index){
  //       $(this).siblings('label').text("Proposed Business Activity " + (index+1));
  //     });
  //   });
  //   var labelActivity = $('<label></label>').attr({'for': 'proposedBusinessActivity'+(intLastCount + 1)}).text('Major Industry ' + (intLastCount + 1));
  //   var selectActivity = $('<select></select>').attr({'class': 'custom-select form-control validate[required]','name': 'proposedBusinessActivity[]', 'id': 'proposedBusinessActivity' + (intLastCount + 1)}).change(function(){
  //     $('#reserveAddForm #proposedBusinessActivitySubtype' + (intLastCount+1)).empty();
  //     $("#reserveAddForm #proposedBusinessActivitySubtype" + (intLastCount+1)).prop("disabled",true);
  //     $('#reserveAddForm #typeOfCooperative').val("");
  //     if($(this).val() && ($(this).val()).length > 0){
  //       $("#reserveAddForm #proposedBusinessActivitySubtype" + (intLastCount+1)).prop("disabled",false);
  //       var business_activity = $(this).val();
  //         $.ajax({
  //         type : "POST",
  //         url  : "../api/business_activity_subtypes",
  //         dataType: "json",
  //         data : {
  //           business_activity_id: business_activity
  //         },
  //         success: function(data){
  //           $('#reserveAddForm #proposedBusinessActivitySubtype' + (intLastCount+1)).append($('<option></option>').attr('value',"").text(""));
  //           $.each(data, function(key,value){
  //             $('#reserveAddForm #proposedBusinessActivitySubtype' + (intLastCount+1)).append($('<option></option>').attr('value',value.id).text(value.name));
  //           });
  //         }
  //       });
  //     }
  //   });
  //   var labelSubtype = $('<label></label>').attr({'for': 'proposedBusinessActivitySubtype'+(intLastCount + 1)}).text('Proposed Business Activity Subtype ' + (intLastCount + 1));
  //   var selectSubtype = $('<select></select>').attr({'class': 'custom-select form-control validate[required]','name': 'proposedBusinessActivitySubtype[]', 'id': 'proposedBusinessActivitySubtype' + (intLastCount + 1), 'disabled': 'true'}).change(function(){
  //     var activityCount = 0;
  //     var hasValueCount = 0;
  //     $('#reserveAddForm select[name="proposedBusinessActivitySubtype[]"').each(function(){
  //       activityCount++;
  //       if(this.value.length > 0){
  //         hasValueCount++;
  //       }
  //     });
  //     if(hasValueCount === activityCount){
  //         $('#reserveAddForm #typeOfCooperative').val("Multi-Purpose");
  //     }else{
  //       $('#reserveAddForm #typeOfCooperative').val("");
  //     }
  //   });
  //   var divFormGroupActivity = $('<div></div>').attr({'class':'form-group'});
  //   var divFormGroupSubtype = $('<div></div>').attr({'class':'form-group'});
  //   var divColActivity = $('<div></div>').attr({'class':'col-sm-12 col-md-6'});
  //   var divColSubtype = $('<div></div>').attr({'class':'col-sm-12 col-md-6'});
  //   var divRow = $('<div></div>').attr({'class':'row'});
  //   $.ajax({
  //     type : "GET",
  //     url  : "../api/business_activity_types",
  //     dataType: "json",
  //     success: function(data){
  //       $(selectActivity).append($('<option></option').attr({'selected':true}).val(""));
  //       $.each(data, function (i, activity) {
  //           $(selectActivity).append($('<option>', {
  //               value: activity.id,
  //               text : activity.name
  //           }));
  //       });
  //       $(divFormGroupActivity).append(labelActivity,selectActivity);
  //       $(divColActivity).append(divFormGroupActivity);
  //       $(divFormGroupSubtype).append(deleteSpan,labelSubtype,selectSubtype);
  //       $(divColSubtype).append(divFormGroupSubtype);
  //       $(divRow).append(divColActivity,divColSubtype);
  //       $('.col-addreserve-activites').append(divRow);
  //       $('#reserveAddForm #proposedBusinessActivitySubtype1').trigger('change');
  //       $('#reserveAddForm select[name="proposedBusinessActivitySubtype[]"').each(function(index){
  //         $(this).siblings('label').text("Subclass " + (index+1));
  //       });
  //       $('#reserveAddForm select[name="proposedBusinessActivity[]"').each(function(index){
  //         $(this).siblings('label').text("Major Industry " + (index+1));
  //       });
  //     },
  //     error: function(error){
  //       alert(error + '<br> there was an error getting the list of business activities')
  //     }
  //   });
  // });
  //
  //
  // $('#reserveAddForm #proposedBusinessActivity1').on('change',function(){
  //   $('#reserveAddForm #proposedBusinessActivitySubtype1').empty();
  //   $("#reserveAddForm #proposedBusinessActivitySubtype1").prop("disabled",true);
  //   $('#reserveAddForm #typeOfCooperative').val("");
  //   if($(this).val() && ($(this).val()).length > 0){
  //     $("#reserveAddForm #proposedBusinessActivitySubtype1").prop("disabled",false);
  //     var business_activity = $(this).val();
  //       $.ajax({
  //       type : "POST",
  //       url  : "../api/business_activity_subtypes",
  //       dataType: "json",
  //       data : {
  //         business_activity_id: business_activity
  //       },
  //       success: function(data){
  //         $('#reserveAddForm #proposedBusinessActivitySubtype1').append($('<option></option>').attr('value',"").text(""));
  //         $.each(data, function(key,value){
  //           $('#reserveAddForm #proposedBusinessActivitySubtype1').append($('<option></option>').attr('value',value.id).text(value.name));
  //         });
  //       }
  //     });
  //   }
  // });
  // $('#reserveAddForm #proposedBusinessActivitySubtype1').on('change',function(){
  //   var activityCount = 0;
  //   var hasValueCount = 0;
  //   $('#reserveAddForm select[name="proposedBusinessActivitySubtype[]"').each(function(){
  //     activityCount++;
  //     if(this.value.length > 0){
  //       hasValueCount++;
  //     }
  //   });
  //   if(activityCount<=1){
  //     $('#reserveAddForm #typeOfCooperative').val("");
  //     if($(this).val() && ($(this).val()).length > 0){
  //       var business_activity_subtype = $(this).val();
  //         $.ajax({
  //         type : "POST",
  //         url  : "../api/cooperative_types",
  //         dataType: "json",
  //         data : {
  //           business_activity_subtype_id: business_activity_subtype
  //         },
  //         success: function(data){
  //           $('#reserveAddForm #typeOfCooperative').val(data.coop_name);
  //         }
  //       });
  //     }
  //   }else{
  //     if(hasValueCount === activityCount){
  //         $('#reserveAddForm #typeOfCooperative').val("Multi-Purpose");
  //     }else{
  //       $('#reserveAddForm #typeOfCooperative').val("");
  //     }
  //   }
  // });
  $("#reserveAddForm #is_youth").change(function() {
    if(this.checked) {
        // alert('wow');
        $('#reserveAddForm #proposedName').on('change click',function(){

        var val = $(this).val();

        var typeofcoop = $( "#reserveAddForm #typeOfCooperative option:selected").text();

        var categoryofcoop = $( "#reserveAddForm #categoryOfCooperative option:selected").text();

        var acronym = $( "#reserveAddForm #acronymname").val();



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

          $("#reserveAddForm #acronymname").prop("disabled",true);

          $('#reserveAddForm #acronymnameerr').show();

        } else {

          $('#reserveAddForm #acronymnameerr').hide();

          $("#reserveAddForm #acronymname").prop("disabled",false);

        }

        document.getElementById("acronymname").maxLength = totalval;

      });
        
    } else {
        $('#reserveAddForm #proposedName').on('change click',function(){

        var val = $(this).val();

        var typeofcoop = $( "#reserveAddForm #typeOfCooperative option:selected").text();

        var categoryofcoop = $( "#reserveAddForm #categoryOfCooperative option:selected").text();

        var acronym = $( "#reserveAddForm #acronymname").val();



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

          $("#reserveAddForm #acronymname").prop("disabled",true);

          $('#reserveAddForm #acronymnameerr').show();

        } else {

          $('#reserveAddForm #acronymnameerr').hide();

          $("#reserveAddForm #acronymname").prop("disabled",false);

        }

        document.getElementById("acronymname").maxLength = totalval;

      });
    }
  });
  
  $('#reserveAddForm #acronymnameerr').hide();
  $('#reserveAddForm #typeOfCooperative').find('option:contains(Federation)').hide();

  $('#reserveAddForm #categoryOfCooperative').on('change', function(){
        var categorycoop = $(this).val();

        $('#reserveAddForm #typeOfCooperative').val('');
        $("#proposed_name_msg").html('');
     // alert(categorycoop);
        if(categorycoop=="Primary"){
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Cooperative Bank)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Insurance)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Union)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Federation)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Advocacy)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Agrarian Reform)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Agriculture)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Bank)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Consumers)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Cooperative Bank)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Credit)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Dairy)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Electric)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Financial Service)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Fishermen)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Health Service)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Housing)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Labor Service)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Marketing)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Producers)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Professionals)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Service)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Small Scale Mining)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Transport)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Technology Service)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Water Service)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Workers)').show();
        } else if(categorycoop=="Secondary - Federation"){
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Cooperative Bank)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Insurance)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Union)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Federation)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Advocacy)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Agrarian Reform)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Agriculture)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Bank)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Consumers)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Cooperative Bank)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Credit)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Dairy)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Electric)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Financial Service)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Fishermen)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Health Service)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Housing)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Labor Service)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Marketing)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Producers)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Professionals)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Service)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Small Scale Mining)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Transport)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Technology Service)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Water Service)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Workers)').show();
            // $('#reserveAddForm #coopbank').hide();
        } else if(categorycoop=="Tertiary - Federation"){
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Cooperative Bank)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Insurance)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Union)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Federation)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Advocacy)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Agrarian Reform)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Agriculture)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Bank)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Consumers)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Cooperative Bank)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Credit)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Dairy)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Electric)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Financial Service)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Fishermen)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Health Service)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Housing)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Labor Service)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Marketing)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Producers)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Professionals)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Service)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Small Scale Mining)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Transport)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Technology Service)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Water Service)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Workers)').show();
            // $('#reserveAddForm #coopbank').hide();
        } else if(categorycoop=="Secondary - Union"){
            // $('#reserveAddForm #typeOfCooperative').find('option:contains(Cooperative Bank)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Insurance)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Union)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Federation)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Advocacy)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Agrarian Reform)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Agriculture)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Bank)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Consumers)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Cooperative Bank)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Credit)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Dairy)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Electric)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Education)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Financial Service)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Fishermen)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Health Service)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Housing)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Labor Service)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Marketing)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Producers)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Professionals)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Service)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Small Scale Mining)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Transport)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Technology Service)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Water Service)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Workers)').hide();
        } else {
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Cooperative Bank)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Insurance)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Union)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Federation)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Advocacy)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Agrarian Reform)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Agriculture)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Bank)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Consumers)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Cooperative Bank)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Credit)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Dairy)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Electric)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Financial Service)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Fishermen)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Health Service)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Housing)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Labor Service)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Marketing)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Producers)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Professionals)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Service)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Small Scale Mining)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Transport)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Technology Service)').hide();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Water Service)').show();
            $('#reserveAddForm #typeOfCooperative').find('option:contains(Workers)').show();
        }
  });
  
  $('#reserveAddForm #typeOfCooperative').on('change', function(){
      var typeofcoop = $(this).val();
      // alert(typeofcoop);
      if(typeofcoop == 16 || typeofcoop == 26 || typeofcoop == 9 || typeofcoop == 28){
        var categoryofcoop = $( "#reserveAddForm #categoryOfCooperative option:selected").text();
        // alert('wow');
        if(categoryofcoop == 'Primary' || categoryofcoop == 'Secondary' || categoryofcoop == 'Tertiary'){
          $('#reserveAddForm #typeOfCooperative').val('');
        } 
      } else {
        var categoryofcoop = $( "#reserveAddForm #categoryOfCooperative option:selected").text();
        
        if(categoryofcoop == 'Others'){
          $('#reserveAddForm #typeOfCooperative').val('');
        } 
      }

      if(typeofcoop == 28){
        $('#reserveAddForm #commonbond').hide();
        $('#reserveAddForm #compositionOfMembers1').hide();
        $('#reserveAddForm #addMoreComBtn').hide();
      } else {
        $('#reserveAddForm #commonbond').show();
        $('#reserveAddForm #compositionOfMembers1').show();
        $('#reserveAddForm #addMoreComBtn').show();
      }

      if(typeofcoop == 26){ // val == 'Secondary' || val == 'Tertiary' || 
        $('#reserveAddForm #majorIndustry1').hide();
        $('#reserveAddForm #subClass1').hide();
        $('#reserveAddForm #addMoreSubclassBtn').hide();
        $('#reserveAddForm #majorlabel').hide();
        $('#reserveAddForm #subclasslabel').hide();
      } else {
        $('#reserveAddForm #majorIndustry1').show();
        $('#reserveAddForm #subClass1').show();
        $('#reserveAddForm #addMoreSubclassBtn').show();
        $('#reserveAddForm #majorlabel').show();
        $('#reserveAddForm #subclasslabel').show();
      }
    });

  $("#reserveAddForm #proposedName").bind("keyup change",function(){
      var val = $(this).val();
      var typeofcoop = $( "#reserveAddForm #typeOfCooperative option:selected").text();
      var categoryofcoop = $( "#reserveAddForm #categoryOfCooperative option:selected").text();
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
        $("#proposed_name_msg").html('Proposed Name Preview if submitted: '+val+' '+typeofcoop+' Cooperative');
      }
    });

  $("#reserveAddForm #is_youth").change(function() {
    if(this.checked) {
      $("#reserveAddForm #acronymname").bind("keyup change",function(){
          var val = $(this).val();
          var typeofcoop = $( "#reserveAddForm #typeOfCooperative option:selected").text();
          var categoryofcoop = $( "#reserveAddForm #categoryOfCooperative option:selected").text();
          var proposenameinput = $( "#reserveAddForm #proposedName").val();
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
            $("#proposed_name_msg").html('Proposed Name Preview if submitted: '+proposenameinput+' Youth '+typeofcoop+' Cooperative ('+val+')');
          }
        });
    } else {
      $("#reserveAddForm #acronymname").bind("keyup change",function(){
          var val = $(this).val();
          var typeofcoop = $( "#reserveAddForm #typeOfCooperative option:selected").text();
          var categoryofcoop = $( "#reserveAddForm #categoryOfCooperative option:selected").text();
          var proposenameinput = $( "#reserveAddForm #proposedName").val();
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
    }
  });


  // $('#reserveAddForm #categoryOfCooperative').on('change', function(){
  //   var val = $("#reserveAddForm #categoryOfCooperative option:selected").text();

  //   // alert(val);
  //   if(val == 'Others'){ // val == 'Secondary' || val == 'Tertiary' || 
  //     $('#reserveAddForm #majorIndustry1').hide();
  //     $('#reserveAddForm #subClass1').hide();
  //     $('#reserveAddForm #addMoreSubclassBtn').hide();
  //     $('#reserveAddForm #majorlabel').hide();
  //     $('#reserveAddForm #subclasslabel').hide();
  //   } else {
  //     $('#reserveAddForm #majorIndustry1').show();
  //     $('#reserveAddForm #subClass1').show();
  //     $('#reserveAddForm #addMoreSubclassBtn').show();
  //     $('#reserveAddForm #majorlabel').show();
  //     $('#reserveAddForm #subclasslabel').show();
  //   }
  // });

  $('#reserveAddForm #typeOfCooperative').on('change', function(){
    var val = $("#reserveAddForm #typeOfCooperative option:selected").text();
    $('#reserveAddForm #addMoreSubclassBtn').prop("disabled",true);
    $("#reserveAddForm #proposedName").prop("disabled",true);
    $('#reserveAddForm select[name="majorIndustry[]"').each(function(index){
      $(this).empty();
      $(this).prop("disabled",true);
    });
    $('#reserveAddForm select[name="subClass[]"').each(function(index){
      $(this).empty();
      $(this).prop("disabled",true);
    });

    
    if($(this).val() && ($(this).val()).length > 0){
      $("#reserveAddForm #addMoreSubclassBtn").prop("disabled",false);
      document.getElementById("proposedName").maxLength = "99";

      $('#reserveAddForm #proposedName').on('change',function(){
        document.getElementById('acronymname').value = '';
        var value = document.getElementById("proposedName").value;
        var totalval = 99 - value.length; 
        if(totalval == 0){
          $("#reserveAddForm #acronymname").prop("disabled",true);
          $('#reserveAddForm #acronymnameerr').show();
        } else {
          $('#reserveAddForm #acronymnameerr').hide();
          $("#reserveAddForm #acronymname").prop("disabled",false);
        }
        document.getElementById("acronymname").maxLength = totalval;
      });
      // if (value.length < totalval) {
        // document.getElementById("acronymname").maxLength = totalval;
      // }

      $("#reserveAddForm #proposedName").prop("disabled",false);
      var coop_type = $(this).val();
        $.ajax({
        type : "POST",
        url : $('body').attr('data-baseurl') + "api/major_industries",
        dataType: "json",
        data : {
          coop_type: coop_type
        },
        success: function(data){
          $('#reserveAddForm select[name="majorIndustry[]"').each(function(index){
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

  $('#reserveAddForm select[name="majorIndustry[]"').each(function(index){
    $(this).on('change',function(){ 
      $('#reserveAddForm #subClass'+(index+1)).empty();
      $('#reserveAddForm #subClass'+(index+1)).prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        var subClassTemp =   $('#reserveAddForm #subClass'+(index+1));
        $(subClassTemp).prop("disabled",false);
        var major_industry = $(this).val();
        var coop_type = $('#reserveAddForm #typeOfCooperative').val();
        if(coop_type.length > 0 ){
            $.ajax({
            type : "POST",
            url : $('body').attr('data-baseurl') + "api/industry_subclasses",
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
 
  $('#reserveAddForm #addMoreSubclassBtn').on('click', function(){
    if($('#reserveAddForm #typeOfCooperative').val() && ($('#reserveAddForm #typeOfCooperative').val()).length > 0){
      var lastCountOfSubclass = $('select[name="subClass[]"').last().attr('id'); 
      var totalCountOFSubclass = $('select[name="subClass[]"').length;
      var intLastCount = parseInt(lastCountOfSubclass.substr(-1));
      var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn businessActivityRemoveBtn float-right text-danger'}).click(function(){
          $(this).parent().parent().parent().remove();
          $('#reserveAddForm select[name="majorIndustry[]"]').each(function(index){
            $(this).siblings('label').text("Major Industry Classification No. " + (index+1));
          });
          $('#reserveAddForm select[name="subClass[]"]').each(function(index){
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
            var coop_type_val = $('#reserveAddForm #typeOfCooperative').val();
              $.ajax({
              type : "POST",
              url : $('body').attr('data-baseurl') + "api/industry_subclasses",
              dataType: "json",
              data : {
                coop_type: coop_type_val,
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
      var coop_type_val = $('#reserveAddForm #typeOfCooperative').val();
      $.ajax({
          type : "POST",
          url : $('body').attr('data-baseurl') + "api/major_industries", 
          dataType: "json",
          data : {
            coop_type: coop_type_val
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
              $("#reserveAddForm .col-industry-subclass").append(divInnerRow);
              $('#reserveAddForm select[name="majorIndustry[]"').each(function(index){
                $(this).siblings('label').text("Major Industry Classification No. " + (index+1));
              });
              $('#reserveAddForm select[name="subClass[]"').each(function(index){
                $(this).siblings('label').text("Major Industry Classification No. " + (index+1) + " Subclass ");
              });
          }
        });
    }else{
      $('#reserveAddForm #typeOfCooperative').focus();
    }
  });

  $('#reserveAddForm select[name="compositionOfMembers[]"').on('change', function(){

    if(($(this).val()).length>0)
      $("#reserveAddForm #addMoreComBtn").prop("disabled",false);
    else
      $("#reserveAddForm #addMoreComBtn").prop("disabled",true);

    if($(this).val()=="Others"){
      var compositionOfMembersSpecify = $('<div class="col-sm-12 col-md-6 col-composition-specify">' +
                '<div class="form-group"><label for="compositionOfMembersSpecify">Specify Others:</label>' +
                '<input type="text" class="form-control validate[required]" name="compositionOfMembersSpecify" id="compositionOfMembersSpecify">' +
                '</div></div>');
      $('#reserveAddForm .rd-row').append(compositionOfMembersSpecify);
    }else{
      $('#reserveAddForm .col-composition-specify').remove();
    }
  });

  $('#reserveAddForm #addMoreComBtn').on('click', function(){
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
    $("#reserveAddForm .col-com").append(divFormGroup);
  });
  
  $('#reserveAddForm #addMoreInsBtn').on('click', function(){
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
    $("#reserveAddForm .col-com").append(divFormGroup);
  });
  
  $('#reserveAddForm #addMoreAssocBtn').on('click', function(){
    var lastCountOfcom = $('#name_associational').last().attr('id');
    intLastCount = parseInt(lastCountOfcom.substr(-1));
    var divFormGroup= $('<div></div>').attr({'class':'form-group'});
    var selectComposition = $('<input>').attr({'class': 'custom-select form-control validate[required]','name': 'name_associational[]', 'id': 'name_associational' + (intLastCount + 1)}).prop("disabled",false);
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
    $("#reserveAddForm .col-com").append(divFormGroup);
  });
    
    $('#reserveAddForm #field_membership').hide();
    $('#reserveAddForm #name_institution_label').hide();
    $('#reserveAddForm #name_associational_label').hide();
    $('#reserveAddForm #name_institution').hide();
    $('#reserveAddForm #name_associational').hide();
    $('#reserveAddForm #addMoreInsBtn').hide();
    $('#reserveAddForm #fieldmembershipname').hide();
    $('#reserveAddForm #addMoreAssocBtn').hide();
    
    $('#reserveAddForm #commonBondOfMembership').on('change',function(){
        if($(this).val()=="Institutional"){
            $('#reserveAddForm select[name="compositionOfMembers[]"').hide();
            $('#reserveAddForm #fieldmembershipmemofficname').hide();
            $('#reserveAddForm #commonbondname').hide();
            $('#reserveAddForm #addMoreComBtn').hide();
            $('#reserveAddForm #name_associational_label').hide();
            $('#reserveAddForm #name_associational').hide();
            $('#reserveAddForm #addMoreAssocBtn').hide();
            $('#reserveAddForm #field_membership').show();
            $('#reserveAddForm #name_institution_label').show();
            $('#reserveAddForm #name_institution').show();
            $('#reserveAddForm #addMoreInsBtn').show();
            $('#reserveAddForm #fieldmembershipname').show();
            $('#reserveAddForm #name_associational').prop("required",false);
            $('#reserveAddForm #field_membership').prop("required",true);
            $('#reserveAddForm #name_institution').prop("required",true);
        } else if($(this).val()=="Associational"){
            $('#reserveAddForm select[name="compositionOfMembers[]"').hide();
            $('#reserveAddForm #addMoreComBtn').hide();
            $('#reserveAddForm #commonbondname').hide();
            $('#reserveAddForm #name_institution_label').hide();
            $('#reserveAddForm #name_institution').hide();
            $('#reserveAddForm #addMoreInsBtn').hide();
            $('#reserveAddForm #fieldmembershipname').hide();
            $('#reserveAddForm #name_associational_label').show();
            $('#reserveAddForm #name_associational').show();
            $('#reserveAddForm #addMoreAssocBtn').show();
            $('#reserveAddForm #field_membership').show();
            $('#reserveAddForm #fieldmembershipmemofficname').show();
            $('#reserveAddForm #name_institution').prop("required",false);
            $('#reserveAddForm #field_membership').prop("required",true);
            $('#reserveAddForm #name_associational').prop("required",true);
        } else if($(this).val()=="Residential"){
            $('#reserveAddForm #fieldmembershipmemofficname').hide();
            $('#reserveAddForm #field_membership').hide();
            $('#reserveAddForm #name_institution_label').hide();
            $('#reserveAddForm #name_associational_label').hide();
            $('#reserveAddForm #name_institution').hide();
            $('#reserveAddForm #name_associational').hide();
            $('#reserveAddForm #addMoreInsBtn').hide();
            $('#reserveAddForm #fieldmembershipname').hide();
            $('#reserveAddForm #addMoreAssocBtn').hide();
            $('#reserveAddForm select[name="compositionOfMembers[]"').hide();
            $('#reserveAddForm #commonbondname').hide();
            $('#reserveAddForm #addMoreComBtn').hide();
            $('#reserveAddForm #name_institution').prop("required",false);
            $('#reserveAddForm #field_membership').prop("required",false);
            $('#reserveAddForm #name_associational').prop("required",false);
        } else {
            $('#reserveAddForm #fieldmembershipmemofficname').hide();
            $('#reserveAddForm #field_membership').hide();
            $('#reserveAddForm #name_institution_label').hide();
            $('#reserveAddForm #name_associational_label').hide();
            $('#reserveAddForm #name_institution').hide();
            $('#reserveAddForm #name_associational').hide();
            $('#reserveAddForm #addMoreInsBtn').hide();
            $('#reserveAddForm #fieldmembershipname').hide();
            $('#reserveAddForm #addMoreAssocBtn').hide();
            $('#reserveAddForm #commonbondname').show();
            $('#reserveAddForm select[name="compositionOfMembers[]"').show();
            $('#reserveAddForm #addMoreComBtn').show();
            $('#reserveAddForm #name_institution').prop("required",false);
            $('#reserveAddForm #field_membership').prop("required",false);
            $('#reserveAddForm #name_associational').prop("required",false);
        }
    });
    
    // Jiee
    $('#reserveAddForm #interregional').hide();
    $('#reserveAddForm #regions').hide();
    $('#reserveAddForm #selectisland').hide();
    $('#reserveAddForm #selectregion').hide();

    $('#reserveAddForm #areaOfOperation').on('change',function(){
        $('#reserveAddForm #region').empty();
        $('#reserveAddForm #regions').empty();
        var areaOfOperation = $(this).val();
        if(areaOfOperation == "Interregional"){
        $('#reserveAddForm #allisland').show();
        $('#reserveAddForm #allregions').show();
            $('#reserveAddForm #region').empty();
            $('#reserveAddForm #interregional').show();
            $('#reserveAddForm #regions').show();
            $('#reserveAddForm #selectisland').show();
            $(".select-island").each(function(){
                $(this).select2({
                    template: "bootstrap",
                    multiple: true,
                    tagging: true,
                    allowClear: true,
                    placeholder: "Select island"
                });
            });
            $('#reserveAddForm #selectregion').show();
           $(".select-region").each(function(){
                            $(this).select2({
                                template: "bootstrap",
                                multiple: true,
                                tagging: true,
                                allowClear: true,
                                placeholder: "Select region"
                            });
                        });

            $('#reserveAddForm #interregional').on('change',function(){
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
                // if($(this).val().length != 2){
                  // alert($(this).val());
                  $('#reserveAddForm #regions').empty();
                  $('#reserveAddForm #province').empty();
                  $("#reserveAddForm #province").prop("disabled",true);
                  $('#reserveAddForm #city').empty();
                  $("#reserveAddForm #city").prop("disabled",true);
                  $('#reserveAddForm #barangay').empty();
                  $("#reserveAddForm #barangay").prop("disabled",true);
                  if($(this).val() && ($(this).val()).length > 0){
                    $("#reserveAddForm #province").prop("disabled",false);
                    var interregional = $(this).val();
                      $.ajax({
                      type : "POST",
                      url : $('body').attr('data-baseurl') + "api/islands",
                      dataType: "json",
                      data : {
                        interregional: interregional
                      },
                      success: function(data){
                        $('#reserveAddForm #regions').append($('<option></option>').attr('value',"").text(""));
                        $.each(data, function(key,value){
                          $('#reserveAddForm #regions').append($('<option></option>').attr('value',value.region_code).text(value.regDesc));
                        });
                         
                      }
                    });
                  }
                // } else {
                //     // $('#reserveAddForm #interregional').empty();
                //     // alert("Maximum of 2 Island.");
                //     $('.opt').each(function() {
                //         if(!this.selected) {
                //             $(this).attr('disabled', true);
                //         }
                //     });
                // }
            });

            $('#reserveAddForm #regions').on('change',function(){
              // alert($(this).val());
              $('#reserveAddForm #region').empty();
              $("#reserveAddForm #province").prop("disabled",true);
              $('#reserveAddForm #city').empty();
              $("#reserveAddForm #city").prop("disabled",true);
              $('#reserveAddForm #barangay').empty();
              $("#reserveAddForm #barangay").prop("disabled",true);
              if($(this).val() && ($(this).val()).length > 0){
                $("#reserveAddForm #province").prop("disabled",false);
                var regions = $(this).val();
                  $.ajax({
                  type : "POST",
                  url : $('body').attr('data-baseurl') + "api/regions",
                  dataType: "json",
                  data : {
                    regions: regions
                  },
                  success: function(data){
                    $('#reserveAddForm #region').append($('<option></option>').attr('value',"").text(""));
                    $.each(data, function(key,value){
                      $('#reserveAddForm #region').append($('<option></option>').attr('value',value.regCode).text(value.regDesc));
                    });
                  }
                });
              }
            });

        } else {
        $('#reserveAddForm #allisland').hide();
        $('#reserveAddForm #allregions').hide();
            $('#reserveAddForm #region').empty();
            $('#reserveAddForm #interregional').hide();
            $('#reserveAddForm #regions').hide();
            $('#reserveAddForm #selectisland').hide();
            $('#reserveAddForm #selectregion').hide();

            $.ajax({
                  type : "GET",
                  url : $('body').attr('data-baseurl') + "api/regions",
                  dataType: "json",
                  success: function(data){
                    $('#reserveAddForm #region').append($('<option></option>').attr('value',"").text(""));
                    $.each(data, function(key,value){
                      $('#reserveAddForm #region').append($('<option></option>').attr('value',value.regCode).text(value.regDesc));
                    });
              }
            });
        }
    });
  // End Jiee

    $('#reserveAddForm #region').on('change',function(){
      $('#reserveAddForm #province').empty();
      $("#reserveAddForm #province").prop("disabled",true);
      $('#reserveAddForm #city').empty();
      $("#reserveAddForm #city").prop("disabled",true);
      $('#reserveAddForm #barangay').empty();
      $("#reserveAddForm #barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#reserveAddForm #province").prop("disabled",false);
        var region = $(this).val();
          $.ajax({
          type : "POST",
          url : $('body').attr('data-baseurl') + "api/provinces",
          dataType: "json",
          data : {
            region: region
          },
          success: function(data){
            $('#reserveAddForm #province').append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $('#reserveAddForm #province').append($('<option></option>').attr('value',value.provCode).text(value.provDesc));
            });
          }
        });
      }
    });

    $('#reserveAddForm #province').on('change',function(){
      $('#reserveAddForm #city').empty();
      $("#reserveAddForm #city").prop("disabled",true);
      $('#reserveAddForm #barangay').empty();
      $("#reserveAddForm #barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#reserveAddForm #city").prop("disabled",false);
        var province = $(this).val();
          $.ajax({
          type : "POST",
          url : $('body').attr('data-baseurl') + "api/cities",
          dataType: "json",
          data : {
            province: province
          },
          success: function(data){
            $('#reserveAddForm #city').append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $('#reserveAddForm #city').append($('<option></option>').attr('value',value.citymunCode).text(value.citymunDesc));
            });
          }
        });
      }
    });

    $('#reserveAddForm #city').on('change',function(){
      $('#reserveAddForm #barangay').empty();
      $("#reserveAddForm #barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#reserveAddForm #barangay").prop("disabled",false);
        var cities = $(this).val();
          $.ajax({
          type : "POST",
          url : $('body').attr('data-baseurl') + "api/barangays",
          dataType: "json",
          data : {
            cities: cities
          },
          success: function(data){
            $('#reserveAddForm #barangay').append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $('#reserveAddForm #barangay').append($('<option></option>').attr('value',value.brgyCode).text(value.brgyDesc));
            });
          }
        });
      }
    });

  $("#reserveAddForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
          if(status==true){
            if($("#reserveAddLoadingBtn").length <= 0){
              $("#reserveAddForm #reserveAddBtn").hide();
              $("#reserveAddForm .col-reserve-btn").append($('<button></button>').attr({'id':'reserveAddLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
            }else{
              return false;
            }
          }else{
            return false;
          }
        }
  });
  $("#reserveAddForm #reserveAddAgree").click(function(){
    if($(this).is(':checked')){
      $('#reserveAddForm #reserveAddBtn').removeAttr('disabled');
    }else{
      $('#reserveAddForm #reserveAddBtn').attr('disabled','disabled');
    }
  });
  
});
