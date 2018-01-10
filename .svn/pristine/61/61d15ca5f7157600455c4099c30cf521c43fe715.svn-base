<?php
namespace apps_wechat\controllers;

use app\models\RoomType;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use apps_wechat\models\PasswordResetRequestForm;
use apps_wechat\models\ResetPasswordForm;
use apps_wechat\models\SignupForm;
use apps_wechat\models\ContactForm;

/**
 * 用户 controller
 */
class IndexController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $startDate = date('Y-m-d');
        $endDate = date("Y-m-d", strtotime("+1 day"));

        //记录用户查询时间（即入住时间）
        Yii::$app->session['check_in_time'] = $startDate;
        Yii::$app->session['check_out_time'] = $endDate;

        $query = RoomType::find();
        $list = $query->joinWith(['roomTypes'])->where(['zdh_hotel_room_type.status' => 1])->asArray()->all();
        //反序列化数据处理
        foreach ($list as $k => $v) {
            $list[$k]['attrs'] = unserialize($v['attrs']);
        }

        $data = [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'list' => $list
        ];
        return $this->render('index', $data);
    }

}
