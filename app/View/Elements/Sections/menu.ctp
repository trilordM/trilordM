<div class="container">
    <!-- HEADER-LOG0 -->
    <div class="header-company-logo">
     <?php
    echo $this->Html->link($this->Html->image('/img/globo/logo.png',array('class'=>'main-logo','alt' => 'job board')),array('controller' => 'pages', 'action' => 'display', 'home'),array('title' => 'Trilord Market Logo','rel'=>'home','escape' => false));
    ?>

    </div>
    <!-- END HEADER LOGO -->
    <div class="header-nav-bar home-slide">
        <nav>

            <button><i class="fa fa-bars"></i></button>

            <ul class="primary-nav list-unstyled">
                <li class= " <?php if (isset($home)) echo 'bg-color'; ?>" ><?php echo $this->html->link('HOME',array('controller' => 'pages', 'action' => 'display', 'home'));?></li>
                <li class= " <?php if (isset($about)) echo 'bg-color'; ?>" >
                    <?php echo $this->html->link('About', $menuItems['About']['url']);?>
                </li>
                <li class= " <?php if (isset($search_market)) echo 'bg-color'; ?>" ><?php echo $this->html->link('Search Market', array('controller'=>'pages', 'action' => 'search_marketplace'));?></li>
                <li class= " <?php if (isset($career)) echo 'bg-color'; ?>" ><?php echo $this->html->link('Career', array('controller'=>'careers', 'action' => 'career'));?></li>
                <li class= " <?php if (isset($contact)) echo 'bg-color'; ?>" ><?php echo $this->html->link('Contact Us', array('controller'=>'pages', 'action' => 'contact'));?></li>

                <li class= "bg-color <?php if (!isset($faq)) echo 'faq'; ?>" ><a href="javascript:void(0)">FAQ<i class="fa fa-angle-down"></i></a>
                    <ul class="sub-menu">
                        <li><?php echo $this->html->link("Service Provider", array('controller'=>'faqs', 'action' => 'view/provider'));?></li>
                        <li><?php echo $this->html->link("Customer", array('controller'=>'faqs', 'action' => 'view/customer'));?></li>
                    </ul>
                </li>




            </ul>
        </nav>
    </div> <!-- end .header-nav-bar -->
</div> <!-- end .container -->