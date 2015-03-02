<div class="service-seeker-request-container"><!-- start .service-seeker-container -->
    <div class="title-container"><!-- start .title-container -->
        <div class="container">
            <div class="page-title">Service Seeker > New Service Enquiry </div>
        </div>
    </div><!-- end .title-container -->
    <div class="container content-container">
            <?php echo $this->Session->flash(); ?>

            <?php
            if (strpos($this->here,'success')== false) {
                 $success_message=null;
            }else{
                $success_message='success';
            }
            if(empty($success_message)){?>

            <p>Please note, fields marked with (<span class="required">*</span>) are mandatory!</p>

            <?php echo $this->Form->create('SeekerProviderRequest', array('novalidate' => true,'class'=>"post-resume-form")); ?>
                <div class="row">
                    <div class="col-md-6 first-col">
                        <?php echo $this->Form->input('requested_date', array('type' => 'text','placeholder'=>'Click here to select requested date','class'=>'demoHeaders','id' => 'datetimepicker','div'=>array('class'=>'form-group'),'class'=>'form-control input','readonly'=>true)); ?>
                        <?php echo $this->Form->input('description', array('type' => 'textarea','placeholder'=>'Briefly describe the service that you want to request.','div'=>array('class'=>'form-group'),'class'=>'form-control textarea')); ?>
                    </div>
                    <div class="col-md-6 second-col">

                       <?php if(!empty($provider_rates)){
                                echo '<div id="document" class="form-group radio-type">';
                                        echo $this->Form->label('Rate');

                                        $num=count($rate);

                                        for($i=0;$i<$num;$i++){
                                            $options=array($rate[$i]['RP']['title']=>'');
                                            $attributes=array('legend'=>false,'value' =>$rate[$i]['RP']['title']);

                                        }

                                        for($i=0;$i<$num;$i++){
                                            $a[$i]="Rs".$rate[$i]['SPR']['rate'].' '.$rate[$i]['RP']['title'];

                                        }

                                            $options=$a;
                                            $attributes=array('legend'=>false);


                                            echo $this->Form->radio('opt',$options,$attributes);

                                            echo '</div>';

                                            echo $this->Form->input('txtTime',array('id'=>'txttime','disabled'=>'disabled','label'=>'Time','div'=>array('class'=>'form-group'),'class'=>'form-control input'));
                                            echo '<span id="errmsg"></span>';
                                            echo $this->Form->input('txtTotal',array('id'=>'txttotal','disabled'=>'disabled','label'=>'Total','readonly'=>true,'div'=>array('class'=>'form-group'),'class'=>'form-control input'));


                                    ?>
                         <?php }?>

                        <?php echo $this->Form->input('payment_on_site',array('type' => 'checkbox','label'=>'Pay in person'));?>

                    </div><!-- end .grid .col-md-6 .second-col -->
                    <div class="col-md-12 second-row-full-col">
                     <?php echo $this->Form->button('SUBMIT',array('type'=>'submit','class'=>'btn btn-default btn-blue')); ?>
                    </div><!-- end .grid .second-row-full-col -->


               </div><!-- end .row -->
               <?php echo $this->Form->end();
            } ?>

        </div> <!-- end .container .content-container-->
</div><!-- end .service-seeker-request-container -->
<script type="text/javascript">
      $(document).ready(function() {

                $('#datetimepicker').datepicker({
                       	formatDate:'Y-m-d',
                       });

      });
</script>



