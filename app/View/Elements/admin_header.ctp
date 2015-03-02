<?php $user = $this->Session->read('Auth.User');?>
<!-- header logo: style can be found in header.less -->
<header class="header">
    <a href="<?php echo SITE_URL;?>" class="logo">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
       <?php echo COMPANY_NAME;?>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                         <?php if(!empty($user)) {
                            echo 'Hi <span>', $user['username'] .'<i class="caret"></i></span>';
                         } ?>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            <img src="<?php echo $this->Html->url('/', true)?>app/webroot/img/avatar3.png" class="img-circle" alt="User Image" />
                            <p>

                                <?php if(!empty($user)) {
                                    echo 'Hi ', $user['username'];
                                } ?>
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?php echo $this->Html->link('Change Password', '/admin/users/change_password', array('class' => 'btn btn-default btn-flat')); ?>
                            </div>
                            <div class="pull-right">
                                <?php echo $this->Html->link('Logout', '/admin/users/logout',array('class' => 'btn btn-default btn-flat')); ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>