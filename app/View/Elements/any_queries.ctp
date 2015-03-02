<?php
if(!(AuthComponent::user())):?>
<div id="cs"><!-- CS -->
					<div class="container">
					<div class="spacer-1">&nbsp;</div>
						<h2>New to Trilord Market?</h2>
						<p class="lead">Trilord Market is an online service portal devoted to bridging the needs between service seekers and service providers. It acts as a facilitator by connecting the right service providers with the service seekers through the website.</p>
						
						<div class="btn-group phone-cs dropup">
						  <button type="button" class="btn btn-default btn-blue dropdown-toggle"  data-toggle="dropdown">REGISTER &nbsp;<span class="caret"></span></button>
						  
						  <ul class="dropdown-menu" role="menu">
						    <li><a href="<?php echo SITE_URL.'seeker_register'?>">Service Seeker</a></li>
						    <li><a href="<?php echo SITE_URL.'provider_register?type=company'?>">Service Provider Company</a></li>
						    <li><a href="<?php echo SITE_URL.'provider_register?type=individual'?>">Individual Service Provider</a></li>
						  </ul>
						</div>
						
					</div>
				</div><!-- CS -->
<?php endif; ?>
                
