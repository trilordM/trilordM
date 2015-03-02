<div class="col-md-9 col-xs-12 right-column">
    <?php echo $this->Session->flash(); ?>
		<h3 class="job-detail-title"><?php echo h($user['User']['name']); ?>'s Profile</h3>
		<div class="row">
			
			<div class="col-md-2">
				<?php if(file_exists(WWW_ROOT.'seekers_photo/thumbs/'.$user['User']['profile_photo'])&&!empty($user['User']['profile_photo'])){ 
				 			echo $this->Html->image('/seekers_photo/thumbs/'.$user['User']['profile_photo'],array('class'=>'img-responsive job-detail-logo img-rounded','alt'=>'Profile_pic'));
				}else{ 
							echo $this->Html->image('avatar.gif',array('class'=>'img-responsive job-detail-logo img-rounded','alt'=>'No Image')) ;
				}
				?>
				<?php 
				 echo $this->Html->link(__('Edit profile pic'), array('action' => 'seeker_pic_edit'),array('class'=>'btn btn-default btn-green btn-sm'));
				 ?>
			</div> <!-- end col -->
			
			<div class="col-md-10">
				
				<ul class="meta-job-detail">
					<li><i class="fa fa-user"></i><?php echo h($user['User']['username']); ?></li>
					<li><i class="fa fa-envelope"></i><?php echo h($user['User']['email']); ?></li>
					<li><i class="fa fa-phone"></i><?php echo h($user['User']['primary_phone']); ?></li>
					<li><i class="fa fa-map-marker"></i><?php echo h($user['User']['permanent_address']).'&nbsp;(Per)'; ?> <?php echo '/ '. h($user['User']['temporary_address']).'&nbsp;(Temp)'; ?></li>
				</ul>
                
                <ul class="meta-job-detail">
					<li>Total Deposit : NRs <?php echo h($getDepositDetail['TotalDeposit']); ?></li>
					
					<li>Available Balance : NRs <?php echo h($getDepositDetail['RemainBalance']); ?></li>
                    <li>Used Balance : NRs <?php echo h($getDepositDetail['UsedBalance']); ?></li>
					<li>Freezed Balance : NRs <?php echo h($getDepositDetail['FreezedAmount']); ?></li>
				</ul>
				
			</div> <!-- end col -->
		
		</div> <!-- end row -->

		<div class="spacer-1">&nbsp;</div>
	</div>
</div> <!-- end main-page-title -->

<div class="container job-detail">
	<div class="spacer-1">&nbsp;</div>
	<div class="row">
		<div class="col-md-12">
			
			<?php if(!empty($history_1)){?>
			<div>
			    <h6><?php echo __('New Service Request History'); ?></h6>
			    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
			    <thead>
			    <tr>
			            <th><?php echo __('Service provider'); ?></th>
			            <th><?php echo __('Requested Date'); ?></th>
			            <th><?php echo __('Description'); ?></th>
			           <!-- <th><?php //echo __('Rate Package'); ?></th>
			            <th><?php //echo __('Rate'); ?></th>
			            <th><?php //echo __('Working Hours'); ?></th>
			            <th><?php //echo __('Working Days'); ?></th>-->
                        <th><?php echo __('Action'); ?></th>
			    </tr>
			    </thead>
			    <tbody>
			    <?php $j=1;
			    foreach ($history_1 as $Service_history): ?>
			    <tr>
			        <td>
			        <?php //debug($Service_history);die;
			        echo $this->SmartForm->getUserInfo($Service_history['SeekerProviderRequest']['service_provider_id']);
			        ?></td>        
			        <td><?php echo h($Service_history['SeekerProviderRequest']['requested_date']); ?></td>
			        <td ><?php echo substr($Service_history['SeekerProviderRequest']['description'],0,50).'...'; ?></a>
					</td>
                    
			       <!-- <td><?php //echo h($Service_history['RatePackage']['title']); ?></td>
			        <td><?php //echo h($Service_history['SeekerProviderRequest']['rate']); ?></td>
			        <td><?php // echo h($Service_history['SeekerProviderRequest']['working_hour']); ?></td>
			        <td><?php //echo h($Service_history['SeekerProviderRequest']['working_days']); ?></td>-->
                    <td ><?php	echo $this->Form->postLink(__('Cancel'), array('controller'=>'SeekerProviderRequests','action' => 'cancel_request',$Service_history['SeekerProviderRequest']['id']),array('class'=>'btn-view-job btn-red'));?></td>
			    </tr>
                <?php if ($j++ == 6) break;?>
				<?php endforeach; ?>
				</tbody>
			    </table>
			    
			    <td class="actions"> 
			        <?php if($j>6){
			        echo $this->Html->link(__('View More'), array('controller'=>'SeekerProviderRequests','action' => 'service_history','New'),array('class'=>'btn btn-default btn-green btn-sm'));
					}?> 
			        </td>
			        <!--<td class="actions">
			     </td>-->
			</div>
			<?php }?>
			
			<?php if(!empty($history_2)){?>
			 <div>
			    <h6><?php echo __('Assigned Service Request History'); ?></h6>
			    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
			    <thead>
			    <tr>
			            <th><?php echo __('Service provider'); ?></th>
			            <th><?php echo __('Requested Date'); ?></th>
			            <th><?php echo __('Description'); ?></th>
			            <th><?php echo __('Assigned Date'); ?></th>
			        <!--<th><?php //echo __('Rate Package'); ?></th>
			            <th><?php //echo __('Rate'); ?></th>
			            <th><?php //echo __('Working Hours'); ?></th>
			            <th><?php //echo __('Working Days'); ?></th>
			            <th><?php //echo __('Assigned By'); ?></th>-->
                        <th><?php echo __('Action'); ?></th>
			    </tr>
			    </thead>
			    <tbody>
			    <?php  $k=1;
				 foreach ($history_2 as $Service_history): ?>
			    <tr>
			        <td>
			        <?php //debug($Service_history);
			        echo $this->SmartForm->getUserInfo($Service_history['SeekerProviderRequest']['service_provider_id']);
			        ?></td>        
			        <td><?php echo h($Service_history['SeekerProviderRequest']['requested_date']); ?></td>
			        <td><?php echo substr($Service_history['SeekerProviderRequest']['description'],0,50).'...'; ?></td>
			        <td><?php echo h($Service_history['SeekerProviderRequest']['assigned_date']); ?></td>
			       <!-- <td><?php //echo h($Service_history['RatePackage']['title']); ?></td>
			        <td><?php //echo h($Service_history['SeekerProviderRequest']['rate']); ?></td>
			        <td><?php //echo h($Service_history['SeekerProviderRequest']['working_hour']); ?></td>
			        <td><?php //echo h($Service_history['SeekerProviderRequest']['working_days']); ?></td>-->
			        <?php 
			       // if(!empty($Service_history['SeekerProviderRequest']['Assigned_by'])){ ?>
			       <!--<td><?php // echo $this->SmartForm->getUserInfo($Service_history['SeekerProviderRequest']['Assigned_by']);?></td>-->
			       <?php  //}?>
			        <td><?php echo $this->html->link('Complain', array('controller'=>'Complains', 'action' => 'add',$Service_history['SeekerProviderRequest']['service_provider_id'],$Service_history['SeekerProviderRequest']['id']),array('class'=>'btn-view-job btn-blue'));?></td>        
			       
			    </tr>
                 <?php if ($k++ == 6) break;?>
				<?php endforeach; ?>
				</tbody>
			    </table>
			        <?php if($k>6){
			        echo $this->Html->link(__('View More'), array('controller'=>'SeekerProviderRequests','action' => 'service_history','Assigned'),array('class'=>'btn btn-default btn-green btn-sm'));
					}?> 
			</div>
			 <?php }?>
			 
			 <?php if(!empty($history_3)){?>
			  <div>
			     <h6><?php echo __('Completed Service Request History'); ?></h6>
			     <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
			     <thead>
			     <tr>
			             <th><?php echo __('Service provider'); ?></th>
			             <th><?php echo __('Description'); ?></th>
			           <!--  <th><?php //echo __('Assigned Date'); ?></th>-->
			             <th><?php echo __('Requested Date'); ?></th>
			             <th><?php echo __('Completed Date'); ?></th>
			            <!-- <th><?php //echo __('Rate Package'); ?></th>
			             <th><?php //echo __('Rate'); ?></th>
			             <th><?php //echo __('Working Hours'); ?></th>
			             <th><?php //echo __('Working Days'); ?></th>
			             <th><?php //echo __('Assigned By'); ?></th>-->
                         <th><?php echo __('Action'); ?></th>
                         <th><?php echo __('Rating'); ?></th>
			     </tr>
			     </thead>
			     <tbody>
			     <?php $i=1;
			     foreach ($history_3 as $Service_history): ?>
			     <tr>
			         <td>
			         <?php //debug($history);die;
			         echo $this->SmartForm->getUserInfo($Service_history['SeekerProviderRequest']['service_provider_id']);
			         ?></td> 
                     <td><?php echo substr($Service_history['SeekerProviderRequest']['description'],'0','50').'...'; ?></td>
			                
			         <td><?php echo h($Service_history['SeekerProviderRequest']['requested_date']); ?></td>
			        <!--<td><?php //echo h($Service_history['SeekerProviderRequest']['assigned_date']); ?></td>-->
			         <td><?php echo h($Service_history['SeekerProviderRequest']['completed_date']); ?></td>
			        <!-- <td><?php //echo h($Service_history['RatePackage']['title']); ?></td>
			         <td><?php //echo h($Service_history['SeekerProviderRequest']['rate']); ?></td>
			         <td><?php //echo h($Service_history['SeekerProviderRequest']['working_hour']); ?></td>
			         <td><?php //echo h($Service_history['SeekerProviderRequest']['working_days']); ?></td>
			         <td><?php 
			        /* if(!empty($Service_history['SeekerProviderRequest']['Assigned_by'])){ 
			         echo $this->SmartForm->getUserInfo($Service_history['SeekerProviderRequest']['Assigned_by']);
			         }*/?></td>-->
			         <td><?php
			 		echo $this->html->link('Complain', array('controller'=>'Complains', 'action' => 'add',$Service_history['SeekerProviderRequest']['service_provider_id'],$Service_history['SeekerProviderRequest']['id']),array('class'=>'btn-view-job btn-blue'));?>&nbsp;<?php
					$reviewCount = $this->SmartForm->getReviewCount($Service_history['SeekerProviderRequest']['id']);
			 		echo $reviewCount==0?$this->html->link('Review', array('controller'=>'Reviews', 'action' => 'add',$Service_history['SeekerProviderRequest']['service_provider_id'],$Service_history['SeekerProviderRequest']['id']),array('class'=>'btn-view-job btn-green')):'';?></td> 
			          <td>
			         <?php $ratingCount=$this->SmartForm->getIndividualProviderRating($Service_history['SeekerProviderRequest']['service_provider_id'],$Service_history['SeekerProviderRequest']['service_seeker_id'],$Service_history['SeekerProviderRequest']['id']);?>
			         <div class="insert_after_<?php echo $Service_history['SeekerProviderRequest']['id'];?>"></div>
			          <?php if($ratingCount['rating']==0){?>
			          <div class="rated_div_<?php echo $Service_history['SeekerProviderRequest']['id'];?>">
			                 <div class="rate-ex3-cnt" id="<?php echo $Service_history['SeekerProviderRequest']['id'];?>" provider_id="<?php echo $Service_history['SeekerProviderRequest']['service_provider_id']?>">
			                     <div onclick="insertRate(1,'<?php echo $Service_history['SeekerProviderRequest']['service_provider_id']?>','<?php echo $Service_history['SeekerProviderRequest']['id'];?>')" id="1" class="rate-btn-1 rate-btn"></div>
			                     <div onclick="insertRate(2,'<?php echo $Service_history['SeekerProviderRequest']['service_provider_id']?>','<?php echo $Service_history['SeekerProviderRequest']['id'];?>')" id="2" class="rate-btn-2 rate-btn"></div>
			                     <div onclick="insertRate(3,'<?php echo $Service_history['SeekerProviderRequest']['service_provider_id']?>','<?php echo $Service_history['SeekerProviderRequest']['id'];?>')" id="3" class="rate-btn-3 rate-btn"></div>
			                     <div onclick="insertRate(4,'<?php echo $Service_history['SeekerProviderRequest']['service_provider_id']?>','<?php echo $Service_history['SeekerProviderRequest']['id'];?>')" id="4" class="rate-btn-4 rate-btn"></div>
			                     <div onclick="insertRate(5,'<?php echo $Service_history['SeekerProviderRequest']['service_provider_id']?>','<?php echo $Service_history['SeekerProviderRequest']['id'];?>')" id="5" class="rate-btn-5 rate-btn"></div>
			                 </div>
			            </div> 
			            <?php }else{?> 
			          <div class="box-result-cnt" id="<?php echo $Service_history['SeekerProviderRequest']['id'];?>">
			         	<hr>
			        
			             <div class="rate-result-cnt">
			                 <div class="rate-bg" style="width:<?php echo $ratingCount['rating']; ?>%"></div>
			                 <div class="rate-stars"></div>
			             </div>
			             
			         	<div>(<span id="rating_point"><?php echo $ratingCount['rating_point'];?></span> from <span  id="rating_people"><?php // echo $ratingCount['people']?></span> you)
			         	</div>
			         	<hr>
			 
			     	</div><!-- /rate-result-cnt -->
			         <?php }?>
			         </td>              
			        
			     </tr>
                <?php  if ($i++ == 6) break;
				//debug($i);?>
			 	<?php endforeach; ?>
			 	</tbody>
			     </table>
			     
			         <?php if($i>6){
			         echo $this->Html->link(__('View More'), array('controller'=>'SeekerProviderRequests','action' => 'service_history','Completed'),array('class'=>'btn btn-default btn-green btn-sm'));
					 }?> 
			 </div>
			 <?php }?>
			 
			 <?php if(!empty($deposit_record)){?>
			 <div>
			     <h6><?php echo __('Seeker Deposits History'); ?></h6>
			     <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
			     <thead>
			     <tr>
			             <th><?php echo __('Deposited Date'); ?></th>
			             <th><?php echo __('Amount USD'); ?></th>
			             <th><?php echo __('Amount NRs'); ?></th>
			             <th><?php echo __('Amount Medium'); ?></th>
			             <th><?php echo __('Transaction Date'); ?></th>
			             <th><?php echo __('Status'); ?></th>
			     </tr>
			     </thead>
			     <tbody>
			     <?php $m=1;
				 foreach ($deposit_record as $deposit): ?>
			 	<tr>
			 		<td><?php echo h($deposit['ServiceSeekerDeposit']['deposited_date']); ?></td>
			 		<td><?php echo h($deposit['ServiceSeekerDeposit']['amount_usd']); ?></td>
			 		<td><?php echo h($deposit['ServiceSeekerDeposit']['amount_nrs']); ?></td>
			 		<td><?php echo h($deposit['ServiceSeekerDeposit']['amount_medium']); ?></td>
			 		<td><?php echo h($deposit['ServiceSeekerDeposit']['transaction_date']); ?></td>
			 		<td><?php echo h($deposit['ServiceSeekerDeposit']['status']); ?></td>
			 	</tr>
               <?php if ($m++ == 6) break;?>
			 	<?php endforeach; ?>
			 	</tbody>
			     </table>
			     
			     <?php if($m>6){
			     echo $this->Html->link(__('View More'), array('controller'=>'ServiceSeekerDeposits','action' => 'deposit_history'),array('class'=>'btn btn-default btn-green btn-sm'));
			 }?> 
			     
			 </div>
			 <?php }?>
			
		</div>
	</div> <!-- service history -->
	
	<div class="spacer-1">&nbsp;</div>
	<div class="row">
		
		<div class="col-md-5">
		    <?php if(!empty($complain_record)){?>
		     <div>
		        <h6><?php //debug($complain_record);die;
				echo __('Complain History'); ?></h6>
		        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
		        <thead>
		        <tr>
					<th><?php echo __('Provider'); ?></th>
					<th><?php echo __('Description'); ?></th>
					<th><?php echo __('Complain Date'); ?></th>
		        </tr>
		        </thead>
		        <tbody>
		        <?php $n=1;
				foreach ($complain_record as $complain): ?>
				<tr>        
			        <td><?php echo $this->SmartForm->getUserInfo($complain['Complain']['service_provider_id']);?></td>
			        <td><?php echo substr($complain['Complain']['description'],'0','50').'...'; ?></td>
					<td><?php echo h($complain['Complain']['complain_date']); ?></td>
				</tr>
                <?php if ($n++ == 6) break;?>
				<?php endforeach; ?>
				</tbody>
		        </table>
		        
	            <?php if($n>6){
	            echo $this->Html->link(__('View More'), array('controller'=>'Complains','action' => 'complain_history'),array('class'=>'btn btn-default btn-green btn-sm'));
				}?> 
		    
		    </div>
		    <?php }?>
			
		</div>
        
        <div class="col-md-7">
			
			<?php if(!empty($review_record)){?>
			 <div>
			    <h6><?php //debug($complain_record);die;
				echo __('Reviews History'); ?></h6>
			    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
			    <thead>
			    <tr>
					<th><?php echo __('Provider'); ?></th>
					<th><?php echo __('Description'); ?></th>
					<th><?php echo __('Review Date'); ?></th>
			    </tr>
			    </thead>
			    <tbody>
			     <?php $p=1;
				 foreach ($review_record as $review): ?>
				<tr>        
			        <td><?php echo $this->SmartForm->getUserInfo($review['Review']['service_provider_id']);?></td>
			        <td><?php echo h($review['Review']['description']); ?></td>
					<td><?php echo h($review['Review']['review_date']); ?></td>
				</tr>
                <?php if ($p++ == 6) break;?>
				<?php endforeach; ?>
				</tbody>
			    </table>
			    
			    <td class="actions"> 
			        <?php if($p>6){
			        echo $this->Html->link(__('View More'), array('controller'=>'Reviews','action' => 'review_history'),array('class'=>'btn btn-default btn-green btn-sm'));
					}?>
			        </td>
			
			</div>
			<?php }?>
        
		
	</div>

	<div class="spacer-2">&nbsp;</div>

</div> <!-- end history detail -->

<script>
        // rating script
        //(function($){
			$(document).ready(function () {
				$('.rate-ex2-cnt').mouseover(function() {
					var divId=this.id;
					var pId=$(this).attr('provider_id');
								
						$('#'+divId).find('.rate-btn').hover(function(){
							
							
							$('#'+divId).find('.rate-btn').removeClass('rate-btn-hover');
							//alert($(this).attr('id'));die;
							var therate = $(this).attr('id');
							//alert(therate);
							for (var i = therate; i >= 0; i--) {
								$('#'+divId).find('.rate-btn-'+i).addClass('rate-btn-hover');
							};
						});
				
								
				
				});
			});
        //});
		
		function insertRate(rate,providerId,serviceId){
			  var therate = rate;
			  
			  var dataRate = 'act=rate&provider_id='+providerId+'&request_id='+serviceId+'&rate='+therate; //
			  $('#'+serviceId).find('.rate-btn').removeClass('rate-btn-active');
			  for (var i = therate; i >= 0; i--) {
				  
				  $('#'+serviceId).find('.rate-btn-'+i).addClass('rate-btn-active');
			  }
			  
			  $.ajax({
				  type : "POST",
				  url : '<?php echo SITE_URL.'users/provider_rating'?>',
				  data: dataRate,
				  success:function(e){
							  $('.rated_div_'+serviceId).remove();
							  $('<div class="box-result-cnt"><hr><div class="rate-result-cnt"><div style="width:'+e+'%" class="rate-bg"></div><div class="rate-stars"></div></div><div>(<span id="rating_point">'+rate+'</span> from <span id="rating_people"></span> you)</div><hr></div>').insertAfter('.insert_after_'+serviceId);
						  }
			  });
		}
</script>