<div id="header"><!-- start main header -->
			<div class="top"><!-- top -->
				<div class="container">
				
					<div class="media-top-left">
						<ul class="media-top clearfix">
							<li class="item"><i class="fa fa-phone"></i> Toll Free: 1660-01-13579</li>
						</ul>
					</div>
					
                     
					<div class="media-top-right">
						<?php
						$page_array = array('display','search_marketplace');
						if(!in_array($this->params['action'],$page_array)){		
						?>
						<div class="header-form media-top-2">						
							<!--<form class="form-inline" method="" action="">-->
                            <?php echo $this->Form->create('Page',array('action'=>'search_marketplace', 'class'=>'form-inline', 'type' => 'get','url' => array('controller' => 'pages', 'action' => 'search_marketplace'))); ?>
								
								<div class="form-group">
								   <!-- <label class="sr-only" for="location">Location</label>
								    <input type="email" class="form-control" id="location" placeholder="Type name of the places.">-->
                                   <?php 	
				echo $this->Form->input('searchplace',array('id'=>'location','placeholder'=>'Type name of the places.','label' => array('text'=> 'Location','class' =>'sr-only'),'class'=>'form-control'));
				?>
								</div>
								
								<div class="form-group">
								   <!-- <label class="sr-only" for="skill-type">Email address</label>
								    <input type="email" class="form-control" id="skill-type" placeholder="Skill Type Keywords here">-->
                                    <?php 	
				echo $this->Form->input('searchjob',array('id'=>'skill-type','placeholder'=>'Skill Type Keywords here','label' => array('text'=> 'Skill Type','class' =>'sr-only'),'class'=>'form-control'));
				?>
								</div>
								<!--
								<button type="submit" class="btn btn-green btn-sm">SEARCH</button>-->
                                <?php  echo $this->Form->button('Search',array('type'=>'submit','class'=>'btn btn-green btn-sm'));?>
								
								<?php echo $this->Form->end(); ?>
								
							<!--</form>-->
						
						</div> <!-- end header form -->
                       <?php  } ?>
						
						<ul class="media-top hidden-xs clearfix">
							<li class="item"><a href="<?php echo TWITER_URL?>" target="blank"><i class="fa fa-twitter"></i></a></li>
							<li class="item"><a href="<?php echo FACEBOOK_URL?>" target="blank"><i class="fa fa-facebook"></i></a></li>
							<!--<li class="item"><a href="<?php //echo GOOGLEPLUS_URL?>" target="blank"><i class="fa fa-google-plus"></i></a></li>-->
						</ul>
						
						<ul class="media-top-2 clearfix">
							 <?php if (AuthComponent::user()):?>
                             <li>Welcome, <?php echo strtok(AuthComponent::user('name'), " ");?></li>
							 <?php
							  if(AuthComponent::user('role')=='ServiceProvider'){?>
                             
								 <li><?php echo $this->html->link('PROFILE', array('controller'=>'users', 'action' => 'provider_profile_page'),array('class'=>'btn btn-default btn-blue btn-sm'));?></li>
                                 
							<?php }else{?>
						
							<li><?php echo $this->html->link('PROFILE', array('controller'=>'users', 'action' => 'seeker_profile'),array('class'=>'btn btn-default btn-blue btn-sm'));?></li>
                            
                            <?php }?>
                            
							<li><?php echo $this->html->link('LOGOUT', array('controller'=>'users', 'action' => 'logout'),array('class'=>'btn btn-default btn-green btn-sm'));?></li>
						    
						     <?php else:?>
						    
						    <li>
                            <button type="button" class="btn btn-default btn-blue btn-sm dropdown-toggle" data-toggle="dropdown">
                               REGISTER <span class="caret"></span>
                             </button>
                             
                             <ul class="dropdown-menu" role="menu">
                                 <li><a href="<?php echo SITE_URL.'seeker_register'?>">Service Seeker</a></li>
                                 <li><a href="<?php echo SITE_URL.'provider_register?type=company'?>">Service Provider Company</a></li>
                                 <li><a href="<?php echo SITE_URL.'provider_register?type=individual'?>">Individual Service Provider</a></li>
                             </ul>
                           
                            </li>
							<li><?php echo $this->html->link('LOG IN', array('controller'=>'users', 'action' => 'login'),array('class'=>'btn btn-default btn-green btn-sm'));?></li>
						    
						  <?php endif;?>
                         
						</ul>
						
						<div class="clearfix"></div>
					</div>
				</div>
			</div><!-- top -->
			<div class="container"><!-- container -->
				<div class="row">
					<div class="col-md-4 col-sm-3"><!-- logo -->
                    <?php 
					echo $this->Html->link($this->Html->image('/images/logo.png',array('class'=>'main-logo','alt' => 'job board')),array('controller' => 'pages', 'action' => 'display', 'home'),array('title' => 'Trilord Market','rel'=>'home','escape' => false));
					?>
					</div><!-- logo -->
					<div class="col-md-8 col-sm-9 main-nav"><!-- Main Navigation -->
						<a id="touch-menu" class="mobile-menu" href="#"><i class="fa fa-bars fa-2x"></i></a>
						<nav>
							<ul class="menu">
								<li><?php echo $this->html->link('HOME',array('controller' => 'pages', 'action' => 'display', 'home'));?></li>
								<li>
                                    <?php echo $this->html->link($menuItems['About']['title'],$menuItems['About']['url']);?>
								</li>
                                <li><?php echo $this->html->link('Search Market', array('controller'=>'pages', 'action' => 'search_marketplace'));?></li>
                                <li><?php echo $this->html->link('Career', array('controller'=>'careers', 'action' => 'career'));?></li>
                                <li><a href="javascript:void(0)">FAQ</a>
									<ul class="sub-menu">
                                    	<li><?php echo $this->html->link("Service Provider", array('controller'=>'faqs', 'action' => 'view/provider'));?></li>
                                        <li><?php echo $this->html->link("Customer", array('controller'=>'faqs', 'action' => 'view/customer'));?></li>
                                    </ul>
								</li>
                                
                               <li><?php echo $this->html->link('Contact Us', array('controller'=>'pages', 'action' => 'contact'));?></li>
							</ul>
						</nav>
					</div><!-- Main Navigation -->
					<div class="clearfix"></div>
				</div>
			</div><!-- container -->
		</div><!-- end main header -->
  <?php //debug($getPlace);die;
		//debug($getSearchjob);die;
		echo $this->Html->script('jquery.tokeninput');
		echo $this->Html->css('header-token-input');
		//debug(SITE_URL);die;
?>

<!--<div  class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button"  class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Registration</h4>
      </div>
      <div class="modal-body">
	<p>Please select one of the link below to register for Service Seeker or Service Provider :</p>
	<p>
	<a href="<?php //echo SITE_URL.'seeker_register'?>" class="btn btn-blue btn-primary">Register as Service Seeker</a>
	<a href="<?php //echo SITE_URL.'provider_register'?>" class="btn btn-primary">Register as Service Provider</a>
	</p>
      </div>
      </div>
    </div>--><!-- /.modal-content -->
  <!--</div>--><!-- /.modal-dialog -->
<!--</div>--><!-- /.modal -->

<script type="text/javascript">
        $(document).ready(function() {
          
		 
			$("#location").tokenInput(<?php  echo json_encode($getPlace)?>, {
                theme: "facebook",
                placeholder: 'Type name of the places',
				preventDuplicates: true,
				tokenLimit : 1
            });
			
			$("#skill-type").tokenInput(<?php echo json_encode($getSearchjob)?>, {
                theme: "facebook",
				placeholder:"Skill type keywords",
				preventDuplicates: true,
				tokenLimit : 1,
				onResult: function (item) {
							if($.isEmptyObject(item)){
								  return [{id:$("#token-input-skill-type").val(),name: $("#token-input-skill-type").val()}]
							}else{
								  item.unshift({id:'0', name: $("#token-input-skill-type").val()});
								  return item
							}
					
						}
	
				});
			
			$('#magnefic-popup').magnificPopup({
				type: 'inline',
				preloader: false,
				focus: '#username',
				modal: true,
				
			});
			$(document).on('click', '.close', function (e) {
				e.preventDefault();
				$.magnificPopup.close();
			});
			
			$('#magnefic-popup1').magnificPopup({
				type: 'inline',
				preloader: false,
				focus: '#username',
				modal: true,
				
			});
						
        });
        </script>
