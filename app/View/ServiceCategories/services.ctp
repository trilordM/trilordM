<div class="main-page-title"><!-- start main page title -->
	<div class="container">
		<div class="page-title">Our Services</div>
	</div>
</div><!-- end main page title -->


<div class="content-about">

	<div class="container">
		
		<!--<div class="spacer-1">&nbsp;</div>-->
		
				<!--<div class="col-md-6">
						<div class="list-group">
                        	<?php //debug($serviceCategories); die;
							//foreach($serviceCategories as $category):?>
						  <a href="" class="list-group-item"><?php //echo $category['ServiceCategory']['title'];?></a> 
                           <?php //endforeach;?>
						</div>
					</div>-->
		
		<div class="spacer-1">&nbsp;</div>
        
        <div class="col-md-8">
								<!--accordion-->
                              <!--  <div class="panel-group" id="accordion">
                                <?php 
								/*$i=0;
								//debug($serviceCategories); die;
								foreach($serviceCategories as $category):
								$i++;*/
								?>
                                  <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php //echo $i?>">
                                          <?php //echo $category['ServiceCategory']['title']?>
                                        </a>
                                      </h4>
                                    </div>
                                    <?php
									/*$subcategories=$this->SmartForm->getsubcategories($category['ServiceCategory']['id']);
									//debug($subcategories);
										$j=0;
										foreach($subcategories as $subcategory):
										$j++;*/
										?>
                                    <div id="collapse<?php  //echo $i?>" class="panel-collapse collapse <?php //echo $j==1?'in':''?>">
                                      <div class="panel-body">
                                       <?php //echo $subcategory['service_categories']['title']?>
                                      </div>
                                    </div>
                                     <?php //endforeach;?>
                                  </div>
                                 <?php //endforeach;?> 
                                </div>-->
                                
                            
						<div class="list-group">
                        	<?php //debug($serviceCategories);die;
							foreach($serviceCategories as $category):?>
						  <a href="<?php echo SITE_URL.'search_marketplace?searchplace=&searchjob='.$category['ServiceCategory']['id']?> " class="list-group-item"><?php echo $category['ServiceCategory']['title'];?></a> 
                           <?php endforeach;?>
						</div>
					
                                <div class="spacer-1">&nbsp;</div>
                                <!--accordion-->
						</div>
	
    
    
	</div> <!-- end container -->

</div> <!-- end content-about -->