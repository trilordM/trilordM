<div class="col-md-9 col-xs-12 user-profile-content right-column">
    <?php echo $this->Session->flash(); ?>
		<div class="row">
			<div class="col-md-2 col-xs-12">

				<?php if(file_exists(WWW_ROOT.'seekers_photo/thumbs/'.$user['User']['profile_photo'])&&!empty($user['User']['profile_photo'])){ 
				 	echo $this->Html->image('/seekers_photo/thumbs/'.$user['User']['profile_photo'],array('class'=>'img-responsive job-detail-logo img-rounded','alt'=>'Profile_pic'));
				}else{ 
					echo $this->Html->image('avatar.gif',array('class'=>'img-responsive job-detail-logo img-rounded','alt'=>'No Image')) ;
				}
				?>
				<?php 
				    echo $this->Html->link('<i class="fa fa-edit"></i>Edit Profile', array('action' => 'seeker_pic_edit'), array('escape' => FALSE));
				?>
			</div> <!-- end .col -->
			
			<div class="col-md-10 col-xs-12">
				
				<ul class="user-details">
					<li class="user-name"><i class="fa fa-user"></i><?php echo h($user['User']['name']); ?></li>
					<li><i class="fa fa-envelope"></i><?php echo h($user['User']['email']); ?></li>
					<li><i class="fa fa-phone"></i><?php echo h($user['User']['primary_phone']); ?></li>
					<li><i class="fa fa-map-marker"></i><?php echo h($user['User']['permanent_address']).'&nbsp;(Per)'; ?> <?php echo '/ '. h($user['User']['temporary_address']).'&nbsp;(Temp)'; ?></li>
				</ul>
			</div> <!-- end col -->
		
		</div> <!-- end row -->
		 <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo h($getDepositDetail['TotalDeposit']); ?></div>
                                            <div>Total Deposits</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-tasks fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo h($getDepositDetail['RemainBalance']); ?></div>
                                            <div>Remaining Balance</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-shopping-cart fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo h($getDepositDetail['UsedBalance']); ?></div>
                                            <div>Used Balance</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-support fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo h($getDepositDetail['FreezedAmount']); ?></div>
                                            <div>Freezed Balance</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
</div> <!-- end .grid .right-column -->

