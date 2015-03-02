$(document).ready(function(){
	
	$('.default').blur(function(){
		var self = this;
		
		$.post( 
				'/serviceportal/Users/validate_form',
				{field:$(this).attr('id'),value:$(this).val()
				},
				function(error){                      
					
					//alert($(this).val())
					handleNameValidation(error,self)
					
				}
			);
			function handleNameValidation(error,el){
				 var $parent = $(el).parent();
					if(error.length>0){
							if($('span.error-message',$parent).length==0){
							$parent.append('<span class="error-message">'+ error + '</span>');
							}
							else{
								 $('span.error-message',$parent).replaceWith('<span class="error-message">'+ error + '</span>');
							}
					}
					else{
						 $parent.removeClass('error-message');
						 $('span.error-message',$parent).fadeOut();
					}
			}
	});
	

	
	/*$('form').submit(function(e){	
		var valid = 1;
		var checkValidation = '';
		var err=0;
		var cnt=0;
		$('.default').each(function(){
			
			var self = this;
			
				$.post( 
					'/serviceportal/Users/validate_form',
					{field:$(this).attr('id'),value:$(this).val()
					},
					function(error){
						cnt++;
						
						if($.trim(error)!='')
						{	
							valid = 0;
							handleNameValidation(error,self);
							
								
						}
						
							
					}
				);
				function handleNameValidation(error,el){
					 var $parent = $(el).parent();
					
						if(error.length>0){
					 	err++;	
								if($('span.error-message',$parent).length==0){
								$parent.append('<span class="error-message">'+ error + '</span>');
									
								}
								
						}
						else{
							 $parent.removeClass('error-message');
							 $('span.error-message',$parent).fadeOut();
							 
						}
						
				}			
		});
		setTimeout(function(){
			if(cnt==13 && valid !=0){
					return true;	
				}else if(cnt==0){
					e.preventDefault();
					return false;
					
				}
			
			
			}, 3000);		
		
		//alert(valid)
		e.preventDefault();
		//if(valid==0)
			//return false;
		//e.preventDefault();
		//if(err==0)
//		{
//			if(cnt!=13){
//				return false;
//				
//			}
//		}
		
		
	});	*/
});
