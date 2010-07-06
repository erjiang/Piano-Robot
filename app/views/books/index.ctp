<div class="books index">
	<h2><?php __('Books');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('creator');?></th>
			<th><?php echo $this->Paginator->sort('edition');?></th>
			<th><?php echo $this->Paginator->sort('length');?></th>
			<th><?php echo $this->Paginator->sort('access');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($books as $book):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $book['Book']['title']; ?>&nbsp;</td>
		<td><?php echo $book['Book']['creator']; ?>&nbsp;</td>
		<td><?php echo $book['Book']['edition']; ?>&nbsp;</td>
		<td><?php echo $book['Book']['length']; ?>&nbsp;</td>
		<td><?php echo ($book['Book']['access'] == 1) ? "Gold" : "Open"; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Read', true), array('action' => 'read', $book['Book']['id'])); ?>
			<?php echo $this->Html->link(__('Info', true), array('action' => 'view', $book['Book']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $book['Book']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $book['Book']['id']), null, sprintf(__('Are you sure you want to delete "%s"?', true), $book['Book']['title'])); ?>
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
		<li><?php echo $this->Html->link(__('New Book', true), array('action' => 'add')); ?></li>
	</ul>
</div>
