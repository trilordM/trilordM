 <div class ="forgot_password">
  <button type="button"  class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	<h4>Enter your email address</h4>
    <div id="showForgetMessage"></div>

	<?php echo $this->Form->create('UserForgot', array('id'=>'send_forgot_password','novalidate' => true,'role'=>'form')); ?>

			<div>
                <?php echo $this->Form->input('email',array('id'=>'email','type'=>'email','label'=>'Email','placeholder'=>'example@domain.com'));?>
			</div>

		<?php  echo $this->Form->button('SEND',array('id'=>'send_forget','type'=>'submit','class'=>'btn btn-default btn-green'));?>
     <?php echo $this->Form->end(); ?>
 </div><!-- end .forgot_password-->