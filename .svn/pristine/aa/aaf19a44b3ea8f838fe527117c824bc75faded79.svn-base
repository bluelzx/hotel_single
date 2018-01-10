<?php
namespace apps_admin\controllers;

use Yii;
use yii\db\Query;
use yii\web\Controller;
use app\models\ZdhApiDaily;
use common\controller\AdminController;
use yii\helpers\Url;
use yii\base\Object;

/* 
 * API日志控制器
 *  */
class ApiDailyController extends AdminController{
    public function actionIndex(){
        define('DEBUG',1);
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            if(DEBUG) {
                if(0 == $_SESSION['acid']) {
                    $acid = $_SESSION['s_acid'];
                } else {
                    $acid = Yii::$app->user->identity->acid;
                }
                if (Yii::$app->request->isPost) {
                    $ApiLogs = new ZdhApiDaily();
                   
                  //搜索条件
                  $wx_name = Yii::$app->request->post('acid');//公众号acid名称
                  $created_time_from1 = Yii::$app->request->post('created_time_from');//操作时间从.......
                  $created_time_from=strtotime($created_time_from1);
                  $created_time_to1 = Yii::$app->request->post('created_time_to');//操作时间至.......
                //  $created_time_to=strtotime($created_time_to1)+86399;//加这个是为了让今天的也显示
                  $created_time_to=strtotime($created_time_to1);
                  $api_type = Yii::$app->request->post('api_type');//接口类型
                  
                  
                  
                   $TO= strtotime(date('Y-m-d 00:00:00'));//当前日期时间戳
                  $FROM= $TO-(3600*24*7) ;//最后操作时间减去7天 
                  if(empty($created_time_from1)&&!empty($created_time_to1)){
                      $created_time_from=$FROM= $TO-(3600*24*7) ;
                  }elseif (!empty($created_time_from1)&&empty($created_time_to1)){
                      $created_time_to=strtotime(date('Y-m-d 00:00:00'));
                  }
                  
                  
                  
                  
                  
                  
                  if($api_type=="房间实况"){
                      $api_type="room-live";
                  }elseif ($api_type=="营收"){
                      $api_type="revenue-history";
                  }elseif ($api_type=='客人入住\离店'){
                      $api_type="check-in-and-out";
                  }elseif ($api_type=="交班"){
                      $api_type="shift";
                  }elseif ($api_type=="全部"){
                      $api_type=null;
                  }elseif ($api_type=="更改房态"){
                      $api_type="room-status";
                  }
                  /* 初始化分页查询条件 */
                    $pageSize = $this->post('iDisplayLength');    //每页记录数
                    $page = $this->post('iDisplayStart');     //当前起始索引
                    $params = [
                        'acid' => $acid,
                        'offset' => $page,
                        'wx_name'=>$wx_name,
                        'created_time_from'=>$created_time_from,
                        'created_time_to'=>$created_time_to,
                        'api_type'=>$api_type,
                        'offset' => $page,
                        'limit' => $pageSize    
                    ];
                    $d = $ApiLogs->getApiList($params);
                 foreach ($d['data'] as $key =>$value){
                    $d['data'][$key]['params']= substr_replace($value['params'], "......}", 50) ."<hr/>";//截取替换
                } 
                    $list['iTotalRecords'] = $d['count'];   //总记录数
                    $list['iTotalDisplayRecords'] = $d['count'];   //过滤之后，实际的行数
                    $list['aaData'] = $d['data'];      //表中数据
                //  $list['s'] = $Search;
                    return $this->ajaxOutput($list);
                } else {
                    $connection= \Yii::$app->db;
                    $sql = "SELECT * FROM zdh_wx_accounts";
                    $command = $connection->createCommand($sql);
                    $arr=$command->queryAll();   
                    //var_dump($arr);die;
                         
                    return $this->render('index',['arr' => $arr]);
                }
            } else {
                $ApiLogs = new ZdhApiDaily();
                $params = [
                    'acid' => 3,
                    //   'search' => $Search,
                    'offset' => '',
                    'wx_name'=>'利众合',
                    'created_time_from'=>strtotime('2016-12-3'),
                    'created_time_to'=>strtotime('2016-12-6'),
                    'api_type'=>'',
                    'offset' => '',
                    'limit' => ''
                ];
                $d = $ApiLogs->getApiList($params);
                foreach ($d['data'] as $key =>$value){
                    //$d['data'][$k]['created_time'] = date("Y-m-d H:i:s",$dd['created_time']);
                    $d['data'][$key]['params']= substr_replace($value['params'], "......}", 50) ."<hr/>";//截取替换
                }
                echo "<pre>";
                print_r($d);
                exit;
                $params = [
                    'acid' => 3,
                    'search' => '',
                    'offset' => '',
                    'limit' => ''
                ];
                $ApiLogs = new ZdhApiDaily();
                $d = $ApiLogs-> getApiList($params);
                echo "<pre>";
                foreach ($d['data'] as $key =>$value){
                   $str= $value['params'];
                   echo substr_replace($str, "......", 50) ."<hr/>";
                }
            }
        }
  }
  
  
  /* 
   * 
   *  搜索方法
   *  
   *  */
 public function  actionSearch(){
     define('DEBUG',1);
     if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
         $this->redirect(['login/index']);
     } else {
         if(DEBUG) {
             if(0 == $_SESSION['acid']) {
                 $acid = $_SESSION['s_acid'];
             } else {
                 $acid = Yii::$app->user->identity->acid;
             }
             if (Yii::$app->request->isPost) {
                 //搜索条件
                $wx_name = Yii::$app->request->post('wx_name');//公众号名称
                $created_time_from1 = Yii::$app->request->post('created_time_from');//操作时间从.......
                $created_time_from=strtotime($created_time_from1);
                $created_time_to1 = Yii::$app->request->post('created_time_to');//操作时间至.......
                $created_time_to=strtotime($created_time_to1);
                $api_type = Yii::$app->request->post('api_type');//接口类型
                
                if($api_type=="房间实况"){
                    $api_type="room-live";
                }elseif ($api_type=="营收"){
                    $api_type="revenue-history";
                }elseif ($api_type=='客人入住 \离店'){
                     $api_type="check-in-and-out";
                }elseif ($api_type=="交班"){
                     $api_type="shift";
                }elseif ($api_type=="全部"){
                    $api_type=null;
                }
                
                 /* 初始化分页查询条件 */
                 $pageSize = 10;    //每页记录数
                 $page = $this->post('iDisplayStart');     //当前起始索引
     
                 $_SESSION['search'] = [
                     'acid' => $acid,
                     'wx_name'=>$wx_name,
                     'created_time_from'=>$created_time_from,
                     'created_time_to'=>$created_time_to,
                     'api_type'=>$api_type,
                     'offset' => $page,
                     'limit' => $pageSize
                 ];
                 $ApiLogs = new ZdhApiDaily();
                 $d = $ApiLogs->search($_SESSION['search']);
                 $list['iTotalRecords'] = $d['count'];   //总记录数
                 $list['iTotalDisplayRecords'] = $d['count'];   //过滤之后，实际的行数
                 $list['aaData'] = $d['data'];      //表中数据
             foreach ($d['data'] as $key =>$value){
                    $d['data'][$key]['params']= substr_replace($value['params'], "......}", 50) ."<hr/>";//截取替换
                } 
                 
                 $connection= \Yii::$app->db;
                 $sql = "SELECT * FROM  zdh_wx_accounts";
                 $command = $connection->createCommand($sql);
                 $arr=$command->queryAll();
                 
                 
                 
                 return $this->render('search',["raws"=> $d,'arr' => $arr,"wx_name"=>$wx_name,"created_time_from1"=>$created_time_from1,"created_time_to1"=>$created_time_to1,"api_type"=>$api_type]);
             } else if(Yii::$app->request->isGet) {
                 $page = $this->get('page');
                 $ApiLogs = new ZdhApiDaily();
                 $_SESSION['search']['offset'] = $page;
                 $d = $ApiLogs->search($_SESSION['search']);
                 
             } else {
                 return $this->render('search',["raws"=> $d]);
             }
         } else {
           
             $params = [
                 'acid' => 3,
                 'search' => '',
                 'offset' => '',
                 'limit' => ''
             ];
             $ApiLogs = new ZdhApiDaily();
             $d = $ApiLogs-> search($params);
             echo "<pre>";
             print_r($d);
         }
     }
 }
 
 public function actionAjax(){
    $id=  json_encode($_GET['data']);
     $connection= \Yii::$app->db;
     $sql ="SELECT params FROM zdh_mg_api_logs   where id ={$id}" ;
     $command = $connection->createCommand($sql);
     $Raw =$command->queryAll(); 
  echo   json_encode($Raw[0]['params']) ;
 }
}





































































