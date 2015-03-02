<?php 
$manualLimit = isset($this->request->data['User']['document_count'])?$this->request->data['User']['document_count']:'0';

?>
<script>
$(function() {
	
	$('#document_count').val('<?php echo $manualLimit?>');
	
	
	
	$('#document-button').click(function(event){
				
		var documentCount = parseInt($('#document_count').val())+1;
		var inputHtml = '<div class="input text"><label for="UserDocumentId2">Document Title</label><input id="UserDocumentId2" type="text" name="data[User][document_id_'+documentCount+']"></div><div class="input file scanned"><input id="UserDocument2" type="file" name="data[User][document_'+documentCount+']"></div>';
		$('#document_count').val(documentCount);
		event.preventDefault();
		$('#document').append(inputHtml);
	});
	
	
	
});


</script>

<div class="users form">
<?php echo $this->Form->create('User', array('novalidate' => true,'type'=>'file')); ?>
	<fieldset>
		<legend><?php echo __('Add Company'); ?></legend>
	<?php
		echo $this->Form->input('company_name',array('id'=>'company_name','label'=>'Company Name','class'=>'default'));
		echo $this->Form->input('email',array('id'=>'email','label'=>'Email Address','class'=>'default'));
				
		echo $this->Form->input('identifier',array('id'=>'identification','class'=>'default','empty'=>'<--Select-->','options'=>array('PAN No.'=>'PAN No.','VAT No.'=>'VAT No.','citizenship'=>'Citizenship','work Permit'=>'Work Permit')));
		echo $this->Form->input('identification_number',array('id'=>'identification_number','class'=>'default'));
		
		
		echo $this->Form->input('company_registration_number',array('id'=>'company_registration_number','class'=>'default'));
		echo $this->Form->input('permanent_address',array('id'=>'permanent_address','class'=>'default'));
		echo $this->Form->input('temporary_address',array('id'=>'temporary_address','class'=>'default'));
		
		//echo $this->Form->input('place',array('id'=>'facebook-theme','class'=>'default','div'=>array('class'=>'input text required')));?>
        
         <a href="#place-form" id="place-popup" >Add Place</a>	
		 <!--<div id="load-place">	-->
        <?php //echo $this->requestAction('admin/users/load_place');
		echo $this->Form->input('place',array('id'=>'facebook-theme','class'=>'default','div'=>array('class'=>'input text required')));?>
        <!--</div>-->
        <?php
		
		echo $this->Form->input('ward_number',array('id'=>'ward_number','type'=>'text','class'=>'default'));
		
		
		echo $this->Form->input('country_id',array('empty'=>'<--Select-->','options'=>$country,'id'=>'country_id','class'=>'default'));
		echo $this->Form->input('city',array('id'=>'city','class'=>'default','empty'=>'<--Select-->','options'=>array('kathmandu'=>'Kathmandu','bhaktapur'=>'Bhaktapur','lalitpur'=>'Lalitpur','kavre'=>'Kavre')));
		/*echo $this->Form->input('citizenship_number',array('id'=>'citizenship_number','class'=>'default'));
		echo $this->Form->input('passport_number',array('id'=>'passport_number','class'=>'default'));*/
		echo $this->Form->input('primary_phone',array('id'=>'primary_phone','class'=>'default'));
		echo $this->Form->input('secondary_phone',array('id'=>'secondary_phone','class'=>'default'));
			
		echo $this->Form->input('contact_person',array('id'=>'contact_person','class'=>'default'));
		echo $this->Form->input('designation',array('id'=>'designation','class'=>'default'));
		//echo $this->Form->input('phone',array('label'=>false,'label'=>'Mobile number','id'=>'phone','class'=>'default'));
		//echo $this->Form->input('expertise_level',array('empty'=>'<--Select-->','options'=>array('expert'=>'Expert','intermediate'=>'Intermediate','basic'=>'Basic'),'id'=>'expertise_level','class'=>'default'));
		echo $this->Form->input('profile_image',array('type'=>'file','id'=>'profile_image','class'=>'default'));
		echo $this->Form->input('about_me', array('type' => 'textarea','id'=>'about_me','class'=>'default', 'escape' => false));
		
		$i =0;
		foreach($ratePackages as $rate):
			$i++;
			//echo 'Per '.$rate['RatePackage']['title'];
			echo $this->Form->input('rate_'.$i,array('label'=>'Per '.$rate['RatePackage']['title'].' Rate in NRs'));
			echo $this->Form->hidden('rate_id_'.$i, array('value'=>$rate['RatePackage']['id']));
		endforeach;
		//count $ratePackages
		echo $this->Form->hidden('rate_count',array('value'=>count($ratePackages)));
		echo '<div id="document">';
		
		echo '<h4><b>Scanned Documents </b>(e.g. citizenship, passport, certficates)</h4>';
		for($j=1;$j<=$manualLimit;$j++){
			echo '<div>';
			echo $this->Form->input('document_id_'.$j,array('label'=>'Document Title'));
			echo $this->Form->input('document_'.$j,array('type'=>'file','label'=>'Choose a file'));
			echo '</div>';
		}
		echo '</div>';
		echo $this->Form->hidden('document_count',array('id'=>'document_count','value'=>$manualLimit));
		echo $this->Form->button('ADD DOCUMENT', array('type' => 'button','id'=>'document-button'));
   		//echo $this->Form->input('category', array('multiple'=>'checkbox','options'=>$serviceCategories,'id'=>'category','class'=>'default'));?>
         <?php
		echo '<div class="input checkbox required"><label>Service Categories</label>';?>
		<a href="#category-form" id="category-popup" class="btn btn-default btn-blue btn-sm category-popup">Add Category</a>
		<div id="load-category">
        <?php
		 echo $this->requestAction('admin/users/load_category');?>
        </div>	
        <?php echo '</div>';?>
        <?php
		//echo '<div class="input checkbox required"><label>Service Categories</label>';?>
		<!--<a href="#category-form" id="category-popup" class="btn btn-default btn-blue btn-sm category-popup">Add Category</a>-->
		<?php //echo '<ul class="categories">';
		//echo $this->SmartForm->RecursiveCategories($serviceCategories);
		//echo '</ul></div>';
		
		//echo $this->Form->hidden('category_count',array('value'=>$countServiceCategory));
		//echo '<div>';
		
		echo '<div class="input select inline-select">';			
		echo $this->Form->input('year_of_experience',array('div'=>false,'label'=>false,'label'=>'Years of experience in current occupation :','empty'=>'<--Select Year-->','options'=>array_combine(range(1,20),range(1,20))));
		echo $this->Form->input('month_of_experience',array('empty'=>'<--Select Month-->','options'=>array_combine(range(1,11),range(1,11)),'div'=>false,'label'=>false));
		echo '</div>';	
				
		echo $this->Form->input('additional_experience',array('label'=>'Additional Experiences in related field.(Only enter the services, that you can provide, with comma seperation)','type'=>'textarea','id'=>'additional_experience','class'=>'default'));
		echo $this->Form->input('do_you_work_alone',array('label'=>false,'label'=>'Do you work alone?    If no, list your partners and their expertise','type'=>'textarea','id'=>'do_you_work_alone','class'=>'default'));
	?>
   
    
 
	</fieldset>
   
<?php echo $this->Form->end(__('Submit')); ?>
<!--<input type="submit" value="1" name="submit" />
<input type="button" value="Submit" id="submit" />
</form>-->

</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'admin_provider_index')); ?></li>
	</ul>
</div>

 <?php echo $this->element('ajax_category_add');?>
 
 <?php echo $this->element('ajax_place_add');?>
 
 

      
 <?php
echo $this->Html->script('jquery.tokeninput');
echo $this->Html->css('token-input-facebook');
?>
<?php  //$url="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>      
             
<script type="text/javascript">
        $(document).ready(function() {
			  $("#facebook-theme").tokenInput('<?php echo SITE_URL.'admin/users/refresh_place'?>' ,{
                theme: "facebook",
				preventDuplicates: true,
				tokenLimit : 1
            });


        });
        </script>

