<?php
namespace apps_manage\controllers;

use app\models\RoomsLive;
use common\controller\ManageController;
use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class LiveController extends ManageController
{
    public $layout = false;
    public $enableCsrfValidation = false;

    public function actionIndex1()
    {
        $data = $this->getRoomNo();
        return $this->render('index_a', $data);
    }

    public function actionIndex2()
    {
        $data = $this->getRoomType();
        return $this->render('index_b', $data);
    }

    /**
     * 房间实况（根据房号显示）
     */
    public function getRoomNo()
    {
        if (Yii::$app->request->isGet) {

            $max_id = RoomsLive::find()->max('id');
            $model = RoomsLive::find()->select('content')->where(['id' => $max_id])->andWhere(['app_id' => Yii::$app->session['app_id']])->asArray()->one();
            $data = json_decode($model['content'], true);

            $all = [];
            if (!empty($data)) {
                //空房
                if ($data['empty_room']['room_count'] != '0')
                    foreach ($data['empty_room']['room_list'] as $room) {
                        $all[] = ['room_no' => $room['room_no'], 'color' => 'grey'];
                    }
                //脏房
                if ($data['dirty_room']['room_count'] != '0')
                    foreach ($data['dirty_room']['room_list'] as $room) {
                        $all[] = ['room_no' => $room['room_no'], 'color' => 'black'];
                    }
                //住人
                if ($data['living_room']['room_count'] != '0')
                    foreach ($data['living_room']['room_list'] as $room) {
                        $all[] = ['room_no' => $room['room_no'], 'color' => 'green'];
                    }
                //维修
                if ($data['maintain_room']['room_count'] != '0')
                    foreach ($data['maintain_room']['room_list'] as $room) {
                        $all[] = ['room_no' => $room['room_no'], 'color' => 'yellow'];
                    }
                //预抵
                if ($data['arrival_room']['room_count'] != '0')
                    foreach ($data['arrival_room']['room_list'] as $room) {
                        $all[] = ['room_no' => $room['room_no'], 'color' => 'purple'];
                    }
                //自用
                if ($data['personal_use_room']['room_count'] != '0')
                    foreach ($data['personal_use_room']['room_list'] as $room) {
                        $all[] = ['room_no' => $room['room_no'], 'color' => 'alls'];
                    }

                $all = $this->two_array_sort($all, 'room_no', SORT_ASC, SORT_STRING);
            }

            return ['live' => $data, 'all' => $all];
            /* echo json_encode($data);
             exit();*/
        }
    }

    /**
     * 房间实况（根据房型显示）
     */
    public function getRoomType()
    {
        if (Yii::$app->request->isGet) {

            $empty_room_type = [];
            $dirty_room_type = [];
            $living_room_type = [];
            $maintain_room_type = [];
            $arrival_room_type = [];
            $personal_use_room_type = [];
            $all = [];
            $max_id = RoomsLive::find()->max('id');
            $model = RoomsLive::find()->select('content')->where(['id' => $max_id])->andWhere(['app_id' => Yii::$app->session['app_id']])->asArray()->one();
            $data = json_decode($model['content'], true);
            //初始化房型数组
            if (!empty($data)) {
                $types = $data['room_type_list'];
                foreach ($types as $type) {
                    $empty_room_type[$type] = [];
                    $dirty_room_type[$type] = [];
                    $living_room_type[$type] = [];
                    $maintain_room_type[$type] = [];
                    $arrival_room_type[$type] = [];
                    $personal_use_room_type[$type] = [];
                    $all[$type] = [];
                }


                //空房
                if ($data['empty_room']['room_count'] != '0')
                    foreach ($data['empty_room']['room_list'] as $room) {
                        $empty_room_type[$room['room_type']][] = ['room_no' => $room['room_no'], 'color' => 'grey'];
                        $all[$room['room_type']][] = ['room_no' => $room['room_no'], 'color' => 'grey'];
                    }
                //脏房
                if ($data['dirty_room']['room_count'] != '0')
                    foreach ($data['dirty_room']['room_list'] as $room) {
                        $dirty_room_type[$room['room_type']][] = ['room_no' => $room['room_no'], 'color' => 'black'];
                        $all[$room['room_type']][] = ['room_no' => $room['room_no'], 'color' => 'black'];
                    }
                //住人
                if ($data['living_room']['room_count'] != '0')
                    foreach ($data['living_room']['room_list'] as $room) {
                        $living_room_type[$room['room_type']][] = ['room_no' => $room['room_no'], 'color' => 'green'];
                        $all[$room['room_type']][] = ['room_no' => $room['room_no'], 'color' => 'green'];
                    }
                //维修
                if ($data['maintain_room']['room_count'] != '0')
                    foreach ($data['maintain_room']['room_list'] as $room) {
                        $maintain_room_type[$room['room_type']][] = ['room_no' => $room['room_no'], 'color' => 'yellow'];
                        $all[$room['room_type']][] = ['room_no' => $room['room_no'], 'color' => 'yellow'];
                    }
                //预抵
                if ($data['arrival_room']['room_count'] != '0')
                    foreach ($data['arrival_room']['room_list'] as $room) {
                        $arrival_room_type[$room['room_type']][] = ['room_no' => $room['room_no'], 'color' => 'purple'];
                        $all[$room['room_type']][] = ['room_no' => $room['room_no'], 'color' => 'purple'];
                    }
                //自用
                if ($data['personal_use_room']['room_count'] != '0')
                    foreach ($data['personal_use_room']['room_list'] as $room) {
                        $personal_use_room_type[$room['room_type']][] = ['room_no' => $room['room_no'], 'color' => 'alls'];
                        $all[$room['room_type']][] = ['room_no' => $room['room_no'], 'color' => 'alls'];
                    }
            }


            $data = [
                'errcode' => 0,
                'model' => $data,
                'live' => $all,
                'empty_room_type' => $empty_room_type,
                'dirty_room_type' => $dirty_room_type,
                'living_room_type' => $living_room_type,
                'maintain_room_type' => $maintain_room_type,
                'arrival_room_type' => $arrival_room_type,
                'personal_use_room_type' => $personal_use_room_type,
            ];
            return $data;
            /*echo json_encode($data);
            exit();*/
        }
    }

    //二位数组排序
    private function two_array_sort($arrays, $sort_key, $sort_order = SORT_ASC, $sort_type = SORT_NUMERIC)
    {
        if (is_array($arrays)) {
            foreach ($arrays as $array) {
                if (is_array($array)) {
                    $key_arrays[] = $array[$sort_key];
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
        array_multisort($key_arrays, $sort_order, $sort_type, $arrays);
        return $arrays;
    }

}
