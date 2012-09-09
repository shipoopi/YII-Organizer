<?php
/* @var $this SettingsController */
/* @var $model Settings */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('category')); ?>:</b>
	<?php echo CHtml::encode($data->category); ?>
	<br />

	<b><?php echo CHtml::encode($data->key); ?>:</b>
	<?php echo CHtml::encode(unserialize($data->value)); ?>
	<br />

	<?php echo CHtml::link('Update', array('/settings/update/id/' . $data->id));?>

</div>