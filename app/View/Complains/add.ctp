<div class="col-md-9 col-xs-12 complains-container right-column">
   <?php echo $this->Session->flash(); ?>
   <div class="row container-content">
      <div class="col-md-9 col-xs-12">
         <p>Please note, fields marked with (*) are mandatory!</p>
         <?php echo $this->Form->create('Complain',array('class'=>"post-resume-form")); ?>
         <fieldset>
            <?php
               echo $this->Form->input('description',array('label'=>'Message','div'=>array('class'=>'form-group'),'class'=>'form-control textarea'));
               ?>
         </fieldset>
         <?php
            echo '<button type="submit" class="btn btn-default"><i class="fa  fa-save"></i>Add Complaint</button>';
            echo $this->Form->end();
            ?>
      </div>
      <!-- end .grid -->
   </div>
   <!-- .container-content -->
</div>
<!-- end .complains-container -->
