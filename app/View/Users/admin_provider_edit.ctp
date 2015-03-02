<?php
echo $this->Html->script('jquery.tokeninput');
echo $this->Html->css('token-input-facebook');
?>
<?php 
$manualLimit = isset($this->request->data['User']['document_count'])?$this->request->data['User']['document_count']:'0';

//debug($manualLimit);die;
?>
<script>
$(function() {
	
	$('#document_count').val('<?php echo $manualLimit?>');
	
	
	
	$('#document-button').click(function(event){
				
		var documentCount = parseInt($('#document_count').val())+1;
		var inputHtml = '<div class="input text"><label for="UserDocumentId2">Document Title</label><input id="UserDocumentId2" type="text" name="data[User][document_id_'+documentCount+']"></div><div class="input file"><input id="UserDocument2" type="file" name="data[User][document_'+documentCount+']"></div>';
		$('#document_count').val(documentCount);
		event.preventDefault();
		$('#document').append(inputHtml);
	});
	

	
});


</script>

<div class="users form">
<?php echo $this->Form->create('User', array('novalidate' => true,'type'=>'file')); ?>
	<fieldset>
		<legend><?php //debug($user);die;
		echo __('Edit Provider Profile'); ?></legend>
         <?php if(file_exists(WWW_ROOT.'providers_photo/'.$user['User']['profile_photo'])&&!empty($user['User']['profile_photo'])){ 
			 echo $this->Html->image('/providers_photo/'.$user['User']['profile_photo'],array('width'=>140,'height'=>'100','alt'=>'Profile_picture'));
			}else{ 
				echo $this->Html->image('avatar.gif',array('width'=>140,'height'=>'100','alt'=>'No Image')) ;
		 }?>
        
		<?php  
		//echo $this->Form->PostLink(__('Remove Photo'),array('action' => 'remove_picture',$user['User']['id']),null,__('Are you sure you want to delete # %s?',$user['User']['profile_photo'])); ?>
	<?php  	            
	  		
		//echo $this->Html->image('/providers_photo/'.$user['User']['profile_photo'],array('width'=>140,'height'=>'100','alt'=>'Profile_pic'));
        //echo $this->Html->link(__('Edit photo'), array('action' => 'provider_pic_edit', $user['User']['id']));
		echo $this->Form->input('profile_image',array('type'=>'file','id'=>'profile_image','label'=>'profile photo','class'=>'default'));
		echo $this->Form->hidden('profile_photo',array('value'=>$user['User']['profile_photo']));
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('id'=>'name','class'=>'default'));
		echo '<div class="input text">';
		echo '<label for="DateOfBirthNepali">Date of Birth (B.S)</label>';
			echo $this->SmartForm->nepaliDate('data[User][dob_nepali]',$user_details['User']['dob_nepali']);	
		echo '</div>';
			
		echo $this->Form->input('dob_english',array('id'=>'dob_english','label'=>'Date of Birth (A.D)','class'=>'default', 									'minYear' => 1940,'maxYear' => date('Y'),'empty'=>array('month'=>'Month','day'=>'Day','year'=>'Year')));
		
		echo $this->Form->input('identifier',array('id'=>'identification','class'=>'default','empty'=>'<--Select-->','options'=>array('citizenship'=>'Citizenship','passport'=>'Passport','work Permit'=>'Work Permit','voting Card'=>'Voting Card')));
		echo $this->Form->input('identification_number',array('id'=>'identification_number','class'=>'default'));
		
		echo $this->Form->input('Involved_company',array('id'=>'Involved_company','class'=>'default'));
		$type=array('1'=>'Public','0'=>'Private');
		echo $this->Form->input('profile_visibility',array('empty'=>'<--Select-->','options'=>$type,'id'=>'profile_visibility','class'=>'default'));
		
		echo $this->Form->input('permanent_address',array('id'=>'permanent_address','class'=>'default'));
		echo $this->Form->input('temporary_address',array('id'=>'temporary_address','class'=>'default'));
		
		echo $this->Form->input('ward_number',array('id'=>'ward_number','type'=>'text','class'=>'default'));
		//echo $this->Form->input('place',array('id'=>'facebook-theme','class'=>'default','div'=>array('class'=>'input text required')));?>
        
         <a href="#place-form" id="place-popup" >Add Place</a>
        <!--<div id="load-place">-->
        <?php //echo $this->requestAction('admin/users/load_place');
		echo $this->Form->input('place',array('id'=>'facebook-theme','class'=>'default','div'=>array('class'=>'input text required')));?>
        <!--</div>-->
        <?php 
		echo $this->Form->input('country_id',array('empty'=>'<--Select-->','options'=>$country,'id'=>'country_id','class'=>'default'));
		echo $this->Form->input('city',array('id'=>'city','class'=>'default','empty'=>'<--Select-->','options'=>array('kathmandu'=>'Kathmandu','bhaktapur'=>'Bhaktapur','lalitpur'=>'Lalitpur','kavre'=>'Kavre')));
		//echo $this->Form->input('passport_number',array('id'=>'passport_number','class'=>'default'));
		echo $this->Form->input('primary_phone',array('id'=>'primary_phone','class'=>'default'));
		echo $this->Form->input('secondary_phone',array('id'=>'secondary_phone','class'=>'default'));
			
		//echo $this->Form->input('phone',array('label'=>false,'label'=>'Mobile number','id'=>'phone','class'=>'default'));
		echo $this->Form->input('expertise_level',array('empty'=>'<--Select-->','options'=>array('expert'=>'Expert','intermediate'=>'Intermediate','basic'=>'Basic'),'id'=>'expertise_level','class'=>'default'));
		echo $this->Form->input('about_me', array('type' => 'textarea','id'=>'about_me','class'=>'default', 'escape' => false));
		
		$i =0;
		foreach($ratePackages as $rate):
			$i++;
			//echo 'Per '.$rate['RP']['title'];
			echo $this->Form->input('rate_'.$i,array('label'=>'Per '.$rate['RP']['title'].' Rate in NRs','value' => $rate['SPR']['rate']));
			echo $this->Form->hidden('rate_id_'.$i, array('value'=>$rate['RP']['id']));
		endforeach;
		//count $ratePackages
		echo $this->Form->hidden('rate_count',array('value'=>count($ratePackages)));
		//echo '<b>Scanned Documents </b>(e.g. citizenship, passport, certficates)';	
			$i=0;
			//debug($documents);
			foreach($document as $doc):
					$i++;
					echo $this->Form->input('doc_title_'.$i,array('value' => $doc['SPD']['title'],'label'=>false,'label'=>'Document Title'	));
					echo $this->Form->input('doc_name_'.$i,array('type'=>'file','label'=>false));
					echo $this->Form->hidden('doc_id_'.$i,array('value'=>$doc['SPD']['id']));
					echo $this->Form->hidden('user_id_'.$i,array('value'=>$doc['SPD']['user_id']));
					echo $this->Form->hidden('doc_name_'.$i,array('value'=>$doc['SPD']['document_file']));
					echo $this->Html->image('/providers_document/'.$doc['SPD']['document_file'],array('width'=>140,'height'=>'100'));	 					
					echo $this->Form->hidden('document_file');
					
			endforeach;
			echo $this->Form->hidden('doc_count',array('value'=>count($document)));
			
		//debug($manualLimit);die;	
		echo '<div id="document">';
		echo '<h4><b>Scanned Documents </b>(e.g. citizenship, passport, certficates)</h4>';
		
		for($j=1;$j<=$manualLimit;$j++){
		
			echo '<div>';
				echo $this->Form->input('document_id_'.$j,array('label'=>false,'label'=>'Document Title'));
				echo $this->Form->input('document_'.$j,array('type'=>'file','label'=>false));
			
			echo '</div>';
			
		}
		echo '</div>';
		//debug($count);die;
		echo $this->Form->hidden('document_count',array('id'=>'document_count','value'=>$manualLimit));
		echo $this->Form->button('ADD DOCUMENT', array('type' => 'button','id'=>'document-button'));
   		//echo $this->Form->input('category', array('multiple'=>'checkbox','options'=>$serviceCategories,'id'=>'category','class'=>'default'));
		//echo '<div class="input checkbox required"><label>Service Categories</label>';?>
        
		<!--<a href="#category-form" id="category-popup" class="btn btn-default btn-blue btn-sm category-popup">Add Category</a>-->
		<?php /*echo '<ul class="categories">';
		echo $this->SmartForm->RecursiveCategories($serviceCategories,$checkedArray);
		echo '</ul></div>';
*/?>
		  <?php
		echo '<div class="input checkbox required"><label>Service Categories</label>';?>
		<a href="#category-form" id="category-popup" class="btn btn-default btn-blue btn-sm category-popup">Add Category</a>
		<div id="load-category">
        <?php
		 echo $this->requestAction('admin/users/load_category/'.$user['User']['id']);?>
        </div>	
        <?php echo '</div>';?>		
		
		<?php echo '<div class="input select inline-select">';
		echo $this->Form->input('year_of_experience',array('div'=>false,'label'=>false,'label'=>'Years of experience in current occupation :','empty'=>'<--Select Year-->','options'=>array_combine(range(1,20),range(1,20))));
		echo $this->Form->input('month_of_experience',array('empty'=>'<--Select Month-->','options'=>array_combine(range(1,11),range(1,11)),'div'=>false,'label'=>false));
		echo '</div>';
		
		echo $this->Form->input('additional_experience',array('label'=>'Additional Experiences in related field.(Only enter the services, that you can provide, with comma seperation)','type'=>'textarea','id'=>'additional_experience','class'=>'default'));
		echo $this->Form->input('do_you_work_alone',array('label'=>false,'label'=>'Do you work alone?    If no, list your partners and their expertise','type'=>'textarea','id'=>'do_you_work_alone','class'=>'default'));
	?>
	</fieldset>
	
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'admin_provider_index')); ?></li>
	</ul>
</div>


 <?php echo $this->element('ajax_category_add');?>
 
 <?php echo $this->element('ajax_place_add');?>

 
 
 <?php //echo json_encode($getPlace )
 //$url="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
 //debug($url);die;
 //echo json_encode($getPlace );?>
 
<script type="text/javascript">
	  $(document).ready(function() {
		 
		  $("#facebook-theme").tokenInput('<?php echo SITE_URL.'admin/users/refresh_place'?>', {
			  theme: "facebook",
			  preventDuplicates: true,
			  tokenLimit : 1,
			  prePopulate : <?php echo json_encode($placeDistrict)?>
		  });
		  $("#Involved_company").tokenInput(<?php echo json_encode($getCompany )?>, {
                theme: "facebook",
				preventDuplicates: true,
				tokenLimit : 1,
			  	prePopulate : <?php echo json_encode($company)?>
				
            });
			

	  });
</script>