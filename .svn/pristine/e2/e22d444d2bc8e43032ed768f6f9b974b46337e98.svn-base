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

class ZdhSysAdmin extends ActiveRecord {

    public static function tableName() {
        return 'zdh_sys_admin';
    }

    //获取管理员
    public function getAccount($_params = []) {
        if(!empty($_params['search'])) {
            $Where = 'zsa.acid = zwa.acid and zsa.acid = '.$_params['acid'].' and zwa.name like "%'. $_params['search'].'%"';
        } else if(!empty($_params['username'])) {
            $Where = 'zsa.acid = zwa.acid and zsa.acid = '.$_params['acid'].' and zsa.username like "%'. $_params['username'].'%"';
        } else if(isset($_params['acid'])) {
            $Where = 'zsa.acid = ' . $_params['acid'];
        } else {
            $Where = 1;
        }

        $Query = (new Query())->select('zsa.id,zsa.acid,zsa.username,zsa.last_login_time,zsa.last_login_ip,zsa.status,zwa.name')
            ->from(['zsa' => 'zdh_sys_admin'])
            ->leftJoin(['zwa' => 'zdh_wx_accounts'],'zsa.acid = zwa.acid')
            ->where($Where);

        $C_Query = clone $Query;
        $Raws['count'] = $C_Query->count();
        $Raws['data'] = $Query->all();
        return $Raws;
    }

    //获取公众号列表
    public function getWechatList() {
        $Raws = (new Query())->select('name,acid')->from('zdh_wx_accounts')->all();
        return $Raws;
    }

    //获取公众号
    public function getWechatAccount($_params = []) {
        $Raws = (new Query())->select('name,acid')->from('zdh_wx_accounts')->where("acid=".$_params['acid'])->one();
        return $Raws;
    }
}






