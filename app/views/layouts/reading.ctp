<?php
/**
 *
 * Reading style layout meant to maximize viewable
 * area and minimize distractions.
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('CakePHP: the rapid development php framework:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('reading');
		echo $this->Html->script('jquery');

		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="content">
			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
