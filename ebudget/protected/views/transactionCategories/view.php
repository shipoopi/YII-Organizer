<?php
/* @var $this TransactionCategoriesController */
/* @var $model TransactionCategories */

$this->breadcrumbs=array(
	'Transaction Categories'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List TransactionCategories', 'url'=>array('index')),
	array('label'=>'Create TransactionCategories', 'url'=>array('create')),
	array('label'=>'Update TransactionCategories', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TransactionCategories', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TransactionCategories', 'url'=>array('admin')),
);
?>

<h1>View TransactionCategories #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'created',
		'modified',
		'name',
		'transaction_count',
	),
)); ?>
