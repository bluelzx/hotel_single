<?php
namespace apps_admin\controllers;
use Yii;
use app\models\Roomstate;
use yii\web\Controller;
use yii\base\Object;
use yii\helpers\VarDumper;

class RoomStateController extends Controller{
    public $enableCsrfValidation = false;
    public function actionIndex(){
        define('DEBUG',1);
        if(!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0 ){
            $this->redirect("login/index");
        }else {
            if(0 == $_SESSION['acid']){
                $acid=$_SESSION['s_acid'];
            }else {
                $acid=\Yii::$app->user->identity->acid;
            }
        }
        $type=\Yii::$app->request->get('room_type');
      /*   var_dump($type);
        exit(); */
        if(isset($type) ){
            $connection= \Yii::$app->db;
            $sql = "SELECT * FROM  zdh_mg_rooms_live where room_type='{$type}'";
            $command = $connection->createCommand($sql);
            $rooms=$command->queryAll();
        }else {
            $connection= \Yii::$app->db;
            $sql = "SELECT * FROM  zdh_mg_rooms_live ";
            $command = $connection->createCommand($sql);
            $rooms=$command->queryAll(); 
      /*   $room = Searchroom::find();
        $rooms=$room->orderBy(["room_no"=>SORT_ASC])->all(); */
        }
     // var_dump($rooms);die();
        $connection= \Yii::$app->db;
         $sql = "SELECT room_type,COUNT(room_type) room_type_count FROM zdh_mg_rooms_live GROUP BY room_type";
         $command = $connection->createCommand($sql);
         $roomtype=$command->queryAll();
         //ar_dump($roomtype);die();
       return $this->render('index', array('rooms'=>$rooms,'roomtype'=>$roomtype)); 
      
    }
   
    
   /* 
    * 
    * 房型统计方法 
    *  
    *  */ 
    public function actionStatistics()
    {
        if (! isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect("login/index");
        } else {
            if (0 == $_SESSION['acid']) {
                $acid = $_SESSION['s_acid'];
            } else {
                $acid = \Yii::$app->user->identity->acid;
            }
        }
        
        //查房型及其数量    
            $connection= \Yii::$app->db;
            $sql = "SELECT  name,room_num   FROM  zdh_hotel_room_type WHERE acid = {$_SESSION['s_acid']}  AND is_del=0";
            //echo $sql;die;
            $command = $connection->createCommand($sql);
            $arr=$command->queryAll();
            
            /* 
             echo "<pre>";
            print_r($arr);
            die;  */
        
        return $this->render('statistics',array('arr'=>$arr,'acid'=>$acid));
    }
  
    
    /*
     *
     * 点击详情下拉
     *
     *  */
    public function actionAjax(){
        if (! isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect("login/index");
        } else {
            if (0 == $_SESSION['acid']) {
                $acid = $_SESSION['s_acid'];
            } else {
                $acid = \Yii::$app->user->identity->acid;
            }
        }
        if(empty($_GET['order_time_from'])){//如果ajax没有传时间过来，即没有按时间搜索（刚进来点击详情时）  
        $room_type=  $_GET['room_type'];//传输过来的值带了()需进行处理
        $pos = strpos($room_type,'('); //查找"("返回一个数字
        $result = substr($room_type,0,$pos);//截取
        $time=time();
        $time2=strtotime(date('Y-m-d 00:00:00'));//临时添加
        $connection= \Yii::$app->db;
        $sql ="SELECT real_name ,phone,checkin_time,checkout_time FROM zdh_hotel_order   where acid= {$_SESSION['s_acid']} and order_status=3 and  goods_name ='{$result}'  and checkin_time<={$time} and checkout_time>={$time}" ; //已入住的sql语句 
       
        $command = $connection->createCommand($sql);
        $Raw1=$command->queryAll();
        $sql2 ="SELECT real_name ,phone,checkin_time,checkout_time FROM zdh_hotel_order   where acid= {$_SESSION['s_acid']} and order_status=2 and  goods_name ='{$result}'  and order_time >= {$time2}"; //已预定的sql语句
        $command = $connection->createCommand($sql2);
        $Raw2 =$command->queryAll();
        $Raw=array('0'=> $Raw1,"1"=>$Raw2);//合并已入住和已预订
            foreach($Raw[0] as $k => $dd) {//处理时间戳
                $Raw[0][$k]['checkin_time'] = date("Y-m-d ",$dd['checkin_time']);//转化为时间格式
                $Raw[0][$k]['checkout_time'] = date("Y-m-d",$dd['checkout_time']);
            }
        
            foreach($Raw[1] as $k => $dd) {//处理时间戳
                $Raw[1][$k]['checkin_time'] = date("Y-m-d ",$dd['checkin_time']);//转化为时间格式
                $Raw[1][$k]['checkout_time'] = date("Y-m-d",$dd['checkout_time']);
            }
        if(!empty($Raw)){
            echo   json_encode($Raw) ;
        }else{
            echo   json_encode("空") ;
        } 
      }
      
      if(!empty($_GET['order_time_from'])){//如果按照时间来搜索之后了，即按时间搜索之后点击详情时
          $order_time_from1 = $_GET['order_time_from'];//操作时间从.......
          $order_time_from = strtotime($order_time_from1);
          
          $order_time_to = $order_time_from + 86399;//加这个是为了让今天的也显示
          $room_type=  $_GET['room_type'];//传输过来的值带了()需进行处理
          $pos = strpos($room_type,'('); //查找"("返回一个数字
          $result = substr($room_type,0,$pos);//截取
          $time=time();
          $time2=strtotime(date('Y-m-d 00:00:00'));//临时添加
          $connection= \Yii::$app->db;
          
          
          
          if($order_time_from!=$time2){//如果查询时间不是今天
              $sql ="SELECT real_name ,phone,checkin_time,checkout_time FROM zdh_hotel_order   where acid= {$_SESSION['s_acid']} and  checkin_time >= {$order_time_from} and checkin_time <= {$order_time_to}   and order_status=3 and  goods_name ='{$result}'  and checkin_time<={$time} and checkout_time>={$time}" ; //已入住的sql语句
          }
          if($order_time_from==$time2){//如果查询时间是今天
              $sql ="SELECT real_name ,phone,checkin_time,checkout_time FROM zdh_hotel_order   where acid= {$_SESSION['s_acid']} and   order_status=3 and  goods_name ='{$result}'  and checkin_time<={$time} and checkout_time>={$time}" ; //已入住的sql语句
          }
          
         
          $command = $connection->createCommand($sql);
          $Raw1=$command->queryAll();
         // return $sql;                                                                                                            //暂时去掉checkout_time
          $sql2 ="SELECT real_name ,phone,checkin_time,checkout_time FROM zdh_hotel_order   where acid= {$_SESSION['s_acid']} and  checkin_time >= {$order_time_from}  and checkin_time <= {$order_time_to}  and order_status=2 and  goods_name ='{$result}'  "; //已预订的sql语句
          $command = $connection->createCommand($sql2);
          $Raw2 =$command->queryAll();
        // return $sql2;
          $Raw=array('0'=> $Raw1,"1"=>$Raw2);//合并已入住和已预订
           
          
          foreach($Raw[0] as $k => $dd) {//处理时间戳
              $Raw[0][$k]['checkin_time'] = date("Y-m-d ",$dd['checkin_time']);//转化为时间格式
              $Raw[0][$k]['checkout_time'] = date("Y-m-d",$dd['checkout_time']);
          }
          
          foreach($Raw[1] as $k => $dd) {//处理时间戳
              $Raw[1][$k]['checkin_time'] = date("Y-m-d ",$dd['checkin_time']);//转化为时间格式
              $Raw[1][$k]['checkout_time'] = date("Y-m-d",$dd['checkout_time']);
          }
          if(!empty($Raw)){
              echo   json_encode($Raw) ;
          }else{
              echo   json_encode("空") ;
          }
      }
     
   
    }
    
    
    
    public function actionSearch(){
        if (! isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect("login/index");
        } else {
            if (0 == $_SESSION['acid']) {
                $acid = $_SESSION['s_acid'];
            } else {
                $acid = \Yii::$app->user->identity->acid;
            }
        }
        $time2=strtotime(date('Y-m-d 00:00:00')); //获取今天的0时0分0秒（当前日期的0时0分0秒）
        $order_time_from1 = Yii::$app->request->post('order_time_from');//操作时间从.......
        $order_time_from = strtotime($order_time_from1);
        $order_time_to = $order_time_from + 86399;//加这个是为了让今天的也显示
       // echo $order_time_from;echo "<hr/>";echo $order_time_to;
        $connection= \Yii::$app->db;
        /*查询全部房型  */
        $sql = "SELECT  name,room_num   FROM  zdh_hotel_room_type WHERE acid = {$_SESSION['s_acid']}  AND is_del=0";
            //echo $sql;die;
        $command = $connection->createCommand($sql);
        $arr=$command->queryAll();
        $connection2 = \Yii::$app->db;
        $time = time();
        /*在住 */
        
        if($order_time_from!=$time2){//如果查询时间不是今天
            $sql2 = "SELECT goods_name, sum(room_count) goods_name_count FROM  zdh_hotel_order   where acid= '{$acid}'  AND checkin_time >= {$order_time_from}  and checkin_time <= {$order_time_to}   and checkin_time<='{$time}'   and  checkout_time>='{$time}' and order_status=3  GROUP BY goods_name ";
        }
        
        if($order_time_from==$time2){//如果查询时间是今天
            $sql2 = "SELECT goods_name, sum(room_count) goods_name_count FROM  zdh_hotel_order   where acid= '{$acid}'    and checkin_time<='{$time}'   and  checkout_time>='{$time}' and order_status=3  GROUP BY goods_name ";
        }
        
       
      
      // return $sql2;
        $command = $connection2->createCommand($sql2);
        $arr2 = $command->queryAll();
       
        /*已经预定*/                                                                                                       //暂时去掉checkout_time
        $sql3="SELECT goods_name, sum(room_count) goods_name_count FROM  zdh_hotel_order   where acid= '{$acid}'  AND checkin_time >= {$order_time_from} and checkin_time <= {$order_time_to}  and order_status=2  GROUP BY goods_name";
       // return $sql3;
        $command = $connection2->createCommand($sql3);
        $arr3 = $command->queryAll();
     
        foreach ($arr as $k=>$v){//全部
            $arr[$k]['already_selled']=0;
            $arr[$k]['ordered']=0;
            foreach ($arr2 as $value){//入住
                if ($v['name']==$value['goods_name']){
                    $arr[$k]['already_selled']=$value['goods_name_count'];
                }
            }
            foreach ($arr3 as $v3){//预定
                if ($v['name']==$v3['goods_name']){
                    $arr[$k]['ordered']=$v3['goods_name_count'];
                }
            }
        }
        echo     json_encode($arr);
       
    
    }
}
