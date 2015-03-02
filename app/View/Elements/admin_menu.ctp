<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="active">
                <?php echo $this->Html->link('<i class="fa fa-th"></i><span>Dashboard</span>', '/admin', array('escape' => FALSE)); ?>
            </li>
            <?php
                if(($this->Session->read('Auth.User.id')=='131')){
            ?>
                <li><?php echo $this->Html->link('<i class="fa fa-th"></i><span>User Management</span>','/admin/users/index', array('escape' => FALSE)); ?></li>

            <?php } ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-search"></i>
                    <span><?php echo __('Seeker'); ?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>Service Seekers','/admin/users/seeker_index',array('escape' => FALSE)); ?></li>
                    <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>Service Requests','/admin/seeker_provider_requests', array('escape' => FALSE)); ?></li>
                     <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>Service Package Requests','/admin/service_package_requests', array('escape' => FALSE)); ?></li>
                     <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>Deposits','/admin/service_seeker_deposits', array('escape' => FALSE)); ?></li>
                     <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>Testimonial','/admin/testimonials', array('escape' => FALSE)); ?></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span><?php echo __('Service Provider'); ?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>Unverified Service Providers','/admin/users/unverified_provider_index',array('escape' => FALSE)); ?></li>
                    <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>Verified Service Providers','/admin/users/provider_index',array('escape' => FALSE)); ?></li>
                    <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>Add Service Provider(Individual)','/admin/users/provider_add',array('escape' => FALSE)); ?></li>
                    <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>Add Service Provider(Company)','/admin/users/company_add',array('escape' => FALSE)); ?></li>
                    <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>Complains','/admin/complains',array('escape' => FALSE)); ?></li>
                    <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>Reviews','/admin/reviews',array('escape' => FALSE)); ?></li>
                    <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>Places','/admin/places',array('escape' => FALSE)); ?></li>
                    <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>Provider Requests','/admin/provider_requested_documents',array('escape' => FALSE)); ?></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-tasks"></i> <span>Categories</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                   <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>Rate Management','/admin/rate_packages', array('escape' => FALSE)); ?></li>
                   <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>Service Category','/admin/service_categories', array('escape' => FALSE)); ?></li>
                   <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>Service Packages','/admin/service_packages', array('escape' => FALSE)); ?></li>
                   <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>Career','/admin/careers', array('escape' => FALSE)); ?></li>
                   <li><?php echo $this->html->link('<i class="fa fa-angle-double-right"></i>Provider FAQ', array('controller'=>'faqs', 'action' => 'index/provider'), array('escape' => FALSE));?></li>
                   <li><?php echo $this->html->link('<i class="fa fa-angle-double-right"></i>Customer FAQ', array('controller'=>'faqs', 'action' => 'index/customer'), array('escape' => FALSE));?></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-credit-card"></i> <span>Payment Settings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>Paypal','/admin/paypal_settings/edit/1', array('escape' => FALSE)); ?></li>
                    <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>Esewa','/admin/paypal_settings/esewa/1', array('escape' => FALSE)); ?></li>
                    <!--<li><?php //echo $this->Html->link('MoCo','/admin/paypal_settings/moco/1', array('escape' => FALSE)); ?></li>-->
                    <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>SMS','/admin/paypal_settings/sms/1', array('escape' => FALSE)); ?></li>
                    <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>Country','/admin/countries', array('escape' => FALSE)); ?></li>
                </ul>
            </li>
            <li>
                <?php echo $this->Html->link('<i class="fa fa-files-o"></i>Contents(Pages)','/admin/content_pages',array('escape' => FALSE)); ?>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>





