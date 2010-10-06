<script type="text/javascript">
$(document).ready(function () {
	$("#BookPdf").change(function () {
		// only continue if the user hasn't already filled anything in
		if($("#BookTitle").value || $("#BookCreator").value) {
			console.log("Fields already filled.");
			return;
		}

		/*
		 * Try to fill in the title and creator name from the filename
		 * in the form "Creator - Title.pdf"
		 */
		String.prototype.endsWith = function(str)
			{return (this.match(str+"$")==str)};
			
		var filename = this.value;
		if(!filename.endsWith('.pdf')) {
			console.log("Not a PDF.");
			return;
		}
		filename = filename.substring(0, filename.length - 4);
		filename = filename.split("_").join(" "); // no underscores
		if(filename.indexOf(' - ') == -1) {
			$("#BookTitle").val(filename);
		} else {
			var dashIndex = filename.indexOf(' - ');
			var creator = filename.substring(0, dashIndex);
			var title = filename.substr(dashIndex + 3);
			$("#BookTitle").val(title);
			$("#BookCreator").val(creator);
		}
	});
});
</script>
<div class="books form">
<?php echo $this->Form->create('Book',
		array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add Book'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('creator');
		echo $this->Form->input('edition');
		echo $this->Form->input('pdf', array('type'=>'file'));
		echo $this->Form->input('access',
			array('type'=>'radio',
				'default'=>1,
				'options'=>array(
				'0'=>'Open access',
				'1'=>'Gold membership required')));
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
