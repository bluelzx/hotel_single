<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zdh_mg_shift".
 *
 * @property string $id
 * @property string $app_id
 * @property string $class_id
 * @property string $class_name
 * @property integer $class_date
 * @property string $class_js_xj
 * @property string $class_js_lc
 * @property string $class_bb_xj
 * @property string $class_bb_sk
 * @property string $class_bb_txj
 * @property string $class_bb_tsk
 * @property string $class_sj_xj
 * @property string $class_sj_sk
 * @property string $class_xf_xj
 * @property string $class_xf_lc
 * @property integer $created_at
 */
class Shift extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zdh_mg_shift';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['app_id', 'class_id', 'class_date', 'class_name', 'class_js_xj', 'class_js_lc', 'class_bb_xj', 'class_bb_sk', 'class_bb_txj', 'class_bb_tsk', 'class_sj_xj', 'class_sj_sk', 'class_xf_xj', 'class_xf_lc'], 'required'],
            [['created_at'], 'integer'],
            [['class_name', 'class_js_xj', 'class_js_lc', 'class_bb_xj', 'class_bb_sk', 'class_bb_txj', 'class_bb_tsk', 'class_sj_xj', 'class_sj_sk', 'class_xf_xj', 'class_xf_lc'], 'string', 'max' => 30],
            ['class_date', 'filter', 'filter' => function ($value) {
                return strtotime($value);
            }]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'app_id' => 'App ID',
            'class_id' => 'Class ID',
            'class_name' => 'Class Name',
            'class_date' => 'Class Date',
            'class_js_xj' => 'Class Js Xj',
            'class_js_lc' => 'Class Js Lc',
            'class_bb_xj' => 'Class Bb Xj',
            'class_bb_sk' => 'Class Bb Sk',
            'class_bb_txj' => 'Class Bb Txj',
            'class_bb_tsk' => 'Class Bb Tsk',
            'class_sj_xj' => 'Class Sj Xj',
            'class_sj_sk' => 'Class Sj Sk',
            'class_xf_xj' => 'Class Xf Xj',
            'class_xf_lc' => 'Class Xf Lc',
            'created_at' => 'Created At',
        ];
    }
}
