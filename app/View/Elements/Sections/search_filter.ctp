<?php if(!isset($hideSearchBar)):?>
<div class="header-search-bar <?php if(!isset($frontPage)) echo 'normal-search-bar';?>">
	<?php echo $this->Form->create('Page',array('action'=>'search_marketplace','type' => 'get','url' => array('controller' => 'pages', 'action' => 'search_marketplace'))); ?>
	<div class="container">
		<div class="search-value">
			<div class="keywords">

				<?php echo $this->Form->input('searchjob', array('options' => array_column($getSearchjob, 'name', 'id'), 'empty' => 'Type Categories (E.g: Plumber)', 'class' => 'tokenize-sample uou-custom-select' , 'label' => false, 'div' => false, 'multiple' => false )); ?>

			</div>
			<div class="category-search">

				 <?php echo $this->Form->input('searchplace', array('options' => array_column($getPlace, 'name', 'id'), 'empty' => 'Type Locations (E.g: Patan)', 'class' => 'tokenize-sample uou-custom-select','label' => false, 'div' => false, 'multiple' => false )); ?>

			</div>
			<button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
		</div>
	</div>
	<!-- END .CONTAINER -->
	<?php echo $this->Form->end(); ?>
</div>
<!-- END .header-search-bar -->
<?php endif ?>