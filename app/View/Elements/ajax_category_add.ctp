<?php //debug($user);die;
if(isset($user['User']['id'])){
	$user = SITE_URL.'admin/users/load_category/'.$user['User']['id'];
}else{
		$user = SITE_URL.'admin/users/load_category';
}?>

<div id="category-form" class="mfp-hide white-popup-block">

	 <div class="modal-header">
        <button type="button"  class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <span id="loading_text"></span>
      <div class="modal-body">
	<?php echo $this->Form->input('parent_id',array('id'=>'parent_id'));
		echo '<span id="errmsg"></span>';
		echo $this->Form->input('title',array('id'=>'category-title'));
		echo $this->Form->input('range_1',array('id'=>'range_1'));
		echo $this->Form->input('range_2',array('id'=>'range_2'));
		echo $this->Form->button('add_category',array('id'=>'add_category','class'=>array('btn btn-default btn-green')));
		echo $this->Form->button('cancel',array('onclick'=>'$.magnificPopup.close()','class'=>array('btn btn-default btn-green')));
		?>
	
      </div>
      
      </div>
        

    
 
<script type="text/javascript">
       
        $(document).ready(function() {
        
			//category
			$('#category-popup').magnificPopup({
				type: 'inline',
				preloader: false,
				modal: true
			});
			$(document).on('click', '.close', function (e) {
				
				$('#parent_id').val('');
				$('#category-title').val('');
				$('#range_1').val('');
				$('#range_2').val('');
				$('#loading_text').hide();
				$('#errmsg').hide();
				
				e.preventDefault();
				$.magnificPopup.close();
			});
			
			
			
			$("#add_category").click(function(e){
			  var category_parent_id=$('#parent_id').val();
			 	//alert(category_parent_id);
			  var cat_title=$('#category-title').val();
			  
			  var cat_id_1=$('#range_1').val();
			  //alert(cat_id_1);
			  
			  var cat_id_2=$('#range_2').val();
			  //alert(cat_id_2);
			  
			  
			  $('#add_category').prop('disabled', true);
			  
			  $('#loading_text').prepend('<span style="color:red;">Please wait ...</span>');
						
						 $.ajax({
						  type: "POST",
						  url: '<?php echo SITE_URL.'admin/service_categories/category_add'?>',
						  data: ({id: category_parent_id,cat_title: cat_title,range_1:cat_id_1,range_2:cat_id_2}),
					      success:  function(data){
							   if(data=='1'){
								   $('#category-title').after( $('#errmsg').html('<span style="color:red;">Please enter category and range value</span>')); 
								   
								$('#add_category').prop('disabled', false);
								   $('#loading_text').hide();
								   
							   }else{
								   $('#add_category').prop('disabled', false);
												 $('#loading_text').hide();
												$.magnificPopup.close();
								   
								    $.ajax({
											type: "GET",
											url: "<?php echo  $user?>",
											
											success: function(data){
												$('#load-category').html(data);
												$('#add_category').prop('disabled', false);
												$('#parent_id').val('');
												$('#category-title').val('');
												$('#range_1').val('');
												$('#range_2').val('');
												 $('#loading_text').hide();
												 $('#errmsg').hide();
												$.magnificPopup.close();
											    }
											});
									
								   //window.location.reload(true);
								 }
						  		}
							
							});
							
					
				
				e.preventDefault();	 
			});
			
 });
		
		
        </script>
 
