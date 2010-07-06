<div class="books view">
<h2><?php  __('Book');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $book['Book']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $book['Book']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Creator'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $book['Book']['creator']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Edition'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $book['Book']['edition']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Filename'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $book['Book']['filename']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Length'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $book['Book']['length']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $book['Book']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $book['Book']['modified']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Access'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $book['Book']['access']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Read Book', true), array('action' => 'read', $book['Book']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Edit Book', true), array('action' => 'edit', $book['Book']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Book', true), array('action' => 'delete', $book['Book']['id']), null, sprintf(__('Are you sure you want to delete "%s"?', true), $book['Book']['title'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Books', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Book', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Scores');?></h3>
	<?php if (!empty($book['Score'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Book Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Composer'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Length'); ?></th>
		<th><?php __('Start'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($book['Score'] as $score):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $score['id'];?></td>
			<td><?php echo $score['book_id'];?></td>
			<td><?php echo $score['title'];?></td>
			<td><?php echo $score['composer'];?></td>
			<td><?php echo $score['description'];?></td>
			<td><?php echo $score['length'];?></td>
			<td><?php echo $score['start'];?></td>
			<td><?php echo $score['created'];?></td>
			<td><?php echo $score['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'scores', 'action' => 'view', $score['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'scores', 'action' => 'edit', $score['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'scores', 'action' => 'delete', $score['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $score['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Score', true), array('controller' => 'scores', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
