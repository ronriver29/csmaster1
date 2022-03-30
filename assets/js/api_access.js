$(function(){



	 $('input[name=switchbtn]').click(function(){ 	
	 	var cb = $(this);
	 	var table = $(this).val();
	    if(cb.is(':checked'))
        {
        	var id=1;
        }
        else
        {
        	id =0;
        }
       		 $.ajax({
                type : "POST",
                url  : "api_access/update_access",
                dataType: "json",
                data:{id:id,table:table},
                success: function(data){
                 console.log(data);
                }
            });
    	
     });
        
	
	
});