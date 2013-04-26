<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php echo $this->Html->charset(); ?>
<title>
	<?php echo $title_for_layout; ?>
</title>
<?php
	echo $this->Html->css('cake.blue');
	echo $scripts_for_layout;
?>
</head>
<body>
 <div id ="header">スレッド掲示板</div>
<div id ="content">
	<?php echo $content_for_layout; ?>
</div>
<div id = "footer"><a href="mailto:lee_young19880910@yahoo.co.jp">@リエイ</a></div>
<!-- <?php echo $this->element('sql_dump'); ?> -->
</body>
</html>