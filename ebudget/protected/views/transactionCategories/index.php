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
<div class="search-form">
	<div class="wide form">

		<?php $form=$this->beginWidget('CActiveForm', array(
				'action'=>Yii::app()->createUrl($this->route),
				'method'=>'get',
				'focus'=>array($model,'date_range_end'),
)); ?>
		<div class="row">
			<?php echo $form->label($model,'date_range_start'); ?>
			<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'name'=>'date_range_start',
					// additional javascript options for the date picker plugin
					'options'=>array(
							'showAnim'=>'fold',
					),
					'htmlOptions'=>array(
							'style'=>'height:20px;'
					),
			));
			?>
		</div>
		<div class="row">
			<?php echo $form->label($model,'date_range_end'); ?>
			<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'name'=>'date_range_end',
					// additional javascript options for the date picker plugin
					'options'=>array(
							'showAnim'=>'fold',
					),
					'htmlOptions'=>array(
							'style'=>'height:20px;'
					),
			));
			?>
		</div>		
		<div class="row">
			<?php echo $form->label($model,'name'); ?>
			<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>512)); ?>
		</div>
		<div class="row buttons">
			<?php echo CHtml::submitButton('Search'); ?>
		</div>

		<?php $this->endWidget(); ?>

	</div>
	<!-- search-form -->
</div>
<?php 
$transactionCategories = $transactionCategoriesDP->getData();
$form=$this->beginWidget('CActiveForm', array(
		'action'=>CHtml::normalizeUrl(array('transactionCategories/gupdate')),
		'id'=>'transaction-categories-form',
		'enableAjaxValidation'=>false,
));
?>
<div class="grid-view">
	<table class="items">
		<thead>
			<tr>
				<th>&nbsp;</th>
				<th><?php echo $transactionCategoriesDP->getSort()->link('tc.id', 'ID');?>
				</th>
				<th><?php echo $transactionCategoriesDP->getSort()->link('tc.created', 'Created');?>
				</th>
				<th><?php echo $transactionCategoriesDP->getSort()->link('tc.name', 'Name');?>
				</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			if (!empty($transactionCategories)){
	foreach($transactionCategories as $transactionCategorie){
?>
			<tr class="odd">
				<td><?php echo $form->checkBox($model,'id[]', array('value' => $transactionCategorie['id'])); ?>
				</td>
				<td><?php echo $transactionCategorie['id'];?></td>
				<td><?php echo $transactionCategorie['created'];?></td>
				<td><?php echo $transactionCategorie['name'];?></td>
				<td><?php 
				echo CHtml::link('Update', array('/transactionCategories/update/id/' . $transactionCategorie['id']));
				echo CHtml::linkButton('Delete', array(
			         'submit'=>array('transactionCategories/Delete', 'id' =>$transactionCategorie['id']),
			         'params'=>array('id' =>$transactionCategorie['id']),
					'confirm'=>"Are you sure want to delete this data ?"
				));
			?>
				</td>
			</tr>
			<?php	
	}
}else{
?>
			<tr class="">
				<td colspan="100">Sorry no records found</td>
			</tr>
			<?php 
}
?>
		</tbody>
	</table>
</div>
<div class="row buttons">
	<?php echo CHtml::dropDownList('action', null, array('' => 'Select', 'delete' => 'Delete')); ?>
	<?php echo CHtml::submitButton('Update'); ?>
</div>
<?php $this->endWidget(); ?>
<?php
$this->widget('CLinkPager', array(
                                   'itemCount'=> $transactionCategoriesCount,
                                   'pageSize'=> Yii::app()->params['listPerPage'],
                                   'maxButtonCount'=> 10,
                                   'nextPageLabel'=>'Next >>',
                                   'header' => 'Go to page::',
                                    //'htmlOptions'=>array('class'=>'pages'),
                                ));
?>