<?php
namespace apps_manage\controllers;

use app\models\Shift;
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
 * Site controller
 */
class ShiftController extends ManageController
{

    public $layout = false;
    public $enableCsrfValidation = false;

    /**
     * 交班列表
     * @return string
     */
    public function actionIndex()
    {

        //最近7天班次
        $sql = "SELECT SUM(class_sj_xj+class_sj_sk) sj,SUM(class_xf_xj+class_xf_lc) xf,FROM_UNIXTIME(class_date,'%Y-%m-%d') cdate FROM `zdh_mg_shift` WHERE app_id='" . Yii::$app->session['app_id'] . "' AND date_sub(curdate(), INTERVAL 120 DAY) <= date(FROM_UNIXTIME(class_date,'%Y-%m-%d')) GROUP BY cdate ORDER BY cdate desc;";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($data as $k => $v) {
            $date = $v['cdate'];
            $subsql = "SELECT id,class_name,(class_sj_xj+class_sj_sk) sj,(class_xf_xj+class_xf_lc) xf FROM zdh_mg_shift WHERE app_id='" . Yii::$app->session['app_id'] . "' AND FROM_UNIXTIME(class_date,'%Y-%m-%d')='" . $date . "'";
            $subdata = Yii::$app->db->createCommand($subsql)->queryAll();
            $data[$k]['items'] = $subdata;
        }

        //本月上缴合计
        $sql = "SELECT SUM(class_sj_xj+class_sj_sk) sj FROM zdh_mg_shift WHERE app_id='" . Yii::$app->session['app_id'] . "' AND DATE_FORMAT(FROM_UNIXTIME(class_date,'%Y-%m-%d'),'%Y%m')=DATE_FORMAT(CURDATE(),'%Y%m')";
        $sj = Yii::$app->db->createCommand($sql)->queryOne();

        return $this->render('index', ['list' => $data, 'sj_total' => $sj]);
    }

    /**
     * 交班详情
     */
    public function actionDetail()
    {
        $id = Yii::$app->request->get('id');
        $model = Shift::findOne(['id' => $id, 'app_id' => Yii::$app->session['app_id']]);

        return $this->render('detail', ['model' => $model]);
    }

}
