<?php

/**
 * Restful Api Controller
 * @description 后端管理所有控制器父类
 * @access public
 * @author www.zdhzdl.com 2015/11/17 <service@zdhzdl.com>
 * @package apps_api\controllers
 * @license http://www.zdhzdl.com/license.html
 * @since void
 * @version v1.0
 * @copyright (c) 2015-2020, www.zdhzdl.com
 */

namespace common\controller;

use app\models\ApiLogs;
use Yii;
use yii\rest\ActiveController;
use common\components\auth\HttpAuth;

class ApiController extends \yii\web\Controller
{

    public $layout = false;
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


    /**
     * 初始化函数
     * @author Richard 2016/1/19
     * @access public
     */
    public function init()
    {
        //验证
        //$this->auth();

        $this->request = Yii::$app->request;
        $this->response = Yii::$app->response;
    }

    /**
     * 动作执行后
     * @param type $action
     * @param type $result
     */
    public function afterAction($action, $result)
    {
        if (!$this->request->isGet) {
            $model = new ApiLogs();
            $model->setAttributes([
                'type' => $this->request->method,
                'domain' => $this->request->ServerName,
                'url' => $this->request->url,
                //'params'=>file_get_contents('php://input'),
                'params' => \yii\helpers\Json::encode($this->post1()),
                'controller' => $this->id,
                'action' => $this->action->id,
                'ip' => $this->request->userIP,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $model->save();
        }
        return parent::afterAction($action, $result);
    }

    /**
     * 获取一个指定的参数
     * @param string $key 参数名称
     * @param string $default 如果参数不存在的默认值
     * @return mixd
     */
    public function post($key = null, $default = null)
    {
        return $this->request->post($key, $default);
    }

    public function post1($key=null)
    {
        $jsonStr = file_get_contents('php://input');
        return json_decode($jsonStr, true);
    }

    /**
     * api处理成功输出
     * @return string json
     */
    public function success()
    {
        $this->response->format = \yii\web\Response::FORMAT_JSON;
        $data = ['errcode' => 0, 'errmsg' => 'success'];
        return $data;
    }

    /**
     * api处理错误输出
     * @param string $message 错误信息
     * @return string json
     */
    public function error($message = '')
    {
        $this->response->format = \yii\web\Response::FORMAT_JSON;
        $data = ['errcode' => 1, 'errmsg' => $message];
        return $data;
    }

    /**
     * 输出格式化后的数据
     */
    public function outputFormatData($data)
    {
        /*header('Content-Type:application/json; charset=utf-8');
        exit(json_encode($data));*/

        $this->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    /**
     * 验证认证信息
     * @author Kelvin.H 2016/1/19
     * @access private
     */
    private function auth()
    {
        $HttpAuth = new HttpAuth('Basic');
        $HttpAuth->checkAuth([
            'user' => 'demo',
            'password' => '123456'
        ]);
    }

}
