<div class="main-page-title"><!-- start main page title -->
	
	<div class="container">
		
		<div class="post-job-title">Welcome to TrilordMarket!</div>
		<div class="post-job-phone"><img src="<?php echo SITE_URL;?>images/registration-search-assist.png" width="600" height="30" /></div>
		
	</div>
	
</div><!-- end main page title -->

<div class="content-about">
	
	<div class="container">
		
		<div class="spacer-1">&nbsp;</div>
		
		<div class="row">
			
			<div class="col-md-8">
				
				<div class="welcome-registration">
					
					<p>Dear <?php echo $name;?>,</p>
					<p>Thank you for registering with us!</p>
					<p>We are here to ensure that services you require are available at your door step.  Let's begin!</p>				
					
				</div> <!-- end col-12 -->
				
				<div class="row">
					
					<div class="col-md-6">
						
						<h6>Our service categories</h6>
						<div class="list-group">
                        	<?php foreach($categories as $category):?>
						  <a href="<?php echo SITE_URL.'search_marketplace?searchplace=&searchjob='.$category['service_categories']['id']?> " class="list-group-item"><?php echo $category['service_categories']['title'];?></a> 
                           <?php endforeach;?>
                           <a href="<?php echo SITE_URL.'service_categories/services'?>" class="list-group-item active">+ More Services</a>
						</div>
					</div>
					
					<div class="col-md-6">
						
						<div class="payment-info">
							<h6>Safe &amp; Easy Payments</h6>
							<p><img src="<?php echo SITE_URL;?>images/payment.png" width="350" height="233" alt="Payment Options" /></p>
						</div>
					
					</div>
				
				</div> <!-- end row -->
				
				<p>Visit our <a href="<?php echo SITE_URL.'contents/'.$getPrivacyPolicy[0]['ContentPage']['slug']; ?>">Privacy Policy</a> and <a href="#">User Agreement</a> if you have any questions. 
				
			</div> <!-- end col-8 -->
			
			<div class="col-md-4">
			
		<?php if(!empty($service_packages)){?>
				<div class="jumbotron">
				  <h3>Exclusive Deal</h3>
                 <h6> <?php //debug($service_packages);die;
				 echo $service_packages[0]['ServicPackage']['title'];?></h6>
                  <p><?php echo substr($service_packages[0]['ServicPackage']['description'],0,120).'...';?></p>
				  <!--<p>Free Manicure with any Hair treatment service at Rashmi Beauty Parlor.</p>-->
                  <p><?php echo $this->Html->link('Request Package',array('controller' => 'service_package_requests', 'action' => 'add',$service_packages[0]['ServicPackage']['slug']),array('class'=>'btn btn-primary btn-green'));?></p>
				  <!--<p><a class="btn btn-primary btn-green">Request Package</a></p>-->
				</div>
				<?php }?>
				<div class="jumbotron">
					
					<h3>Contact us if you have any query.</h3>
					<p>Toll Free No. 1660-01-13579</p>
					<p>Follow Us:  <a href="<?php echo FACEBOOK_URL?>">Facebook</a>, <a href="#">Twitter</a></p>
					
				</div>
			
			</div> <!-- end col-4 -->
			
		</div> <!-- end row -->
		
		<div class="spacer-1">&nbsp;</div>
		
	</div> <!-- end container -->
	
</div> <!-- end content-about -->