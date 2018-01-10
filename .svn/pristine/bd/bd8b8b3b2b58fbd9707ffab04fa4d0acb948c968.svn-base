<?php

/**
 * Wechat Controller
 * @description 微信端所有控制器父类
 * @access public
 * @author www.zdhzdl.com 2015/11/17 <service@zdhzdl.com>
 * @package apps_wechat\controllers
 * @license http://www.zdhzdl.com/license.html
 * @since void
 * @version v1.0
 * @copyright (c) 2015-2020, www.zdhzdl.com
 */

namespace common\controller;

use app\models\User;
use app\models\WxAccounts;
use app\models\WxUser;
use common\components\wechat\Wechat;
use Yii;
use yii\db\Query;

class WechatController extends \yii\web\Controller
{

    public $enableCsrfValidation = false;
    public $reqParams = [];
    /**
     * 请求对象
     * @var \yii\web\Request
     */
    public $request = null;

    /**
     * 响应对象
     * @var \yii\web\Response
     */
    public $response = null;

    public $wechat; //微信api对象

    public $wx_id;

    /**
     * 初始化函数
     * @author Richard 2016/1/19
     * @access public
     */
    public function init()
    {
        $this->request = Yii::$app->request;
        $this->response = Yii::$app->response;

        $this->wx_id = $this->get('id');
        if (empty($this->wx_id)) $this->wx_id = Yii::$app->session['acid'];
        if (empty($this->wx_id))
            exit('参数不正确！');

        $model = WxAccounts::findOne($this->wx_id);
        $option = array(
            'token' => $model->token, //填写你设定的key
            'encodingaeskey' => $model->encodingaeskey, //填写加密用的EncodingAESKey
            'appid' => $model->app_id, //填写高级调用功能的app id
            'appsecret' => $model->app_secret, //填写高级调用功能的密钥
        );
        $this->wechat = new Wechat($option);

        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            if (empty(Yii::$app->session['openid'])) {
                $openid = $this->get_openid();
                Yii::$app->session["openid"] = $openid;
            }

            $openid = Yii::$app->session['openid'];

            //没有关注的用户，首先插入微信用户信息
            $model = WxUser::findOne(['open_id' => $openid]);
            if (empty($model) && $openid != '') {
                //如果是空的,该openid只有进行插入了
                $wx_user_info = $this->wechat->getUserInfo($openid);
                (new WxUser())->addWxUser($wx_user_info);
            }

            //$openid = 'oLaFfwocWGMQWwZA4vVL9m2pONFo';

            //初始化用户会话uid,mobile
            $user = (new Query())->from(['a' => 'zdh_hotel_user'])
                ->select('a.uid,a.mobile,a.real_name')
                ->leftJoin(['b' => 'zdh_wx_user'], 'a.uid=b.uid')
                ->where(['open_id' => $openid])
                ->one();

            if (!empty($user)) {
                Yii::$app->session['uid'] = $user['uid'];
                Yii::$app->session['mobile'] = $user['mobile'];
                Yii::$app->session['real_name'] = $user['mobile'];
            }
        } else {
            //其它浏览器
        }
    }


    /**
     * post方式获取一个指定的参数
     * @param string $key 参数名称
     * @param string $default 如果参数不存在的默认值
     * @return mixd
     */
    public function post($key = null, $default = null)
    {
        return $this->request->post($key, $default);
    }

    /**
     * get方式获取一个指定的参数
     * @param string $key 参数名称
     * @param string $default 如果参数不存在的默认值
     * @return mixd
     */
    public function get($key = null, $default = null)
    {
        return $this->request->get($key, $default);
    }

    function get_openid()
    {
        $code = $this->get_code();
        $auth = $this->wechat->getOauthAccessToken(); //获取access_token
        return $auth['openid'];
    }

    function get_code()
    {
        $url = 'http://' . $_SERVER['SERVER_NAME'] . '?id=' . $this->wx_id;
        if (!isset($_GET['code'])) {
            //触发微信返回code码
            $code_url = $this->wechat->getOauthRedirect($url, '1', 'snsapi_base');
            /* var_dump($code_url);
             exit();*/
            Header("Location: $code_url");
            exit();
        } else {
            //获取code码，以获取openid
            $code = $_GET['code'];
            return $code;
        }
    }

}
