<div class="admin-login">
<?php echo $this->Session->flash('auth'); ?>
<h1>
    <?php echo __('Log In'); ?>
</h1>
<?php echo $this->Form->create('User'); ?>
        
        <?php echo $this->Form->input('email',array('placeholder'=>'Email Address'));
        echo $this->Form->input('password', array('placeholder'=>'Password'));
    ?>
<?php echo $this->Form->end(__('Login')); ?>
</div>