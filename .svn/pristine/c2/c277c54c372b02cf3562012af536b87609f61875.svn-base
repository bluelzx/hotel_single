<?php
namespace apps_wechat\controllers;

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
class DefaultController extends Controller
{
    public function actionTest1()
    {
        $array1 = [
            ['room_no' => '88100', 'room_type' => '情侣房', 'start_date' => '2016-10-11'],
            ['room_no' => '88106', 'room_type' => '标准单人间', 'start_date' => '2016-10-11', 'end_date' => '2016-10-12'],
            ['room_no' => '88211', 'room_type' => '标准单人间', 'start_date' => '2016-10-11', 'end_date' => '2016-10-12'],
            ['room_no' => '88206', 'room_type' => '特价房', 'start_date' => '2016-10-12', 'end_date' => '2016-10-13'],
            ['room_no' => '88310', 'room_type' => '特价房', 'start_date' => '2016-10-11', 'end_date' => '2016-10-12'],
            ['room_no' => '88101', 'room_type' => '豪华单人房', 'start_date' => '2016-10-11', 'end_date' => '2016-10-12'],
            ['room_no' => '88305', 'room_type' => '豪华单人房', 'start_date' => '2016-10-11', 'end_date' => '2016-10-12'],
            ['room_no' => '88309', 'room_type' => '豪华单人房', 'start_date' => '2016-10-11', 'end_date' => '2016-10-12'],
            ['room_no' => '88208', 'room_type' => '豪华单人房(电)', 'start_date' => '2016-10-11', 'end_date' => '2016-10-12'],
            ['room_no' => '88301', 'room_type' => '超豪华(电)', 'start_date' => '2016-10-11', 'end_date' => '2016-10-12'],
        ];
        //$array2 = array(6, 7, 8, 9, 10, 11, 12);

        print_r(array_filter($array1, [$this, 'odd']));
    }

    public function odd($var)
    {
        $now =  strtotime(date('Y-m-d', time()));; //当前日期
        if (strtotime($var['start_date']) < $now && $now <= strtotime($var['end_date']))
            return true;
    }

    public function even($var)
    {
        // returns whether the input integer is even
        return (!($var & 1));
    }
}
