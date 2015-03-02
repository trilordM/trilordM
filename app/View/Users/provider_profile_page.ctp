<?php echo $this->Html->css('rating/rating');?>


<?php 
$manualLimit = isset($this->request->data['User']['document_count'])?$this->request->data['User']['document_count']:'0';

?>
<script>
$(function() {
	
	$('#document_count').val('<?php echo $manualLimit?>');
	
	
	
	$('#document-button').click(function(event){
						
		var documentCount = parseInt($('#document_count').val())+1;
		var inputHtml = '<div class="input text"><label for="UserDocumentId2">Document Title</label><input id="UserDocumentId2" type="text" name="data[User][document_id_'+documentCount+']"></div><div class="input text"><label for="UserDocumentDecription2">Description</label><textarea class="form-control message" rows="8" id="UserDocumentDecription2" name="data[User][document_description_'+documentCount+']"></textarea></div><div class="input file"><input id="UserDocument2" type="file" name="data[User][document_'+documentCount+']"></div>';
		$('#document_count').val(documentCount);
		event.preventDefault();
		$('#document').append(inputHtml);
	});
	
	
	
});


</script>



<div class="main-page-title"><!-- start main page title -->
	<div class="container">
		<h3 class="job-detail-title"><?php echo h($user['User']['name']); ?>'s Profile</h3>
		<div class="recent-job-detail">
			<div class="col-md-4 job-detail-desc">
				
				<?php if(file_exists(WWW_ROOT.'providers_photo/thumbs/'.$user['User']['profile_photo'])&&!empty($user['User']['profile_photo'])){        
				 			echo $this->Html->image('/providers_photo/thumbs/'.$user['User']['profile_photo'],array('class'=>'img-responsive job-detail-logo img-rounded','alt'=>'Profile Image'));
						}else{
							echo $this->Html->image('avatar.gif',array('class'=>'img-responsive job-detail-logo img-rounded','alt'=>'No Image')) ;
						}
				?>
				
				<h5>
				<?php
					/*$i =0;
					foreach($serviceCategories as $category):
					debug($category);*/
				$serviceCategories=str_replace(",",", ",$serviceCategories[0][0]['title']);
				echo $serviceCategories;
					//endforeach;
				?>
				</h5>
				<p><?php echo h($user['User']['expertise_level']); ?></p>
				
				<div class="box-result-cnt inline-block">
				           
		            <div class="rate-result-cnt">
		                <div class="rate-bg" style="width:<?php echo $ratingCount['rating']; ?>%"></div>
		                <div class="rate-stars-green-alt"></div>
		            </div>
				
		        </div><!-- /rate-result-cnt -->

			                				
			</div>
			<div class="col-md-3 job-detail-name">
				<h6><i class="fa fa-trophy"></i><?php //debug($user);die;
					if(!empty($user['User']['year_of_experience'])){
						$experience[]= $user['User']['year_of_experience']." Year";
					}
					if(!empty($user['User']['month_of_experience'])){
						$experience[]= $user['User']['month_of_experience']." month";
					}
					if(!empty($experience)){
					$experience=implode(' & ',$experience);
					echo $experience.' of Experience';
					}?></h6>
			</div>
			<div class="col-md-2 job-detail-location">
				<h6><i class="fa fa-map-marker"></i><?php if(!empty($user_place[0][0]['PlaceName'])){
					echo h($user_place[0][0]['PlaceName']);
				}?></h6>
			</div>
                       
            
			<div class="col-md-3">
				<div class="row">
					<div class="col-md-7 job-detail-type">
						<?php  //debug('ratePackages');die;
						foreach($ratePackages as $rate):
						?>
						
							  <h6><i class="fa fa-money"></i><?php echo $rate['SPR']['rate']."/".$rate['RP']['title']; ?></h6>
						
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>

		<div class="row  job-detail">
			<div class="col-md-9">
                                  <?php if(!empty($user['User']['additional_experience'])){
							echo '<h6>ADDITIONAL EXPERIENCE</h6><p>'. $user['User']['additional_experience'].'</p>';
					}
				?>
				<h6>ABOUT ME</h6>
				<p><?php echo ($user['User']['about_me']); ?></p>
                                 <!--
                 <p><?php /*if($user['User']['registered_as']=='company'){
							if(!empty($user['User']['contact_person'])){
								echo '<h6>CONTACT PERSON</h6> <p>'.$user['User']['contact_person'].'</p>';
							}
						}*/?>
                 </p>-->
			</div>
			<!--<div class="col-md-3">
				<h6>DOCUMENTS</h6>
				<?php
					/*echo "<ul id='documents-list'>";
					foreach($user['ServiceProviderDocument'] as $document):
					echo "<li>";
					echo '<span>'.$document['title'].'</span>';
				   	echo '<span>'. $this->Html->image('/providers_document/'.$document['document_file'],array('width'=>140,'height'=>'100','alt'=>'Documents','class'=>'img-rounded')).'</span>';
				   	echo "</li>";
					endforeach;
					echo "</ul>";*/
				?>
			</div>-->
            <div class="col-md-3">
				<h6>REVIEWS</h6>
				<blockquote class="blockquote">
				<?php 
                      if(isset($review_record) && count($review_record)>0){
					?>  
                <div id="job-opening-carousel" class="owl-carousel">
						<?php  foreach($review_record as $review_records): ?>
                      <div class="item-home blockquote-content">
                            <p>
                            <?php echo substr($review_records['Review']['description'],0,120).' ...'?>
                            </p>                            
             				<footer><?php $time=$this->Time->format('F jS, Y',$review_records['Review']['review_date']);
							 echo $this->SmartForm->getUserInfo($review_records['Review']['service_seeker_id']).' , '. $time?></footer>
									
                       </div>
                     <?php endforeach; }else{?>
                      		<div class="item-home blockquote-content">
							  <p>No review available.</p>
						  </div>
                      <?php } ?>
				  </div>
				</blockquote>
			</div> <!-- end col-md-3 -->
		</div> <!-- end row -->
		
     <?php if(!empty($history_3)){?>
		<div class="row service-history">
			
			<div class="container">
				
				<div class="row">
				
					<div class="col-md-12">
						
						 <?php // if(!empty($history_3)){?>
						    <h4><?php echo __('Service Success History'); ?></h4>
						    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
						    <thead>
						    <tr>
						            <th><?php echo __('Enquired By'); ?></th>
						            <th><?php echo __('Assigned Date'); ?></th>
						            <th><?php echo __('Completed Date'); ?></th>
						            <th><?php echo __('Package');?></th>
						            <th><?php echo __('Working Days'); ?></th>
						            <th><?php echo __('Working Hours'); ?></th>
						    </tr>
						    </thead>
						    <tbody>
						    <?php  $i=1; 
						    foreach ($history_3 as $Service_history): ?>
						    <tr>
						        <td>
						        <?php //debug($history);die;
						        echo $this->SmartForm->getUserInfo($Service_history['SeekerProviderRequest']['service_seeker_id']);
						        ?></td>        
						        <td><?php echo h($Service_history['SeekerProviderRequest']['assigned_date']); ?></td>
						        <td><?php echo h($Service_history['SeekerProviderRequest']['completed_date']); ?></td>
						        <td><?php echo h($Service_history['RatePackage']['title']); ?></td>
						        <td><?php echo h($Service_history['SeekerProviderRequest']['working_days']); ?></td>
						        <td><?php echo h($Service_history['SeekerProviderRequest']['working_hour']); ?></td>
						    </tr>
		                     <?php if ($i++ == 6) break;?>
						<?php endforeach; ?>
							</tbody>
						    </table>
						    
						        <?php if($i>6){
						        echo $this->Html->link(__('View More'), array('controller'=>'SeekerProviderRequests','action' => 'provider_service_history',$Service_history['SeekerProviderRequest']['service_provider_id'],'Completed'),array('class'=>'btn btn-default btn-green btn-sm'));
								}?> 
						<?php //}?>
						
					</div> <!-- end col-md-12 -->
				
				</div> <!-- end row -->
			
            </div> <!-- end container --> 
			
		</div> <!-- end service-history row -->
        <?php }?>
		
		<div class="spacer-1">&nbsp;</div>
        
        <div class="row service-history">
        
            <div class="container">
                    
                    <div class="row">
                    
                        <div class="col-md-12">
                        
						<?php echo $this->Form->create('User', array('novalidate' => true,'type'=>'file')); ?>
							<fieldset>
								<legend><?php echo __('Upload Documents'); ?></legend>
                                
                        		<?php echo $this->Session->flash(); ?>
                                <?php 
								
                                echo '<b>Documents must be Scanned Images</b>(citizenship, passport, certficates)';
                                echo '<div id="document">';
                                for($j=1;$j<=$manualLimit;$j++){
                                    echo $this->Form->input('document_id_'.$j,array('label'=>false,'label'=>'Document Title'));
                                    echo $this->Form->input('document_description_'.$j,array('class'=>'form-control message','type'=>'textarea','label'=>'Description','rows'=>'8'));
                                    echo $this->Form->input('document_'.$j,array('type'=>'file','label'=>false));
                                }
                                echo '</div>';
                                echo $this->Form->hidden('document_count',array('id'=>'document_count','value'=>$manualLimit));
                                echo $this->Form->button('ADD DOCUMENT', array('type' => 'button','id'=>'document-button')); ?>
                                
							</fieldset>
     							<?php  echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-default btn-green'));?>
                            
                            	<?php echo $this->Form->end(); ?>
                        </div> 
                    </div>
          		</div>
		</div>
    
    
</div> <!-- End main page title -->
