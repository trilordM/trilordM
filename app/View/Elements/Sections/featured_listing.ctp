 <div class="featured-listing" id= "featured-list">
    <div class="container col-md-6 col-sm-12 col-xs-12">
        <div class="row clearfix">
            <h2><strong>Featured</strong>  Listing</h2>

            <?php
                $i=0;
                foreach($user as $users):
                    $i++;
            ?>
                <div class="feature-box col-md-3 col-sm-3 col-xs-6">
                    <div class="single-product">
                        <figure>
                            <?php if(file_exists(WWW_ROOT.'providers_photo/thumbs/'.$users['U']['profile_photo'])&&!empty($users['U']['profile_photo'])){
                                    echo $this->Html->link($this->Html->image('/providers_photo/thumbs/'.$users['U']['profile_photo'],array('class'=>'img-responsive img-thumbnail','alt'=>'Profile Photo')),array('controller' => 'users', 'action' => 'provider',$users['U']['id']),array('escape'=>false));

                            }else{
                                echo $this->Html->link($this->Html->image('avatar.gif',array('class'=>'img-responsive img-thumbnail','alt'=>'Profile Photo Avatar')),array('controller' => 'users', 'action' => 'provider',$users['U']['id']),array('escape'=>false));
                            }?>

                           
                            <figcaption>
                                <div class="bookmark">
                                <?php echo $this->html->link('Request Info', array('controller'=>'SeekerProviderRequests', 'action' => 'add',$users['U']['id']));?>
                                </div>
                            </figcaption>
                        </figure>
                        <h6><?php $serviceCategories=str_replace(",",", ",$users[0]['categories']);
                                  echo substr($serviceCategories,0,30) . "...";
                            ?>
                        </h6>

                    </div> <!-- end .single-product -->
                </div> <!-- end .col-md-6 .col-sm-6 .col-xs-12 -->
            <?php endforeach; ?>
        </div>  <!-- end .row -->
    </div>  <!-- end .container -->
</div>  <!-- end .featured-listing -->