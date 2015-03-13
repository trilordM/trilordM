
    <div class="container search-market-list">
      <div class="row">

        <div class="col-md-9 col-md-push-3">
          <div class="page-content">

            <div class="product-details-list view-switch">
              <div class="tab-content">

                <div class="tab-pane active" id="category-book">


                  <h2><?php echo $searchJobTitle; ?><span class="category-name"><b>\</b>Search Results</span><span class="comments"><?php echo $this->Paginator->counter('{:count}') ?></span></h2>


                  <div class="row clearfix">
                  <?php
                 if($user){
                    $i=0;
                    foreach($user as $users):

                 ?>

                    <div class="col-sm-4 col-xs-6">

                      <div class="single-product">
                        <figure>
                            <?php if(file_exists(WWW_ROOT.'providers_photo/thumbs/'.$users[0]['__profilephoto'])&&!empty($users[0]['__profilephoto'])){
                                                                                    echo $this->Html->link($this->Html->image('/providers_photo/thumbs/'.$users[0]['__profilephoto'],array('class'=>'img-responsive img-thumbnail','alt'=>'dummy-joblist')),array('controller' => 'users', 'action' => 'provider',$users[0]['__id']),array('escape'=>false));

                            }else{
                                    echo $this->Html->link($this->Html->image('avatar.gif',array('class'=>'img-responsive img-thumbnail','alt'=>'dummy-joblist')),array('controller' => 'users', 'action' => 'provider',$users[0]['__id']),array('escape'=>false));
                            }?>
                        </figure>

                        <div class="box-result-cnt">
                            <hr>
                            <div class="rate-result-cnt">
                                <div class="rate-bg" style="width:<?php echo $users[0]['0']; ?>%"></div>
                                <div class="rate-stars"></div>
                            </div>
                            <hr>
                        </div>

                        <h4><a href="#"><?php echo $this->Html->link($users[0]['__name'],array('controller' => 'users', 'action' => 'provider',$users[0]['__id']));?></a></h4>

                        <h5><?php $serviceCategories=str_replace(",",", ",$users[0]['__categories']);
                                  echo $serviceCategories;
                             ?>

                        </h5>

                        <p><?php echo substr($users[0]['__aboutme'],0,130)."...";?></p>
                        <?php echo $this->html->link('Request Info', array('controller'=>'SeekerProviderRequests', 'action' => 'add',$users[0]['__id']), array('class' => 'btn btn-blue'));?>
                        <?php echo $this->html->link('View Listing', array('controller'=>'users', 'action' => 'provider',$users[0]['__id']), array('class' => 'btn btn-burgandy'));?>

                      </div> <!-- end .single-product -->
                    </div> <!-- end .col-sm-4 grid layout -->

                  <?php $i++; endforeach;?>
                  <ul class="pagination">

                      <li >
                      <?php
                          echo $this->Paginator->prev('Prev',array('class' => 'pag-prev'), null, array('class' => 'pag-prev disabled'));
                      ?>
                      </li>
                      <li>
                      <?php
                          echo $this->Paginator->numbers(array('separator' => '','currentClass' => 'pag-num active','class' =>'pag-num'));
                      ?>
                      </li>
                      <li>
                      <?php
                          echo $this->Paginator->next('Next',array('class' => 'pag-next'), null, array('class' => 'pag-next disabled'));
                      ?>
                      </li>
                  </ul>
                   <?php }
                   else{
                        echo ' <h4>At this time, we do not have anything available in the category you just selected. We apologize for any inconvenience. </h4>
                        <strong>Please check out other categories or contact us at Toll Free: 1660-01-13579, or email us at email@trilordmarket.com if you need any assistance.</strong>';
                    }?>

                  </div> <!-- end .row -->
                </div> <!-- end .tab-pane -->

              </div> <!-- end .tab-content -->


            </div> <!-- end .product-details -->
          </div> <!-- end .page-content -->
        </div>

        <div class="col-md-3 col-md-pull-9 category-toggle">
          <button><i class="fa fa-briefcase"></i></button>

          <div class="page-sidebar">

            <ul class="list-group">
                <?php $i = 0 ;
                 foreach($getSearchjob as $joblist):
                    $i++;
                    if($i > 25)
                        break;
                    $count = $this->SmartForm->getServiceInfo($joblist['id']);
                    if($count<=0) continue;
                ?>
                  <li class="list-group-item">
                    <span class="badge"><?php echo $count; ?></span>
                    <?php echo $this->Html->link(
                        $joblist['name'],
                        'search_marketplace?searchjob='. $joblist['id'] . "&searchplace="
                    ); ?>
                  </li>
                <?php endforeach; ?>
            </ul>

          </div> <!-- end .page-sidebar -->
        </div> <!-- end grid layout-->
      </div> <!-- end .row -->
    </div> <!-- end .container -->
