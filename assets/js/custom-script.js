$(function(){
  $('[data-toggle="tooltip"]').tooltip();
  /*
    STARTLIST OF DATA TABLES
  */
  $('#committeesTable').dataTable();
  $('#committeesTable2').dataTable();
  $('#cooperativesTable').DataTable();
  $('#cooperativesTable2').DataTable();
  $('#cooperatorsTable').DataTable();
  $('#cooperatorsTable2').DataTable();
  $('#staffTable').DataTable();
  $('#adminsTable').DataTable();
  /*
    END  LIST  OF DATA TABLE
  */
  $("#termsAndConditionModal .modal-custom-height").mCustomScrollbar({
      theme: "minimal-dark",
      setHeight: "450px",
      callbacks:{
        onTotalScroll:function(){
          $('#termsAndConditionModal #btnTermsClose').prop("disabled",false);
        },
        // onScroll: function(){
        //   $('#termsAndConditionModal #btnTermsClose').prop("disabled",true);
        // }
    }
  });
  //start sign up validation script
  $("#signUpForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      'custom_error_messages': {
        '#cPword' : {
            'equals': {
              'message': "* The specified passwords do not match"
            }
          }
        },
        onValidationComplete: function(form,status){
          if(status==true){
            if($("#signUpLoadingBtn").length <= 0){
              $("#signUpBtn").hide();
              $(".col-signup-btn").append($('<button></button>').attr({'id':'signUpLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
            }else{
              return false;
            }
          }else{
            return false;
          }
        }
  });
 
  $("#signUpAgree").click(function(event){
    // var check = $(this);
    //  event.preventDefault();
    // event.stopPropagation();
    // Swal({
    //   title: 'Terms and conditions',
    //   text: "This is the terms and conditions",
    //   type: 'info',
    //   showCancelButton: true,
    //   confirmButtonColor: '#3085d6',
    //   cancelButtonColor: '#d33',
    //   cancelButtonText: 'No, I dont agree',
    //   confirmButtonText: 'I agree with the terms and conditions'
    // }).then((result) => {
    //   if (result.value) {
    //     $('#signUpBtn').removeAttr('disabled');
    //     $(check).prop('checked','checked');
    //   }else{
    //     $('#signUpBtn').attr('disabled','disabled');
    //     $(check).prop('checked',false);
    //   }
    // });
    // if($(this).is(':checked')){
    //   $('#signUpBtn').removeAttr('disabled');
    // }else{
    //   $('#signUpBtn').attr('disabled','disabled');
    // }
  });
  $('#addCooperatorForm #validIdType').on('change',function(){
    if($(this).val() && ($(this).val()).length > 0){
      $('#addCooperatorForm #validIdNo').prop('disabled',false);
    }else{
      $('#addCooperatorForm #validIdNo').prop('disabled',true);
    }
  });

  //AMENDMENT
   $('#addCooperatorFormAmendment #validIdType').on('change',function(){
    if($(this).val() && ($(this).val()).length > 0){
      $('#addCooperatorFormAmendment #validIdNo').prop('disabled',false);
    }else{
      $('#addCooperatorFormAmendment #validIdNo').prop('disabled',true);
    }
  });
  //END AMENDMENT
  //end sign up validation

  /* START DELETE COOPERATIVE*/
  $('#deleteCooperativeModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var coop_name = button.data('cname');
    var coop_id = button.data('coopid');
    var modal = $(this)
    modal.find('.modal-body #cooperativeID').val(coop_id);
    modal.find
    ('.modal-body .cooperative-name-text').text(coop_name);
  });

   /* START DELETE COOPERATIVE*/
  $('#deleteAmendmentForm').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var coop_name = button.data('cname');
    var coop_id = button.data('coopid');
    var modal = $(this)
    modal.find('.modal-body #cooperativeID').val(coop_id);
    modal.find
    ('.modal-body .cooperative-name-text').text(coop_name);
  });
  


$("#deleteCooperativeForm").validationEngine('attach',
    {promptPosition: 'inline',
    scroll: false,
    focusFirstField : false,
    onValidationComplete: function(form,status){
        if(status == true){
          if($("#deleteCooperativeLoadingBtn").length <= 0){
            $("#deleteCooperativeForm #deleteCooperativeBtn").hide();
            $("#deleteCooperativeForm .col-delete-cooperative-btn").append($('<button></button>').attr({'id':'deleteCooperativeLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
            return true;
          }else{
            return false;
          }
        }else{
          return false;
        }
      }
});
/* END DELETE COOPERATIVE*/

//modify by jason
 $('#deleteLabModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var branch_name = button.data('cname');
    var branch_id = button.data('coopid');
    var modal = $(this)
    modal.find('.modal-body #branchID').val(branch_id);
    modal.find
    ('.modal-body .branch-name-text').text(branch_name);
  });
//end modify


//modify by json
/* START DELETE PDF*/
$('#deletePDFModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var full_name = button.data('fname');
  var fileName = full_name.substr(13,15);
  var cname = button.data('comname');
  var coop_id = button.data('coopid');
  var pdf_ID = button.data('pdfid');
  var doc_types = button.data('doctypess');
  var modal = $(this)
  modal.find('.modal-body #cooperativeID').val(coop_id);
  modal.find('.modal-body #pdfID').val(pdf_ID);
  modal.find('.modal-body #file_name').val(cname);
  modal.find('.modal-body .pdf-name-text').text(fileName);
  modal.find('.modal-body .pdf-cname-text').text(cname);
  modal.find('.modal-body #doc_type_').val(doc_types);
});
/* END DELETE PDF*/

// json
/* START DELETE PDF AMENDMENT*/
$('#deletePDFModal_amendment').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var full_name = button.data('fname');
  var fileName = full_name.substr(17,15);
  var cname = button.data('comname');
  var coop_id = button.data('amendmentid');
  var pdf_ID = button.data('pdfid');
  var doc_types = button.data('doctypess');
  var modal = $(this)
  modal.find('.modal-body #amendment_id').val(coop_id);
  modal.find('.modal-body #pdfID').val(pdf_ID);
  modal.find('.modal-body #file_name').val(cname);
  modal.find('.modal-body .pdf-name-text').text(fileName);
  modal.find('.modal-body .pdf-cname-text').text(cname);
  modal.find('.modal-body #doc_type_').val(doc_types);
});

/* END DELETE PDF*/

  /* START DELETE COOPERATIVE*/
  $('#deleteBranchModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var branch_name = button.data('cname');
    var branch_id = button.data('coopid');
    var modal = $(this)
    modal.find('.modal-body #branchID').val(branch_id);
    modal.find
    ('.modal-body .branch-name-text').text(branch_name);
  });


$("#deleteBranchForm").validationEngine('attach',
    {promptPosition: 'inline',
    scroll: false,
    focusFirstField : false,
    onValidationComplete: function(form,status){
        if(status == true){
          if($("#deleteBranchLoadingBtn").length <= 0){
            $("#deleteBranchForm #deleteBranchBtn").hide();
            $("#deleteBranchForm .col-delete-branch-btn").append($('<button></button>').attr({'id':'deleteBranchLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
            return true;
          }else{
            return false;
          }
        }else{
          return false;
        }
      }
});
/* END DELETE COOPERATIVE*/
/* START DELETE COOPERATOR*/
$('#deleteCooperatorModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var full_name = button.data('fname');
  var coop_id = button.data('coopid');
  var cooperatorid = button.data('cooperatorid');
  var modal = $(this);
  modal.find('.modal-body #cooperativeID').val(coop_id);
  modal.find('.modal-body #cooperatorID').val(cooperatorid);
  modal.find('.modal-body .cooperator-name-text').text(full_name);
});
$('#addAffiliatorModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var full_name = button.data('fname');
  var coop_id = button.data('coopid');
  var cooperatorid = button.data('cooperatorid');
  var application_id = button.data('application_id');
  var regno = button.data('regno');
  var regid = button.data('reg_id');
  var modal = $(this);
  modal.find('.modal-body #cooperativeID').val(coop_id);
//  modal.find('.modal-body #cooperatorID').val(cooperatorid);
  modal.find('.modal-body #application_id').val(application_id);
  modal.find('.modal-body #coopname').val(full_name);
  modal.find('.modal-body .cooperator-name-text').text(full_name);
  modal.find('.modal-body #regno').val(regno);
  modal.find('.modal-body #regid').val(regid);
});
$('#fullInfoRegisteredModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var full_name = button.data('fname');
  var placeissuance = button.data('placeissuance');
  var regno = button.data('regno');
  var business_activity = button.data('business_activity');
  var business_activity_sub = button.data('business_activity_sub');
  var common_bond_membership = button.data('common_bond_membership');
  var house_blk_no = button.data('house_blk_no');
  var street = button.data('street');
  var region = button.data('region');
  var city = button.data('city');
  var province = button.data('province');
  var brgy = button.data('brgy');
  var type = button.data('type');
  var modal = $(this);
  modal.find('.modal-body .fname').text(full_name);
  modal.find('.modal-body .place-issuance').text(placeissuance);
  modal.find('.modal-body .regno').text(regno);
  modal.find('.modal-body .business_activity').text(business_activity);
  modal.find('.modal-body .business_activity_sub').text(business_activity_sub);
  modal.find('.modal-body .common_bond_membership').text(common_bond_membership);
  modal.find('.modal-body .house_blk_no').text(house_blk_no);
  modal.find('.modal-body .street').text(street);
  modal.find('.modal-body .region').text(region);
  modal.find('.modal-body .city').text(city);
  modal.find('.modal-body .province').text(province);
  modal.find('.modal-body .brgy').text(brgy);
  modal.find('.modal-body .type').text(type);
});
$('#fullInfoCooperatorModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var full_name = button.data('fname');
  var placeissuance = button.data('placeissuance');
  var dateissued = button.data('dateissued');
  var proof = button.data('validid');
  var proofnumber = button.data('valididno');
  var paid = button.data('paid');
  var subscribed = button.data('subscribed');
  var membertype = button.data('membertype');
  var pos = button.data('pos');
  var paddress = button.data('paddress');
  var bdate = button.data('bdate');
  var gender = button.data('gender');
  var modal = $(this);
  modal.find('.modal-body .fname').text(full_name);
  modal.find('.modal-body .place-issuance').text(placeissuance);
  modal.find('.modal-body .date-issued').text(dateissued);
  modal.find('.modal-body .proof-identity').text(proof);
  modal.find('.modal-body .proof-identity-number').text(proofnumber);
  modal.find('.modal-body .paid').text(paid);
  modal.find('.modal-body .subscribed').text(subscribed);
  modal.find('.modal-body .type-of-member').text(membertype);
  modal.find('.modal-body .position').text(pos);
  modal.find('.modal-body .postal-address').text(paddress);
  modal.find('.modal-body .birth-date').text(bdate);
  modal.find('.modal-body .gender').text(gender);
});
$("#deleteCooperatorForm").validationEngine('attach',
  {promptPosition: 'inline',
  scroll: false,
  focusFirstField : false,
  onValidationComplete: function(form,status){
      if(status==true){
        if($("#deleteCooperatorLoadingBtn").length <= 0){
          $("#deleteCooperatorForm #deleteCooperatorBtn").hide();
          $("#deleteCooperatorForm .col-delete-cooperator-btn").append($('<button></button>').attr({'id':'deleteCooperatorLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
          return true;
        }else{
          return false;
        }
      }else{
        return false;
      }
    }
});
/* END DELETE COOPERATOR*/
/* START DELETE COMMITTEE*/
$('#deleteCommitteeModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var full_name = button.data('fname');
  var cname = button.data('comname');
  var coop_id = button.data('coopid');
  var committeeid = button.data('committeeid');
  var modal = $(this)
  modal.find('.modal-body #cooperativeID').val(coop_id);
  modal.find('.modal-body #committeeID').val(committeeid);
  modal.find('.modal-body .committee-name-text').text(full_name);
  modal.find('.modal-body .committee-cname-text').text(cname);
});
$("#deleteCommitteeForm").validationEngine('attach',
  {promptPosition: 'inline',
  scroll: false,
  focusFirstField : false,
  onValidationComplete: function(form,status){
      if(status==true){
        if($("#deleteCommitteeLoadingBtn").length <= 0){
          $("#deleteCommitteeForm #deleteCommitteeBtn").hide();
          $("#deleteCommitteeForm .col-delete-cooperator-btn").append($('<button></button>').attr({'id':'deleteCommitteeLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
          return true;
        }else{
          return false;
        }
      }else{
        return false;
      }
    }
});
/* END DELETE COMMITTEE*/
/* START DELETE STAFF*/
$('#deleteStaffModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var full_name = button.data('fname');
  var coop_id = button.data('coopid');
  var staffid = button.data('staffid');
  var modal = $(this)
  modal.find('.modal-body #cooperativeID').val(coop_id);
  modal.find('.modal-body #staffID').val(staffid);
  modal.find('.modal-body .staff-name-text').text(full_name);
});
$("#deleteStaffForm").validationEngine('attach',
  {promptPosition: 'inline',
  scroll: false,
  focusFirstField : false,
  onValidationComplete: function(form,status){
      if(status==true){
        if($("#deleteStaffLoadingBtn").length <= 0){
          $("#deleteStaffForm #deleteStaffBtn").hide();
          $("#deleteStaffForm .col-delete-cooperator-btn").append($('<button></button>').attr({'id':'deleteStaffLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
          return true;
        }else{
          return false;
        }
      }else{
        return false;
      }
    }
});
/* END DELETE STAFF*/

  /* start validation modal add cooperators */
  // $('#addCooperatorModal').on('hidden.bs.modal', function () {
  //   $('#addCooperatorForm')[0].reset();
  // });
  // $("#addCooperatorBtn").on('click',function(e){
  //   if(validateAddCooperatorAjax()){
  //     return true;
  //   }else{
  //     return false;
  //   }
  // });
  $("#addCooperatorForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
          if(status==true){
            if($("#addCooperatorLoadingBtn").length <= 0){
              $("#addCooperatorBtn").hide();
              $(".addCooperatorFooter").append($('<button></button>').attr({'id':'addCooperatorLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
          }else{
              return false;
            }
          }else{
            return false;
          }
        }
      });

  //Amendment
  $("#addCooperatorFormAmendment").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
          if(status==true){
            if($("#addCooperatorLoadingBtn").length <= 0){
              $("#addCooperatorBtn").hide();
              $(".addCooperatorFooter").append($('<button></button>').attr({'id':'addCooperatorLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
          }else{
              return false;
            }
          }else{
            return false;
          }
        }
      });
  //end amendment

      // $('#cooperatorsTable').DataTable({
      //     "ajax": {
      //       url: "cooperators/all",
      //       "type": "POST"
      //     },
      //     "deferRender": true,
      //     "columns": [
      //             { "data": "full_name" },
      //             { "data": "gender" },
      //             { "data": "birth_date" },
      //             { "data": "postal_address" },
      //             { "data": "position" },
      //             {
      //               "data": "null",
      //               "orderable": false,
      //               "render": function ( data, type, full, meta ) {
      //                      var cooperatorID = full.id;
      //                      var cooperatorFullName = full.full_name;
      //                      var cooperatorGender = full.gender;
      //                      var cooperatorBirthDate = full.birth_date;
      //                      var cooperatorPostalAddress = full.postal_address;
      //                      var cooperatorPosition = full.position;
      //                      return "<div class='btn-group' role='group' aria-label='Basic example'>" +
      //                      "<button class='btn btn-sm btn-warning btn-cooperator-edit text-white' data-id='"+cooperatorID+"'data-position='"+cooperatorPosition+"'data-postaladdress='"+cooperatorPostalAddress+"' data-bdate='"+cooperatorBirthDate+"' data-gender='"+cooperatorGender+"' data-fullname='" + cooperatorFullName +"' data-toggle='modal' data-target='#editCooperatorModal'><i class='fas fa-edit'></i></button>" +
      //                      "<button class='btn btn-sm btn-danger btn-cooperator-delete text-white' data-id='"+cooperatorID+"' data-toggle='modal' data-target='#deleteCooperatorModal'><i class='fas fa-trash'></i></button></div>";
      //                  }
      //             }
      //         ]
      //   });
        /*end cooperators table*/

        /*start edit cooperator modal*/
        // $('#editCooperatorModal').on('show.bs.modal', function (event) {
        //   var button = $(event.relatedTarget);
        //   var id = button.data('id');
        //   var fullName = button.data('fullname');
        //   var gender = button.data('gender');
        //   var bdate = button.data('bdate');
        //   var pAddress = button.data('postaladdress');
        //   var position = button.data('position');
        //
        //   var modal = $(this);
        //   modal.find('#cooperatorID').val(id);
        //   modal.find('#fName').val(fullName)
        //   modal.find('#position').val(position);
        //   modal.find('#bDate').val(bdate);
        //   modal.find('#pAddress').val(pAddress);
        //   modal.find('#gender').val(gender);
        // });
        /*end edit cooperator modal*/

        /*
        START EDIT COOPERATOR DETAILS VALIDATION
        */
        $("#editCooperatorForm").validationEngine('attach',
            {promptPosition: 'inline',
            scroll: false,
            focusFirstField : false,
            onValidationComplete: function(form,status){
              if(status==true){
                if($("#editCooperatorLoadingBtn").length <= 0){
                  $("#editCooperatorBtn").hide();
                  $(".editCooperatorFooter").append($('<button></button>').attr({'id':'editCooperatorLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
                  return true;
                }else{
                  return false;
                }
              }else{
                return false;
              }
            }
        });
        /*
        END EDIT COOPERATOR DETAILS VALIDATION
        */
              /*
              Start add committee form
              */
              $('#addCommitteeForm #committeeName').on('change', function(){
                if($(this).val()=="Others"){
                  var committeeNameSpecify = $('<div class="col-sm-12 col-md-4 col-committee-specify">' +
                            '<div class="form-group"><label for="committeeNameSpecify">Specify Others:</label>' +
                            '<input type="text" class="form-control validate[required,funcCall[validateOthersInCommitteeNameCustom],ajax[ajaxCommitteeNameCallPhp]]" name="committeeNameSpecify" id="committeeNameSpecify">' +
                            '</div></div>');
                  $('#addCommitteeForm .ac-row').append(committeeNameSpecify);
                }else{
                  $('#addCommitteeForm .col-committee-specify').remove();
                }
              });
              $('#addCommitteeForm #cooperatorID').on('change', function(){
                $("#addCommitteeForm .ac-info-row input,textarea").val("");
                if($(this).val() && $(this).val().length >0){
					       var cooperator_id = $(this).val() ;
					// alert(cooperator_ID);
                  $.ajax({
                      type : "POST",
                      url  : "../cooperators/get_post_cooperator_info",
                      dataType: "json",
                      data : {
                        cooperator_id: cooperator_id
                      },
                      success: function(data){
                        $('#addCommitteeForm #committeeName').prop('disabled',false);
                        $('#addCommitteeForm #position').val(data.position);
                        $('#addCommitteeForm #membershipType').val(data.type_of_member);
                        $('#addCommitteeForm #gender').val(data.gender);
                        $('#addCommitteeForm #bDate').val(data.birth_date);

                        if (data.position=='Vice-Chairperson'){
                          $('#addCommitteeForm #A').prop('disabled',true);
                          $('#addCommitteeForm #B').prop('disabled',false);
                          $('#addCommitteeForm #C').prop('disabled',false);
                        } else if(data.position=='Board of Director'){
                          $('#addCommitteeForm #A').prop('disabled',true);
                          $('#addCommitteeForm #B').prop('disabled',false);
                          $('#addCommitteeForm #C').prop('disabled',true);
                        } else if(data.position=='Member'){
                          $('#addCommitteeForm #A').prop('disabled',false);
                          $('#addCommitteeForm #B').prop('disabled',false);
                          $('#addCommitteeForm #C').prop('disabled',false);
                        } else {
                          $('#addCommitteeForm #A').prop('disabled',true);
                          $('#addCommitteeForm #B').prop('disabled',false);
                          $('#addCommitteeForm #C').prop('disabled',true);
                        }
                        var addr='';
                        if (data.house_blk_no=='' && data.streetName=='')
                          addr = data.brgy +', '+data.city+', '+data.province;
                        else
                          addr = data.house_blk_no+' '+data.streetName+', '+data.brgy+', '+data.city+', '+data.province;
                        
                        $('#addCommitteeForm #pAddress').val(addr);
                      }
                    });
                }
              });


              /*
              Start add committee form
              */
              $('#addCommitteeForm #committeeName').on('change', function(){
                if($(this).val()=="Others"){
                  var committeeNameSpecify = $('<div class="col-sm-12 col-md-4 col-committee-specify">' +
                            '<div class="form-group"><label for="committeeNameSpecify">Function and Responsibilities:</label>' +
                            // '<input type="text" class="form-control validate[required,funcCall[validateOthersInCommitteeNameCustom],ajax[ajaxCommitteeNameCallPhp]]" name="func_and_respons" id="committeeNameSpecify">' +
                             '<textarea class="form-control validate[required]" name="func_and_respons" id="func_and_respons" rows="5"></textarea>' +
                            '<input type="hidden" value="others" name="type">' +
                            '</div></div>');
                  $('#addCommitteeForm .ac-row').append(committeeNameSpecify);
                }else{
                  $('#addCommitteeForm .col-committee-specify').remove();
                }
              });
              $('#addCommitteeForm #cooperatorID').on('change', function(){
                $("#addCommitteeForm .ac-info-row input,textarea").val("");
                if($(this).val() && $(this).val().length >0){
                 var cooperator_id = $(this).val() ;
          // alert(cooperator_ID);
                  $.ajax({
                      type : "POST",
                      url  : "../cooperators/get_post_cooperator_info",
                      dataType: "json",
                      data : {
                        cooperator_id: cooperator_id
                      },
                      success: function(data){
                        $('#addCommitteeForm #committeeName').prop('disabled',false);
                        $('#addCommitteeForm #position').val(data.position);
                        $('#addCommitteeForm #membershipType').val(data.type_of_member);
                        $('#addCommitteeForm #gender').val(data.gender);
                        $('#addCommitteeForm #bDate').val(data.birth_date);

                        if (data.position=='Vice-Chairperson'){
                          $('#addCommitteeForm #A').prop('disabled',true);
                          $('#addCommitteeForm #B').prop('disabled',false);
                          $('#addCommitteeForm #C').prop('disabled',false);
                        } else if(data.position=='Board of Director'){
                          $('#addCommitteeForm #A').prop('disabled',true);
                          $('#addCommitteeForm #B').prop('disabled',false);
                          $('#addCommitteeForm #C').prop('disabled',true);
                        } else if(data.position=='Member'){
                          $('#addCommitteeForm #A').prop('disabled',false);
                          $('#addCommitteeForm #B').prop('disabled',false);
                          $('#addCommitteeForm #C').prop('disabled',false);
                        } else {
                          $('#addCommitteeForm #A').prop('disabled',true);
                          $('#addCommitteeForm #B').prop('disabled',false);
                          $('#addCommitteeForm #C').prop('disabled',true);
                        }
                        var addr='';
                        if (data.house_blk_no=='' && data.streetName=='')
                          addr = data.brgy +', '+data.city+', '+data.province;
                        else
                          addr = data.house_blk_no+' '+data.streetName+', '+data.brgy+', '+data.city+', '+data.province;
                        
                        $('#addCommitteeForm #pAddress').val(addr);
                      }
                    });
                }
              });

                /*
              Start add committee form amendment
              */
              $('#addCommitteeFormAmendment #committeeName').on('change', function(){
                if($(this).val()=="Others"){
                  var committeeNameSpecify = $('<div class="col-sm-12 col-md-4 col-committee-specify">' +
                            '<div class="form-group"><label for="committeeNameSpecify">Specify Others:</label>' +
                            '<input type="text" class="form-control validate[required,funcCall[validateOthersInCommitteeNameCustom],ajax[ajaxCommitteeNameCallPhpAmendment]]" name="committeeNameSpecify" id="committeeNameSpecify">' +
                            '</div></div>');
                  $('#addCommitteeFormAmendment .ac-row').append(committeeNameSpecify);
                }else{
                  $('#addCommitteeFormAmendment .col-committee-specify').remove();
                }
              });

              $('#addCommitteeFormAmendment #cooperator_ID').on('change', function(){
                $("#addCommitteeFormAmendment .ac-info-row input,textarea").val("");
                if($(this).val() && $(this).val().length >0){
                 var cooperator_id = $(this).val() ; 
          // alert(cooperator_ID);
                  var amd_id = $("#cooperativesID").val();
                  $.ajax({
                      type : "POST",
                     url  : "../amendment_cooperators/get_post_cooperator_info_ajax",
                      dataType: "json",
                      data : {
                        cooperator_id: cooperator_id,amd_ids:amd_id
                      },
                      success: function(data){
                        $('#addCommitteeFormAmendment #committeeName').prop('disabled',false);
                        $('#addCommitteeFormAmendment #position').val(data.position);
                        $('#addCommitteeFormAmendment #membershipType').val(data.type_of_member);
                        $('#addCommitteeFormAmendment #gender').val(data.gender);
                        $('#addCommitteeFormAmendment #bDate').val(data.birth_date);

                        if (data.position=='Vice-Chairperson'){
                          $('#addCommitteeFormAmendment #A').prop('disabled',true);
                          $('#addCommitteeFormAmendment #B').prop('disabled',false);
                          $('#addCommitteeFormAmendment #C').prop('disabled',false);
                        } else if(data.position=='Board of Director'){
                          $('#addCommitteeFormAmendment #A').prop('disabled',true);
                          $('#addCommitteeFormAmendment #B').prop('disabled',false);
                          $('#addCommitteeFormAmendment #C').prop('disabled',true);
                        } else if(data.position=='Member'){
                          $('#addCommitteeFormAmendment #A').prop('disabled',false);
                          $('#addCommitteeFormAmendment #B').prop('disabled',false);
                          $('#addCommitteeFormAmendment #C').prop('disabled',false);
                        } else {
                          $('#addCommitteeFormAmendment #A').prop('disabled',true);
                          $('#addCommitteeFormAmendment #B').prop('disabled',false);
                          $('#addCommitteeFormAmendment #C').prop('disabled',true);
                        }
                        var addr='';
                        if (data.house_blk_no=='' && data.streetName=='')
                          addr = data.brgy +', '+data.city+', '+data.province;
                        else
                          addr = data.house_blk_no+' '+data.streetName+', '+data.brgy+', '+data.city+', '+data.province;
                        
                        $('#addCommitteeFormAmendment #pAddress').val(addr);
                      }
                    });
                }
              });

              $("#addCommitteeFormAmendment").validationEngine('attach',
                  {promptPosition: 'inline',
                  scroll: false,
                  focusFirstField : false,
                  onValidationComplete: function(form,status){
                    if(status==true){
                      if($("#addCommitteeLoadingBtn").length <= 0){
                        $("#addCommitteeBtn").hide();
                        $(".addCommitteeFooter").append($('<button></button>').attr({'id':'addCommitteeLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
                        return true;
                      }else{
                        return false;
                      }
                    }else{
                      return false;
                    }
                  }
              });
              //end add amendment committee

              //json
              $('#addCommitteeForm #cooperator_ID').on('change', function(){
                $("#addCommitteeForm .ac-info-row input,textarea").val("");
                if($(this).val() && $(this).val().length >0){
                 var cooperator_id = $(this).val() ;
                var amd_id = $("#cooperativesID").val();
                // alert(cooperator_id);
                  $.ajax({
                      type : "POST",
                      url  : "../amendment_cooperators/get_post_cooperator_info_ajax",
                      dataType: "json",
                      data : {
                        cooperator_id: cooperator_id,amd_ids:amd_id
                      },
                      success: function(data){
                        console.log(data);
                        $('#addCommitteeForm #committeeName').prop('disabled',false);
                        $('#addCommitteeForm #position').val(data.position);
                        $('#addCommitteeForm #membershipType').val(data.type_of_member);
                        $('#addCommitteeForm #gender').val(data.gender);
                        $('#addCommitteeForm #bDate').val(data.birth_date);

                        if (data.position=='Vice-Chairperson'){
                          $('#addCommitteeForm #A').prop('disabled',true);
                          $('#addCommitteeForm #B').prop('disabled',false);
                          $('#addCommitteeForm #C').prop('disabled',false);
                        } else if(data.position=='Board of Director'){
                          $('#addCommitteeForm #A').prop('disabled',true);
                          $('#addCommitteeForm #B').prop('disabled',false);
                          $('#addCommitteeForm #C').prop('disabled',true);
                        } else if(data.position=='Member'){
                          $('#addCommitteeForm #A').prop('disabled',false);
                          $('#addCommitteeForm #B').prop('disabled',false);
                          $('#addCommitteeForm #C').prop('disabled',false);
                        } else {
                          $('#addCommitteeForm #A').prop('disabled',true);
                          $('#addCommitteeForm #B').prop('disabled',false);
                          $('#addCommitteeForm #C').prop('disabled',true);
                        }
                        var addr='';
                        
                        if (data.house_blk_no=='' && data.streetName=='')
                          addr = data.brgy +', '+data.city+', '+data.province;
                        else
                          addr = data.house_blk_no+' '+data.streetName+', '+data.brgy+', '+data.city+', '+data.province;
                        
                        $('#addCommitteeForm #pAddress').val(addr);
                      }
                    });
                }
              });
              //end json

              $("#addCommitteeForm").validationEngine('attach',
                  {promptPosition: 'inline',
                  scroll: false,
                  focusFirstField : false,
                  onValidationComplete: function(form,status){
                    if(status==true){
                      if($("#addCommitteeLoadingBtn").length <= 0){
                        $("#addCommitteeBtn").hide();
                        $(".addCommitteeFooter").append($('<button></button>').attr({'id':'addCommitteeLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
                        return true;
                      }else{
                        return false;
                      }
                    }else{
                      return false;
                    }
                  }
              });
              /*
              end add committee form
              */


              /*
              Start edit committee form
              */
              $('#editCommitteeForm #committeeName').on('change', function(){
                if($(this).val()=="Others"){
                  var committeeNameSpecify = $('<div class="col-sm-12 col-md-4 col-committee-specify">' +
                            '<div class="form-group"><label for="committeeNameSpecify">Specify Others:</label>' +
                            '<input type="text" class="form-control validate[required,funcCall[validateOthersInCommitteeNameCustom],ajax[ajaxCommitteeNameCallPhp]]" name="committeeNameSpecify" id="committeeNameSpecify">' +
                            '</div></div>');
                  $('#editCommitteeForm .ac-row').append(committeeNameSpecify);
                }else{
                  $('#editCommitteeForm .col-committee-specify').remove();
                }
              });
              // $('#editCommitteeForm #cooperatorID').on('change', function(){
              //   $("#editCommitteeForm .ac-info-row input,textarea").val("");
              //   if($(this).val() && $(this).val().length >0){
              //     $.ajax({
              //         type : "POST",
              //         url  : "../cooperators/get_post_cooperator_info",
              //         dataType: "json",
              //         data : {
              //           cooperator_id: $(this).val()
              //         },
              //         success: function(data){
              //           $('#editCommitteeForm #position').val(data.position);
              //           $('#editCommitteeForm #membershipType').val(data.type_of_member);
              //           $('#editCommitteeForm #gender').val(data.gender);
              //           $('#editCommitteeForm #bDate').val(data.birth_date);
              //           $('#editCommitteeForm #pAddress').val(data.postal_address);
              //         }
              //       });
              //   }
              // });
              $("#editCommitteeForm").validationEngine('attach',
                  {promptPosition: 'inline',
                  scroll: false,
                  focusFirstField : false,
                  onValidationComplete: function(form,status){
                    if(status==true){
                      if($("#editCommitteeLoadingBtn").length <= 0){
                        $("#editCommitteeBtn").hide();
                        $(".editCommitteeFooter").append($('<button></button>').attr({'id':'editCommitteeLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
                        return true;
                      }else{
                        return false;
                      }
                    }else{
                      return false;
                    }
                  }
              });
              /*
              end edit committee form
              */

              /*
              Start edit committee form amendment
              */
              $('#editCommitteeFormAmendment #committeeName').on('change', function(){
                if($(this).val()=="Others"){
                  var committeeNameSpecify = $('<div class="col-sm-12 col-md-4 col-committee-specify">' +
                            '<div class="form-group"><label for="committeeNameSpecify">Specify Others:</label>' +
                            '<input type="text" class="form-control validate[required,funcCall[validateOthersInCommitteeNameCustom],ajax[ajaxCommitteeNameCallPhp]]" name="committeeNameSpecify" id="committeeNameSpecify">' +
                            '</div></div>');
                  $('#editCommitteeFormAmendment .ac-row').append(committeeNameSpecify);
                }else{
                  $('#editCommitteeFormAmendment .col-committee-specify').remove();
                }
              });
              // $('#editCommitteeForm #committeeName').on('change', function(){
              //   $("#editCommitteeForm .ac-info-row input,textarea").val("");
              //   alert($(this).val());
              //   if($(this).val() && $(this).val().length >0){
              //     $.ajax({
              //         type : "POST",
              //         url  : "../cooperators/get_post_cooperator_info",
              //         dataType: "json",
              //         data : {
              //           cooperator_id: $(this).val()
              //         },
              //         success: function(data){
              //           $('#editCommitteeForm #position').val(data.position);
              //           $('#editCommitteeForm #membershipType').val(data.type_of_member);
              //           $('#editCommitteeForm #gender').val(data.gender);
              //           $('#editCommitteeForm #bDate').val(data.birth_date);
              //           $('#editCommitteeForm #pAddress').val(data.postal_address);
              //         }
              //       });
              //   }
              // });
              $("#editCommitteeFormAmendment").validationEngine('attach',
                  {promptPosition: 'inline',
                  scroll: false,
                  focusFirstField : false,
                  onValidationComplete: function(form,status){
                    if(status==true){
                      if($("#editCommitteeLoadingBtn").length <= 0){
                        $("#editCommitteeBtn").hide();
                        $(".editCommitteeFooter").append($('<button></button>').attr({'id':'editCommitteeLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
                        return true;
                      }else{
                        return false;
                      }
                    }else{
                      return false;
                    }
                  }
              });
              /*
              end edit committee form
              */


  /* START PRIMARY BYLAWS FORM*/
    $('#bylawsPrimaryForm #kindsOfMember').on('change', function(){
      if($(this).val()==2){
        $('#bylawsPrimaryForm #colAssociateSubscription').show();
        $('#bylawsPrimaryForm #associateMembershipPercentageSubscription').addClass('validate[required,min[1],custom[integer]]');
        $('#bylawsPrimaryForm #associateMembershipPercentagePay').addClass('validate[required,min[1,custom[integer],funcCall[validateMinimumPaidAssociatePrimaryCustom]]');
        $('#bylawsPrimaryForm #associateMembershipPercentageSubscription').prop('disabled', false);
        $('#bylawsPrimaryForm #associateMembershipPercentagePay').prop('disabled', false);
        $('#bylawsPrimaryForm .row-assoc').show();
        $('#bylawsPrimaryForm .row-assoc input[name="associateQualifications[]"]').prop('disabled', false);
      }else{
        $('#bylawsPrimaryForm #colAssociateSubscription').hide();
        $('#bylawsPrimaryForm #associateMembershipPercentageSubscription').removeClass('validate[required,min[1],custom[integer]]');
        $('#bylawsPrimaryForm #associateMembershipPercentagePay').removeClass('validate[required,min[1],custom[integer],funcCall[validateMinimumPaidAssociatePrimaryCustom]]');
        $('#bylawsPrimaryForm #associateMembershipPercentageSubscription').prop('disabled', true);
        $('#bylawsPrimaryForm #associateMembershipPercentagePay').prop('disabled', true);
        $('#bylawsPrimaryForm .row-assoc').hide();
        $('#bylawsPrimaryForm .row-assoc input[name="associateQualifications[]"]').prop('disabled', true);
      }
    });

    // October 15, 2019
        // Union JS
            $('#bylawsUnionForm #addMoreRequirementsBtn').on('click', function(){
                var lastCountOfadditionalRequirementsForMembership = $('input[name="additionalRequirementsForMembership[]"').last().attr('id');
                var intLastCount = parseInt(lastCountOfadditionalRequirementsForMembership.substr(-1));
                var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn regularQualificationRemoveBtn float-right text-danger'}).click(function(){

                  $(this).parent().parent().remove();
                  $('#bylawsUnionForm input[name="additionalRequirementsForMembership[]"').each(function(index){
                    $(this).siblings('label').text("Requirements for Membership " + (index+4));
                  });
                });
                var labeladditionalRequirementsForMembership = $('<label></label>').attr({'for': 'additionalRequirementsForMembership'+(intLastCount + 1)}).text('Regular member qualification ' + (intLastCount + 1));
                var inputadditionalRequirementsForMembership = $('<input></input>').attr({'type':'text','class': 'form-control','placeholder':'Must be in a sentence','name': 'additionalRequirementsForMembership[]', 'id': 'additionalRequirementsForMembership' + (intLastCount + 1)});
                var divFormGroupadditionalRequirementsForMembership = $('<div></div>').attr({'class':'form-group'});
                var divColadditionalRequirementsForMembership = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
                $(divFormGroupadditionalRequirementsForMembership).append(deleteSpan,labeladditionalRequirementsForMembership,inputadditionalRequirementsForMembership);
                $(divColadditionalRequirementsForMembership).append(divFormGroupadditionalRequirementsForMembership);
                $('.additionalRequirementsForMembership').append(divColadditionalRequirementsForMembership);
                $('#bylawsUnionForm input[name="additionalRequirementsForMembership[]"').each(function(index){
                  $(this).siblings('label').text("Requirements for Membership " + (index+4));
                });
            });
            
            $('#bylawsUnionForm #addMoredelegatePowersBtn').on('click', function(){
                var lastCountOfadditionalRequirementsForMembership = $('input[name="additionaldelegatePowers[]"').last().attr('id');
                var intLastCount = parseInt(lastCountOfadditionalRequirementsForMembership.substr(-1));
                var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn regularQualificationRemoveBtn float-right text-danger'}).click(function(){
                  $(this).parent().parent().remove();
                  $('#bylawsUnionForm input[name="additionaldelegatePowers[]"').each(function(index){
                    $(this).siblings('label').text("General Assembly " + (index));
                  });
                });
                var labeladditionalRequirementsForMembership = $('<label></label>').attr({'for': 'additionaldelegatePowers'+(intLastCount + 1)}).text('Regular member qualification ' + (intLastCount + 1));
                var inputadditionalRequirementsForMembership = $('<input></input>').attr({'type':'text','class': 'form-control','placeholder':'Must be in a sentence','name': 'additionaldelegatePowers[]', 'id': 'additionaldelegatePowers' + (intLastCount + 1)});
                var divFormGroupadditionalRequirementsForMembership = $('<div></div>').attr({'class':'form-group'});
                var divColadditionalRequirementsForMembership = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
                $(divFormGroupadditionalRequirementsForMembership).append(deleteSpan,labeladditionalRequirementsForMembership,inputadditionalRequirementsForMembership);
                $(divColadditionalRequirementsForMembership).append(divFormGroupadditionalRequirementsForMembership);
                $('.delegatePowers').append(divColadditionalRequirementsForMembership);
                $('#bylawsUnionForm input[name="additionaldelegatePowers[]"').each(function(index){
                  $(this).siblings('label').text("General Assembly " + (index));
                });
            });
            
            $('#bylawsUnionForm #addMoreprimaryConsiderationBtn').on('click', function(){
                var lastCountOfadditionalRequirementsForMembership = $('input[name="primaryConsideration[]"').last().attr('id');
                var intLastCount = parseInt(lastCountOfadditionalRequirementsForMembership.substr(-1));
                var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn regularQualificationRemoveBtn float-right text-danger'}).click(function(){
                  $(this).parent().parent().remove();
                  $('#bylawsUnionForm input[name="primaryConsideration[]"').each(function(index){
                    $(this).siblings('label').text("Primary Consideration " + (index));
                  });
                });
                var labeladditionalRequirementsForMembership = $('<label></label>').attr({'for': 'primaryConsideration'+(intLastCount + 1)}).text('Regular member qualification ' + (intLastCount + 1));
                var inputadditionalRequirementsForMembership = $('<input></input>').attr({'type':'text','class': 'form-control','placeholder':'Must be in a sentence','name': 'primaryConsideration[]', 'id': 'primaryConsideration' + (intLastCount + 1)});
                var divFormGroupadditionalRequirementsForMembership = $('<div></div>').attr({'class':'form-group'});
                var divColadditionalRequirementsForMembership = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
                $(divFormGroupadditionalRequirementsForMembership).append(deleteSpan,labeladditionalRequirementsForMembership,inputadditionalRequirementsForMembership);
                $(divColadditionalRequirementsForMembership).append(divFormGroupadditionalRequirementsForMembership);
                $('.primaryConsideration').append(divColadditionalRequirementsForMembership);
                $('#bylawsUnionForm input[name="primaryConsideration[]"').each(function(index){
                  $(this).siblings('label').text("Primary Consideration " + (index));
                });
            });
        // END Union JS
        
    $('#bylawsPrimaryForm #addMoredelegatePowersBtn').on('click', function(){
      var lastCountOfadditionalRequirementsForMembership = $('input[name="additionaldelegatePowers[]"').last().attr('id');
      var intLastCount = parseInt(lastCountOfadditionalRequirementsForMembership.substr(-1));
      var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn regularQualificationRemoveBtn float-right text-danger'}).click(function(){
        $(this).parent().parent().remove();
        $('#bylawsPrimaryForm input[name="additionaldelegatePowers[]"').each(function(index){
          $(this).siblings('label').text("General Assembly " + (index+1));
        });
      });
      var labeladditionalRequirementsForMembership = $('<label></label>').attr({'for': 'additionaldelegatePowers'+(intLastCount + 1)}).text('Regular member qualification ' + (intLastCount + 1));
      var inputadditionalRequirementsForMembership = $('<input></input>').attr({'type':'text','class': 'form-control','placeholder':'Must be in a sentence','name': 'additionaldelegatePowers[]', 'id': 'additionaldelegatePowers' + (intLastCount + 1)});
      var divFormGroupadditionalRequirementsForMembership = $('<div></div>').attr({'class':'form-group'});
      var divColadditionalRequirementsForMembership = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
      $(divFormGroupadditionalRequirementsForMembership).append(deleteSpan,labeladditionalRequirementsForMembership,inputadditionalRequirementsForMembership);
      $(divColadditionalRequirementsForMembership).append(divFormGroupadditionalRequirementsForMembership);
      $('.additionaldelegatePowers').append(divColadditionalRequirementsForMembership);
      $('#bylawsPrimaryForm input[name="additionaldelegatePowers[]"').each(function(index){
        $(this).siblings('label').text("General Assembly " + (index+1));
      });
    });
    
    $('#bylawsPrimaryForm #addMorePrimaryConsiderationBtn').on('click', function(){
      var lastCountOfadditionalRequirementsForMembership = $('input[name="additionalPrimaryConsideration[]"').last().attr('id');
      var intLastCount = parseInt(lastCountOfadditionalRequirementsForMembership.substr(-1));
      var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn regularQualificationRemoveBtn float-right text-danger'}).click(function(){
        $(this).parent().parent().remove();
        $('#bylawsPrimaryForm input[name="additionalPrimaryConsideration[]"').each(function(index){
          $(this).siblings('label').text("a. " + (index+1));
        });
      });
      var labeladditionalRequirementsForMembership = $('<label></label>').attr({'for': 'additionalPrimaryConsideration'+(intLastCount + 1)}).text('Regular member qualification ' + (intLastCount + 1));
      var inputadditionalRequirementsForMembership = $('<input></input>').attr({'type':'text','class': 'form-control','placeholder':'Must be in a sentence','name': 'additionalPrimaryConsideration[]', 'id': 'additionalPrimaryConsideration' + (intLastCount + 1)});
      var divFormGroupadditionalRequirementsForMembership = $('<div></div>').attr({'class':'form-group'});
      var divColadditionalRequirementsForMembership = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
      $(divFormGroupadditionalRequirementsForMembership).append(deleteSpan,labeladditionalRequirementsForMembership,inputadditionalRequirementsForMembership);
      $(divColadditionalRequirementsForMembership).append(divFormGroupadditionalRequirementsForMembership);
      $('.additionalPrimaryConsideration').append(divColadditionalRequirementsForMembership);
      $('#bylawsPrimaryForm input[name="additionalPrimaryConsideration[]"').each(function(index){
        $(this).siblings('label').text("a. " + (index+1));
      });
    });
            
    $('#bylawsPrimaryForm #addMoreRequirementsBtn').on('click', function(){
      var lastCountOfadditionalRequirementsForMembership = $('input[name="additionalRequirementsForMembership[]"').last().attr('id');
      var intLastCount = parseInt(lastCountOfadditionalRequirementsForMembership.substr(-1));
      var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn regularQualificationRemoveBtn float-right text-danger'}).click(function(){
        $(this).parent().parent().remove();
        $('#bylawsPrimaryForm input[name="additionalRequirementsForMembership[]"').each(function(index){
          $(this).siblings('label').text("Regular member qualification " + (index+4));
        });
      });
      var labeladditionalRequirementsForMembership = $('<label></label>').attr({'for': 'additionalRequirementsForMembership'+(intLastCount + 1)}).text('Regular member qualification ' + (intLastCount + 1));
      var inputadditionalRequirementsForMembership = $('<input></input>').attr({'type':'text','class': 'form-control','placeholder':'Must be in a sentence','name': 'additionalRequirementsForMembership[]', 'id': 'additionalRequirementsForMembership' + (intLastCount + 1)});
      var divFormGroupadditionalRequirementsForMembership = $('<div></div>').attr({'class':'form-group'});
      var divColadditionalRequirementsForMembership = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
      $(divFormGroupadditionalRequirementsForMembership).append(deleteSpan,labeladditionalRequirementsForMembership,inputadditionalRequirementsForMembership);
      $(divColadditionalRequirementsForMembership).append(divFormGroupadditionalRequirementsForMembership);
      $('.additionalRequirementsForMembership').append(divColadditionalRequirementsForMembership);
      $('#bylawsPrimaryForm input[name="additionalRequirementsForMembership[]"').each(function(index){
        $(this).siblings('label').text("Requirements for Membership " + (index+4));
      });
    });

    $('#bylawsPrimaryForm #addMoreMembersEntitledtoVoteBtn').on('click', function(){
      var lastCountOfadditionalConditionsForVoting = $('input[name="additionalConditionsForVoting[]"').last().attr('id');
      var intLastCount = parseInt(lastCountOfadditionalConditionsForVoting.substr(-1));
      var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn regularQualificationRemoveBtn float-right text-danger'}).click(function(){
        $(this).parent().parent().remove();
        $('#bylawsPrimaryForm input[name="additionalConditionsForVoting[]"').each(function(index){
          $(this).siblings('label').text("Members Entitled to Vote " + (index+5));
        });
      });
      var labeladditionalConditionsForVoting = $('<label></label>').attr({'for': 'additionalConditionsForVoting'+(intLastCount + 1)}).text('Regular member qualification ' + (intLastCount + 1));
      var inputadditionalConditionsForVoting = $('<input></input>').attr({'type':'text','class': 'form-control','placeholder':'Must be in a sentence','name': 'additionalConditionsForVoting[]', 'id': 'additionalConditionsForVoting' + (intLastCount + 1)});
      var divFormGroupadditionalConditionsForVoting = $('<div></div>').attr({'class':'form-group'});
      var divColadditionalConditionsForVoting = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
      $(divFormGroupadditionalConditionsForVoting).append(deleteSpan,labeladditionalConditionsForVoting,inputadditionalConditionsForVoting);
      $(divColadditionalConditionsForVoting).append(divFormGroupadditionalConditionsForVoting);
      $('.additionalConditionsForVoting').append(divColadditionalConditionsForVoting);
      $('#bylawsPrimaryForm input[name="additionalConditionsForVoting[]"').each(function(index){
        $(this).siblings('label').text("Members Entitled to Vote " + (index+5));
      });
    });
    // - End

  $('#bylawsPrimaryForm #addMoreQualificationsRegularBtn').on('click', function(){
    var lastCountOfRegularQualifications = $('input[name="regularQualifications[]"').last().attr('id');
    var intLastCount = parseInt(lastCountOfRegularQualifications.substr(-1));
    var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn regularQualificationRemoveBtn float-right text-danger'}).click(function(){
      $(this).parent().parent().remove();
      $('#bylawsPrimaryForm input[name="regularQualifications[]"').each(function(index){
        $(this).siblings('label').text("Regular member qualification " + (index+1));
      });
    });
    var labelRegularQualifications = $('<label></label>').attr({'for': 'regularQualifications'+(intLastCount + 1)}).text('Regular member qualification ' + (intLastCount + 1));
    var inputRegularQualifications = $('<input></input>').attr({'type':'text','class': 'form-control validate[required]','placeholder':'Must be in a sentence','name': 'regularQualifications[]', 'id': 'regularQualifications' + (intLastCount + 1)});
    var divFormGroupRegularQualifications = $('<div></div>').attr({'class':'form-group'});
    var divColRegularQualifications = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
    $(divFormGroupRegularQualifications).append(deleteSpan,labelRegularQualifications,inputRegularQualifications);
    $(divColRegularQualifications).append(divFormGroupRegularQualifications);
    $('.row-regular-qualifications').append(divColRegularQualifications);
    $('#bylawsPrimaryForm input[name="regularQualifications[]"').each(function(index){
      $(this).siblings('label').text("Regular member qualification " + (index+1));
    });
  });
  $('#bylawsPrimaryForm #addMoreQualificationsAssociateBtn').on('click', function(){
    var lastCountOfAssociateQualifications = $('input[name="associateQualifications[]"').last().attr('id');
    var intLastCount = parseInt(lastCountOfAssociateQualifications.substr(-1));
    var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn associateQualificationRemoveBtn float-right text-danger'}).click(function(){
      $(this).parent().parent().remove();
      $('#bylawsPrimaryForm input[name="associateQualifications[]"').each(function(index){
        $(this).siblings('label').text("Associate member qualification " + (index+1));
      });
    });
    var labelAssociateQualifications = $('<label></label>').attr({'for': 'associateQualifications'+(intLastCount + 1)}).text('Associate member qualification ' + (intLastCount + 1));
    var inputAssociateQualifications = $('<input></input>').attr({'type':'text','class': 'form-control validate[required]','placeholder':'Must be in a sentence','name': 'associateQualifications[]', 'id': 'associateQualifications' + (intLastCount + 1)});
    var divFormGroupAssociateQualifications = $('<div></div>').attr({'class':'form-group'});
    var divColAssociateQualifications = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
    $(divFormGroupAssociateQualifications).append(deleteSpan,labelAssociateQualifications,inputAssociateQualifications);
    $(divColAssociateQualifications).append(divFormGroupAssociateQualifications);
    $('.row-associate-qualifications').append(divColAssociateQualifications);
    $('#bylawsPrimaryForm input[name="associateQualifications[]"').each(function(index){
      $(this).siblings('label').text("Associate member qualification " + (index+1));
    });
  });
  $("#bylawsPrimaryForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
        if(status==true){
          if($("#bylawsPrimaryLoadingBtn").length <= 0){
            $("#bylawsPrimaryBtn").hide();
            $("#bylawsPrimaryCancelBtn").prop('disabled',true);
            $(".bylawsPrimaryFooter").append($('<button></button>').attr({'id':'bylawsPrimaryLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
            return true;
          }else{
            return false;
          }
        }else{
          return false;
        }
      }
  });
  $('#btnEditBylawsPrimary').on('click', function(){
    $(this).hide();
    var btnGroup = $('<div></div>').attr({'id':'bylawsPrimaryCancelBtn','class':'btn-group','role':'group','aria-label':'Basic-example'});
    var btnCancel = $('<a></a>').attr({'class':'btn btn-secondary btn-sm float-right text-white','role':'button'}).html("<i class='fas fa-times'></i> Cancel").click(function(){
      location.reload();
    });
    $('.col-btn-action-bylaws-primary').append(btnCancel);
    $(".bylawsPrimaryFooter").show();
    $("#bylawsPrimaryForm select,input,textarea,button").prop('disabled', false);
  });
  /* END PRIMARY BYLAWS FORM*/
  /* START PRIMARY ARTICLES FORM*/
  $("#articlesPrimaryForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
        if(status==true){
          if($("#articlesPrimaryLoadingBtn").length <= 0){
            $("#articlesPrimaryBtn").hide();
            $("#articlesPrimaryCancelBtn").prop('disabled',true);
            $(".articlesPrimaryFooter").append($('<button></button>').attr({'id':'articlesPrimaryLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
            return true;
          }else{
            return false;
          }
        }else{
          return false;
        }
      }
  });
  $('#btnEditArticlesPrimary').on('click', function(){
    $(this).hide();
    var btnGroup = $('<div></div>').attr({'id':'articlesPrimaryCancelBtn','class':'btn-group','role':'group','aria-label':'Basic-example'});
    var btnCancel = $('<a></a>').attr({'class':'btn btn-secondary btn-sm float-right text-white','role':'button'}).html("<i class='fas fa-times'></i> Cancel").click(function(){
      location.reload();
    });
    $('.col-btn-action-articles-primary').append(btnCancel);
    $(".articlesPrimaryFooter").show();
    $("#articlesPrimaryForm select,input,textarea").prop('disabled', false);
  });
/* END PRIMARY ARTICLES FORM*/

/* START ECONOMIC SURVEY FORM*/
  $("#economicSurveyForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
        if(status==true){
          if($("#economicSurveyLoadingBtn").length <= 0){
            $("#economicSurveyBtn").hide();
            $("#economicSurveyCancelBtn").prop('disabled',true);
            $(".economicSurveyFooter").append($('<button></button>').attr({'id':'economicSurveyLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
            return true;
          }else{
            return false;
          }
        }else{
          return false;
        }
      }
  });
  $('#btnEditEconomicSurvey').on('click', function(){
    $(this).hide();
    var btnGroup = $('<div></div>').attr({'id':'economicSurveyCancelBtn','class':'btn-group','role':'group','aria-label':'Basic-example'});
    var btnCancel = $('<a></a>').attr({'class':'btn btn-secondary btn-sm float-right text-white','role':'button'}).html("<i class='fas fa-times'></i> Cancel").click(function(){
      location.reload();
    });
    $('.col-btn-action-survey-primary').append(btnCancel);
    $(".economicSurveyFooter").show();
    $("#economicSurveyForm select,input,textarea").prop('disabled', false);
  });

  $('#economicSurveyForm #registeredOthers').on('click', function(){
    var registeredOthersSpecify = $('<div class="col-sm-12 col-md-12 col-registered-specify">' +
              '<div class="form-group"><label for="registeredOthersSpecify">Specify Others:</label>' +
              '<input type="text" class="form-control validate[required]" name="registeredOthersSpecify" id="registeredOthersSpecify">' +
              '</div></div>');
    if($(this).is(":checked")){
      $('#economicSurveyForm .row-pre-reg').append(registeredOthersSpecify);
    }else if($(this).is(":not(:checked)")){
      $('#economicSurveyForm .col-registered-specify').remove();
    }
  });

  $('#economicSurveyForm #strategiesSupportOthers').on('click', function(){
    var strategiesSupportOthersSpecify = $('<div class="col-sm-12 col-md-12 col-strategies-specify">' +
              '<div class="form-group"><label for="strategiesSupportOthersSpecify">Specify others strategies:</label>' +
              '<input type="text" class="form-control validate[required]" name="strategiesSupportOthersSpecify" id="strategiesSupportOthersSpecify">' +
              '</div></div>');
    if($(this).is(":checked")){
      $('#economicSurveyForm .row-strat').append(strategiesSupportOthersSpecify);
    }else if($(this).is(":not(:checked)")){
      $('#economicSurveyForm .col-strategies-specify').remove();
    }
  });
  $('#economicSurveyForm #investOthers').on('click', function(){
    var investOthersSpecify = $('<div class="col-sm-12 col-md-12 col-investments-specify">' +
              '<div class="form-group"><label for="investOthersSpecify">Specify other investments:</label>' +
              '<input type="text" class="form-control validate[required]" name="investOthersSpecify" id="investOthersSpecify">' +
              '</div></div>');
    if($(this).is(":checked")){
      $('#economicSurveyForm .row-investments').append(investOthersSpecify);
    }else if($(this).is(":not(:checked)")){
      $('#economicSurveyForm .col-investments-specify').remove();
    }
  });
  $('#economicSurveyForm #equipmentOthers').on('click', function(){
    var equipmentOthersSpecify = $('<div class="col-sm-12 col-md-12 col-equipments-specify">' +
              '<div class="form-group"><label for="equipmentOthersSpecify">Specify other equipments:</label>' +
              '<input type="text" class="form-control validate[required]" name="equipmentOthersSpecify" id="equipmentOthersSpecify">' +
              '</div></div>');
    if($(this).is(":checked")){
      $('#economicSurveyForm .row-equipments').append(equipmentOthersSpecify);
    }else if($(this).is(":not(:checked)")){
      $('#economicSurveyForm .col-equipments-specify').remove();
    }
  });
  $('#economicSurveyForm #procureEquipmentOthers').on('click', function(){
    var procureEquipmentOthersSpecify = $('<div class="col-sm-12 col-md-12 col-procurements-specify">' +
              '<div class="form-group"><label for="procureEquipmentOthersSpecify">Specify other mode/s:</label>' +
              '<input type="text" class="form-control validate[required]" name="procureEquipmentOthersSpecify" id="procureEquipmentOthersSpecify">' +
              '</div></div>');
    if($(this).is(":checked")){
      $('#economicSurveyForm .row-procurements').append(procureEquipmentOthersSpecify);
    }else if($(this).is(":not(:checked)")){
      $('#economicSurveyForm .col-procurements-specify').remove();
    }
  });

  $("#uploadOtherDocumentForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
        if(status==true){
          if($("#uploadOtherDocumentLoadingBtn").length <= 0){
            $("#uploadOtherDocumentBtn").hide();
            $("#uploadOtherDocumentCancelBtn").prop('disabled',true);
            $(".uploadOtherDocumentFooter").append($('<button></button>').attr({'id':'uploadOtherDocumentLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
            return true;
          }else{
            return false;
          }
        }else{
          return false;
        }
      }
  });
  $("#uploadOtherDocumentTwoForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
        if(status==true){
          if($("#uploadOtherDocumentTwoLoadingBtn").length <= 0){
            $("#uploadOtherDocumentTwoBtn").hide();
            $("#uploadOtherDocumentTwoCancelBtn").prop('disabled',true);
            $(".uploadOtherDocumentTwoFooter").append($('<button></button>').attr({'id':'uploadOtherDocumentTwoLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
            return true;
          }else{
            return false;
          }
        }else{
          return false;
        }
      }
  });
/* END ECONOMIC SURVEY FORM*/

/* START ADD STAFF FORM*/
  $("#addStaffForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
        if(status==true){
          if($("#addStaffLoadingBtn").length <= 0){
            $("#addStaffBtn").hide();
            $("#addStaffCancelBtn").prop('disabled',true);
            $(".addStaffFooter").append($('<button></button>').attr({'id':'addStaffLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
            return true;
          }else{
            return false;
          }
        }else{
          return false;
        }
      }
  });
/* END ADD STAFF FORM*/
/* START EDIT STAFF FORM */
$('#addStaffForm #position').on('change', function(){
  if($(this).val()=="Others"){
    var staffPositionSpecify = $('<div class="col-sm-12 col-md-4 col-staff-position-specify">' +
              '<div class="form-group"><label for="staffPositionSpecify">Specify Others:</label>' +
              '<input type="text" class="form-control validate[required]" name="staffPositionSpecify" id="staffPositionSpecify">' +
              '</div></div>');
    $('#addStaffForm .as-row').append(staffPositionSpecify);
  }else{
    $('#addStaffForm .col-staff-position-specify').remove();
  }
});

$('#editStaffForm #position').on('change', function(){ 
  if($(this).val()=="Others"){
    var staffPositionSpecify = $('<div class="col-sm-12 col-md-4 col-staff-position-specify">' +
              '<div class="form-group"><label for="staffPositionSpecify">Specify Others:</label>' +
              '<input type="text" class="form-control validate[required]" name="staffPositionSpecify" id="staffPositionSpecify">' +
              '</div></div>');
    $('#editStaffForm .as-row').append(staffPositionSpecify);
  }else{
    $('#editStaffForm .col-staff-position-specify').remove();
  }
});

/*  END EDIT STAFF FORM */
/* ANJURY FOR PAYMENT POP UP */
  $(".btnOkForPayment").on('click',function(e){
    var lnkProceed = this;
    e.preventDefault();
    Swal({
      title: 'Proceed to Payment?',
      text: "Once submitted, you wont be able to change all the information you provide.",
      type: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'No, Review again',
      confirmButtonText: 'Yes'
    }).then((result) => {
      if (result.value) {
        window.location.href = lnkProceed;
      }
    });
  });

/* ANJURY END */
  $(".btnFinalize").on('click',function(e){
    var lnkProceed = this;
    e.preventDefault();
    Swal({
      title: 'Proceed to Evaluation?',
      text: "Once submitted, you wont be able to change all the information you provide.",
      type: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'No, Review again',
      confirmButtonText: 'Yes'
    }).then((result) => {
      if (result.value) {
        window.location.href = lnkProceed;
      }
    });
  });

  /* START ADD ADMIN FORM*/
    $("#addAdministratorForm").validationEngine('attach',
        {promptPosition: 'inline',
        scroll: false,
        focusFirstField : false,
        onValidationComplete: function(form,status){
          if(status==true){
            if($("#addAdministratorLoadingBtn").length <= 0){
              $("#addAdministratorBtn").hide();
              $("#addAdministratorCancelBtn").prop('disabled',true);
              $(".addAdministratorFooter").append($('<button></button>').attr({'id':'addAdministratorLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
            }else{
              return false;
            }
          }else{
            return false;
          }
        }
    });
  /* END ADD ADMIN FORM*/
  /* START EDIT ADMIN FORM*/
    $("#editAdministratorForm").validationEngine('attach',
        {promptPosition: 'inline',
        scroll: false,
        focusFirstField : false,
        onValidationComplete: function(form,status){
          if(status==true){
            if($("#editAdministratorLoadingBtn").length <= 0){
              $("#editAdministratorBtn").hide();
              $("#editAdministratorCancelBtn").prop('disabled',true);
              $(".editAdministratorFooter").append($('<button></button>').attr({'id':'editAdministratorLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
            }else{
              return false;
            }
          }else{
            return false;
          }
        }
    });
  /* END EDIT ADMIN FORM*/
  /* START DELETE ADMIN*/
  $('#deleteAdministratorModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var full_name = button.data('fname');
    var adid = button.data('adid');
    var modal = $(this)
    modal.find('.modal-body #adminID').val(adid);
    modal.find
    ('.modal-body .admin-name-text').text(full_name);
  });
  $("#deleteAdministratorForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
          if(status==true){
            if($("#deleteAdministratorLoadingBtn").length <= 0){
              $("#deleteAdministratorForm #deleteAdministratorBtn").hide();
              $("#deleteAdministratorForm .col-delete-cooperative-btn").append($('<button></button>').attr({'id':'deleteAdministratorLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
            }else{
              return false;
            }
          }else{
            return false;
          }
        }
  });
  /* END DELETE ADMIN*/
  /* ANJURY RESET PASSWORD START*/
  $('#resetPasswordModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var full_name = button.data('fname');
    var adid = button.data('adid');
    var modal = $(this)
    modal.find('.modal-body #adminID').val(adid);
    modal.find
    ('.modal-body .admin-name-text').text(full_name);
  });
  $("#resetPasswordForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
          if(status==true){
            if($("#resetPasswordLoadingBtn").length <= 0){
              $("#resetPasswordForm #resetPasswordBtn").hide();
              $("#resetPasswordForm .col-delete-cooperative-btn").append($('<button></button>').attr({'id':'resetPasswordLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
            }else{
              return false;
            }
          }else{
            return false;
          }
        }
  });
  /* ANJURY RESET PASSWORD END*/
  /* START APPROVE COOPERATIVE*/
  $('#approveCooperativeModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var coop_name = button.data('cname');
    var coop_id = button.data('coopid');
    var modal = $(this)
    modal.find('.modal-body #cooperativeID').val(coop_id);
    modal.find('.modal-body #cName').val(coop_name);
  });
  $("#approveCooperativeForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
          if(status==true){
            if($("#approveAdministratorLoadingBtn").length <= 0){
              $("#approveCooperativeForm #approveCooperativeBtn").hide();
              $("#approveCooperativeForm .col-approve-cooperative-btn").append($('<button></button>').attr({'id':'approveAdministratorLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
            }else{
              return false;
            }
          }else{
            return false;
          }
        }
  });
  /* END APPROVE COOPERATIVE*/

    /* START APPROVE AMENDMENT*/
  $('#approveAmendmentModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var coop_name = button.data('cname');
    var coop_id = button.data('coopid');
    var modal = $(this)
    modal.find('.modal-body #cooperativeID').val(coop_id);
    modal.find('.modal-body #cName').val(coop_name);
  });
  $("#approveAmendmentForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
          if(status==true){
            if($("#approveAdministratorLoadingBtn").length <= 0){
              $("#approveAmendmentForm #approveCooperativeBtn").hide();
              $("#approveAmendmentForm .col-approve-cooperative-btn").append($('<button></button>').attr({'id':'approveAdministratorLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
            }else{
              return false;
            }
          }else{
            return false;
          }
        }
  });
  /* END APPROVE AMENDMENT*/


   //modify by json
  /* START DENY LABORATORY */
  $('#denyLaboratoryModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var lab_name = button.data('cname');
    var lab_id = button.data('coopid');
    var modal = $(this)
    modal.find('.modal-body #laboratoryID').val(lab_id);
    modal.find('.modal-body .laboratory-name-text').text(lab_name+" Laboratory Cooperative");
  });
  /* END DENY LABORATORY*/

      //modify by json
  /* START DEFER LABORATORY */
  $('#deferLaboratoryModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var lab_name = button.data('cname');
    var lab_id = button.data('coopid');
    var modal = $(this);
    modal.find('.modal-body #laboratoryID').val(lab_id);
    modal.find('.modal-body .laboratory-name-text').text(lab_name+" Laboratory Cooperative");
  });
  /* END DEFER LABORATORY*/
  
  
  /* START DENY COOPERATIVE*/
  $('#denyCooperativeModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var coop_name = button.data('cname');
    var coop_id = button.data('coopid');
    var modal = $(this)
    modal.find('.modal-body #cooperativeID').val(coop_id);
    modal.find('.modal-body .cooperative-name-text').text(coop_name);
  });
  $("#denyCooperativeForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
          if(status==true){
            if($("#denyAdministratorLoadingBtn").length <= 0){
              $("#denyCooperativeForm #denyCooperativeBtn").hide();
              $("#denyCooperativeForm .col-deny-cooperative-btn").append($('<button></button>').attr({'id':'denyAdministratorLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
            }else{
              return false;
            }
          }else{
            return false;
          }
        }
  });
  /* END DENY COOPERATIVE*/
  /* START DEFER COOPERATIVE*/
  $('#deferCooperativeModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var coop_name = button.data('cname');
    var comment = button.data('comment');
    var coop_id = button.data('coopid');
    var modal = $(this)
    modal.find('.modal-body #cooperativeID').val(coop_id);
    modal.find('.modal-body .cooperative-name-text').text(coop_name);
    modal.find('.modal-body .cooperative-comment-text').text(comment);
  });
  $("#deferCooperativeForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
          if(status==true){
            if($("#deferAdministratorLoadingBtn").length <= 0){
              $("#deferCooperativeForm #deferCooperativeBtn").hide();
              $("#deferCooperativeForm .col-defer-cooperative-btn").append($('<button></button>').attr({'id':'deferAdministratorLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
            }else{
              return false;
            }
          }else{
            return false;
          }
        }
  });
  /* END DEFER COOPERATIVE*/
/* START APPROVE COOPERATIVE*/
  $('#approveBranchModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var branchName = button.data('cname');
    var branch_id = button.data('coopid');
    var modal = $(this)
    modal.find('.modal-body #branchID').val(branch_id);
    modal.find('.modal-body #bName').val(branchName);
  });
  $("#approveBranchForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
          if(status==true){
            if($("#approveAdministratorLoadingBtn").length <= 0){
              $("#approveranchBForm #approveBranchBtn").hide();
              $("#approveBranchForm .col-approve-branch-btn").append($('<button></button>').attr({'id':'approveAdministratorLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
            }else{
              return false;
            }
          }else{
            return false;
          }
        }
  });
  /* END APPROVE COOPERATIVE*/
  /* START DENY COOPERATIVE*/
  $('#denyBranchModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var branchName = button.data('cname');
    var branch_id = button.data('coopid');
    var modal = $(this)
    modal.find('.modal-body #branchID').val(branch_id);
    modal.find('.modal-body .branch-name-text').text(branchName);
  });
  $("#denyBranchForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
          if(status==true){
            if($("#denyAdministratorLoadingBtn").length <= 0){
              $("#denyBranchForm #denyBranchBtn").hide();
              $("#denyBranchForm .col-deny-Branch-btn").append($('<button></button>').attr({'id':'denyAdministratorLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
            }else{
              return false;
            }
          }else{
            return false;
          }
        }
  });
  /* END DENY Branch*/
  /* START DEFER Branch*/
  $('#deferBranchModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var branchName = button.data('cname');
    var branch_id = button.data('coopid');
    var comment = button.data('comment');
    var modal = $(this)
    modal.find('.modal-body #branchID').val(branch_id);
    modal.find('.modal-body .branch-name-text').text(branchName);
    modal.find('.modal-body #branch-comment-text').text(comment);
  });
  $("#deferBranchForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
          if(status==true){
            if($("#deferAdministratorLoadingBtn").length <= 0){
              $("#deferBranchForm #deferBranchBtn").hide();
              $("#deferBranchForm .col-defer-branch-btn").append($('<button></button>').attr({'id':'deferAdministratorLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
            }else{
              return false;
            }
          }else{
            return false;
          }
        }
  });
  /* END DEFER COOPERATIVE*/
  //amendment
   $("#amendmentAddForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
          if(status==true){
            if($("#deferAdministratorLoadingBtn").length <= 0){
              $("#amendmentAddForm #amendmentAddBtn").hide();
              $("#amendmentAddForm .col-btn").append($('<button></button>').attr({'id':'deferAdministratorLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
            }else{
              return false;
            }
          }else{
            return false;
          }
        }
  });

  //end amendment
  $("#reserveUpdateForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
          if(status==true){
            if($("#reserveUpdateLoadingBtn").length <= 0){
              $("#reserveUpdateForm #reserveUpdateBtn").hide();
              $("#reserveUpdateForm .col-reserveupdate-btn").append($('<button></button>').attr({'id':'reserveUpdateLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
            }else{
              return false;
            }
          }else{
            return false;
          }
        }
  });
  $("#reserveBranchUpdateForm #reserveUpdateAgree").click(function(){
    if($(this).is(':checked')){
      $('#reserveBranchUpdateForm #reserveBranchUpdateBtn').removeAttr('disabled');
    }else{
      $('#reserveBranchUpdateForm #reserveBranchUpdateBtn').attr('disabled','disabled');
    }
  });
  
  $("#reserveUpdateForm #reserveUpdateAgree").click(function(){
    if($(this).is(':checked')){
      $('#reserveUpdateForm #reserveUpdateBtn').removeAttr('disabled');
    }else{
      $('#reserveUpdateForm #reserveUpdateBtn').attr('disabled','disabled');
    }
  });

  $('#reserveUpdateForm #typeOfCooperative').on('change', function(){
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
      $("#reserveUpdateForm #proposedName").prop("disabled",false);
      var coop_type = $(this).val();
        $.ajax({
        type : "POST",
        url  : "../../api/major_industries",
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
            url  : "../../api/industry_subclasses",
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
  $('#reserveUpdateForm #addMoreSubclassBtn').on('click', function(){
    if($('#reserveUpdateForm #typeOfCooperative').val() && ($('#reserveUpdateForm #typeOfCooperative').val()).length > 0){
      var lastCountOfSubclass = $('select[name="subClass[]"').last().attr('id');
      var totalCountOFSubclass = $('select[name="subClass[]"').length;
      var intLastCount = parseInt(lastCountOfSubclass.substr(-1));
      var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn businessActivityRemoveBtn float-right text-danger'}).click(function(){
          $(this).parent().parent().parent().remove();
          $('#reserveUpdateForm select[name="majorIndustry[]"').each(function(index){
            $(this).siblings('label').text("Major Industry " + (index+1));
          });
          $('#reserveUpdateForm select[name="subClass[]"').each(function(index){
            $(this).siblings('label').text("Major Industry " + (index+1) + "Subclass ");
          });
        });
        var divFormGroupSubclass= $('<div></div>').attr({'class':'form-group'});
        var divColSubclass = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
        var labelSubClass = $('<label></label>').attr({'for': 'subClass'+(intLastCount + 1)}).text("Major Industry " + (intLastCount+1) + " Subclass ");
        var selectSubClass = $('<select></select>').attr({'class': 'custom-select form-control validate[required]','name': 'subClass[]', 'id': 'subClass' + (intLastCount + 1)}).prop("disabled",true);
        var divFormGroupMajorIndustry = $('<div></div>').attr({'class':'form-group'});
        var divColMajorIndustry = $('<div></div>').attr({'class':'col-sm-12 col-md-12'});
        var labelMajorIndustry = $('<label></label>').attr({'for': 'majorIndustry'+(intLastCount + 1)}).text("Major Industry " + (intLastCount+1));
        var selectMajorIndustry = $('<select></select>').attr({'class': 'custom-select form-control validate[required]','name': 'majorIndustry[]', 'id': 'majorIndustry' + (intLastCount + 1)}).change(function(){
        $(selectSubClass).empty();
        $(selectSubClass).prop("disabled",true);
        if($(this).val() && ($(this).val()).length > 0){
          $(selectSubClass).prop("disabled",false);
          var major_industry = $(this).val();
            var coop_type_val = $('#reserveUpdateForm #typeOfCooperative').val();
            $.ajax({
              type : "POST",
              url  : "../../api/industry_subclasses",
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
          url  : "../../api/major_industries",
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
          }
        });
    }else{
      $('#reserveUpdateForm #typeOfCooperative').focus();
    }
  } );

  $('#reserveUpdateForm #compositionOfMembers').on('change', function(){
    if($(this).val()=="Others"){
      var compositionOfMembersSpecify = $('<div class="col-sm-12 col-md-6 col-composition-specify">' +
                '<div class="form-group"><label for="compositionOfMembersSpecify">Specify Others:</label>' +
                '<input type="text" class="form-control validate[required]" name="compositionOfMembersSpecify" id="compositionOfMembersSpecify">' +
                '</div></div>');
      $('#reserveUpdateForm .rd-row').append(compositionOfMembersSpecify);
    }else{
      $('#reserveUpdateForm .col-composition-specify').remove();
    }
  });

  $('#reserveUpdateForm #region').on('change',function(){
    $('#reserveUpdateForm #province').empty();
    $("#reserveUpdateForm #province").prop("disabled",true);
    $('#reserveUpdateForm #city').empty();
    $("#reserveUpdateForm #city").prop("disabled",true);
    $('#reserveUpdateForm #barangay').empty();
    $("#reserveUpdateForm #barangay").prop("disabled",true);
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
          $('#reserveUpdateForm #province').append($('<option></option>').attr('value',"").text(""));
          $.each(data, function(key,value){
            $('#reserveUpdateForm #province').append($('<option></option>').attr('value',value.provCode).text(value.provDesc));
          });
        }
      });
    }
  });

  $('#reserveBranchUpdateForm #region').on('change',function(){
    // $('#reserveBranchUpdateForm #province').empty();
    // $("#reserveBranchUpdateForm #province").prop("disabled",true);
    // $('#reserveBranchUpdateForm #city').empty();
    // $("#reserveBranchUpdateForm #city").prop("disabled",true);
    // $('#reserveBranchUpdateForm #barangay').empty();
    // $("#reserveBranchUpdateForm #barangay").prop("disabled",true);
    if($(this).val() && ($(this).val()).length > 0){
      // $("#reserveBranchUpdateForm #province").prop("disabled",false);
      var region = $(this).val();
        $.ajax({
        type : "POST",
        url  : "../../api/provinces",
        dataType: "json",
        data : {
          region: region
        },
        success: function(data){
          $('#reserveBranchUpdateForm #province').append($('<option></option>').attr('value',"").text(""));
          $.each(data, function(key,value){
            $('#reserveBranchUpdateForm #province').append($('<option></option>').attr('value',value.provCode).text(value.provDesc));
          });
        }
      });
    }
  });

  // $('#reserveUpdateFormAmendment #region').on('change',function(){
  //   $('#reserveUpdateFormAmendment #province').empty();
  //   $("#reserveUpdateFormAmendment #province").prop("disabled",true);
  //   $('#reserveUpdateFormAmendment #city').empty();
  //   $("#reserveUpdateFormAmendment #city").prop("disabled",true);
  //   $('#reserveUpdateFormAmendment #barangay').empty();
  //   $("#reserveUpdateFormAmendment #barangay").prop("disabled",true);
  //   if($(this).val() && ($(this).val()).length > 0){
  //     $("#reserveUpdateForm #province").prop("disabled",false);
  //     var region = $(this).val();
  //       $.ajax({
  //       type : "POST",
  //       url  : "../../api/provinces",
  //       dataType: "json",
  //       data : {
  //         region: region
  //       },
  //       success: function(data){
  //         $('#reserveUpdateFormAmendment #province').append($('<option></option>').attr('value',"").text(""));
  //         $.each(data, function(key,value){
  //           $('#reserveUpdateFormAmendment #province').append($('<option></option>').attr('value',value.provCode).text(value.provDesc));
  //         });
  //       }
  //     });
  //   }
  // });


  $('#reserveUpdateForm #province').on('change',function(){
    $('#reserveUpdateForm #city').empty();
    $("#reserveUpdateForm #city").prop("disabled",true);
    $('#reserveUpdateForm #barangay').empty();
    $("#reserveUpdateForm #barangay").prop("disabled",true);
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
          $('#reserveUpdateForm #city').append($('<option></option>').attr('value',"").text(""));
          $.each(data, function(key,value){
            $('#reserveUpdateForm #city').append($('<option></option>').attr('value',value.citymunCode).text(value.citymunDesc));
          });
        }
      });
    }
  });


  $('#reserveBranchUpdateForm #province').on('change',function(){
    // $('#reserveBranchUpdateForm #city').empty();
    // $("#reserveBranchUpdateForm #city").prop("disabled",true);
    // $('#reserveBranchUpdateForm #barangay').empty();
    // $("#reserveBranchUpdateForm #barangay").prop("disabled",true);
    if($(this).val() && ($(this).val()).length > 0){
      // $("#reserveBranchUpdateForm #city").prop("disabled",false);
      var province = $(this).val();
        $.ajax({
        type : "POST",
        url  : "../../api/cities",
        dataType: "json",
        data : {
          province: province
        },
        success: function(data){
          $('#reserveBranchUpdateForm #city').append($('<option></option>').attr('value',"").text(""));
          $.each(data, function(key,value){
            $('#reserveBranchUpdateForm #city').append($('<option></option>').attr('value',value.citymunCode).text(value.citymunDesc));
          });
        }
      });
    }
  });

  // $('#reserveUpdateFormAmendment #province').on('change',function(){
  //   $('#reserveUpdateFormAmendment #city').empty();
  //   $("#reserveUpdateFormAmendment #city").prop("disabled",true);
  //   $('#reserveUpdateFormAmendment #barangay').empty();
  //   $("#reserveUpdateFormAmendment #barangay").prop("disabled",true);
  //   if($(this).val() && ($(this).val()).length > 0){
  //     $("#reserveUpdateForm #city").prop("disabled",false);
  //     var province = $(this).val();
  //       $.ajax({
  //       type : "POST",
  //       url  : "../../api/cities",
  //       dataType: "json",
  //       data : {
  //         province: province
  //       },
  //       success: function(data){
  //         $('#reserveUpdateFormAmendment #city').append($('<option></option>').attr('value',"").text(""));
  //         $.each(data, function(key,value){
  //           $('#reserveUpdateFormAmendment #city').append($('<option></option>').attr('value',value.citymunCode).text(value.citymunDesc));
  //         });
  //       }
  //     });
  //   }
  // });

  $('#reserveUpdateForm #city').on('change',function(){
    $('#reserveUpdateForm #barangay').empty();
    $("#reserveUpdateForm #barangay").prop("disabled",true);
    if($(this).val() && ($(this).val()).length > 0){
      $("#reserveUpdateForm #barangay").prop("disabled",false);
      var cities = $(this).val();
        $.ajax({
        type : "POST",
        url  : "../../api/barangays",
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

  $('#reserveBranchUpdateForm #city').on('change',function(){
    // $('#reserveBranchUpdateForm #barangay').empty();
    // $("#reserveBranchUpdateForm #barangay").prop("disabled",true);
    if($(this).val() && ($(this).val()).length > 0){
      // $("#reserveBranchUpdateForm #barangay").prop("disabled",false);
      var cities = $(this).val();
        $.ajax({
        type : "POST",
        url  : "../../api/barangays",
        dataType: "json",
        data : {
          cities: cities
        },
        success: function(data){
          $('#reserveBranchUpdateForm #barangay').append($('<option></option>').attr('value',"").text(""));
          $.each(data, function(key,value){
            $('#reserveBranchUpdateForm #barangay').append($('<option></option>').attr('value',value.brgyCode).text(value.brgyDesc));
          });
        }
      });
    }
  });
  
  //  $('#reserveUpdateFormAmendment #city').on('change',function(){
  //   $('#reserveUpdateFormAmendment #barangay').empty();
  //   $("#reserveUpdateFormAmendment #barangay").prop("disabled",true);
  //   if($(this).val() && ($(this).val()).length > 0){
  //     $("#reserveUpdateForm #barangay").prop("disabled",false);
  //     var cities = $(this).val();
  //       $.ajax({
  //       type : "POST",
  //       url  : "../../api/barangays",
  //       dataType: "json",
  //       data : {
  //         cities: cities
  //       },
  //       success: function(data){
  //         $('#reserveUpdateFormAmendment #barangay').append($('<option></option>').attr('value',"").text(""));
  //         $.each(data, function(key,value){
  //           $('#reserveUpdateFormAmendment #barangay').append($('<option></option>').attr('value',value.brgyCode).text(value.brgyDesc));
  //         });
  //       }
  //     });
  //   }
  // });

  /* END UPDATE COOPERATIVE FORM*/
  $('#assignSpecialistModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var coop_name = button.data('cname');
    var coop_id = button.data('coopid');
    var modal = $(this)
    modal.find('.modal-body #cooperativesID').val(coop_id);
    modal.find('.modal-body #cooperativeName').val(coop_name);
  });
  $("#assignSpecialistForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
          if(status==true){
            if($("#assignSpecialistLoadingBtn").length <= 0){
              $("#assignSpecialistForm #assignSpecialistBtn").hide();
              $("#assignSpecialistForm .assignSpecialistFooter").append($('<button></button>').attr({'id':'assignSpecialistLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
            }else{
              return false;
            }
          }else{
            return false;
          }
        }
  });

  $('#assignSpecialistAmendmentModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var coop_name = button.data('cname');
    var coop_id = button.data('coopid');
    var modal = $(this)
    modal.find('.modal-body #amd_id').val(coop_id);
    modal.find('.modal-body #amdName').val(coop_name);
  });
  $("#assignSpecialistAmendmentForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
          if(status==true){
            if($("#assignSpecialistLoadingBtn").length <= 0){
              $("#assignSpecialistAmendmentForm #assignSpecialistBtn").hide();
              $("#assignSpecialistAmendmentForm .assignSpecialistFooter").append($('<button></button>').attr({'id':'assignSpecialistLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
            }else{
              return false;
            }
          }else{
            return false;
          }
        }
  });


  //   $("#reserveUpdateFormAmendment").validationEngine('attach',
  //     {promptPosition: 'inline',
  //     scroll: false,
  //     focusFirstField : false,
  //     onValidationComplete: function(form,status){
       
  //         if(status==true){
  //           if($("#reserveUpdateFormAmendment #amendmentAddLoadingBtn").length <= 0){
  //             $("#reserveUpdateFormAmendment  #reserveUpdateBtn2").hide();
  //             $("#reserveUpdateFormAmendment  .col-branch-btn").append($('<button></button>').attr({'id':'branchAddLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
  //             return true;
  //           }else{
  //             return false;
  //           }
  //         }else{
  //           return false;
  //         }
  //       }
  // });

  $('#assignBranchSpecialistModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var coop_name = button.data('cname');
    var coop_id = button.data('coopid');
    var modal = $(this)
    modal.find('.modal-body #branchID').val(coop_id);
    modal.find('.modal-body #branchName').val(coop_name);
  });
  $("#assignBranchSpecialistForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
          if(status==true){
            if($("#assignBranchSpecialistLoadingBtn").length <= 0){
              $("#assignBranchSpecialistForm #assignBranchSpecialistBtn").hide();
              $("#assignBranchSpecialistForm .assignSpecialistFooter").append($('<button></button>').attr({'id':'assignBranchSpecialistLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
            }else{
              return false;
            }
          }else{
            return false;
          }
        }
  });

})

$(document).on('change','#articlesPrimaryForm #commonShares,#parValueCommon,#preferredShares,#parValuePreferred',function(){
  var tempCommonShares = parseInt($("#articlesPrimaryForm #commonShares").val());
  var tempParValueCommon = parseInt($("#articlesPrimaryForm #parValueCommon").val());
  var authorizedShareCapital = $("#articlesPrimaryForm #authorizedShareCapital");
  var tempCommon = parseInt(tempCommonShares * tempParValueCommon);
  if($("#articlesPrimaryForm #preferredShares").length && $("#articlesPrimaryForm #parValuePreferred").length){
    var tempPreferredShares = parseInt($("#articlesPrimaryForm #preferredShares").val());
    var tempParValuePreferred = parseInt($("#articlesPrimaryForm #parValuePreferred").val());
    var tempPreferred =  parseInt(tempPreferredShares * tempParValuePreferred);
    var grandTotal = tempCommon + tempPreferred;
    $(authorizedShareCapital).val(grandTotal);
    $(authorizedShareCapital).trigger('blur');
  }else{
    $(authorizedShareCapital).val(tempCommon);
    $(authorizedShareCapital).trigger('blur');
  }
});
$(document).on('change','#editCooperatorForm #membershipType', function(){
  $('#editCooperatorForm #subscribedShares').trigger('blur');
  $('#editCooperatorForm #paidShares').trigger('blur');
});
$(document).on('click','.regularQualificationRemoveBtn', function(){
  if(!($(this).siblings('input').prop("disabled"))){
    $(this).parent().parent().remove();
    $('#bylawsPrimaryForm input[name="regularQualifications[]"').each(function(index){
      $(this).siblings('label').text("Regular member qualification " + (index+1));
    });
  }
});
$(document).on('click','.associateQualificationRemoveBtn', function(){
  if(!($(this).siblings('input').prop("disabled"))){
    $(this).parent().parent().remove();
    $('#bylawsPrimaryForm input[name="associateQualifications[]"').each(function(index){
      $(this).siblings('label').text("Associate member qualification " + (index+1));
    });
  }
});
$(document).on('click','#reserveUpdateForm .businessActivityRemoveBtn', function(){
  $(this).parent().parent().parent().remove();
  $('#reserveUpdateForm select[name="subClass[]"').each(function(index){
    $(this).siblings('label').text("Major Industry " + (index+1) +  " Subclass ");
  });
});



// Birth Date Validation
function validateAgeCustom(field, rules, i, options){
  if(field.val() || field.val().length>=10){
    let dateField = new Date(field.val());
    let dateNow = new Date();
    let dateFieldYr = dateField.getFullYear();
    let dateNowYr = dateNow.getFullYear();
    if((dateNowYr - dateFieldYr)<18){
       // this allows the use of i18 for the error msgs
       return options.allrules.validateAge.alertText;
    }
  }else{
    return options.allrules.validateAge.alertText;
  }
}
function validateActivityNotNullAddCustom(field, rules, i, options){
  let tempActivity = $.trim($("#reserveAddForm #typeOfCooperative").val());
  if(tempActivity.length <=0){
      return options.allrules.validateActivityNotNull.alertText;
  }
}
function validateActivityInNameAddCustom(field, rules, i, options){
  let tempName = $.trim($(field).val());
  let tempActivity = $.trim($("#reserveAddForm #typeOfCooperative").val());
  if(tempName.length >0 && tempActivity.length >0){
    var textOption = $("#reserveAddForm #typeOfCooperative option[value='" + tempActivity +"']").text();
    var checkName = new RegExp(textOption , 'i');
    var result = checkName.test(tempName);
    if(result){
      return options.allrules.validateActivityInName.alertText;
    }
  }
}
function validateActivityInNameAddCustomAmendment(field, rules, i, options){
  let tempName = $.trim($(field).val());
  let tempActivity = $.trim($("#amendmentAddForm #typeOfCooperative").val());
  if(tempName.length >0 && tempActivity.length >0){
    var textOption = $("#amendmentAddForm #typeOfCooperative option[value='" + tempActivity +"']").text();
    var checkName = new RegExp(textOption , 'i');
    var result = checkName.test(tempName);
    if(result){
      return options.allrules.validateActivityInName.alertText;
    }
  }
}
function validateActivityNotNullUpdateCustom(field, rules, i, options){
  let tempActivity = $.trim($("#reserveUpdateForm #typeOfCooperative").val());
  if(tempActivity.length <=0){
      return options.allrules.validateActivityNotNull.alertText;
  }
}
function validateActivityInNameUpdateCustom(field, rules, i, options){
  let tempName = $.trim($(field).val());
  let tempActivity = $.trim($("#reserveUpdateForm #typeOfCooperative").val());
  if(tempName.length >0 && tempActivity.length >0){
    var checkName = new RegExp(tempActivity , 'i');
    var result = checkName.test(tempName);
    if(result){
      return options.allrules.validateActivityInName.alertText;
    }
  }
}
function validateCooperativeWordInNameCustom(field, rules, i, options){
  let tempName = $.trim($(field).val());
  if(tempName.length >0){
    var checkName = new RegExp('cooperative|cooperatives|kooperatiba|cooperativa|cooperatiba|advocacy|Agrarian Reform|Agriculture|Bank|Consumers|Credit|Dairy|Education|Electric|Financial Service|Fishermen|Health Service|Housing|Insurance|Labor Service|Marketing|Producers|Professionals|Service|Small Scale Mining|Transport|Water Service|Workers|Union|federation', 'i');
    var result = checkName.test(tempName);
    if(result){
      return options.allrules.validateCooperativeWordInName.alertText;
    }
  }
}

function validateOthersInCommitteeNameCustom(field, rules, i, options){
  let tempCommitteeOthersName = $.trim($(field).val());
  if(tempCommitteeOthersName.length >0){
    if(tempCommitteeOthersName.toLowerCase() === "others" || tempCommitteeOthersName.toLowerCase() =="other"){
      return options.allrules.validateOthersInCommitteeName.alertText;
    }
  }
}
function validateMinimumPaidRegularPrimaryCustom(field, rules, i, options){
  let tempMinimumPaid = $.trim($(field).val());
  let tempMinimumSubscription = $.trim($("#bylawsPrimaryForm #regularMembershipPercentageSubscription").val());
  let regularMembershipPercentagePay = $.trim($("#bylawsPrimaryForm #regularMembershipPercentagePay").val());
  let exptd_amnt =0;
  
  exptd_amnt= (tempMinimumSubscription * 0.25);
  if(parseInt(regularMembershipPercentagePay) < parseInt(exptd_amnt))
  {
     return options.allrules.validateMemberUponApprovalRegular.alertText;
  }

  if((tempMinimumSubscription.length >0 && tempMinimumSubscription > 0) && (tempMinimumPaid.length >0 && tempMinimumPaid > 0)){
    if(parseInt(tempMinimumSubscription) < parseInt(tempMinimumPaid)){
     
      return options.allrules.validateMinimumPaidRegular.alertText;
    }
  }
} ///modify

function validateMinimumPaidAssociatePrimaryCustom(field, rules, i, options){
  let tempMinimumPaid = $.trim($(field).val());
  let tempMinimumSubscription = $.trim($("#bylawsPrimaryForm #associateMembershipPercentageSubscription").val());
  let associateMembershipPercentagePay = $.trim($("#bylawsPrimaryForm #associateMembershipPercentagePay").val());
  let exptd_amount =0;


  exptd_amount= (tempMinimumSubscription * 0.25);
  if(parseInt(associateMembershipPercentagePay) < parseInt(exptd_amount))
  {
    return options.allrules.validateMemberUponApproval.alertText;
  }

  if((tempMinimumSubscription.length >0 && tempMinimumSubscription > 0) && (tempMinimumPaid.length >0 && tempMinimumPaid > 0)){
    if(parseInt(tempMinimumSubscription) < parseInt(tempMinimumPaid)){
      return options.allrules.validateMinimumPaidAssociate.alertText;
    }
  }
}

//modify jayson laboratory age member/cooperator validation
function validateLabAge(field, rules, i, options)
{
  let input_age = $("#age_").val();
 
  if((input_age<=6) || (input_age>=18))
  {
       return options.allrules.validateLabAge1.alertText;
  }
}

// function validateTotalAuthorizedShareCapitalRegularCustom(field, rules, i, options){
//   let tempAuthorizedShareCapital = $.trim($(field).val());
//   let tempCommonShares = $.trim($("#articlesPrimaryForm #commonShares").val());
//   let tempParValueCommon = $.trim($("#articlesPrimaryForm #parValueCommon").val());
//   if(tempAuthorizedShareCapital.length >0 && tempAuthorizedShareCapital > 0){
//     if((tempCommonShares.length >0 && tempCommonShares > 0) && (tempParValueCommon.length >0 && tempParValueCommon > 0)){
//       if(parseInt(tempAuthorizedShareCapital) != parseInt(tempCommonShares * tempParValueCommon)){
//         return options.allrules.validateTotalAuthorizedShareCapitalRegular.alertText;
//       }
//     }
//   }
// }
// function validateTotalAuthorizedShareCapitalAssociateCustom(field, rules, i, options){
//   let tempAuthorizedShareCapital = $.trim($(field).val());
//   let tempCommonShares = $.trim($("#articlesPrimaryForm #commonShares").val());
//   let tempParValueCommon = $.trim($("#articlesPrimaryForm #parValueCommon").val());
//   let tempPreferredShares = $.trim($("#articlesPrimaryForm #preferredShares").val());
//   let tempParValuePreferred = $.trim($("#articlesPrimaryForm #parValuePreferred").val());
//   if(tempAuthorizedShareCapital.length >0 && tempAuthorizedShareCapital > 0){
//     if((tempCommonShares.length >0 && tempCommonShares > 0) && (tempParValueCommon.length >0 && tempParValueCommon > 0) && (tempPreferredShares.length >0 && tempPreferredShares > 0) && (tempParValuePreferred.length >0 && tempParValuePreferred > 0)){
//       if(parseInt(tempAuthorizedShareCapital) != (parseInt(tempCommonShares * tempParValueCommon) + parseInt(tempPreferredShares * tempParValuePreferred))){
//         return options.allrules.validateTotalAuthorizedShareCapitalAssociate.alertText;
//       }
//     }
//   }
// }
/* COMMENTED BY FRED FOR CHANGES BELOW */
//function validateRegularAssociateAuthorizedCapitalCustom(field, rules, i, options){
//  var tempCommonShares = parseInt($("#articlesPrimaryForm #commonShares").val());
//  var tempParValueCommon = parseInt($("#articlesPrimaryForm #parValueCommon").val());
//  var tempCommon = parseInt(tempCommonShares * tempParValueCommon);
//  var tempPreferredShares = parseInt($("#articlesPrimaryForm #preferredShares").val());
//  var tempParValuePreferred = parseInt($("#articlesPrimaryForm #parValuePreferred").val());
//  var tempPreferred =  parseInt(tempPreferredShares * tempParValuePreferred);
//  var grandTotal = tempCommon + tempPreferred;
//  var authorizedShareCapitalValue = parseInt($(field).val());
//  var tempCommonCheck = parseInt($(".text-total-primary-subscribed-common-less").text());
//  var tempPreferredCheck = parseInt($(".text-total-primary-subscribed-preferred-less").text());
//  if(tempCommonShares >= tempCommonCheck && tempPreferredShares >= tempPreferredCheck && tempParValueCommon > 0 && tempParValuePreferred > 0){
//    if((grandTotal*0.75 != tempCommon) && (grandTotal*0.25 != tempPreferred)){
//      return "* The product of common shares and par value per common must be 75% of Authorized Shared Capital. (Expected Product: " + grandTotal*0.75 + ") (Current Total: " + tempCommon + ")" + "<br>* The product of preferred shares and par value per preferred must be 25% of Authorized Shared Capital. (Expected Product: " + grandTotal*0.25 + ") (Current Total: " + tempPreferred + ")";
//    }
//  }
//}
function validateRegularAssociateAuthorizedCapitalCustom(field, rules, i, options){
  var totalShares = parseInt($("#articlesPrimaryForm #totalShares").val());
  var totalAuthorized = totalShares*4;
  var tempCommonShares = parseInt($("#articlesPrimaryForm #commonShares").val());
  var tempParValueCommon = parseInt($("#articlesPrimaryForm #parValueCommon").val());
  var tempCommon = parseInt(tempCommonShares * tempParValueCommon);
  var tempPreferredShares = parseInt($("#articlesPrimaryForm #preferredShares").val());
  var tempParValuePreferred = parseInt($("#articlesPrimaryForm #parValuePreferred").val());
  var tempPreferred =  parseInt(tempPreferredShares * tempParValuePreferred);
  var grandTotal = tempCommon + tempPreferred;
  var authorizedShareCapitalValue = parseInt($(field).val());
  var tempCommonCheck = parseInt($(".text-total-primary-subscribed-common-less").text());
  var tempPreferredCheck = parseInt($(".text-total-primary-subscribed-preferred-less").text());
  var output = "";
  var commonPercentage = 0.75;
  var preferredPercentage = 0.25;
    commonPercentage = (tempCommonShares/totalAuthorized).toFixed(2);
    if(commonPercentage > 0.75) {
        preferredPercentage = (1-commonPercentage).toFixed(2);
    }
    
//  var expectedPreferredPercentage = 0.75;
  
  if(tempCommonShares > 0 && tempPreferredShares > 0 && tempParValueCommon > 0 && tempParValuePreferred > 0){
//    if((grandTotal*0.75 != tempCommon) && (grandTotal*0.25 != tempPreferred)){
//      return "* The product of common shares and par value per common must be 75% of Authorized Shared Capital. (Expected Product: " + grandTotal*0.75 + ") (Current Total: " + tempCommon + ")" + "<br>* The product of preferred shares and par value per preferred must be 25% of Authorized Shared Capital. (Expected Product: " + grandTotal*0.25 + ") (Current Total: " + tempPreferred + ")";
//    }
    if(tempCommonShares < totalAuthorized*0.75){
        output = "* The product of common shares and par value per common must be at least 75% of Authorized Shared Capital. (Expected Product: Not lower than " + (totalAuthorized*0.75)*tempParValueCommon + ") (Current Total: "+tempCommon+")";
//      return "* The product of common shares and par value per common must be 75% of Authorized Shared Capital. (Expected Product: " + grandTotal*0.75 + ") (Current Total: " + tempCommon + ")" + "<br>* The product of preferred shares and par value per preferred must be 25% of Authorized Shared Capital. (Expected Product: " + grandTotal*0.25 + ") (Current Total: " + tempPreferred + ")";
    }
    if(tempPreferredShares > totalAuthorized*preferredPercentage){
        output += "<br>* The product of preferred shares and par value per preferred must be at most 25% of Authorized Shared Capital. (Expected Product: Not higher than " + (totalAuthorized*preferredPercentage)*tempParValuePreferred + ") (Current Total: "+tempPreferred+")";
//      return "* The product of common shares and par value per common must be 75% of Authorized Shared Capital. (Expected Product: " + grandTotal*0.75 + ") (Current Total: " + tempCommon + ")" + "<br>* The product of preferred shares and par value per preferred must be 25% of Authorized Shared Capital. (Expected Product: " + grandTotal*0.25 + ") (Current Total: " + tempPreferred + ")";
    }
    if((tempCommonShares+tempPreferredShares)<totalAuthorized) {
        output += "<br>* The total common shares and preferred shares must not be lower than the total authorized shares (Expected total: "+totalAuthorized+") (Current total: "+ (tempCommonShares+tempPreferredShares) +")";
        
    }
    console.log("totalShares "+totalShares);
    console.log("common% "+commonPercentage);
    console.log("preferred% "+preferredPercentage);
    console.log("preferredshares "+tempPreferredShares);
  }
  if(output.length>0) {
    return output;
  }
}
function validateAddNumberOfPaidUpGreaterCustom(field,rules, i, options){
  let tempPaidUp = $.trim($(field).val());
  let tempSubscribed = $.trim($("#addCooperatorForm #subscribedShares").val());
  if(tempPaidUp.length >0 && tempPaidUp > 0){
    if(parseInt(tempPaidUp) > parseInt(tempSubscribed)){
      return options.allrules.validateNumberOfPaidUpGreater.alertText;
    }
  }
}

function validateAddNumberOfPaidUpGreaterCustomAmendment(field,rules, i, options){
  let tempPaidUp = $.trim($(field).val());
  let tempSubscribed = $.trim($("#addCooperatorFormAmendment #amd_subscribedShares").val());
  if(tempPaidUp.length >0 && tempPaidUp > 0){
    if(parseInt(tempPaidUp) > parseInt(tempSubscribed)){
      return options.allrules.validateNumberOfPaidUpGreaterAmendment.alertText;
    }
  }
}
function validateAddNumberOfPaidUpGreaterCustomAmendmentEdit(field,rules, i, options){
  let tempPaidUp = $.trim($(field).val());
  let tempSubscribed = $.trim($("#editCooperatorForm #amd_subscribedShares").val());
  if(tempPaidUp.length >0 && tempPaidUp > 0){
    if(parseInt(tempPaidUp) > parseInt(tempSubscribed)){
      return options.allrules.validateNumberOfPaidUpGreater.alertText;
    }
  }
}
function validateEditNumberOfPaidUpGreaterCustom(field,rules, i, options){
  let tempPaidUp = $.trim($(field).val());
  let tempSubscribed = $.trim($("#editCooperatorForm #amd_subscribedShares").val());
  if(tempPaidUp.length >0 && tempPaidUp > 0){
    if(parseInt(tempPaidUp) > parseInt(tempSubscribed)){
      return options.allrules.validateNumberOfPaidUpGreater.alertText;
    }
  }
}

function validateAddCooperatorAjax(){
  var isValidSubscription = $("#addCooperatorForm #subscribedShares").validationEngine('validate');
  var isValidPaid = $("#addCooperatorForm #paidShares").validationEngine('validate');
  return (isValidSubscription && isValidPaid);
}

function validateAmendment_proposed_name(field, rules, i, options){
  let tempName = $.trim($(field).val());
  if(tempName.length >0){
    var checkName = new RegExp('cooperative|cooperatives|kooperatiba|cooperativa|cooperatiba|multipurpose|multi-purpose', 'i');
    var result = checkName.test(tempName);
    if(result){
      return options.allrules.validateAmendment_proposed_name.alertText;
    }
  }
}
