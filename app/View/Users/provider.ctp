<div class="container provider-detail-page">
            <div class="row clearfix">
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="single-user col-md-12">
                        <figure>
                            <?php if(file_exists(WWW_ROOT.'providers_photo/thumbs/'.$user['User']['profile_photo'])&&!empty($user['User']['profile_photo'])){
                                echo $this->Html->image('/providers_photo/thumbs/'.$user['User']['profile_photo'],array('class'=>'img-responsive job-detail-logo img-rounded','alt'=>'Profile Image'));
                            }else{
                                echo $this->Html->image('avatar.gif',array('class'=>'img-responsive job-detail-logo img-rounded','alt'=>'No Image')) ;
                            }
                            ?>

                            <div class="rating">

                                <ul class="list-inline">
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-half-o"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                </ul>

                            </div> <!-- end .rating -->
                        </figure>
                        <h4><?php echo h($user['User']['name']); ?>'s Profile</h4>

                        <h5>
                            <?php $serviceCategories=str_replace(",",", ",$serviceCategories[0][0]['title']);
                            echo $serviceCategories;
                            ?>
                        </h5>
                        <strong>
                            <i class="fa fa-map-marker"></i>&nbsp; &nbsp;<?php if(!empty($user_place[0][0]['PlaceName'])){
                            echo h($user_place[0][0]['PlaceName']);
                            }?>
                        </strong>
                        <?php echo $this->html->link('Request Info', array('controller'=>'SeekerProviderRequests', 'action' => 'add',$user['User']['id']), array('class' => 'btn btn-blue'));?>
                    </div><!-- end .single-user .col-sm-12 grid-layout-->
                    <div class="shortcodes col-md-12">
                        <ul class="nav nav-tabs list-inline horizontal-tab" role="tablist">
                            <li class="active"><a href="#tab-1" role="tab" data-toggle="tab">Overview</a>
                            </li>
                            <li><a href="#tab-2" role="tab" data-toggle="tab">Specialities</a>
                            </li>
                            <li><a href="#tab-3" role="tab" data-toggle="tab">Review</a>
                            </li>
                        </ul>
                         <div class="tab-content">
                                <div class="tab-pane fade in active" id="tab-1">
                                    <?php
                                        if(!empty($user['User']['additional_experience'])){
                                            echo ' <strong>Additional Experience</strong><p>'. $user['User']['additional_experience'].'</p>';
                                        }
                                    ?>

                                    <strong>About Me:</strong>
                                    <p>
                                    <?php echo ($user['User']['about_me']); ?>
                                    </p>

                                        <?php if($user['User']['registered_as']=='company'){
                                            if(!empty($user['User']['contact_person'])){
                                                echo '<h6>CONTACT PERSON</h6> <p>'.$user['User']['contact_person'].'</p>';
                                            }
                                        }?>

                                </div><!-- end .tab-pane-->

                                <div class="tab-pane fade" id="tab-2">
                                    <p>
                                        <strong>Specialities</strong>
                                        <?php
                                            echo $serviceCategories;
                                        ?>
                                    </p>
                                </div><!-- end .tab-pane-->


                                <div class="tab-pane fade" id="tab-3">
                                    <h6>REVIEWS</h6>

                                    <blockquote class="blockquote">
                                        <?php
                                            if(isset($review_record) && count($review_record)>0){
                                        ?>
                                        <div id="job-opening-carousel" class="owl-carousel">
                                            <?php  foreach($review_record as $review_records): ?>
                                                <div class="item-home blockquote-content">
                                                    <p>
                                                        <?php echo substr($review_records['Review']['description'],0,120).' ...'?>
                                                     </p>
                                                    <footer>
                                                        <?php
                                                            $time = $this->Time->format('F jS, Y',$review_records['Review']['review_date']);
                                                            echo $this->SmartForm->getUserInfo($review_records['Review']['service_seeker_id']).'</br> '. $time
                                                        ?>
                                                    </footer>

                                                </div><!-- end .item-home -->
                                            <?php endforeach; }
                                            else{?>
                                                <div class="item-home blockquote-content">
                                                    <p>No review available.</p>
                                                </div>
                                            <?php } ?>
                                        </div><!-- end .job-opening-carousel-->
                                    </blockquote>
                                </div><!-- end .tab-pane-->

                         </div><!-- end .tab-content->

                    </div><!-- end .shortcodes .col-sm-12 grid-layout-->

                </div> <!-- end .col-sm-8 grid layout -->
                
                <?php if(!AuthComponent::User()):?>
               
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
                            </div><!-- end .btn-group -->
                          </div> <!-- end .pricing-table -->

                      </div> <!-- end .price-listing-->

                </div> 
            <?php endif;?><!-- end .col-sm-12 grid-layout -->
               


            </div><!-- end .row-->
</div>  <!-- end .provider-detail-page -->


