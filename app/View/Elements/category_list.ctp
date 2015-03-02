<?php 
echo '<div class="input checkbox required"><label>Service Categories</label>';?>
		<a href="#category-form" id="category-popup" class="btn btn-default btn-blue btn-sm category-popup">Add Category</a>
		<?php echo '<ul class="categories">';
		echo $this->SmartForm->RecursiveCategories($serviceCategories,$checkedArray);
		echo '</ul></div>';
		?>