<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
// use app\controllers\Details;
use app\models\Details;
// use app\controllers\PDO;
use yii\db\Query;

class DetailsController extends \yii\web\Controller

{	

    public function actionIndex()
    {
    	$model = new Details();

    	$data = ArrayHelper::map(Details::find()->select(['tablename'])->asArray()->where(['status'=>'1'])->all(), 'tablename', 'tablename');
    	
    	$detail =ArrayHelper::map(Details::find()->select(['tablename'])->asArray()->where(['location'=>"slave"])->all(),'tablename','tablename');
		
    	if($model->load(\Yii::$app->request->post()) && $model->validate());
    	{
        	
        	return $this->render('index',[
        	'model'=>$model,
        	'data'=>$data,
        	'detail'=>$detail,
        	]);

    	}
	}


	public function actionExecute()
	{
		
		$postdata = $_POST;
		if($postdata['Details']['slave'] == null )
		{
			$connection = \Yii::$app->db2;
			$query = $postdata['Details']['query'];	
			$res = $connection->createCommand($query);
			$users = $res->queryAll();
		;
		}

		elseif ($postdata['Details']['slave'] == 'jd') {
			$connection = \Yii::$app->db3;
			$query = $postdata['Details']['query'];
			$res = $connection->createCommand(mysql_real_escape_string(trim($query)));
			$users = $res->queryAll();
			return "success!";
	
		}
		elseif ($postdata['Details']['slave'] == 'madras') {
			$connection = \Yii::$app->db4;
			$query = $postdata['Details']['query'];			
			$res = $connection->createCommand(mysql_real_escape_string(trim($query)));
			$users = $res->queryAll();
			
		}
		
	}		
}


	



