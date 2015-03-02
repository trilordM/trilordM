
		<?php echo '<ul class="categories">';
		echo $this->SmartForm->RecursiveCategories($serviceCategories,$checkedArray);
		echo '</ul>';
		
		//echo $this->Form->hidden('category_count',array('value'=>$countServiceCategory));
		
?>		

