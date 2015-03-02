<div class="users form">
<?php echo $this->Session->flash(); ?>
<?php echo $this->Html->image('/providers_photo/'.$user['User']['profile_photo'],array('width'=>140,'height'=>'100','alt'=>'no picture'));?>
<?php  //debug($user);die;
echo $this->Form->create('User',array('type'=>'file')); ?>
<?php
echo $this->Form->input('profile_photo',array('type'=>'file'));
echo $this->Form->hidden('img_name',array('value'=>$user['User']['profile_photo']));
?>
<?php echo $this->Form->end(__('Submit')); ?>
</div>