<?php //debug($user);die;
if(isset($user['User']['id'])){
	$user = SITE_URL.'admin/users/load_place/'.$user['User']['id'];
}else{
	$user = SITE_URL.'admin/users/load_place';
}?>

<?php $district = $this->SmartForm->getDistrict();
 ?>

<div id="place-form" class="mfp-hide white-popup-block">

	 <div class="modal-header">
        <button type="button"  class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        
      <span id="loading_text"></span>
      <div class="modal-body">
	<?php //debug($district);
		echo $this->Form->input('district_id',array('id'=>'district_id','empty'=>'Select','options'=>$district));
		echo $this->Form->input('place_1',array('id'=>'place_1'));
		
		echo $this->Form->button('add_place',array('id'=>'add_place','class'=>array('btn btn-default btn-green')));
		echo $this->Form->button('cancel',array('onclick'=>'$.magnificPopup.close()','class'=>array('btn btn-default btn-green')));
		?>
        </div>
      </div>
         
    
  
 
<script type="text/javascript">
        $(document).ready(function() {
        
		
			//addplace	
			
			 $('#place-popup').magnificPopup({
				type: 'inline',
				preloader: false,
				modal: true
			});
				$(document).on('click', '.close', function (e) {
					$('#district_id').val('');
					$('#place_1').val('');
					$('#loading_text').hide();
					$('#errmsg').hide();
					
				e.preventDefault();
				$.magnificPopup.close();
			});
			
			
			
			$("#add_place").click(function(e){
			  var district_id=$('#district_id').val();
			  var place_name=$('#place_1').val();
			  
			  $('#add_place').prop('disabled', true);
			  			  
			   $('#loading_text').prepend('<span style="color:red;">Please wait ...</span>');

						
						 $.ajax({
						  type: "POST",
						  url: '<?php echo SITE_URL.'admin/places/place_add'?>',
						  data: ({id: district_id,name: place_name}),
					      success:  function(data){
							   if(data=='1'){
								   $('#place_1').after( $('#errmsg').html('<span style="color:red;">Please select district and enter place name</span>'));
								   
								$('#add_place').prop('disabled', false);
								  $('#loading_text').hide();
							   }else{
								   				
												$('#add_place').prop('disabled', false);
												$('#district_id').val('');
												$('#place_1').val('');
												 $('#loading_text').hide();
												 $('#errmsg').hide();
												$.magnificPopup.close();
								   
								   /* $.ajax({
											type: "GET",
											url: '<?php //echo SITE_URL.'admin/users/refresh_place'?>',
											
											success: function(data){
												$('#get_place').val(data);
												
											    }
											});*/
									
								   //window.location.reload(true);
								 }
						  		}
							
							});
							
					
				
				e.preventDefault();	 
			});		
		        					
			
		});
		
        </script>