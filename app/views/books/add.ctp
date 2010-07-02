<div class="books form">
<?php echo $this->Form->create('Book');?>
	<fieldset>
 		<legend><?php __('Add Book'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('editor');
		echo $this->Form->input('publisher');
		echo $this->Form->input('file', array('type'=>'file'));
		echo $this->Form->input('access',
			array('type'=>'radio','options'=>array(
				'0'=>'Open access',
				'1'=>'Gold membership access')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Books', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Scores', true), array('controller' => 'scores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Score', true), array('controller' => 'scores', 'action' => 'add')); ?> </li>
	</ul>
</div>
