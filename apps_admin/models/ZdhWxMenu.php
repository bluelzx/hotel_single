<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zdh_wx_menu".
 *
 * @property integer $id
 * @property integer $acid
 * @property integer $pid
 * @property string $name
 * @property integer $type
 * @property string $type_content
 * @property integer $sort
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $click_id
 */
class ZdhWxMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zdh_wx_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['acid', 'pid', 'type', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['name', 'sort'], 'required'],
            [['name'], 'string', 'max' => 30],
            [['type_content'], 'string', 'max' => 255],
            ['click_id', 'filter', 'filter' => function ($value) {
                if ($this->type == 0 || $this->type == -1)
                    return 0;
                else
                    return $value;
            }],
            ['created_at', 'filter', 'filter' => function ($value) {
                return time();
            }],
            ['updated_at', 'filter', 'filter' => function ($value) {
                return time();
            }],
        ];
    }

    public function scenarios()
    {
        return [
            'add' => ['acid', 'pid', 'name', 'type', 'type_content', 'sort', 'created_at', 'click_id'],
            'update' => ['acid', 'pid', 'name', 'type', 'type_content', 'sort', 'updated_at', 'click_id']
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
            'pid' => '父菜单',
            'name' => '名称',
            'type' => '菜单类型',
            'type_content' => 'URL或事件',
            'sort' => '排序',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
            'click_id' => '素材',
        ];
    }

    /**
     * 获取推送菜单所属素材
     */
    public function getMenuClick()
    {
        return $this->hasOne(ZdhWxMenuClick::className(), ['id' => 'click_id']);
    }
}
