<div class="job-finder"><!-- start job finder -->
	<div class="container">
		<h3>Search Market</h3>
		<?php 
		echo $this->Form->create('Page',array('action'=>'search_marketplace','type' => 'get','url' => array('controller' => 'pages', 'action' => 'search_marketplace')));
		?>
			
			<div class="col-md-5 form-group group-1">
			<?php 	
				echo $this->Form->input('searchjob',array('id'=>'searchjob','placeholder'=>'Type Keywords Here (eg: Electrician, Plumber, Carpenter...)','label' => array('text'=> 'Looking for','class' =>'label'),'class'=>'input-job'));
				?>
			</div>
            
			<div class="col-md-6 form-group group-2">
				<?php 	
				echo $this->Form->input('searchplace',array('id'=>'searchplace','placeholder'=>'Type Name of the places (eg: New Baneshower, Kupondole, Maharajgunj, Jawalakhel...)','label' => array('text'=> 'Location','class' =>'label'),'class'=>'input-location'));
				?>
			</div>
			
			<div class="col-md-1 form-group group-3">
				<?php  echo $this->Form->button('search',array('type'=>'submit','class'=>'btn btn-default btn-green btn-search'));?>
			</div> 
			 
		<?php echo $this->Form->end(); ?>
	</div>
</div><!-- end job finder -->

<?php //debug($getPlace);die;
echo $this->Html->script('jquery.tokeninput');
echo $this->Html->css('token-input');
?>
<script type="text/javascript">
        $(document).ready(function() {
          
		 
			$("#searchplace").tokenInput(<?php  echo json_encode($getPlace)?>, {
                theme: "facebook",
                placeholder: 'Type name of the places ( eg: New Baneshower, Kupondole, Maharajgunj etc. )',
				preventDuplicates: true,
				noResultsText: "No results",
			  	prePopulate : <?php echo json_encode($placeDistrict)?>
            });
			
			$("#searchjob").tokenInput(<?php echo json_encode($getSearchjob)?>, {
                theme: "facebook",
				placeholder:"Type keywords here (eg: Electrician, Plumber, Carpenter...)",
				preventDuplicates: true,
				tokenLimit : 1,
			  	prePopulate : <?php echo json_encode($job)?>,
				onResult: function (item) {
							if($.isEmptyObject(item)){
								  return [{id:$("#token-input-searchjob").val(),name: $("#token-input-searchjob").val()}]
							}else{
								  item.unshift({id:'0', name: $("#token-input-searchjob").val()});
								  return item
							}
					
						},
	
            });
			
        });
</script>