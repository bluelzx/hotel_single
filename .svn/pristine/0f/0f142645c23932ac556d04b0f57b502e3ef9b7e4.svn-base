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

class ZdhModelAttribute extends ActiveRecord {

    public static function tableName() {
        return 'zdh_model_attribute';
    }

    //获取房型属性
    public function getRoomsAttrs($_params = []) {
        $Raws = (new Query())->select("za.id,za.attr_name,za.attr_type,za.attr_option_values,za.attr_suffix_text")
            ->from(['za' => 'zdh_model_attribute'])
            ->where("za.type_id=".$_params['id'] . " and za.acid=".$_params['acid'])
            ->all();
        return $Raws;
    }

    //获取房型属性名称
    public function getRoomsAttrsName($params = []) {
        $Raws = (new Query())->select("za.id,za.attr_type,za.attr_name")
            ->from(['za' => 'zdh_model_attribute'])
            ->where("za.type_id=" . $params['id'] . " and za.acid=".$params['acid'])
            ->all();
        return $Raws;
    }
}






