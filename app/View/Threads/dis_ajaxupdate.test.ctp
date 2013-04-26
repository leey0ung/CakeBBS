<?php
	echo $this->Html->script('jquery',array('inline' => false));
?>

<?php echo $this->Form->create('Post'); ?>
<?php echo $this->Form->text('pwd');?>
<?php echo $this->Js->submit('Update', array(
  'url'=> array('action' => 'ajaxupdate'),
  'update'=>'#result-ajaxupdate'
  ));
?>
<?php echo $this->Form->end(); ?>
<?php echo $this->Js->writeBuffer(array('inline' => 'true')); ?>
<div id="result-ajaxupdate"></div>