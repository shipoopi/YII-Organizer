<?php
/* @var $this TransactionCategoriesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Transaction Categories',
);

$this->menu=array(
	array('label'=>'Create TransactionCategories', 'url'=>array('create')),
	array('label'=>'Manage TransactionCategories', 'url'=>array('admin')),
);
?>

<h1>Transaction Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
