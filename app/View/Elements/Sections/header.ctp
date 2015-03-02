  <header id="header">
    <div class="header-top-bar">
      <div class="container">
        <div class="row">
             <?php $base_url = SITE_URL . "";?>
            <!-- HEADER-CONTACT -->
            <div class="header-contact col-md-3 col-sm-6 col-xs-12">
                <i class="fa fa-phone"></i> Toll free: 1660-01-13579
            </div>
            <!-- END HEADER-CONTACT -->

            <!-- HEADER-SOCIAL -->
            <div class="header-social col-md-3 col-sm-6 col-xs-12">

            </div>
            <!-- END HEADER-SOCIAL -->

            <!-- HEADER-LOGIN-REGISTER -->
            <div class="header-login-register col-md-6 col-sm-6 col-xs-12">
                <?php if (AuthComponent::user()):?>

                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <?php echo 'Welcome <span>'. strtok(AuthComponent::user('name'), " ") .'<i class="fa fa-angle-down"></i></span>'; ?>

                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                     <i class="fa fa-user"></i>
                                    <p>
                                        <?php echo strtok(AuthComponent::user('name'), " ");?>
                                    </p>
                                    <small>Member since Nov. 2012</small>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <?php

                                            if (AuthComponent::user('role')=='ServiceProvider')
                                                echo $this->html->link('Profile', array('controller'=>'users', 'action' => 'provider_profile_page'),array('class'=>'btn btn-default btn-flat'));
                                            else
                                                echo $this->html->link('PROFILE', array('controller'=>'users', 'action' => 'seeker_profile'),array('class'=>'btn btn-default btn-flat'));
                                        ?>
                                    </div>
                                    <div class="pull-right">
                                        <?php echo $this->html->link('Logout', array('controller'=>'users', 'action' => 'logout'),array('class'=>'btn btn-default btn-flat'));?>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                  <?php else:?>
                    <a class="btn btn-facebook">
                        <i class="fa fa-facebook fa-lg"></i> Sign in
                    </a>
                    <div class="btn-group">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Register <i class="fa fa-angle-down"></i>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                         <li><a href="<?php echo $base_url.'seeker_register'?>">Service Seeker</a></li>
                         <!--<li><a href="<?php //echo $base_url.'provider_register?type=company'?>">Service Provider (Company)</a></li>-->
                         <!--<li><a href="<?php echo $base_url.'provider_register?type=individual'?>">Service Provider (Individual)</a></li>-->

                      </ul>
                    </div>
                    <?php echo $this->html->link('Login', array('controller'=>'users', 'action' => 'login'),array('class'=>'btn'));?>
                  <?php endif;?>

            </div> <!-- END .HEADER-LOGIN-REGISTER -->

         </div><!-- END .ROW-->
      </div><!-- END .CONTAINER-->
    </div>
    <!-- END .HEADER-TOP-BAR -->

    <?php echo $this->element('Sections/menu')?>

    <!-- HEADER SEARCH SECTION -->
    <div class="header-search slider-home">

       <?php echo $this->element('Sections/search_filter');?>

       <!-- HEADER SLIDER -->
       <?php
            if(isset($frontPage))
                echo $this->element('Sections/slider');

        ?>
    </div> <!-- END .SEARCH and slide-section -->


  </header> <!-- end #header -->