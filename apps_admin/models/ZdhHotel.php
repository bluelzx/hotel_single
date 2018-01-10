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

class ZdhHotel extends ActiveRecord {

    public static function tableName() {
        return 'zdh_hotel';
    }

    //获取公众号appid
    public function getAppId($_params = []) {
        $Rows = (new Query())->select("app_id")->from("zdh_wx_accounts")->where("acid = " . $_params['acid'])->one();
        return $Rows;
    }

}






