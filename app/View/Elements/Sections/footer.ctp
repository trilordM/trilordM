<footer id="footer">
    <div class="main-footer">

      <div class="container">
        <div class="row">

          <div class="col-md-3 col-sm-6">
            <div class="footer-features">
               <h3>Features</h3>

              <ul>
                <li><i class="fa  fa-arrow-circle-right"></i><?php echo $this->html->link('Home',array('controller' => 'pages', 'action' => 'display', 'home'));?></li>
                <li><i class="fa  fa-arrow-circle-right"></i><?php echo $this->html->link($menuItems['About']['title'],$menuItems['About']['url']);?></li>
                <li><i class="fa  fa-arrow-circle-right"></i><?php echo $this->html->link('Search Market', array('controller'=>'pages', 'action' => 'search_marketplace'));?></li>
                <li><i class="fa  fa-arrow-circle-right"></i><?php echo $this->html->link('Career', array('controller'=>'careers', 'action' => 'career'));?></li>
                <li><i class="fa  fa-arrow-circle-right"></i><?php echo $this->html->link('Contact Us', array('controller'=>'pages', 'action' => 'contact'));?></li>
                <li><i class="fa  fa-arrow-circle-right"></i><?php echo $this->html->link("FAQs - Service Provider", array('controller'=>'faqs', 'action' => 'view/provider'));?></li>
                <li><i class="fa  fa-arrow-circle-right"></i><?php echo $this->html->link("FAQs - Customer", array('controller'=>'faqs', 'action' => 'view/customer'));?></li>
              </ul>
            </div>
           
          </div> <!-- end Grid layout-->

          <div class="col-md-3 col-sm-6 clearfix">
            <div class="popular-categories">
              <h3>Popular Categories</h3>

              <ul>
                <li><i class="fa fa-shopping-cart"></i>
                <?php echo $this->Html->link(
                       'Plumber',
                       'search_marketplace?searchjob=35&searchplace='
                   ); ?>
                </li>
                <li><i class="fa fa-paper-plane-o"></i>
                <?php echo $this->Html->link(
                                       'Electrician',
                                       'search_marketplace?searchjob=34&searchplace='
                                   ); ?>
                </li>
                <li><i class="fa fa-cogs"></i><?php echo $this->Html->link(
                                                                     'Maid/Caretaker',
                                                                     'search_marketplace?searchjob=28&searchplace='
                                                                 ); ?></li>
                <li><i class="fa fa-book"></i><?php echo $this->Html->link(
                                                                     'Driver',
                                                                     'search_marketplace?searchjob=52&searchplace='
                                                                 ); ?></li>
                <li><i class="fa fa-building-o"></i><?php echo $this->Html->link(
                                                                     'Painter',
                                                                     'search_marketplace?searchjob=132&searchplace='
                                                                 ); ?></li>
              </ul>
            </div> <!-- end .popular-categories-->
          </div> <!-- end Grid layout-->
          <div class="col-md-3 col-sm-6">
            <div class="newsletter">
              <h3>Support</h3>
  
             
              Bagbazar, Kathmandu, Nepal
              </br><i class="fa fa-phone"></i> 01-4220007
              </br><i class="fa fa-envelope"></i> email@trilordmarket.com
              </br><i class="fa fa-smile-o"></i> 8:00am-6:00pm, Sunday-Friday

              <h3>Keep In Touch</h3>

              <ul class="list-inline">
                <li class="facebook-icon"><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li class="twitter-icon"><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li class="google-plus-icon"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                <li class="linkedin-icon"><a href="#"><i class="fa fa-linkedin"></i></a></li>
              </ul>
            </div> <!-- end .newsletter-->

          </div> <!-- end Grid layout-->

          <div class="col-md-3 col-sm-6">
            <h3>Follow us</h3>

            <div class="latest-post clearfix">
                <?php echo $this->element('Sections/facebook')?>
            </div>

          </div> <!-- end Grid layout-->       

          
        </div> <!-- end .row -->
      </div> <!-- end .container -->
    </div> <!-- end .main-footer -->

    <div class="copyright">
      <div class="container">
        <p>Copyright 2014 &copy; TrilordMarket. All rights reserved.</p>
      </div> <!-- END .container -->
    </div> <!-- end .copyright-->
  </footer> <!-- end #footer -->