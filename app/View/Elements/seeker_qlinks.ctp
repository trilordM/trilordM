<h4>Quick Links</h4>
<?php
echo $this->Html->link(__('Edit Profile'), array('controller'=>'users','action' => 'seeker_edit'),array('class'=>'btn btn-default btn-green btn-block')); ?>
<?php
echo $this->Html->link(__('Change password'), array('controller'=>'users','action' => 'change_password'),array('class'=>'btn btn-default btn-green btn-block')); ?> 
					
<?php
echo $settings['PaypalSetting']['paypal_is_active']==1?$this->Html->link(__('Recharge Paypal'), array('controller'=>'payments','action' => 'paypal'),array('class'=>'btn btn-default btn-green btn-block')):''; ?> 
<?php
echo $this->Html->link(__('Bank Deposit'), array('controller'=>'payments','action' => 'bank_deposit'),array('class'=>'btn btn-default btn-green btn-block')); ?> 
 <?php
echo $settings['PaypalSetting']['esewa_is_active']==1?$this->Html->link(__('Esewa Deposit'), array('controller'=>'payments','action' => 'esewa_deposit'),array('class'=>'btn btn-default btn-green btn-block')):''; ?> 
<?php
echo $settings['PaypalSetting']['moco_is_active']==1?$this->Html->link(__('MoCo Payment'), array('controller'=>'payments','action' => 'moco_deposit'),array('class'=>'btn btn-default btn-green btn-block')):''; ?> 
<?php
echo $this->Html->link(__('Deposit History'), array('controller'=>'service_seeker_deposits','action' => 'index'),array('class'=>'btn btn-default btn-green btn-block')); ?>