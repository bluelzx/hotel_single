<?php

/**
 * Manage Controller
 * @description 后端管理所有控制器父类
 * @access public
 * @author www.zdhzdl.com 2015/11/17 <service@zdhzdl.com>
 * @package apps_wechat\controllers
 * @license http://www.zdhzdl.com/license.html
 * @since void
 * @version v1.0
 * @copyright (c) 2015-2020, www.zdhzdl.com
 */

namespace common\controller;

use Yii;

/**
 * manage控制器类
 *
 */
class ManageController extends \yii\web\Controller
{


    /**
     * action执行前
     */

    public function beforeAction($action)
    {
        //父类是否执行成功
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (empty(Yii::$app->session['rights'])) {
            $this->redirect(['login/index', 'ad' => Yii::$app->session['app_id']]);
            return false;
        }

        return true;
    }

}
