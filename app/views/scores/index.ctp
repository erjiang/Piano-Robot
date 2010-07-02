<div class="scores index">
	<h2><?php __('Scores');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('book_id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('composer');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('length');?></th>
			<th><?php echo $this->Paginator->sort('start');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($scores as $score):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $score['Score']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($score['Book']['title'], array('controller' => 'books', 'action' => 'view', $score['Book']['id'])); ?>
		</td>
		<td><?php echo $score['Score']['title']; ?>&nbsp;</td>
		<td><?php echo $score['Score']['composer']; ?>&nbsp;</td>
		<td><?php echo $score['Score']['description']; ?>&nbsp;</td>
		<td><?php echo $score['Score']['length']; ?>&nbsp;</td>
		<td><?php echo $score['Score']['start']; ?>&nbsp;</td>
		<td><?php echo $score['Score']['created']; ?>&nbsp;</td>
		<td><?php echo $score['Score']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $score['Score']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $score['Score']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $score['Score']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $score['Score']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Score', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Books', true), array('controller' => 'books', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Book', true), array('controller' => 'books', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Metadata', true), array('controller' => 'metadata', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Metadatum', true), array('controller' => 'metadata', 'action' => 'add')); ?> </li>
	</ul>
</div>