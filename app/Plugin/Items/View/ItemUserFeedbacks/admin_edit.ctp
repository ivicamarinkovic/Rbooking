<?php /* SVN: $Id: $ */ ?>
<ul class="breadcrumb top-mspace ver-space">
  <li><?php echo $this->Html->link( __l('Feedback To') . ' ' . Configure::read('item.alt_name_for_booker_singular_caps'), array('controller'=>'item_user_feedbacks','action'=>'index', 'admin' => 'true'), array('escape' => false));?><span class="divider">/</span></li>
  <li class="active"><?php echo __l('Edit Feedback'); ?></li>
</ul>
<div class="itemFeedbacks form sep-top">
	<?php echo $this->Form->create('ItemUserFeedback', array('class' => 'form-horizontal space'));?>
	<fieldset>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('feedback', array('label' => __l('Feedback')));
		echo $this->Form->input('is_satisfied', array('label' => __l('Satisfied')));
	?>
	</fieldset>
	<div class="form-actions">
      	<?php echo $this->Form->submit(__l('Update'), array('class' => 'btn btn-large btn-primary textb text-16')); ?>
    </div>
    <?php echo $this->Form->end(); ?>
</div>