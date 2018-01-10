<?php
namespace apps_manage\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\db\Query;
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
class SiteController extends Controller
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return 'api started';
    }

    public function actionTest()
    {
        //(new Query())->select()->from()
        echo date("Y-m-d", strtotime("2011-12-12 3:45:29"));
    }

    public function actionTest1()
    {
        $date = \DateTime::createFromFormat('m/d/Y', '10/27/2014');
        $date->setTime(0, 0, 0);

// set lowest date value
        $unixDateStart = $date->getTimeStamp();

// add 1 day and subtract 1 second
        $date->add(new \DateInterval('P1D'));
        $date->sub(new \DateInterval('PT1S'));

// set highest date value
        $unixDateEnd = $date->getTimeStamp();
        $a=0;

       /* $query->andFilterWhere(
            ['between', 'created_at', $unixDateStart, $unixDateEnd]);*/
    }

}
