<div class="main-page-title"><!-- start main page title -->
	<div class="container">
		<div class="page-title">Bank Deposit</div>
	</div>
</div><!-- end main page title -->

<div class="content-about">

	<div class="container">
		
		<div class="spacer-1">&nbsp;</div>
        <?php echo $this->Form->create(array('action'=>'moco_redirect')); ?>
        <?php
		echo $this->Form->input('amount',array('value'=>12, 'name'=>'data[amount]'));
		echo $this->Form->input('tid',array('value'=>1234, 'name'=>'data[tid]'));
		echo $this->Form->input('userid',array('value'=>123456, 'name'=>'data[userid]'));
		echo $this->Form->input('status',array('value'=>'S', 'name'=>'data[status]'));
		echo $this->Form->input('message',array('value'=>'Good', 'name'=>'data[message]'));
		echo $this->Form->input('name',array('value'=>'Ritesh', 'name'=>'data[name]'));
		echo $this->Form->input('email',array('value'=>'ritesh@smarttech.com.np', 'name'=>'data[email]'));
		echo $this->Form->input('hash',array('value'=>hash_hmac("md5", '1234SGood123456Riteshritesh@smarttech.com.np', 'tril0rd'), 'name'=>'data[hash]'));
	?>
        <?php 
				$options = array('div'=>array('class'=>'form-group'),'value'=>'Submit', 'class'=> 'btn btn-default btn-green');
				echo $this->Form->end($options); 
			?>
        
        <div class="spacer-1">&nbsp;</div>
	
	</div> <!-- end container -->
	
</div> <!-- end content-about -->

