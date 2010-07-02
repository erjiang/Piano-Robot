<div class="scores form">
<?php echo $this->Form->create('Score');?>
	<fieldset>
 		<legend><?php __('Edit Score'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('book_id');
		echo $this->Form->input('title');
		echo $this->Form->input('composer');
		echo $this->Form->input('description');
		echo $this->Form->input('length');
		echo $this->Form->input('start');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Score.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Score.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Scores', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Books', true), array('controller' => 'books', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Book', true), array('controller' => 'books', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Metadata', true), array('controller' => 'metadata', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Metadatum', true), array('controller' => 'metadata', 'action' => 'add')); ?> </li>
	</ul>
</div>