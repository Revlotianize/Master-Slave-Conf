<?php

namespace app\models;

use Yii;
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


    public static function tableName()
    {
        return 'details';
    }

    public function connection()
    {
        
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            // Maximum Length
            [['tablename', 'location'], 'string', 'max' => 255],
            // name, email, subject and body are required
            [['tablename', 'location', 'query'], 'required'],   
        ];
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
