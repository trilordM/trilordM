<div class="confirm-message-container"><!-- start main page title -->
    <div class="title-container"><!-- start main page title -->
        <div class="container">
            <div class="page-title">Account Confirmation</div>
        </div>
    </div><!-- end .title-container -->
    <div class="container content-container">

         <div class="row">

                <div class="col-md-3 col-md-12 page-sidebar">

                     <ul class="list-group">
                        <?php $i = 0 ;
                         foreach($categories as $category):
                            $i++;
                            if($i > 25)
                                break;
                            $count = $this->SmartForm->getServiceInfo($category['service_categories']['id']);
                            if($count<=0) continue;
                        ?>
                          <li class="list-group-item">
                            <span class="badge"><?php echo $count; ?></span>
                            <?php echo $this->Html->link(
                                $category['service_categories']['title'],
                                'search_marketplace?searchjob='.$category['service_categories']['id']
                            ); ?>
                          </li>
                        <?php endforeach; ?>
                     </ul>

                </div> <!-- end .col-md-4 .col-categories -->

                <div class="col-md-8 col-md-12 welcome-registration">

                    <p>Dear <?php echo $name;?>,</p>
                    <p>Thank you for registering with us!</p>
                    <p>We are here to ensure that services you require are available at your door step.  Let's begin!</p>

                </div> <!-- end .col-md-9 .welcome-registration -->

         </div> <!-- end .row -->

    </div> <!-- end content-container -->
</div><!-- end .confirm-message-container -->