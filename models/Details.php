<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Details;
/**
 * This is the model class for table "details".
 *
 * @property string $tablename
 * @property string $location
 */
class Details extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $tablename;
    public $location;
    public $query;
    public $slave;

     public function rules()
    {
        return [
            // Maximum Length
            [['tablename', 'location'], 'string', 'max' => 255],
            // name, email, subject and body are required
            [['tablename', 'location', 'query'], 'required'],   
        ];
    }

    public static function tableName()
    {
        return 'details';
    }

    public function getTable()
    {
        $data = ArrayHelper::map(Details::find()->select(['tablename'])->asArray()->where(['status'=>'1'])->all(), 'tablename', 'tablename');               
        return $data;        
    }
    public function  getSlave()
    {
         $detail =ArrayHelper::map(Details::find()->select(['tablename'])->asArray()->where(['location'=>"slave"])->all(),'tablename','tablename');
         return $detail;
    }

    public function checkDb()
    {
        $postdata = $_POST;
        if($postdata['Details']['slave'] == null ) {
            $connection = \Yii::$app->db2;
            $query = $postdata['Details']['query']; 
            $res = $connection->createCommand($query);
            $users = $res->queryAll();
        }

        elseif ($postdata['Details']['slave'] == 'jd') {
            $connection = \Yii::$app->db3;
            $query = $postdata['Details']['query'];
            $res = $connection->createCommand($query);
            $users = $res->queryAll();
    
        }
        elseif ($postdata['Details']['slave'] == 'madras') {
            $connection = \Yii::$app->db4;
            $query = $postdata['Details']['query'];         
            $res = $connection->createCommand($query);
            $users = $res->queryAll();      
        }
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tablename' => 'Tablename',
            'location' => 'Location',
        ];
    }
}
