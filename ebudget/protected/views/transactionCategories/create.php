<?php
/* @var $this TransactionCategoriesController */
/* @var $model TransactionCategories */

$this->breadcrumbs=array(
	'Transaction Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TransactionCategories', 'url'=>array('index')),
	array('label'=>'Manage TransactionCategories', 'url'=>array('admin')),
);
?>

<h1>Create TransactionCategories</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>