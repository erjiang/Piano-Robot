<div class="metadata view">
<h2><?php  __('Metadatum');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $metadatum['Metadatum']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Score'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($metadatum['Score']['title'], array('controller' => 'scores', 'action' => 'view', $metadatum['Score']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Key'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $metadatum['Metadatum']['key']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $metadatum['Metadatum']['type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Value'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $metadatum['Metadatum']['value']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Metadatum', true), array('action' => 'edit', $metadatum['Metadatum']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Metadatum', true), array('action' => 'delete', $metadatum['Metadatum']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $metadatum['Metadatum']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Metadata', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Metadatum', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Scores', true), array('controller' => 'scores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Score', true), array('controller' => 'scores', 'action' => 'add')); ?> </li>
	</ul>
</div>
