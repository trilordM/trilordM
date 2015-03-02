<div class="col-md-9 col-xs-12 response-enquire-container right-column">
	<!-- end .title-container -->
	<?php echo $this->Session->flash(); ?>
	<div class="row container-content">
		<div class="col-md-12 first-row">
			<?php
				foreach($ProviderRequest as $ProviderRequests ):
				    $message_send_date=$ProviderRequests['SeekerProviderRequest']['response_date'];
				    $request_id=$ProviderRequests['SeekerProviderRequest']['id'];
				    $requested_provider=$ProviderRequests['SeekerProviderRequest']['service_provider_id'];
				?>
			<blockquote class="blockquote">
				<p>
				<p>Requested Provider:<?php echo $this->SmartForm->getUserInfo($requested_provider); ?></p>
				<p>Description:<?php echo $ProviderRequests['SeekerProviderRequest']['description'];?></p>
				<p>Reply:<?php echo $ProviderRequests['SeekerProviderRequest']['reply'];?> </p>
				<p>Total amount:Rs<?php echo $ProviderRequests['SeekerProviderRequest']['total'];?> </p>
				<p>Message sent date:<?php echo $ProviderRequests['SeekerProviderRequest']['response_date']; ?></p>
				</p>
				<a href=".modal-dialog" id="<?php echo $request_id?>"  class="btn btn-default btn-blue btn-sm accept-popup">Accept</a>
				<a href="#request-form" id="decline-popup-<?php echo $request_id?>" requested ="<?php echo $request_id?>" class="btn btn-default btn-blue btn-sm decline-popup">Decline</a>
			</blockquote>
			<?php endforeach;?>
		</div>
		<!-- end .first-row -->
	</div>
	<!-- end .container-content -->
</div>
<!-- end .response-enquire-container -->

<div id="model_accept"  class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button"  class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			</div>
			<div class="modal-body">
				<div id="errormessage"></div>
				<p>Are you sure you want to accept this request?</p>
				<p>Note:If you don't have enough amount in your deposit,checked the box below.</p>
				<?php echo $this->Form->input('payment_on_site',array('id'=>'payment_on_site','name'=>'payment','type' => 'checkbox','label'=>"Pay in person"));?>
				<?php echo $this->Form->hidden('data_id',array('id'=>'request_id'));?>
				<?php echo $this->Form->button('ok',array('id'=>'accepted','class'=>array('btn btn-default btn-green')));?>
				<?php echo $this->Form->button('cancel',array('onclick'=>'$.magnificPopup.close()','class'=>array('btn btn-default btn-green')));
					?>
			</div>
			<div class="modal-footer">
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div  id="request-form" class="mfp-hide white-popup-block">
	<div class="modal-header">
		<button type="button"  class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	</div>
	<div class="modal-body">
		<p>Are you sure you want to cancel this request?</p>
		<?php //echo $this->Form->postLink('yes', array('controller'=>'SeekerProviderRequests','action' => 'select', $request_id,'decline'),array('class'=>'btn btn-default btn-green'));$nbsp;?>
		<?php echo $this->Form->hidden('data',array('id'=>'req_id'));?>
		<?php echo $this->Form->button('yes',array('id'=>'declined','class'=>array('btn btn-default btn-green')));?>
		<?php echo $this->Form->button('No',array('onclick'=>'$.magnificPopup.close()','class'=>array('btn btn-default btn-green')));
			?>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {

	    $('.accept-popup').click(function(){

	        var request_id=$(this).attr("id");
	        $('#request_id').val(request_id);

	    });

	    $('.decline-popup').click(function(){

	        var req_id=$(this).attr("requested");
	        $('#req_id').val(req_id);

	    });


	    $('.accept-popup').magnificPopup({
	        type: 'inline',
	        preloader: false,
	        modal: true
	    });

	    $(document).on('click', '.close', function (e) {
	        e.preventDefault();
	        $.magnificPopup.close();
	    });

	    $('.decline-popup').magnificPopup({
	        type: 'inline',
	        preloader: false,
	        modal: true,
	    });


	    $(document).on('click', '#accepted', function(e){
	        if($('#payment_on_site').is(':checked') ){
	            var	checked_value='1';
	        }else{
	            var	checked_value='0';
	        }
	        var get_id=$('#request_id').val();

	        $.ajax({
	        type: "POST",
	        url: '<?php echo SITE_URL.'seeker_provider_requests/select/accept'?>',
	        data: ({name: checked_value,request_id: get_id}),
	        success:  function(data){
	                 if(data=='1')	{
	                     $('#errormessage').html('<span style="color:red;">There is not enough amount in your deposit please check Pay in person to request for provider.</span>');
	                 }else{
	                        $('#errormessage').removeAttr('disabled');
	                        window.location.reload(true);

	                 }
	            }
	        })
	        e.preventDefault();
	        return false;
	    });

	    $(document).on('click', '#declined', function(e){

	        var get_id=$('#req_id').val();

	        $.ajax({
	        type: "POST",
	        url: '<?php echo SITE_URL.'seeker_provider_requests/select/decline'?>',
	        data: ({request_id: get_id}),
	        success:  function(data){

	            window.location.reload(true);
	            }
	        })
	        e.preventDefault();
	        return false;
	    });


	});


</script>