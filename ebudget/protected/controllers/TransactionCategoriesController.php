<?php

class TransactionCategoriesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new TransactionCategories;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TransactionCategories']))
		{
			$model->attributes=$_POST['TransactionCategories'];
			if($model->save()){
				Yii::app()->user->setFlash('success', 'Record saved successfully.');
				$this->redirect(array('index'));
			}else{
				Yii::app()->user->setFlash('error', 'Problem in saving record.');
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TransactionCategories']))
		{
			$model->attributes=$_POST['TransactionCategories'];
			if($model->save()){
				Yii::app()->user->setFlash('success', 'Record updated successfully.');
				$this->redirect(array('index'));
			}else{
				Yii::app()->user->setFlash('error', 'Problem in updating record.');
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
		Yii::app()->user->setFlash('error', 'Record deleted successfully.');

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax'])){
			if (isset($_POST['returnUrl'])){
				$this->redirect($_POST['returnUrl']);
			}else{
				$this->redirect(array('index'));
			}
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$conditions = array();
		$params = array();

		$model=new TransactionCategories();
		if(isset($_GET['TransactionCategories'])){
			$model->attributes = $_GET['TransactionCategories'];
			if (!empty($_GET['TransactionCategories']['name'])){
				$conditions = 'tc.name like "%' . $_GET['TransactionCategories']['name'] . '%"';
				$params = array (':name' => $_GET['TransactionCategories']['name']);
			}
		}
		$transactionCategoriesCount = Yii::app()->db->createCommand()
		->select('count(*) as count')
		->from('transaction_categories tc')
		->where($conditions, $params)
		->queryScalar();

		$transactionCategoriesSQL = Yii::app()->db->createCommand()
		->select('tc.id, tc.created, tc.name, tc.transaction_count')
		->from('transaction_categories tc')
		->where($conditions, $params);
		
		$transactionCategoriesDP=new CSqlDataProvider($transactionCategoriesSQL->text, array(
				'totalItemCount'=>$transactionCategoriesCount,
				'sort'=>array(
						'attributes'=>array(
								'tc.id', 'tc.created', 'tc.name',
						),
				),
				'pagination'=>array(
						'pageSize'=> Yii::app()->params['listPerPage'],
				),
		));
		$this->render('index',array(
				'transactionCategoriesDP' => $transactionCategoriesDP,
				'transactionCategoriesCount' => $transactionCategoriesCount, 
				'model' => $model
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TransactionCategories('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TransactionCategories']))
			$model->attributes=$_GET['TransactionCategories'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=TransactionCategories::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='transaction-categories-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
