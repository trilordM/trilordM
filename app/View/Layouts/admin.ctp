<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        	<title>
        		<?php echo $title_for_layout; ?>
        	</title>
        	<?php
                echo $this->Html->script('jquery.min');
                echo $this->Html->script('jquery-ui.min');
            ?>


        	<?php
        		echo $this->Html->meta('icon', SITE_URL.'app/webroot/favicon.ico');

        		//<!-- bootstrap 3.0.2 -->
        		echo $this->Html->css('bootstrap.min');
        		//<!-- font Awesome -->
        		echo $this->Html->css('font-awesome');
        		//<!-- Ionicons -->
        		echo $this->Html->css('admin/ionicons.min');

        		//<!-- Theme style -->
        		echo $this->Html->css('admin/AdminLTE');

        		//<!-- bootstrap 3.0.2 -->
                echo $this->Html->css('cake.generic');

                //<!-- magnific popup -->
                echo $this->Html->css('magnific-popup');

                //<!-- Jquery CSS -->
                echo $this->Html->css('jquery-ui.min');

        	?>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-black">
        <?php  if (Authcomponent::user()) echo $this->element('admin_header');?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php  if (Authcomponent::user()) echo $this->element('admin_menu');?>

            <?php echo $this->Session->flash(); ?>
             <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">

                <?php echo $this->fetch('content'); ?>

            </aside><!-- /.right-side -->

        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <?php

            echo $this->Html->script('bootstrap.min');

            //<!-- AdminLTE App -->
            echo $this->Html->script('admin/app');

            //<!-- magnific popup -->
            echo $this->Html->script('jquery.magnific-popup.min');

        ?>
    </body>
    <script type="text/javascript">
      $(document).ready(function() {
            $( "#datepicker" ).datepicker({
        			inline: true,
        			dateFormat: 'yy-mm-dd'
        	});

        	$( "#datepicker1" ).datepicker({
        			inline: true,
        			dateFormat: 'yy-mm-dd'
        	});
        	$( "#datepicker2" ).datepicker({
        			inline: true,
        			dateFormat: 'yy-mm-dd'
        	});

      });
    </script>

</html>