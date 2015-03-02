 <div class="col-md-3 col-xs-12 left-column">
    <div class="page-sidebar company-sidebar">
        <ul class="company-category nav nav-tabs home-tab" role="tablist">
            <li class="<?php if (isset($active_seeker_profile)) echo $active_seeker_profile; ?>">
                  <?php echo $this->Html->link('<i class="fa fa-newspaper-o"></i>Profile', array('controller'=>'users','action' => 'seeker_profile'),array('escape' => FALSE)); ?>
            </li>
            <li class="<?php if (isset($active_edit_profile)) echo $active_edit_profile; ?>">
                 <?php echo $this->Html->link('<i class="fa fa-newspaper-o"></i>Edit Profile', array('controller'=>'users','action' => 'seeker_edit'),array('escape' => FALSE)); ?>
            </li>
	        <li class="<?php if (isset($active_service_request)) echo $active_service_request; ?>">
                <?php echo $this->Html->link('<i class="fa fa-keyboard-o"></i>Service Request', array('controller'=>'seeker_provider_requests','action' => 'service_history','New'), array('escape' => FALSE)); ?>
            </li>

            <li class="<?php if (isset($active_testimonials_add)) echo $active_testimonials_add; ?>">
                <?php echo $this->Html->link('<i class="fa fa-cubes"></i>Add Testimonials', array('controller'=>'testimonials','action' => 'add'),array('escape' => FALSE)); ?>
            </li>           
             <li class="<?php if (isset($active_response_enquire)) echo $active_response_enquire; ?>">
                <?php echo $this->Html->link('<i class="fa fa-keyboard-o"></i>Response(Enquire)', array('controller'=>'seeker_provider_requests','action' => 'response_enquire'),array('escape' => FALSE)); ?>

             </li>
             <li class="<?php if (isset($active_seeker_request)) echo $active_seeker_request; ?>">
                 <?php echo $this->Html->link('<i class="fa fa-keyboard-o"></i>Response', array('controller'=>'ServiceRequestRelays','action' => 'seeker_request'), array('escape' => FALSE)); ?>

             </li>
              <li class="<?php if (isset($active_change_password)) echo $active_change_password; ?>">
                  <?php echo $this->Html->link('<i class="fa fa-keyboard-o"></i>Change Password', array('controller'=>'users','action' => 'change_password'), array('escape' => FALSE)); ?>

              </li>               
        </ul>
    </div><!-- end .page-sidebar -->
  </div><!-- end .left-column -->
