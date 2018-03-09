<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use app\models\Details;
use yii\db\Query;

class DetailsController extends \yii\web\Controller

{	

    public function actionIndex()
    {
    	$model = new Details();
	 	$data = $model->getTable();
    	$detail = $model->getSlave();
		
        	return $this->render('index',[
        	'model'=>$model,
        	'data'=>$data,
        	'detail'=>$detail,
        	]);

	}


	public function actionExecute()
	{				
    	$model = new Details();
		$model->check();	
	}		
}


	



