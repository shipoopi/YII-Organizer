<?php
/* @var $this TransactionCategoriesController */
/* @var $model TransactionCategories */

$this->breadcrumbs=array(
	'Transaction Categories'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TransactionCategories', 'url'=>array('index')),
	array('label'=>'Create TransactionCategories', 'url'=>array('create')),
	array('label'=>'View TransactionCategories', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TransactionCategories', 'url'=>array('admin')),
);
?>

<h1>Update TransactionCategories <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>