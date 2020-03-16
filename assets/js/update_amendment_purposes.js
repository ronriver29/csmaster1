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
    // alert('go');
     $(this).closest('.purposes_wrapper').remove();//$("#con-wrapper").children().last().remove(); // $(this).parent().remove();// $(this).closest(".tbl").remove();

    // $(this).parent().parent().remove();
    // $('#editPurposesForm textarea[name="purposes[]"').each(function(index){
    //   $(this).siblings('label').html("<strong>Purpose No. " + (index+1) + "</strong>");
    // });
  });


  $("#editPurposesForm #addMorePurposeBtn").on('click',function(){
    var data_selector = $(this).data("id");
    if(data_selector ==1)
    {
      var html_lable = '#editPurposesForm textarea[name="purposes1[]"';
      var array_name = 'purposes1[]';
      var name =$('textarea[name="purposes1[]"');
      var division = '#type_count1';
      var textarea_id = 'purposes1';
    }
    else if(data_selector ==2)
    {
      var html_lable = '#editPurposesForm textarea[name="purposes2[]"';
      var array_name = 'purposes2[]';
      var name =$('textarea[name="purposes2[]"');
      var division = '#type_count2';
      var textarea_id = 'purposes2';
    }
    else if(data_selector ==3)
    {
      var html_lable = '#editPurposesForm textarea[name="purposes3[]"';
      var array_name = 'purposes3[]';
      var name =$('textarea[name="purposes3[]"');
      var division = '#type_count3';
      var textarea_id = 'purposes3';
    }
    else
    {
      var html_lable = '#editPurposesForm textarea[name="purposes4[]"';
      var array_name = 'purposes3[]';
      var name =$('textarea[name="purposes4[]"');
      var division = '#type_count4';
      var textarea_id = 'purposes4';
    }

    var lastCountOfPurposes = name.first().attr('id');
    var intLastCount = parseInt(lastCountOfPurposes.substr(-1));
    // var deleteSpan = $('<a><i class="fas fa-minus-circle"></i></a>').attr({'class':'customDeleleBtn purposeRemoveBtn float-left text-danger'}).click(function(){
      // $(this).parent().parent().remove();
   

    // var divFormGroupPurpose = $('<div></div>').attr({'class':'form-group'});
    // var divColPurpose = $('<div></div>').attr({'class':'col-sm-12 col-md-12 col-purpose'});
    // var labelPurpose = $('<label></label>').attr({'for': 'purpose'+(intLastCount + 1)}).html('<strong>Purpose No. 1 </strong>');
    // var textareaPurpose = $('<textarea></textarea>').attr({'class':'form-control validate[required] textarea-purpose','placeholder':'Must be in sentence','rows':'2','name':'purposes[]','id':'purpose'+(intLastCount+1)});
    // $(divFormGroupPurpose).append(deleteSpan,labelPurpose,textareaPurpose);
    // $(divColPurpose).append(divFormGroupPurpose);
    // var rowPurpose = $('#editPurposesForm .row-purposes');

    var htmlfield ='<div class="purposes_wrapper"><div class="form-group"><a id="btn-remove" class="customDeleleBtn purposeRemoveBtn float-left text-danger"><i class="fas fa-minus-circle btn-delete"></i></a><label for="'+ textarea_id+'"><strong>Purpose No.</strong></label><textarea class="form-control validate[required] textarea-purpose" id="'+textarea_id+'" name="'+array_name+'" placeholder="Must be in sentence" rows="2"> </textarea></div></div>';
    $(division).prepend(htmlfield);
    // $( ".col-purpose:nth-child(2)").find('.form-group').prepend(deleteSpan);
    $(html_lable).each(function(index){
      $(this).siblings('label').html("<strong>Purpose No. " + (index+1) + "</strong>");
    });

     $(".purposeRemoveBtn").on('click',function(){
      // $(this).parent().parent().remove();
   
      $(this).closest('div').remove();
      $(html_lable).each(function(index){
      $(this).siblings('label').html("<strong>Purpose No. " + (index+1) + "</strong>");
      });
    }); //end delete


  });
});
