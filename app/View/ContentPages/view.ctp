<div class="about-page-container">
		<div class="title-container"><!-- start main page title -->
			<div class="container">
				<div class="page-title"><?php echo $contentPage['ContentPage']['title']; ?></div>
			</div>
		</div><!-- end main .title-container -->

		<div id="page-content"><!-- start content -->
			<div class="content-about">
				<div class="container"><!-- container -->
					<div class="row clearfix">
						<div class="col-md-8 col-sm-12 col-xs-12"">
								<?php echo $contentPage['ContentPage']['description']; ?>
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
										 <li><a href="<?php echo $base_url.'seeker_register'?>">Service Seeker</a></li>
										 <li><a href="<?php echo $base_url.'provider_register?type=company'?>">Service Provider Company</a></li>
										 <li><a href="<?php echo $base_url.'provider_register?type=individual'?>">Individual Service Provider</a></li>

									  </ul>
									</div>
								  </div> <!-- end .pricing-table -->

							</div> <!-- end .price-listing-->
                        </div> <!-- end grid-layout -->
					</div>
				</div><!-- .container -->
				
			</div><!-- end .content-about -->
		</div><!-- end .page-content -->
</div><!-- end .about-page-container -->

