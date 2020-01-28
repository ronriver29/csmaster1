$(function(){
  $("#editPurposesForm").validationEngine('attach',
      {promptPosition: 'inline',
      scroll: false,
      focusFirstField : false,
      onValidationComplete: function(form,status){
          if(status==true){
            if($("#editPurposeLoadingBtn").length <= 0){
              $("#editPurposesForm #editPurposesBtn").hide();
              $("#editPurposesForm .editPurposesFooter").append($('<button></button>').attr({'id':'editPurposeLoadingBtn','disabled':'disabled','class':'btn btn-block btn-secondary'}).text("Loading"));
              return true;
            }else{
              return false;
            }
          }else{
            return false;
          }
        }
  });
  $("#editPurposesForm .purposeRemoveBtn").on('click',function(){
    $(this).parent().parent().remove();
    $('#editPurposesForm textarea[name="purposes[]"').each(function(index){
      $(this).siblings('label').html("<strong>Purpose No. " + (index+1) + "</strong>");
    });
  });
  $("#editPurposesForm #addMorePurposeBtn").on('click',function(){
    var lastCountOfPurposes = $('textarea[name="purposes[]"').first().attr('id');
    var intLastCount = parseInt(lastCountOfPurposes.substr(-1));
    console.log(intLastCount);
    var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn purposeRemoveBtn float-left text-danger'}).click(function(){
      $(this).parent().parent().remove();
      $('#editPurposesForm textarea[name="purposes[]"').each(function(index){
        $(this).siblings('label').html("<strong>Purpose No. " + (index+1) + "</strong>");
      });
    });
    var divFormGroupPurpose = $('<div></div>').attr({'class':'form-group'});
    var divColPurpose = $('<div></div>').attr({'class':'col-sm-12 col-md-12 col-purpose'});
    var labelPurpose = $('<label></label>').attr({'for': 'purpose'+(intLastCount + 1)}).html('<strong>Purpose No. 1 </strong>');
    var textareaPurpose = $('<textarea></textarea>').attr({'class':'form-control validate[required] textarea-purpose','placeholder':'Must be in sentence','rows':'2','name':'purposes[]','id':'purpose'+(intLastCount+1)});
    $(divFormGroupPurpose).append(deleteSpan,labelPurpose,textareaPurpose);
    $(divColPurpose).append(divFormGroupPurpose);
    var rowPurpose = $('#editPurposesForm .row-purposes');
    $(rowPurpose).prepend(divColPurpose);
    // $( ".col-purpose:nth-child(2)").find('.form-group').prepend(deleteSpan);
    $('#editPurposesForm textarea[name="purposes[]"').each(function(index){
      $(this).siblings('label').html("<strong>Purpose No. " + (index+1) + "</strong>");
    });
  });
});
