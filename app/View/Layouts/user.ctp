<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php echo $this->Html->meta('icon', SITE_URL.'app/webroot/favicon.ico'); ?>
  <title><?php echo COMPANY_NAME ?></title>


  <!-- GOOGLE FONTS -->
  <link href='http://fonts.googleapis.com/css?family=Raleway:400,700,600,800%7COpen+Sans:400italic,400,600,700' rel='stylesheet' type='text/css'>

  <!--[if IE 9]>
    echo $this->Html->script('globo/media.match.min');
  <![endif]-->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <?php
        echo $this->Html->css('bootstrap.min');
  	    echo $this->Html->css('globo/style');
        echo $this->Html->css('magnific-popup');
  		echo $this->Html->css('rating/rating');
  ?>
</head>

<body>

<div id="main-wrapper">

    <?php echo $this->element('Sections/header')?>
    <div class = "row service-seeker-admin-container">

        <div class="col-md-12 col-xs-12 title-container"><!-- start .title-container -->
            <div class="container">
                <div class="page-title"><?php echo $page_title ?></div>
            </div>
        </div><!-- end .title-container -->

        <div class = "container">
            <?php echo $this->element('user/left_menu')?>
            <?php echo $this->fetch('content')?>
        </div>
    </div>
    <?php echo $this->element('Sections/footer')?>

</div> <!-- end #main-wrapper -->

<!-- Scripts -->
<?php

	  echo $this->Html->script('globo/jquery.ba-outside-events.min');
      echo $this->Html->script('globo/bootstrap.min');
      echo $this->Html->script('jquery.magnific-popup.min');
?>
</script>

</body>
</html>
