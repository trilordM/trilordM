<div class="faq-container">
        <div class="title-container"><!-- start main page title -->
			<div class="container">
				<div class="page-title">FAQS > <?php echo $type=='provider'?"Service Provider":"Customer"?></div>
			</div>
		</div><!-- end .title-container -->

		<div id="page-content"><!-- start content -->
			<div class="content-about">
				<div class="container"><!-- container -->
				<div class="spacer-1">&nbsp;</div>
					<div class="row clearfix">
						<div class="col-md-8 col-sm-12 col-xs-12"">
								<!--accordion-->
                                <div class="panel-group" id="accordion">
                                <?php 
								$i=0;
								foreach($faqs as $faq):
								$i++;
								?>
                                  <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i?>">
                                          <?php echo $faq['Faq']['title']?>
                                        </a>
                                      </h4>
                                    </div>
                                    <div id="collapse<?php echo $i?>" class="panel-collapse collapse <?php echo $i==1?'in':''?>">
                                      <div class="panel-body">
                                       <?php echo $faq['Faq']['description']?>
                                      </div>
                                    </div>
                                  </div>
                                 <?php endforeach;?> 
                                </div><!--accordion-->
						</div> <!-- end grid-layout -->
                        <div class="col-md-4 col-sm-12 col-xs-12">
                              <div class ="price-listing">
                                  <div class="pricing-table active">
                                    <h3><strong>Register</strong> Now</h3>
                                    <div class="price">
                                      <span><strong>Free</strong></span>
                                    </div>

                                    <ul class="list-group">
                                      <li class="list-group-item"><i class="fa fa-check-circle-o"></i> Free Listing</li>
                                      <li class="list-group-item"><i class="fa fa-check-circle-o"></i> Save Your Customized Profile</li>
                                      <li class="list-group-item"><i class="fa fa-check-circle-o"></i> Submit Reviews</li>
                                    </ul>
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                       <i class="fa fa-check-square-o">Register with us</i>
                                      </button>
                                      <ul class="dropdown-menu" role="menu">
                                         <li><a href="<?php echo SITE_URL.'seeker_register'?>">Service Seeker</a></li>
                                         <li><a href="<?php echo SITE_URL.'provider_register?type=company'?>">Service Provider Company</a></li>
                                         <li><a href="<?php echo SITE_URL.'provider_register?type=individual'?>">Individual Service Provider</a></li>

                                      </ul>
                                    </div>
                                  </div> <!-- end .pricing-table -->

                              </div> <!-- end .price-listing-->

                        </div> <!-- end grid-layout -->
						
					</div>
					<div class="spacer-1">&nbsp;</div>
				</div><!-- container -->
				
			</div><!-- end content -->
		</div><!-- end page content -->

</div><!-- end .faq-container -->