<div class="books form">
<?php echo $this->Form->create('Book');?>
	<fieldset>
 		<legend><?php __('Edit Book'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('creator');
		echo $this->Form->input('edition');
		echo $this->Form->input('access',
			array('type'=>'radio',
				'default'=>1,
				'options'=>array(
				'0'=>'Open access',
				'1'=>'Gold membership required')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
	<img style="border:1px solid black"
		src="/books/page/<?php echo $this->Form->value('Book.id'); ?>/1/200" />
	<img style="border:1px solid black"
		src="/books/page/<?php echo $this->Form->value('Book.id'); ?>/2/200" />
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Book.id')), null, sprintf(__('Are you sure you want to delete "%s"?', true), $this->Form->value('Book.title'))); ?></li>
		<li><?php echo $this->Html->link(__('List Books', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Scores', true), array('controller' => 'scores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Score', true), array('controller' => 'scores', 'action' => 'add')); ?> </li>
	</ul>
</div>
