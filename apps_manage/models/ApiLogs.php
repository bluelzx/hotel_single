<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zdh_mg_api_logs".
 *
 * @property integer $id
 * @property string $app_id
 * @property string $type
 * @property string $domain
 * @property string $url
 * @property string $params
 * @property string $controller
 * @property string $action
 * @property string $ip
 * @property string $created_at
 */
class ApiLogs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zdh_mg_api_logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'domain', 'url', 'params', 'controller', 'action', 'ip', 'created_at'], 'required'],
            [['params'], 'string'],
            [['created_at'], 'safe'],
            [['type', 'ip'], 'string', 'max' => 50],
            [['domain'], 'string', 'max' => 200],
            [['url'], 'string', 'max' => 255],
            [['controller', 'action'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'app_id'=>'App ID',
            'type' => 'Type',
            'domain' => 'Domain',
            'url' => 'Url',
            'params' => 'Params',
            'controller' => 'Controller',
            'action' => 'Action',
            'ip' => 'Ip',
            'created_at' => 'Created At',
        ];
    }
}
