<?php
namespace apps_manage\controllers;

use app\models\RoomsAt;
use common\controller\ManageController;
use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class CheckController extends ManageController
{

    public $layout = false;
    public $enableCsrfValidation = false;

    /**
     * 在住报告、今日离店、昨日离店
     * @return string
     */
    public function actionIndex()
    {
        //获取今日开始时间戳和结束时间戳
        $beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $endToday = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
        //获取昨日起始时间戳和结束时间戳
        $beginYesterday = mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'));
        $endYesterday = mktime(0, 0, 0, date('m'), date('d'), date('Y')) - 1;
        //获取本月起始时间戳和结束时间戳
        $beginThismonth = mktime(0, 0, 0, date('m'), 1, date('Y'));
        $endThismonth = mktime(23, 59, 59, date('m'), date('t'), date('Y'));

        //1.当前入住
        $now_check_in = RoomsAt::find()->select('checkin_id,room_no,name,real_price,checkin_time,checkout_time')->where(['check_status' => 1, 'app_id' => Yii::$app->session['app_id']])->asArray()->all();
        //2.今日离店
        $today_check_out = RoomsAt::find()->select('checkin_id,room_no,name,night_count,total_amount')->where(['between', 'updated_at', $beginToday, $endToday])->andWhere(['check_status' => 0, 'app_id' => Yii::$app->session['app_id']])->asArray()->all();
        //3.昨天离店
        $yestoday_check_out = RoomsAt::find()->select('checkin_id,room_no,name,night_count,total_amount')->where(['between', 'updated_at', $beginYesterday, $endYesterday])->andWhere(['check_status' => 0, 'app_id' => Yii::$app->session['app_id']])->asArray()->all();
        //4.本月离店金额统计
        $month_check_out_total = RoomsAt::find()->where(['between', 'updated_at', $beginThismonth, $endThismonth])->andWhere(['check_status' => 0, 'app_id' => Yii::$app->session['app_id']])->asArray()->sum('total_amount');

        //当前入住统计
        //==>在住间数，房价合计
        $now_check_in_count = count($now_check_in);
        $now_check_in_price_total = 0.00;
        foreach ($now_check_in as $v) {
            $now_check_in_price_total += floatval($v['real_price']);
        }

        //今日离店
        //==>今日总消费、间夜数、元/间夜
        $today_check_out_total_amount = 0.00;
        $today_check_out_night_count = 0;
        $today_check_out_avg = 0;
        foreach ($today_check_out as $v) {
            $today_check_out_total_amount += floatval($v['total_amount']);
            $today_check_out_night_count += intval($v['night_count']);
        }
        if ($today_check_out_total_amount != 0.00)
            $today_check_out_avg = $today_check_out_total_amount / $today_check_out_night_count;

        //昨天离店
        $yestoday_check_out_total_amount = 0.00;
        $yestoday_check_out_night_count = 0;
        $yestoday_check_out_avg = 0;
        foreach ($yestoday_check_out as $v) {
            $yestoday_check_out_total_amount += floatval($v['total_amount']);
            $yestoday_check_out_night_count += intval($v['night_count']);
        }
        if ($yestoday_check_out_total_amount != 0.00)
            $yestoday_check_out_avg = $yestoday_check_out_total_amount / $yestoday_check_out_night_count;

        $data = [
            'now_check_in' => $now_check_in,
            'now_check_in_count' => $now_check_in_count,
            'now_check_in_price_total' => $now_check_in_price_total,

            'today_check_out' => $today_check_out,
            'today_check_out_total_amount' => $today_check_out_total_amount,
            'today_check_out_night_count' => $today_check_out_night_count,
            'today_check_out_avg' => $today_check_out_avg,

            'yestoday_check_out' => $yestoday_check_out,
            'yestoday_check_out_total_amount' => $yestoday_check_out_total_amount,
            'yestoday_check_out_night_count' => $yestoday_check_out_night_count,
            'yestoday_check_out_avg' => $yestoday_check_out_avg,
            'month_check_out_total' => $month_check_out_total

        ];

        return $this->render('index', $data);
    }

    /**
     * 入住详情
     */
    public function actionDetail()
    {
        $id = Yii::$app->request->get('id');
        $type = Yii::$app->request->get('type');
        $data = RoomsAt::find()->where(['checkin_id' => $id])->andWhere(['app_id' => Yii::$app->session['app_id']])->asArray()->one();

        return $this->render('detail', ['model' => $data, 'type' => $type]);
    }

    public function actionTest()
    {
        echo time();
    }

}
