<div class="books form">
<?php echo $this->Form->create('Book');?>
	<fieldset>
 		<legend><?php __('Edit Book'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('editor');
		echo $this->Form->input('publisher');
		echo $this->Form->input('filename');
		echo $this->Form->input('length');
		echo $this->Form->input('access');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Book.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Book.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Books', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Scores', true), array('controller' => 'scores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Score', true), array('controller' => 'scores', 'action' => 'add')); ?> </li>
	</ul>
</div>