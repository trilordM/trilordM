<div class="col-md-9 col-xs-12 service-history-container right-column">
    <!-- end .title-container -->
    <?php echo $this->Session->flash(); ?>
    <div class="row container-content">
        <div class="col-md-9 col-xs-12">
            <ul class="nav nav-pills">
                <li <?php if(isset($new)) echo $new ?> ><a href="/seeker_provider_requests/service_history/New" >New</a>
                </li>
                <li <?php if(isset($completed)) echo $completed ?> ><a href="/seeker_provider_requests/service_history/Completed" >Completed</a>
                </li>
                <li <?php if(isset($assigned)) echo $assigned ?> ><a href="/seeker_provider_requests/service_history/Assigned" >Assigned</a>
                </li>
            </ul>
            <table class = "table">
                <thead>
                    <tr>
                        <th><?php echo $this->Paginator->sort('service_provider_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('requested_date'); ?></th>
                        <th><?php echo $this->Paginator->sort('description'); ?></th>
                        <?php if($status=='Assigned'){ ?>
                        <th><?php echo $this->Paginator->sort('assigned_date'); ?></th>
                        <?php } ?>
                        <?php if($status=='Completed'){?>
                        <th><?php echo $this->Paginator->sort('completed_date');?> </th>
                        <?php }?>
                        <?php if($status!='Completed'){?>
                        <th><?php	echo $this->Paginator->sort('Action'); ?></th>
                        <?php }else{?>
                        <th><?php	echo $this->Paginator->sort('Action'); ?></th>
                        <th><?php	echo $this->Paginator->sort('Rating'); ?></th>
                        <?php }?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($service_history as $history): ?>
                    <tr>
                        <td><?php echo $this->SmartForm->getUserInfo($history['SeekerProviderRequest']['service_provider_id']);?>&nbsp;</td>
                        <td><?php echo h($history['SeekerProviderRequest']['requested_date']); ?>&nbsp;</td>
                        <td><?php echo substr($history['SeekerProviderRequest']['description'],'0','50').'...'; ?>&nbsp;</td>
                        <?php if($status=='Assigned'){ ?>
                        <td><?php	echo h($history['SeekerProviderRequest']['assigned_date']); ?>&nbsp;</td>
                        <?php }?>
                        <?php if($status=='Completed'){?>
                        <td><?php	echo h($history['SeekerProviderRequest']['completed_date']); ?>&nbsp;</td>
                        <?php }?>
                        <?php if($status=='New'){ ?>
                        <td colspan="2"><?php	echo $this->Form->postLink(__('Cancel'), array('controller'=>'SeekerProviderRequests', 'action' => 'cancel_request',$history['SeekerProviderRequest']['id']),array('class'=>'btn btn-default btn-red'));?>&nbsp;</td>
                        <?php }?>
                        <?php if($status!='New'){ ?>
                        <td ><?php	echo $this->html->link('Complain', array('controller'=>'Complains', 'action' => 'add',$history['SeekerProviderRequest']['service_provider_id'],$history['SeekerProviderRequest']['id']),array('class'=>'btn btn-default btn-blue')); }?>&nbsp;
                            <?php if($status=='Completed'){?>
                            <?php
                                $reviewCount = $this->SmartForm->getReviewCount($history['SeekerProviderRequest']['id']);
                                $service_provider_id = $history['SeekerProviderRequest']['service_provider_id'];
                                $service_seeker_id = $history['SeekerProviderRequest']['id'];
                                echo $reviewCount==0?$this->html->link('Review', array('controller'=>'Reviews', 'action' => 'add',$history['SeekerProviderRequest']['service_provider_id'],$history['SeekerProviderRequest']['id']), array('class'=>'btn btn-default btn-green')):'';?>
                        </td>
                        <td>
                            <?php $ratingCount=$this->SmartForm->getIndividualProviderRating($history['SeekerProviderRequest']['service_provider_id'],$history['SeekerProviderRequest']['service_seeker_id'],$history['SeekerProviderRequest']['id']);?>
                            <div class="insert_after_<?php echo $history['SeekerProviderRequest']['id'];?>"></div>
                            <?php if($ratingCount['rating']==0){?>
                            <div class="rated_div_<?php echo $history['SeekerProviderRequest']['id'];?>">
                                <div class="rate-ex3-cnt" id="<?php echo $history['SeekerProviderRequest']['id'];?>" provider_id="<?php echo $history['SeekerProviderRequest']['service_provider_id']?>">
                                    <div onclick="insertRate(1,'<?php echo $history['SeekerProviderRequest']['service_provider_id']?>','<?php echo $history['SeekerProviderRequest']['id'];?>')" id="1" class="rate-btn-1 rate-btn"></div>
                                    <div onclick="insertRate(2,'<?php echo $history['SeekerProviderRequest']['service_provider_id']?>','<?php echo $history['SeekerProviderRequest']['id'];?>')" id="2" class="rate-btn-2 rate-btn"></div>
                                    <div onclick="insertRate(3,'<?php echo $history['SeekerProviderRequest']['service_provider_id']?>','<?php echo $history['SeekerProviderRequest']['id'];?>')" id="3" class="rate-btn-3 rate-btn"></div>
                                    <div onclick="insertRate(4,'<?php echo $history['SeekerProviderRequest']['service_provider_id']?>','<?php echo $history['SeekerProviderRequest']['id'];?>')" id="4" class="rate-btn-4 rate-btn"></div>
                                    <div onclick="insertRate(5,'<?php echo $history['SeekerProviderRequest']['service_provider_id']?>','<?php echo $history['SeekerProviderRequest']['id'];?>')" id="5" class="rate-btn-5 rate-btn"></div>
                                </div>
                            </div>
                            <?php }else{?>
                            <div class="box-result-cnt" id="<?php echo $history['SeekerProviderRequest']['id'];?>">
                                <hr>
                                <div class="rate-result-cnt">
                                    <div class="rate-bg" style="width:<?php echo $ratingCount['rating']; ?>%"></div>
                                    <div class="rate-stars"></div>
                                </div>
                                <div>(<span id="rating_point"><?php echo $ratingCount['rating_point'];?></span> from <span  id="rating_people"><?php // echo $ratingCount['people']?></span> you)
                                </div>
                                <hr>
                            </div>
                            <!-- /rate-result-cnt -->
                            <?php }?>
                        </td>
                        <?php }?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="row clearfix">
                <ul class="pagination">
                    <li >
                        <?php
                            echo $this->Paginator->prev('Prev',array('class' => 'pag-prev'), null, array('class' => 'pag-prev disabled'));
                            ?>
                    </li>
                    <li>
                        <?php
                            echo $this->Paginator->numbers(array('separator' => '','currentClass' => 'pag-num active','class' =>'pag-num'));
                            ?>
                    </li>
                    <li>
                        <?php
                            echo $this->Paginator->next('Next',array('class' => 'pag-next'), null, array('class' => 'pag-next disabled'));
                            ?>
                    </li>
                </ul>
            </div>
        </div>
        <!-- end .grid -->
    </div>
    <!-- .container-content -->
</div>
<!-- end .user-profile-edit-container -->
<script>
    // rating script
    //(function($){
    $(document).ready(function () {
    	$('.rate-ex2-cnt').mouseover(function() {
    		var divId=this.id;
    		var pId=$(this).attr('provider_id');
    
    		$('#'+divId).find('.rate-btn').hover(function(){
    
    
    			$('#'+divId).find('.rate-btn').removeClass('rate-btn-hover');
    			var therate = $(this).attr('id');
    
    			for (var i = therate; i >= 0; i--) {
    				$('#'+divId).find('.rate-btn-'+i).addClass('rate-btn-hover');
    			};
    		});
    
    
    
    	});
    });
    
    function insertRate(rate,providerId,serviceId){
    	var therate = rate;
    
    	var dataRate = 'act=rate&provider_id='+providerId+'&request_id='+serviceId+'&rate='+therate;
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