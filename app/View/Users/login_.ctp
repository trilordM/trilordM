<div class="login-container"><!-- start login-container -->
    <div class="title-container"><!-- start main page title -->
        <div class="container">
            <div class="page-title">User > Log In</div>
        </div>
    </div><!-- end .title-container -->

    <div class="container content-container">
        <?php echo $this->Session->flash(); ?>

        <div class="row">
            <div class="col-md-5">

                <div class="form-singin-container">

                <?php echo $this->Form->create('User', array('novalidate' => true,'type'=>'file','role'=>'form')); ?>
                        <div class="form-group">
                         <?php echo $this->Form->input('email',array('id'=>'email','type'=>'text','class'=>'form-control input-form','label'=>false,'placeholder'=>'Email registered with TrilordMarket'));?>
                        </div>
                        <div class="form-group">
                        <?php echo $this->Form->input('password',array('id'=>'password','class'=>'form-control input-form','label'=>false,'placeholder'=>'Password'));?>
                            <br>
                            <?php  echo $this->Form->button('LOGIN',array('type'=>'submit','class'=>'btn btn-default btn-blue'));?>
                            <a class="test-popup-link" href="#">Forgot Password</a>
                        </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>

            <div class="col-md-7 singin-page">
                <h5>Not A Member? Register Now!</h5>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="style-list-2">
                            <li>One single venue for all services from the comfort of your home or office.</li>
                            <li>Trusted reviews and ratings from service users.</li>
                            <li>Collaboration with law enforcement to ensure safety.</li>
                            <li>Transparent, Accountable, and Trustworthy Services found nowhere else in Nepal.</li>
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <ul class="style-list-2">
                            <li>A wide array of listings and rates of service providers</li>
                            <li>Exclusive discounts and deals</li>
                            <li>Value for money</li>
                            <li>Opportunity to review and rate</li>
                            <li>Verified, Secure, Reliable, Hassle free service</li>
                        </ul>
                    </div>
                </div>
                <p>
            </div>
        </div>
    </div>





</div><!-- end login-container -->


<script type="text/javascript">
      $(document).ready(function() {
            $form = '<form action="<?php echo $this->Html->url('/', true)?> users/forgot_password" id="send_forgot_password" role="form" method="post" accept-charset="utf-8">\
                        <h6> Password Recovery </h6>\
                        <div style="display:none;"><input name="_method" value="POST" type="hidden"></div>\
                       	    <div class="input email"><label for="email">Email</label><input name="data[UserForgot][email]" id="email" placeholder="example@domain.com" type="email"></div>\
                       		<button id="send_forget" type="submit" class="btn btn-default btn-green">SEND</button>\
                    </form>';
            $('.test-popup-link').magnificPopup(
              {
                items: {
                    src: $form,
                    type: 'inline'
                },
                closeBtnInside: true
              }

            );

      });
</script>


