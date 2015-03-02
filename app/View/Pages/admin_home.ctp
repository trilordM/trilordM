
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php echo $user_stats[0][0]['TotalProvider']?>
                        </h3>
                        <p>
                            Total Service Providers
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="admin/users/provider_index" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            <?php echo $user_stats[0][0]['NewProfile']?><sup style="font-size: 10px">&nbsp;Last 30 days</sup>
                        </h3>
                        <p>
                            New Service Providers
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="admin/users/provider_index" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>
                            <?php echo $user_stats[0][0]['TotalCategory']?>
                        </h3>
                        <p>
                            Service Categories
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="admin/service_categories" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>
                            <?php echo $user_stats[0][0]['TotalSeeker']?>
                        </h3>
                        <p>
                            Service Seekers
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="admin/users/seeker_index" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->

        <!-- top row -->
        <div class="row">
            <div class="col-xs-12 connectedSortable">
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section>
                    <!-- Cash box -->
                    <div class="box box-primary cash-box">
                        <div class="box-header">
                            <i class="fa fa-tachometer"></i>
                            <h3 class="box-title">
                                New Service Request of the Day
                            </h3>
                        </div>
                        <div class="box-body no-padding">
                            <div class="table-responsive">
                                <!-- .table - Uses sparkline charts-->
                                <table class="table table-bordered">
                                    <tr>
                                        <?php echo $this->requestAction('pages/get_service_request');?>
                                    </tr>

                                </table><!-- /.table -->
                                <a href="/admin/seeker_provider_requests" class="small-box-footer">
                                    View All <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- /.box-body-->
                    </div>
                    <!-- /.box -->

                </section><!-- right col -->
            </div><!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-6 connectedSortable">
                 <!-- Services box -->
                    <div class="box box-primary service-box">
                        <div class="box-header">
                            <i class="fa fa-gears"></i>
                            <h3 class="box-title">
                                Services
                            </h3>
                        </div>
                        <div class="box-body no-padding">
                            <div class="table-responsive">
                                <!-- .table - Uses sparkline charts-->
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Description</th>
                                        <th>Total(count)</th>
                                    </tr>
                                    <tr>
                                        <td>New Service Requests</td>
                                        <td><?php echo $user_stats[0][0]['NewRequest']?></td>
                                    </tr>
                                    <tr>
                                        <td>Ongoing Service Request Processing</td>
                                        <td><?php echo $user_stats[0][0]['Assigned']?></td>
                                    </tr>
                                    <tr>
                                        <td>Completed Services</td>
                                        <td><?php echo $user_stats[0][0]['Completed']?></td>
                                    </tr>

                                </table><!-- /.table -->
                            </div>
                        </div><!-- /.box-body-->
                    </div>
                    <!-- /.box -->

            </section><!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-6 connectedSortable ">
                <!-- Cash box -->
                <div class="box box-primary cash-box">
                    <div class="box-header">
                        <i class="fa fa-tachometer"></i>
                        <h3 class="box-title">
                            Cash Deposits
                        </h3>
                    </div>
                    <div class="box-body no-padding">
                        <div class="table-responsive">
                            <!-- .table - Uses sparkline charts-->
                            <table class="table table-bordered">
                                <tr>
                                    <th>Deposits</th>
                                    <th>Total Amount(Rs)</th>
                                </tr>
                                <tr>
                                    <td>Unverified Bank Deposit</td>
                                    <td><?php echo $user_stats[0][0]['Unverified']?></td>
                                </tr>
                                <tr>
                                    <td>New Bank Deposits</td>
                                    <td><?php echo $user_stats[0][0]['NewBankDeposit']?> for last 3 days</td>
                                </tr>
                                <tr>
                                    <td>New Paypal Deposits</td>
                                    <td><?php echo $user_stats[0][0]['PaypalDeposit']?>  for last 3 days</td>
                                </tr>
                                <tr>
                                    <td>New Esewa Deposits</td>
                                    <td><?php echo $user_stats[0][0]['EsewaDeposit']?>  for last 3 days</td>
                                </tr>

                            </table><!-- /.table -->
                        </div>
                    </div><!-- /.box-body-->
                </div>
                <!-- /.box -->

            </section><!-- right col -->
        </div><!-- /.row (main row) -->


        <div class="row">
            <!-- Left col -->
            <section class="col-lg-6 connectedSortable">
                 <!-- Services box -->
                    <div class="box box-primary review-box">
                        <div class="box-header">
                            <h3 class="box-title">
                                Reviews
                            </h3>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="box-body no-padding">
                            <div class="table-responsive">
                                <!-- .table - Uses sparkline charts-->
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Description</th>
                                        <th>Total(count)</th>
                                    </tr>
                                    <tr>
                                        <td>Total Reviews</td>
                                        <td><?php echo $new_review[0][0]['TotalReview']?></td>
                                    </tr>
                                    <tr>
                                        <td>Verified Reviews</td>
                                        <td><?php echo $new_review[0][0]['Verified']?></td>
                                    </tr>
                                    <tr>
                                        <td>Pending Reviews</td>
                                        <td><?php echo $new_review[0][0]['New']?></td>
                                    </tr>
                                    <tr>
                                        <td>Reviews Blocked</td>
                                        <td><?php echo $new_review[0][0]['Blocked']?></td>
                                    </tr>

                                </table><!-- /.table -->
                            </div>
                        </div><!-- /.box-body-->
                    </div>
                    <!-- /.box -->

            </section><!-- /.Left col -->


        </row><!-- /.row -->

    </section><!-- /.content -->