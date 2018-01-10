<?php
namespace apps_admin\controllers;

use app\models\ZdhHotelOrder;
use common\controller\AdminController;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class IndexController extends AdminController
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 判断是否有新订单
     *
     */
    public function actionNewOrder()
    {
        set_time_limit(0);
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            if (0 == $_SESSION['acid']) {
                $acid = $_SESSION['s_acid'];
            } else {
                $acid = Yii::$app->user->identity->acid;
            }
            $list = ZdhHotelOrder::findAll(['acid' => $acid, 'is_tip' => 1]);
            if (!empty($list)) {
                ZdhHotelOrder::updateAll(['is_tip' => 0], 'acid=:acid', [':acid' => $acid]);
                return $this->success('有新订单产生');
            } else {
                return $this->error('没有新订单');
            }


        }
    }

    /**
     * 判断是否有退款订单
     *
     */
    public function actionRefundOrder()
    {
        set_time_limit(0);
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            if (0 == $_SESSION['acid']) {
                $acid = $_SESSION['s_acid'];
            } else {
                $acid = Yii::$app->user->identity->acid;
            }
            $list = ZdhHotelOrder::findAll(['acid' => $acid, 'is_r_tip' => 1]);
            if (!empty($list)) {
                ZdhHotelOrder::updateAll(['is_r_tip' => 0], 'acid=:acid', [':acid' => $acid]);
                return $this->success('有新退款订单产生');
            } else {
                return $this->error('没有新退款订单');
            }


        }
    }

}
