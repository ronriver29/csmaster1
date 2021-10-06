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
    // if(data_selector ==1)
    // {
      var html_lable = '#editPurposesForm textarea[name="items['+data_selector+'][content][]purposes[]"';
      var array_name = 'purposes_add[]';
      // var name =$('textarea[name="purposes1[]"');
      var division = '#type_count'+data_selector;
      var textarea_id = 'purposes1';

     var name =$('textarea[name="items['+data_selector+'][content][]purposes[]"');
     var lastCountOfPurposes = name.first().attr('id');
     var intLastCount = parseInt(lastCountOfPurposes.substr(-1));
     var htmlfield ='<div class="purposes_wrapper"><div class="form-group"><a id="btn-remove" class="customDeleleBtn purposeRemoveBtn float-left text-danger"><i class="fas fa-minus-circle btn-delete"></i></a><label for="'+ textarea_id+'"><strong>Purpose No.</strong></label></textarea><textarea class="form-control validate[required] textarea-purpose" id="'+textarea_id+'" name="items['+data_selector+'][content][]purposes[]" placeholder="Must be in sentence" rows="2"></textarea></div></div>';
    $(division).prepend(htmlfield);

    $('#editPurposesForm textarea[name="items['+data_selector+'][content][]purposes[]"').each(function(index){
      $(this).siblings('label').html("<strong>Purpose No. " + (index+1) + "</strong>");
    });
   
    
  });


     $("#editPurposesForm .purposeRemoveBtns").on('click',function(){ 
      // $(this).parent().parent().remove();
      $(this).closest('div').remove();
       // $('#editPurposesForm textarea[name="items['+data_selector+'][content][]purposes[]"').each(function(index){
       //   $(this).siblings('label').html("<strong>Purpose No. " + (index+1) + "</strong>");
       var data_selector = $(this).data("id");
       var html_lable = '#editPurposesForm textarea[name="items['+data_selector+'][content][]purposes[]"';
      $(html_lable).each(function(index){
      $(this).siblings('label').html("<strong>Purpose No. " + (index+1) + "</strong>");
       });
    }); //end delete



});
