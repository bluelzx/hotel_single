<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/18
 * Time: 16:03
 */
namespace app\models;
use Yii;
use yii\base\Exception;
use yii\db\Query;
use yii\db\ActiveRecord;

class ZdhModel extends ActiveRecord {

    public static function tableName() {
        return 'zdh_model';
    }

    //获取属性列表
    public function getAttrList($_params = []) {
        $Query = (new Query())->select('zm.id as type_id,za.id,za.attr_name,za.attr_type,za.attr_option_values')->from([
            'za' => 'zdh_model_attribute',
            'zm' => 'zdh_model'
        ])->where('za.type_id=zm.id and za.acid=' . $_params['acid'] . ' and za.type_id=' . $_params['type_id']);

        $C_Query = clone $Query;
        //计算行数
        $count = $Query->count();

        $Raws['data'] = $C_Query->all();
        $Raws['count'] = $count;

        return $Raws;
    }

    //检测模型名称
    public function check($_params = []) {
        $Rows = (new Query())->select('id')->from("zdh_model")->where("name='".$_params['name']."'")->one();
        if(empty($Rows)) {
            return false;
        } else {
            return $Rows;
        }
    }
}






