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

class ZdhWxAccounts extends ActiveRecord {

    public static function tableName() {
        return 'zdh_wx_accounts';
    }

    //获取微信公众号列表
    public function getAccountList() {
        $Raws = (new Query())->select('avatar,acid,name,status,created_at')->from('zdh_wx_accounts')->all();
        return $Raws;
    }

    //获取公众号信息
    public function getAccountMsg($params = []) {
        $Raws = (new Query())->select('*')->from('zdh_wx_accounts')->where('acid='.$params['acid'])->one();
        return $Raws;
    }

    //查询公众号
    public function serAccount($params = []) {
        $Raws = (new Query())->select('*')->from('zdh_wx_accounts')->where('name like "%'.$params['search'].'%"')->all();
        return $Raws;
    }
}






