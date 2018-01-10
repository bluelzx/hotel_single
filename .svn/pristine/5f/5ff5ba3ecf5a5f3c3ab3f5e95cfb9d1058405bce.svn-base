<?php
namespace apps_manage\controllers;

use app\models\RevenueRecord;
use apps_manage\components\Common;
use common\controller\ManageController;
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
 * 营收、历史数据统计控制器
 */
class RevenueController extends ManageController
{

    public $layout = false;
    public $enableCsrfValidation = false;

    /**
     * 营收数据
     * @return string
     */
    public function actionIndex()
    {
        $yestoday_revenue = 0.00;//(昨日营收)
        $this_month = 0.00;//(本月累计)
        $checkout = ['yestoday' => 0.00, 'month' => 0.00];//（收款）
        $house_sale = ['yestoday' => 0.00, 'month' => 0.00];//（售房数）
        $occupancy_rate = ['yestoday' => 0.00, 'month' => 0.00];//（入住率）
        $guest_accounts = ['yestoday' => 0.00, 'month' => 0.00];//（宾客账款）
        $finance_receivables = ['yestoday' => 0.00, 'month' => 0.00];//（财务应收）
        $average_house_price = ['yestoday' => 0.00, 'month' => 0.00];//（平均房价）
        $cash = ['yestoday' => 0.00, 'month' => 0.00];//（现金）
        $credit_card = ['yestoday' => 0.00, 'month' => 0.00];//（刷卡）
        $bill = ['yestoday' => 0.00, 'month' => 0.00];//（挂单）
        $free = ['yestoday' => 0.00, 'month' => 0.00];//（免单）
        $membership = ['yestoday' => 0.00, 'month' => 0.00];//（会员卡）
        $other = ['yestoday' => 0.00, 'month' => 0.00];//（其它）

        $beginMonthUnix = mktime(0, 0, 0, date('m'), 1, date('Y'));
        $modellst = RevenueRecord::find()->where(['>=', 'stats_date', $beginMonthUnix])->andWhere(['app_id' => Yii::$app->session['app_id']])->asArray()->all();

        $beginYesterday = mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'));
        $ruzhu_count = 0; //用于平均入住率计算
        foreach ($modellst as $v) {
            switch ($v['type']) {
                case 'yestoday_revenue':
                    if ($v['stats_date'] == $beginYesterday) {
                        $yestoday_revenue = number_format($v['stats_data'], 2);
                    }
                    $this_month += floatval($v['stats_data']);
                    break;
                case 'checkout':
                    if ($v['stats_date'] == $beginYesterday)
                        $checkout['yestoday'] = number_format($v['stats_data'], 2);
                    $checkout['month'] += floatval($v['stats_data']);
                    break;
                case 'house_sale':
                    if ($v['stats_date'] == $beginYesterday)
                        $house_sale['yestoday'] = number_format($v['stats_data'], 2);
                    $house_sale['month'] += floatval($v['stats_data']);
                    break;
                case 'occupancy_rate':
                    if ($v['stats_date'] == $beginYesterday)
                        $occupancy_rate['yestoday'] = floatval($v['stats_data']) * 100;
                    $occupancy_rate['month'] += floatval($v['stats_data']) * 100;
                    $ruzhu_count++;
                    break;
                case 'guest_accounts':
                    if ($v['stats_date'] == $beginYesterday)
                        $guest_accounts['yestoday'] = number_format($v['stats_data'], 2);
                    $guest_accounts['month'] += floatval($v['stats_data']);
                    break;
                case 'finance_receivables':
                    if ($v['stats_date'] == $beginYesterday)
                        $finance_receivables['yestoday'] = number_format($v['stats_data'], 2);
                    $finance_receivables['month'] += floatval($v['stats_data']);
                    break;
                case 'average_house_price':
                    if ($v['stats_date'] == $beginYesterday)
                        $average_house_price['yestoday'] = number_format($v['stats_data'], 2);
                    $average_house_price['month'] += floatval($v['stats_data']);
                    break;
                case 'cash':
                    if ($v['stats_date'] == $beginYesterday)
                        $cash['yestoday'] = number_format($v['stats_data'], 2);
                    $cash['month'] += floatval($v['stats_data']);
                    break;
                case 'credit_card':
                    if ($v['stats_date'] == $beginYesterday)
                        $credit_card['yestoday'] = number_format($v['stats_data'], 2);
                    $credit_card['month'] += floatval($v['stats_data']);
                    break;
                case 'bill':
                    if ($v['stats_date'] == $beginYesterday)
                        $bill['yestoday'] = number_format($v['stats_data'], 2);
                    $bill['month'] += floatval($v['stats_data']);
                    break;
                case 'free':
                    if ($v['stats_date'] == $beginYesterday)
                        $free['yestoday'] = number_format($v['stats_data'], 2);
                    $free['month'] += floatval($v['stats_data']);
                    break;
                case 'membership':
                    if ($v['stats_date'] == $beginYesterday)
                        $membership['yestoday'] = number_format($v['stats_data'], 2);
                    $membership['month'] += floatval($v['stats_data']);
                    break;
                case 'other':
                    if ($v['stats_date'] == $beginYesterday)
                        $other['yestoday'] = number_format($v['stats_data'], 2);
                    $other['month'] += floatval($v['stats_data']);
                    break;
            }
        }

        //人民币数字格式化，每三位加逗号
        $this_month = number_format($this_month, 2);
        $checkout['month'] = number_format($checkout['month'], 2);
        $house_sale['month'] = number_format($house_sale['month'], 2);
        $guest_accounts['month'] = number_format($guest_accounts['month'], 2);
        $finance_receivables['month'] = number_format($finance_receivables['month'], 2);
        $average_house_price['month'] = number_format($average_house_price['month'], 2);
        $cash['month'] = number_format($cash['month'], 2);
        $credit_card['month'] = number_format($credit_card['month'], 2);
        $bill['month'] = number_format($bill['month'], 2);
        $free['month'] = number_format($free['month'], 2);
        $membership['month'] = number_format($membership['month'], 2);
        $other['month'] = number_format($other['month'], 2);

        if (!empty($occupancy_rate['month']))
            $occupancy_rate['month'] = $occupancy_rate['month'] / $ruzhu_count;


        $data = [
            'yestoday_revenue' => $yestoday_revenue,
            'this_month' => $this_month,
            'checkout' => $checkout,
            'house_sale' => $house_sale,
            'occupancy_rate' => $occupancy_rate,
            'guest_accounts' => $guest_accounts,
            'finance_receivables' => $finance_receivables,
            'average_house_price' => $average_house_price,
            'cash' => $cash,
            'credit_card' => $credit_card,
            'bill' => $bill,
            'free' => $free,
            'membership' => $membership,
            'other' => $other
        ];

        return $this->render('index', $data);
    }

    /**
     * 30日营收数据详细
     */
    public function actionDetail($type)
    {
        //30日数据
        $sql = "select * from zdh_mg_revenue_record where date_sub(curdate(), INTERVAL 30 DAY) <= date(FROM_UNIXTIME(stats_date,'%Y-%m-%d')) ";
        $sql .= "and type='" . $type . "' ";
        $sql .= "and app_id='" . Yii::$app->session['app_id'] . "' ";
        $sql .= "order by stats_date desc";
        $data = Yii::$app->db->createCommand($sql)->queryAll();

        //本年度统计
        $statSql = "SUM(stats_data)";
        //入住率、平均房价 统计平均数
        if (in_array($type, ['occupancy_rate', 'average_house_price']))
            $statSql = "CAST(AVG(stats_data) as decimal(10,2))";

        $sql1 = "SELECT " . $statSql . " total FROM zdh_mg_revenue_record WHERE year(FROM_UNIXTIME(stats_date)) = year(curdate()) ";
        $sql1 .= "AND type='" . $type . "'";
        $sql1 .= "and app_id='" . Yii::$app->session['app_id'] . "' ";
        $total = Yii::$app->db->createCommand($sql1)->queryOne();

        return $this->render('detail', ['list' => $data, 'total' => number_format($total['total'], 2)]);
    }

    /**
     * 营收历史数据
     */
    public function actionHistorys()
    {
        $turnover = ['yestoday' => 0.00, 'month' => 0.00, 'year' => 0.00];//(营业额)
        $checkout = ['yestoday' => 0.00, 'month' => 0.00, 'year' => 0.00];//（收款）
        $house_sale = ['yestoday' => 0.00, 'month' => 0.00, 'year' => 0.00];//（售房数）
        $occupancy_rate = ['yestoday' => 0.00, 'month' => 0.00, 'year' => 0.00];//（出租率）
        $finance_receivables = ['yestoday' => 0.00, 'month' => 0.00, 'year' => 0.00];//（财务应收）
        $average_house_price = ['yestoday' => 0.00, 'month' => 0.00, 'year' => 0.00];//（平均房价）

        $beginMonthUnix = mktime(0, 0, 0, date('m'), 1, date('Y'));
        $modellst = RevenueRecord::find()->where(['>=', 'stats_date', $beginMonthUnix])->andWhere(['app_id' => Yii::$app->session['app_id']])->asArray()->all();

        $beginYesterday = mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'));
        $ruzhu_count = 0; //用于平均入住率计算
        foreach ($modellst as $v) {
            switch ($v['type']) {
                case 'yestoday_revenue':
                    if ($v['stats_date'] == $beginYesterday)
                        $turnover['yestoday'] = number_format($v['stats_data'], 2);
                    $turnover['month'] += floatval($v['stats_data']);
                    break;
                case 'checkout':
                    if ($v['stats_date'] == $beginYesterday)
                        $checkout['yestoday'] = number_format($v['stats_data'], 2);
                    $checkout['month'] += floatval($v['stats_data']);
                    break;
                case 'house_sale':
                    if ($v['stats_date'] == $beginYesterday)
                        $house_sale['yestoday'] = number_format($v['stats_data'], 2);
                    $house_sale['month'] += floatval($v['stats_data']);
                    break;
                case 'occupancy_rate':
                    if ($v['stats_date'] == $beginYesterday)
                        $occupancy_rate['yestoday'] = floatval($v['stats_data']) * 100;
                    $occupancy_rate['month'] += floatval($v['stats_data']) * 100;
                    $ruzhu_count++;
                    break;
                case 'finance_receivables':
                    if ($v['stats_date'] == $beginYesterday)
                        $finance_receivables['yestoday'] = number_format($v['stats_data'], 2);
                    $finance_receivables['month'] += floatval($v['stats_data']);
                    break;
                case 'average_house_price':
                    if ($v['stats_date'] == $beginYesterday)
                        $average_house_price['yestoday'] = number_format($v['stats_data'], 2);
                    $average_house_price['month'] += floatval($v['stats_data']);
                    break;
            }
        }

        //人民币数字格式化，每三位加逗号
        $turnover['month'] = number_format($turnover['month'], 2);
        $checkout['month'] = number_format($checkout['month'], 2);
        $house_sale['month'] = number_format($house_sale['month'], 2);
        $finance_receivables['month'] = number_format($finance_receivables['month'], 2);
        $average_house_price['month'] = number_format($average_house_price['month'], 2);

        if (!empty($occupancy_rate['month']))
            $occupancy_rate['month'] = $occupancy_rate['month'] / $ruzhu_count;

        //本年度统计
        //营业额、收款、售房数、出租率、财务应收、平均房价 年度金额统计
        $sql1 = "SELECT SUM(stats_data) total1,CAST(AVG(stats_data) as decimal(10,2)) total2,type FROM zdh_mg_revenue_record WHERE year(FROM_UNIXTIME(stats_date)) = year(curdate()) and app_id='" . Yii::$app->session['app_id'] . "' group BY type ";
        $stats_data = Yii::$app->db->createCommand($sql1)->queryAll();
        foreach ($stats_data as $k => $v) {
            switch ($v['type']) {
                case 'yestoday_revenue':
                    $turnover['year'] = number_format($v['total1'], 2);
                    break;
                case 'checkout':
                    $checkout['year'] = number_format($v['total1'], 2);
                    break;
                case 'house_sale':
                    $house_sale['year'] = number_format($v['total1'], 2);
                    break;
                case 'occupancy_rate':
                    $occupancy_rate['year'] = number_format($v['total2'], 2);
                    break;
                case 'finance_receivables':
                    $finance_receivables['year'] = number_format($v['total1'], 2);
                    break;
                case 'average_house_price':
                    $average_house_price['year'] = number_format($v['total2'], 2);
                    break;
            }
        }

        $data = [
            'turnover' => $turnover,
            'checkout' => $checkout,
            'house_sale' => $house_sale,
            'occupancy_rate' => $occupancy_rate,
            'finance_receivables' => $finance_receivables,
            'average_house_price' => $average_house_price,
        ];
        return $this->render('history', $data);
    }

    /**
     * 最近7天相关营收数据
     */
    public function actionSevenRevenue()
    {
        if (Yii::$app->request->isPost) {
            $type = Yii::$app->request->post('type');
            //最近七天营业额
            $sql2 = "SELECT FROM_UNIXTIME(stats_date,'%m-%d') stats_date,stats_data FROM zdh_mg_revenue_record where DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(FROM_UNIXTIME(stats_date,'%Y-%m-%d')) AND type='" . $type . "' AND app_id='" . Yii::$app->session['app_id'] . "' ORDER BY stats_date desc";
            $sevenTurnover = Yii::$app->db->createCommand($sql2)->queryAll();

            $data = ['errcode' => 0, 'revenue_record' => $sevenTurnover];
            echo json_encode($data);
            exit();
        }
    }
}
