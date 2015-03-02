<div class="main-slider"><!-- start main-headline section -->
	<div class="slider-nav">
		<a class="slider-prev"><i class="fa fa-chevron-circle-left"></i></a>
		<a class="slider-next"><i class="fa fa-chevron-circle-right"></i></a>
	</div>
	<div id="home-slider" class="owl-carousel owl-theme">
		<div class="item-slide">
			<img src="images/upload/dummy-slide-1.jpg" class="img-responsive" alt="dummy-slide" />
		</div>
		<div class="item-slide">
			<img src="images/upload/dummy-slide-2.jpg" class="img-responsive" alt="dummy-slide" />
		</div>
	</div>
</div><!-- end main-headline section -->

<div class="headline container"><!-- start headline section -->
		<div class="row" >
			<div class="col-md-6 align-right">
				<h4>Easiest Way To Find Skilled People</h4>
				<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using</p>
				<p><a href="#" class="btn btn-default btn-yellow">Find Skilled People</a></p>
			</div>
			<div class="col-md-6 align-left">
				<h4>Skilled People, Looking for Marketplace?</h4>
				<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using</p>
				<p><a href="#" class="btn btn-default btn-light" >Post Your Resume</a></p>
			</div>
			<div class="clearfix"></div>
		</div>
</div><!-- end headline section -->

<?php echo $this->element('search');?>

<div class="recent-job"><!-- Start Recent Job -->
	  <div class="container">
		  <div class="row">
			  <div class="col-md-8">
				  <h4><i class="fa fa-users"></i> Top Skilled People</h4>
				  <div id="tab-container" class='tab-container'><!-- Start Tabs -->
					  <ul class='etabs clearfix'>
						  <li class='tab'><a href="#all">All</a></li>
						  <li class='tab'><a href="#contract">Contract</a></li>
						  <li class='tab'><a href="#full">Full Time</a></li>
						  <li class='tab'><a href="#free">Freelence</a></li>
					  </ul>
					  <div class='panel-container'>
						  <div id="all"><!-- Tabs section 1 -->
                         <?php 
						 //debug($user);die;
						 	$i=0;
						    foreach($user as $users): 
                            $i++;
							?>
							  <div class="recent-job-list-home"><!-- Tabs content -->
								  <div class="job-list-logo col-md-1 ">
								  <?php echo $this->Html->image('/providers_photo/'.$users['U']['profile_photo'],array('class'=>'img-responsive','alt'=>'dummy-joblist'));?>
								  </div>
								  <div class="col-md-6 job-list-desc">
									  <h6><?php echo $users['U']['name']?></h6>
									  <p>Similique sunt in culpa qui officia deserunt mollitia animi</p>
									  <p class="small">
                                      <?php echo $users[0]['categories']?></p>
                                      <?php echo $this->Rating->star('user_id', 'User', $ratings); ?>
								  </div>
								  <div class="col-md-5 full">
									  <div class="row">
										  <div class="job-list-location col-md-7 ">
											  <h6><i class="fa fa-map-marker"></i><?php echo $users['U']['permanent_address']?></h6>
										  </div>
										  <div class="job-list-type col-md-5 ">										  
										  <?php $rate=explode(",",$users[0]['rate']);
										  foreach($rate as $rates):
										  ?>
										  
											  <h6><i class="fa fa-money"></i><?php echo $rates ?></h6>
										  
										  <?php endforeach; ?>
										  </div>
									  </div>
								  </div>
								  <div class="clearfix"></div>
							  </div><!-- Tabs content -->
							  <?php endforeach; ?>
							  
						  </div><!-- Tabs section 1 -->
						  <div id="contract"><!-- Tabs section 2 -->
							  
							  
						  </div><!-- Tabs section 2 -->
						  <div id="full"><!-- Tabs section 3 -->

							  
						  </div><!-- Tabs section 3 -->
						  <div id="free"><!-- Tabs section 4 -->
						  
							  

						  </div><!-- Tabs section 4 -->
				   
					  </div>
				  </div><!-- end Tabs -->
				  <div class="spacer-1"></div>
			  </div>
			  
			  <div class="col-md-4">
				  <div id="job-opening">
					  <div class="job-opening-top">
						  <div class="job-oppening-title">Latest Package</div>
						  <div class="job-opening-nav">
							  <a class="btn prev"></a>
							  <a class="btn next"></a>
							  <div class="clearfix"></div>
						  </div>
					  </div>
					  <div class="clearfix"></div>
					  <br/>
					  <div id="job-opening-carousel" class="owl-carousel">
					  
						  <div class="item-home">
							  <div class="job-opening">
								  <img src="images/upload/dummy-job-open-1.png" class="img-responsive" alt="dummy-job-opening" />
								  
								  <div class="job-opening-content">
									  HR Manager
									  <p>
										  Place for worlds best shipping company and work with great level efficiency to break trough in new career.
									  </p>
								  </div>
								  
								  <div class="job-opening-meta clearfix">
									  <div class="meta-job-location meta-block"><i class="fa fa-map-marker"></i>San Fransisco</div>
									  <div class="meta-job-type meta-block"><i class="fa fa-user"></i>Full Time</div>
								  </div>
							  </div>
						  </div>
						  
						  <div class="item-home">
							  <div class="job-opening">
								  <img src="images/upload/dummy-job-open-2.png" class="img-responsive" alt="dummy-job-opening" />
								  
								  <div class="job-opening-content">
									  Head Shop Manager
									  <p>
										  Place for worlds best shipping company and work with great level efficiency to break trough in new career.
									  </p>
								  </div>
								  
								  <div class="job-opening-meta clearfix">
									  <div class="meta-job-location meta-block"><i class="fa fa-map-marker"></i>Denver</div>
									  <div class="meta-job-type meta-block"><i class="fa fa-user"></i>Full Time</div>
								  </div>
							  </div>
						  </div>
						  <div class="item-home">
							  <div class="job-opening">
								  <img src="images/upload/dummy-job-open-1.png" class="img-responsive" alt="dummy-job-opening" />
								  
								  <div class="job-opening-content">
									  Head Shop Manager
									  <p>
										  Place for worlds best shipping company and work with great level efficiency to break trough in new career.
									  </p>
								  </div>
								  
								  <div class="job-opening-meta clearfix">
									  <div class="meta-job-location meta-block"><i class="fa fa-map-marker"></i>San Fransisco</div>
									  <div class="meta-job-type meta-block"><i class="fa fa-user"></i>Washington</div>
								  </div>
							  </div>
						  </div>
						  
					  </div>
				  </div>

				  <div class="post-resume-title">Post Your Resume</div>
				  <div class="post-resume-container">
					  <button type="button" class="post-resume-button">Upload Your Resume<i class="icon-upload grey"></i></button>
				  </div>
			  </div>
			  <div class="clearfix"></div>
		  </div>
	  </div>
  </div><!-- end Recent Job -->
  
<div class="job-status">
	<div class="container">
			<h1>Trilord Marketplace Overview</h1>
			<p>
				At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi.
			</p>

			<div class="counter clearfix">
				<div class="counter-container">
					<div class="counter-value">300</div>
					<div class="line"></div>
					<p>Profiles</p>
				</div>
	
				
				<div class="counter-container">
					<div class="counter-value">50</div>
					<div class="line"></div>
					<p>Category</p>
				</div>
				
				<div class="counter-container">
					<div class="counter-value">75</div>
					<div class="line"></div>
					<p>New Profiles</p>
				</div>
				
				<div class="counter-container">
					<div class="counter-value">85</div>
					<div class="line"></div>
					<p>Job Accomplished</p>
				</div>
			</div>
		
	</div>
</div>

<div class="step-to">
	<div class="container">
		<h1>Easiest Way To Use</h1>
		<p>
			At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas mo
		</p>

		<div class="step-spacer"></div>
		<div id="step-image">
			<div class="step-by-container">
				<div class="step-by">
					First Step
					<div class="step-by-inner">
						<div class="step-by-inner-img">
							<img src="images/step-icon-1.png" alt="step" />
						</div>
					</div>
					<h5>Register with us</h5>
				</div>
						
				<div class="step-by">
					Second Step
					<div class="step-by-inner">
						<div class="step-by-inner-img">
							<img src="images/step-icon-2.png" alt="step" />
						</div>
					</div>
					<h5>Create your profile</h5>
				</div>
						
				<div class="step-by">
					Third Step
					<div class="step-by-inner">
						<div class="step-by-inner-img">
							<img src="images/step-icon-3.png" alt="step" />
						</div>
					</div>
					<h5>Upload your resume</h5>
				</div>
						
				<div class="step-by">
					Now it's our turn
					<div class="step-by-inner">
						<div class="step-by-inner-img">
							<img src="images/step-icon-4.png" alt="step" />
						</div>
					</div>
					<h5>Now take rest :)</h5>
				</div>
						
			</div>
		</div>
		<div class="step-spacer"></div>
	</div>
</div>  

<div class="testimony">
	<div class="container">
		<h1>What People Say About Us</h1>
		<p>
			At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas mo
		</p>
			
	</div>
	<div id="sync2" class="owl-carousel">
		<div class="testimony-image">
			<img src="images/upload/testimony-image-1.jpg" class="img-responsive" alt="testimony"/>
		</div>
		<div class="testimony-image">
			<img src="images/upload/testimony-image-2.jpg" class="img-responsive" alt="testimony"/>
		</div>
		<div class="testimony-image">
			<img src="images/upload/testimony-image-3.jpg" class="img-responsive" alt="testimony"/>
		</div>
		<div class="testimony-image">
			<img src="images/upload/testimony-image-4.jpg" class="img-responsive" alt="testimony"/>
		</div>
		<div class="testimony-image">
			<img src="images/upload/testimony-image-5.jpg" class="img-responsive" alt="testimony"/>
		</div>
		<div class="testimony-image">
			<img src="images/upload/testimony-image-6.jpg" class="img-responsive" alt="testimony"/>
		</div>
		<div class="testimony-image">
			<img src="images/upload/testimony-image-7.jpg" class="img-responsive" alt="testimony"/>
		</div>
		<div class="testimony-image">
			<img src="images/upload/testimony-image-8.jpg" class="img-responsive" alt="testimony"/>
		</div>
		<div class="testimony-image">
			<img src="images/upload/testimony-image-9.jpg" class="img-responsive" alt="testimony"/>
		</div>
		<div class="testimony-image">
			<img src="images/upload/testimony-image-10.jpg" class="img-responsive" alt="testimony"/>
		</div>
		
	</div>
	
	<div id="sync1" class="owl-carousel">
		<div class="testimony-content container">
			<p>
				"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum .
				
			</p>
			<p>
				John Grasin, CEO, IT-Planet
			</p>
			<div class="media-testimony">
				<a href="#" target="blank"><i class="fa fa-twitter twit"></i></a>
				<a href="#" target="blank"><i class="fa fa-linkedin linkedin"></i></a>
				<a href="#" target="blank"><i class="fa fa-facebook fb"></i></a>
			</div>
		</div>
		<div class="testimony-content container">
			<p>
				"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum .
				
			</p>
			<p>
				John Grasin, CEO, IT-Planet
			</p>
			<div class="media-testimony">
				<a href="#" target="blank"><i class="fa fa-twitter twit"></i></a>
				<a href="#" target="blank"><i class="fa fa-linkedin linkedin"></i></a>
				<a href="#" target="blank"><i class="fa fa-facebook fb"></i></a>
			</div>
		</div>
		<div class="testimony-content container">
			<p>
				"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum .
				
			</p>
			<p>
				John Grasin, CEO, IT-Planet
			</p>
			<div class="media-testimony">
				<a href="#" target="blank"><i class="fa fa-twitter twit"></i></a>
				<a href="#" target="blank"><i class="fa fa-linkedin linkedin"></i></a>
				<a href="#" target="blank"><i class="fa fa-facebook fb"></i></a>
			</div>
		</div>
		<div class="testimony-content container">
			<p>
				"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum .
				
			</p>
			<p>
				John Grasin, CEO, IT-Planet
			</p>
			<div class="media-testimony">
				<a href="#" target="blank"><i class="fa fa-twitter twit"></i></a>
				<a href="#" target="blank"><i class="fa fa-linkedin linkedin"></i></a>
				<a href="#" target="blank"><i class="fa fa-facebook fb"></i></a>
			</div>
		</div>
		<div class="testimony-content container">
			<p>
				"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia.
				
			</p>
			<p>
				John Grasin, CEO, IT-Planet
			</p>
			<div class="media-testimony">
				<a href="#" target="blank"><i class="fa fa-twitter twit"></i></a>
				<a href="#" target="blank"><i class="fa fa-linkedin linkedin"></i></a>
				<a href="#" target="blank"><i class="fa fa-facebook fb"></i></a>
			</div>
		</div>
		<div class="testimony-content container">
			<p>
				"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate.
				
			</p>
			<p>
				John Grasin, CEO, IT-Planet
			</p>
			<div class="media-testimony">
				<a href="#" target="blank"><i class="fa fa-twitter twit"></i></a>
				<a href="#" target="blank"><i class="fa fa-linkedin linkedin"></i></a>
				<a href="#" target="blank"><i class="fa fa-facebook fb"></i></a>
			</div>
		</div>
		<div class="testimony-content container">
			<p>
				"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum .
				
			</p>
			<p>
				John Grasin, CEO, IT-Planet
			</p>
			<div class="media-testimony">
				<a href="#" target="blank"><i class="fa fa-twitter twit"></i></a>
				<a href="#" target="blank"><i class="fa fa-linkedin linkedin"></i></a>
				<a href="#" target="blank"><i class="fa fa-facebook fb"></i></a>
			</div>
		</div>
		<div class="testimony-content container">
			<p>
				"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum . At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum .
				
			</p>
			<p>
				John Grasin, CEO, IT-Planet
			</p>
			<div class="media-testimony">
				<a href="#" target="blank"><i class="fa fa-twitter twit"></i></a>
				<a href="#" target="blank"><i class="fa fa-linkedin linkedin"></i></a>
				<a href="#" target="blank"><i class="fa fa-facebook fb"></i></a>
			</div>
		</div>
		<div class="testimony-content container">
			<p>
				"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti.	
			</p>
			<p>
				John Grasin, CEO, IT-Planet
			</p>
			<div class="media-testimony">
				<a href="#" target="blank"><i class="fa fa-twitter twit"></i></a>
				<a href="#" target="blank"><i class="fa fa-linkedin linkedin"></i></a>
				<a href="#" target="blank"><i class="fa fa-facebook fb"></i></a>
			</div>
		</div>
		<div class="testimony-content container">
			<p>
				"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.
				
			</p>
			<p>
				John Grasin, CEO, IT-Planet
			</p>
			<div class="media-testimony">
				<a href="#" target="blank"><i class="fa fa-twitter twit"></i></a>
				<a href="#" target="blank"><i class="fa fa-linkedin linkedin"></i></a>
				<a href="#" target="blank"><i class="fa fa-facebook fb"></i></a>
			</div>
		</div>
	</div>
</div>