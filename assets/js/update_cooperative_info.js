$(function(){



	

  var id = $("#reserveUpdateForm #cooperativeID").val();

 

  $.ajax({

	    type : "POST",

	    url  : "get_cooperative_info",

	    dataType: "json",

	    data : {

	      id: id,

	     

	    },

	    success: function(data){ 

	     var business_activities = data.business_activities;

	    }

    }); 	





  	



	$('#reserveUpdateForm #categoryOfCooperative').on('change', function(){

        var categorycoop = $(this).val();

        	alert(categorycoop	);

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

	var coop_type =$('#reserveUpdateForm #typeOfCooperative').val();

		

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



		$('#reserveUpdateForm select[name="majorIndustry[]"').each(function(index){

			$(this).on('change',function(){ 

				$('#reserveUpdateForm #subClass'+(index+1)).empty();

				$('#reserveUpdateForm #subClass'+(index+1)).prop("disabled",true);

				if($(this).val() && ($(this).val()).length > 0){

					var subClassTemp =   $('#reserveUpdateForm #subClass'+(index+1));

					$(subClassTemp).prop("disabled",false);

					var major_industry = $(this).val();

					var coop_type = $('#reserveUpdateForm #typeOfCooperative').val();

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



	//TYPE OF COOP 

	$('#reserveUpdateForm #typeOfCooperative').on('change', function(){ 

	    var val = $("#reserveUpdateForm #typeOfCooperative option:selected").text();

	    $('#reserveUpdateForm #addMoreSubclassBtn').prop("disabled",true);

	    $("#reserveUpdateForm #proposedName").prop("disabled",true);

	    $('#reserveUpdateForm select[name="majorIndustry[]"').each(function(index){

	      $(this).empty();

	      $(this).prop("disabled",true);

	    });

	    $('#reserveUpdateForm select[name="subClass[]"').each(function(index){

	      $(this).empty();

	      $(this).prop("disabled",true);

	    });



	    

	    if($(this).val() && ($(this).val()).length > 0){

	      $("#reserveUpdateForm #addMoreSubclassBtn").prop("disabled",false);

	      document.getElementById("proposedName").maxLength = "61";



	      $('#reserveUpdateForm #proposedName').on('change',function(){

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

	      // if (value.length < totalval) {

	        // document.getElementById("acronymname").maxLength = totalval;

	      // }



	      $("#reserveUpdateForm #proposedName").prop("disabled",false);

	      var coop_type = $(this).val();

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

	    }

  	});

	//END TYPE OF COOP	

		//ADD MORE BUSINESS

		$('#reserveUpdateForm #addMoreSubclassBtn').on('click', function(){

		    if($('#reserveUpdateForm #typeOfCooperative').val() && ($('#reserveUpdateForm #typeOfCooperative').val()).length > 0){

		      var lastCountOfSubclass = $('select[name="subClass[]"').last().attr('id'); 

		      var totalCountOFSubclass = $('select[name="subClass[]"').length;

		      var intLastCount = parseInt(lastCountOfSubclass.substr(-1));

		      var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn businessActivityRemoveBtn float-right text-danger'}).click(function(){

		          $(this).parent().parent().parent().remove();

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

		            var coop_type_val = $('#reserveUpdateForm #typeOfCooperative').val();

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

      var coop_type_val = $('#reserveUpdateForm #typeOfCooperative').val();

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

      $('#reserveUpdateForm #typeOfCooperative').focus();

    }

  });



	  // LOAD SUBCLASS

	  // var tempCount =0;

	  // $('#reserveUpdateForm select[name="majorIndustry[]"').each(function(){

   //          if($(this).val() && ($(this).val()).length > 0){

   //            $(this).trigger('change');

   //            tempCount++;

   //          }

   //        });

   //        if(tempCount == $('#reserveUpdateForm select[name="majorIndustry[]"').length){

   //          $.ajax({

   //            type : "POST",

   //            url  : "../get_business_activities_of_coop",

   //            dataType: "json",

   //            data : {

   //              id: id

   //            },

   //            success: function(data){

   //              $('#reserveUpdateForm select[name="subClass[]"').each(function(index){

   //                var temp = $(this);

   //                setTimeout(function(){

   //                  $(temp).val(data[index].id);

   //                  $(temp).trigger('change');

   //                },800);

   //              });

   //            }

   //          });

   //        }



		//END ADD MORE BUSINESS

		//COMMON BOND OF MEMBERSHIP

		var comonbond = $("#reserveUpdateForm #commonBondOfMembership").val();

		

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

              $("#reserveUpdateForm .compositionRemoveBtn").hide();

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



	//ADDRCODE API

	$('#reserveUpdateForm #region').on('change',function(){

      $('#reserveUpdateForm #province').empty();

      $("#reserveUpdateForm #province").prop("disabled",false);

      $('#reserveUpdateForm #city').empty();

      $("#reserveUpdateForm #city").prop("disabled",false);

      $('#reserveUpdateForm #barangay').empty();

      $("#reserveUpdateForm #barangay").prop("disabled",false);

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

            $('#reserveUpdateForm #province').append($('<option></option>').attr('value',"").text(""));

            $.each(data, function(key,value){

              $('#reserveUpdateForm #province').append($('<option></option>').attr('value',value.provCode).text(value.provDesc));

            });

          }

        });

      }

    });



    $('#reserveUpdateForm #province').on('change',function(){

      $('#reserveUpdateForm #city').empty();

      $("#reserveUpdateForm #city").prop("disabled",false);

      $('#reserveUpdateForm #barangay').empty();

      $("#reserveUpdateForm #barangay").prop("disabled",false);

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

            $('#reserveUpdateForm #city').append($('<option></option>').attr('value',"").text(""));

            $.each(data, function(key,value){

              $('#reserveUpdateForm #city').append($('<option></option>').attr('value',value.citymunCode).text(value.citymunDesc));

            });

          }

        });

      }

    });



    $('#reserveUpdateForm #city').on('change',function(){

      $('#reserveUpdateForm #barangay').empty();

      $("#reserveUpdateForm #barangay").prop("disabled",false);

      if($(this).val() && ($(this).val()).length > 0){

        $("#reserveUpdateForm #barangay").prop("disabled",false);

        var cities = $(this).val();

          $.ajax({

          type : "POST",

          url : $('body').attr('data-baseurl') + "api/barangays",

          dataType: "json",

          data : {

            cities: cities

          },

          success: function(data){

            $('#reserveUpdateForm #barangay').append($('<option></option>').attr('value',"").text(""));

            $.each(data, function(key,value){

              $('#reserveUpdateForm #barangay').append($('<option></option>').attr('value',value.brgyCode).text(value.brgyDesc));

            });

          }

        });

      }

    });





	//END ADDRCODE API



    //INTERREGIONAL 

    $('#reserveUpdateForm #interregional').hide();

    $('#reserveUpdateForm #regions').hide();

    $('#reserveUpdateForm #selectisland').hide();

    $('#reserveUpdateForm #selectregion').hide();



    $('#reserveUpdateForm #areaOfOperation').on('change',function(){ 

        // $('#reserveUpdateForm #region').empty();

        $('#reserveUpdateForm #regions').empty();

        var areaOfOperation = $(this).val();

        if(areaOfOperation == "Interregional"){

        $('#reserveUpdateForm #allisland').show();

        $('#reserveUpdateForm #allregions').show();

            // $('#reserveUpdateForm #region').empty();

            $('#reserveUpdateForm #interregional').show();

            $('#reserveUpdateForm #regions').show();

            $('#reserveUpdateForm #selectisland').show();

            $(".select-island").each(function(){

                $(this).select2({

                    template: "bootstrap",

                    multiple: true,

                    tagging: true,

                    allowClear: true,

                    placeholder: "Select island"

                });

            });

            $('#reserveUpdateForm #selectregion').show();

           $(".select-region").each(function(){

                            $(this).select2({

                                template: "bootstrap",

                                multiple: true,

                                tagging: true,

                                allowClear: true,

                                placeholder: "Select region"

                            });

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

                // if($(this).val().length != 2){

                  // alert($(this).val());

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

                        $('#reserveUpdateForm #regions').append($('<option></option>').attr('value',"").text(""));

                        $.each(data, function(key,value){

                          $('#reserveUpdateForm #regions').append($('<option></option>').attr('value',value.region_code).text(value.regDesc));

                        });

                         

                      }

                    });

                  }

                // } else {

                //     // $('#reserveUpdateForm #interregional').empty();

                //     // alert("Maximum of 2 Island.");

                //     $('.opt').each(function() {

                //         if(!this.selected) {

                //             $(this).attr('disabled', true);

                //         }

                //     });

                // }

            });



            $('#reserveUpdateForm #regions').on('change',function(){

              // alert($(this).val());

              $('#reserveUpdateForm #region').empty();

              // $("#reserveUpdateForm #province").prop("disabled",true);

              $('#reserveUpdateForm #city').empty();

              // $("#reserveUpdateForm #city").prop("disabled",true);

              $('#reserveUpdateForm #barangay').empty();

              // $("#reserveUpdateForm #barangay").prop("disabled",true);

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



        } 

      else if(areaOfOperation == "National")

      { 

      $('#reserveUpdateForm #allisland').hide();

      $('#reserveUpdateForm #allregions').hide();

      $('#reserveUpdateForm #interregional').hide();

      $('#reserveUpdateForm #regions').hide();

      $('#reserveUpdateForm #selectisland').hide();

      $('#reserveUpdateForm #selectregion').hide();

      $("#reserveUpdateForm #region").prop("disabled",false);

      $("#reserveUpdateForm #province").prop("disabled",false);

      $("#reserveUpdateForm #city").prop("disabled",false);

      $("#reserveUpdateForm #barangay").prop("disabled",false);



       // $('#reserveUpdateForm #regions').on('change',function(){

              // alert($(this).val());

              $('#reserveUpdateForm #region').empty();

              // $("#reserveUpdateForm #province").prop("disabled",true);

              $('#reserveUpdateForm #city').empty();

              // $("#reserveUpdateForm #city").prop("disabled",true);

              $('#reserveUpdateForm #barangay').empty();

              // $("#reserveUpdateForm #barangay").prop("disabled",true);

              if($(this).val() && ($(this).val()).length > 0){

                $("#reserveUpdateForm #province").prop("disabled",false);

                var regions = $(this).val();

                  $.ajax({

                  type : "GET",

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

            // });



      }

      else if(areaOfOperation == "Regional")

      {

      $('#reserveUpdateForm #allisland').hide();

      $('#reserveUpdateForm #allregions').hide();

      $('#reserveUpdateForm #interregional').hide();

      $('#reserveUpdateForm #regions').hide();

      $('#reserveUpdateForm #selectisland').hide();

      $('#reserveUpdateForm #selectregion').hide();

      // $("#reserveUpdateForm #region").prop("disabled",true);

      $("#reserveUpdateForm #province").prop("disabled",false);

      $("#reserveUpdateForm #city").prop("disabled",false);

      $("#reserveUpdateForm #barangay").prop("disabled",false);

      }

      else if(areaOfOperation == "Provincial")

      {

      $('#reserveUpdateForm #allisland').hide();

      $('#reserveUpdateForm #allregions').hide();

      $('#reserveUpdateForm #interregional').hide();

      $('#reserveUpdateForm #regions').hide();

      $('#reserveUpdateForm #selectisland').hide();

      $('#reserveUpdateForm #selectregion').hide();

      // $("#reserveUpdateForm #province").prop("disabled",true);

      // $("#reserveUpdateForm #region").prop("disabled",true);

      $("#reserveUpdateForm #city").prop("disabled",false);

      $("#reserveUpdateForm #barangay").prop("disabled",false);

      }

      else if(areaOfOperation == "Municipality/City")

      {

      $('#reserveUpdateForm #allisland').hide();

      $('#reserveUpdateForm #allregions').hide();

      $('#reserveUpdateForm #interregional').hide();

      $('#reserveUpdateForm #regions').hide();

      $('#reserveUpdateForm #selectisland').hide();

      $('#reserveUpdateForm #selectregion').hide();

      // $("#reserveUpdateForm #province").prop("disabled",true);

      // $("#reserveUpdateForm #region").prop("disabled",true);

      // $("#reserveUpdateForm #city").prop("disabled",true);

      $("#reserveUpdateForm #barangay").prop("disabled",false);

      }

      else

      {

      $('#reserveUpdateForm #allisland').hide();

      $('#reserveUpdateForm #allregions').hide();

      $('#reserveUpdateForm #interregional').hide();

      $('#reserveUpdateForm #regions').hide();

      $('#reserveUpdateForm #selectisland').hide();

      $('#reserveUpdateForm #selectregion').hide();

      // $("#reserveUpdateForm #province").prop("disabled",true);

      // $("#reserveUpdateForm #region").prop("disabled",true);

      // $("#reserveUpdateForm #city").prop("disabled",true);

      $("#reserveUpdateForm #barangay").prop("disabled",false);

      }

    });



	

	

});