<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "demo_link".
 *
 * @property string $id
 * @property string $title
 * @property string $url
 * @property string $desc
 * @property integer $sort
 */
class DemoLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'demo_link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'sort', 'url', 'desc'], 'required'],
            [['desc'], 'string'],
            [['sort'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['url'], 'string', 'max' => 255],
            [['status'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'url' => 'url链接地址',
            'desc' => '描述',
            'sort' => '排序',
        ];
    }
}
