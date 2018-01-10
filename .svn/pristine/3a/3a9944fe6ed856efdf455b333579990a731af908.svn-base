<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zdh_wx_menu_click".
 *
 * @property integer $id
 * @property integer $acid
 * @property integer $type
 * @property string $title
 * @property string $content
 * @property string $pic_content
 * @property integer $sort
 * @property integer $created_at
 * @property integer $updated_at
 */
class ZdhWxMenuClick extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zdh_wx_menu_click';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['acid', 'type', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['title', 'content', 'pic_content', 'sort'], 'required'],
            [['pic_content'], 'string'],
            [['title'], 'string', 'max' => 30],
            [['content'], 'string', 'max' => 500],
            ['created_at', 'filter', 'filter' => function ($value) {
                return time();
            }],
            ['updated_at', 'filter', 'filter' => function ($value) {
                return time();
            }],
        ];
    }

    /**
     * 使用场景
     * @return array
     */
    public function scenarios()
    {
        return [
            'add' => ['acid', 'title', 'type', 'sort', 'created_at'],
            'update' => ['acid', 'title', 'type', 'sort', 'updated_at']
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'acid' => 'Acid',
            'type' => '消息类型',
            'title' => '素材标题',
            'content' => '文本或图片',
            'pic_content' => '图文消息',
            'sort' => '排序',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
