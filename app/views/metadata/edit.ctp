<div class="metadata form">
<?php echo $this->Form->create('Metadatum');?>
	<fieldset>
 		<legend><?php __('Edit Metadatum'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('score_id');
		echo $this->Form->input('key');
		echo $this->Form->input('type');
		echo $this->Form->input('value');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Metadatum.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Metadatum.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Metadata', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Scores', true), array('controller' => 'scores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Score', true), array('controller' => 'scores', 'action' => 'add')); ?> </li>
	</ul>
</div>