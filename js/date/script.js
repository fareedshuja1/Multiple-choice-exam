// JavaScript Document

$(document).ready(jQueryCodeOfReady);
// All jquery functions are ready ti use
function jQueryCodeOfReady() {
     // Wehen page need to laod using data
	function serverCall(url,data,tag) {

		// jquery ajax function
		$.ajax(
		         {
					type:"POST",
					url:url,
					data:data,
					success:function(result)
					                        {
			                                  $(tag).html(result);// display result in targeted path
			                                }
			       }			  
			  );
	}
	
	// Wehen page need to laod

	function loadPage(url,tag) {
		// Jquery function
		$.ajax(
		         {
					url:url,
					success:function(result)
					                        {
			                                   $(tag).html(result); // display result in targeted path	
			                                }
			       }			  
			  );	

	}
	
	
	
    $("#era").change(function() {
	
                    var id=$(this).val();

                    var dataString = 'id='+ id;
                    $.ajax(
                      {
                        type: "POST",
                        url: "./app/antique/period_king.php",
                        data: dataString,
                        cache: false,
                        success: function(html){
                                                 $("#king").html(html);
                                               } 
                      }
                  );
    }
               );	
			   
	
	$("#csearch").change(function() {
	
                    var val=$(this).val();
					
					if(val == "status"){
						
						$("#kw").hide();
						$("#status").show();
						
					}else{
						$("#status").hide();
						$("#kw").show();
					}
 
                   
    }
               );			      
	
  

    $("#add").click(function(e){
		
	e.preventDefault();
		
	var url = $(this).attr("href");
	var tag = $(this).attr("target");
	
	loadPage(url,tag);
	
   });
   
   
   $(".update_photo").click(function() {
	
                    var id=$(this).attr('id');
                    var aid=$(this).attr('name');
					var acc=$(this).attr('rel');
					
                    var dataString ='id='+id+'&aid='+aid+'&acc='+acc;
                    $.ajax(
                      {
                        type: "POST",
                        url: "./app/antique/antique_photo.php",
                        data: dataString,
                        cache: false,
                        success: function(html){
                                                 $("#response").html(html);
                                               } 
                      }
                  );
    }
               );
			   
  

    $.validator.addMethod("lettersonly",function(value, element){return this.optional(element) || /^[a-z ]+$/i.test(value);}, "Must Contain Only Letters!");
 
    $.validator.addMethod("ldigitsonly",function(value, element){return this.optional(element) || /^[0-9.]+$/i.test(value);}, "Must Contain Only Digits!");
   
    $("#myform").validate();

    $("#myform").submit(function(){
		
                                   $("#myform").valid();
                                  }
	                   );
 
   
  
}




	
	
	
	
	





