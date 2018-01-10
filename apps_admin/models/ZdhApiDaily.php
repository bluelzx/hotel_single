<?php
namespace app\models;
use Yii;
use yii\base\Exception;
use yii\db\Query;
use yii\db\ActiveRecord;
class ZdhApiDaily extends ActiveRecord {
    public static function tableName() {
        return 'zdh_mg_api_logs';
    }
    public function getApiList($_params = []) {
     //求出最近一条操作的条件语句
    $TO= strtotime(date('Y-m-d 00:00:00'));//当前日期时间戳
    $FROM= $TO-(3600*24*7);//最后操作时间减去7天 
    $connection2= \Yii::$app->db;
    $sql2 = "SELECT  name FROM  zdh_wx_accounts";
    $command = $connection2->createCommand($sql2);
    $arr=$command->queryAll();
    //var_dump($arr[0]['name']);die;
    $wx_name=$arr[0]['name'];
   
        if(!empty($_params['wx_name']) && !empty($_params['created_time_from'])&&!empty($_params['created_time_to'])&&!empty($_params['api_type'])) {//api_type需要处理
            $Where = 'zl.app_id = "'. $_params['wx_name'] . '" and zl.created_time >= ' . $_params['created_time_from'] . ' and zl.created_time <=' . $_params['created_time_to'].' and zl.action = "' . $_params['api_type'] . '"';
        } else if(!empty($_params['wx_name'])&& !empty($_params['created_time_from'])&&!empty($_params['created_time_to'])) {
            $Where = 'zl.app_id = "'. $_params['wx_name'] . '" and zl.created_time >= ' . $_params['created_time_from'] . ' and zl.created_time <=' .$_params['created_time_to'];
        } else if(!empty($_params['wx_name'])&& !empty($_params['api_type'])&&empty($_params['created_time_from'])&&empty($_params['created_time_to'])) {
            $Where =  'zl.app_id = ' . $_params['wx_name'] . ' and zl.action ="'.$_params['api_type'] .'"  and zl.created_time >= ' . $FROM .' and zl.created_time <= ' . $TO;
        
        } elseif (!empty($_params['wx_name'])){
            $Where =  'zl.app_id = "'. $_params['wx_name'] . '" and zl.created_time >= ' . $FROM .' and zl.created_time <= ' .$TO;
        }elseif (!empty($_params['wx_name'])&& !empty($_params['api_type'])&&empty($_params['created_time_from'])&&!empty($_params['created_time_to'])){//$TO不为空,$FROM为空
            $Where =  'zl.app_id = "'. $_params['wx_name'] . '" and zl.action ="'.$_params['api_type'] .'"  and zl.created_time >= ' . $FROM .' and zl.created_time <= ' . $_params['created_time_to'];
        }elseif (!empty($_params['wx_name'])&& !empty($_params['api_type'])&&!empty($_params['created_time_from'])&&empty($_params['created_time_to'])){//$TO为空,$FROM不为空
            $Where =  'zl.app_id = "'. $_params['wx_name'] . '" and zl.action ="'.$_params['api_type'] .'"  and zl.created_time >= ' . $_params['created_time_to'] .' and zl.created_time <= ' . $TO;
        }
        
        
        
        
        
        
        
        
        
        $Query = (new Query())->select('za.acid,za.name,zl.id,zl.app_id,zl.domain,zl.url,zl.params,zl.ip,zl.created_at,zl.action,zl.created_time')->from([
            'zl' => 'zdh_mg_api_logs' ])
        ->leftJoin(['za' => 'zdh_wx_accounts'],"za.acid = zl.app_id")
        ->where($Where)->offset($_params['offset'])->orderBy('zl.created_time DESC')->limit($_params['limit']);
    
        $C_Query = clone $Query;
        $Raws['count'] = $C_Query->count();
        $Raws['data'] = $Query->all();
         /*  $Raws['data'] = $Query->createCommand()->getRawSql();
        echo $Raws['data'];die;     */ 
        return $Raws;
    }
    
    
    
    
    public function search($_params = []) { 
       
            if(!empty($_params['wx_name']) && !empty($_params['created_time_from'])&&!empty($_params['created_time_to'])&&!empty($_params['api_type'])) {//api_type需要处理
                $Where = 'za.acid = ' . $_params['acid'] . ' and za.name = "' . $_params['wx_name'] . '" and zl.created_time >= ' . $_params['created_time_from'] . ' and zl.created_time <=' . $_params['created_time_to'].' and zl.action = "' . $_params['api_type'] . '"';
            } else if(!empty($_params['wx_name'])&& !empty($_params['created_time_from'])&&!empty($_params['created_time_to'])) {
                $Where = 'za.acid = ' . $_params['acid'] . ' and za.name = "' . $_params['wx_name'] . '"  and zl.created_time >= ' . $_params['created_time_from'] . ' and zl.created_time <=' .$_params['created_time_to'];
            } else if(!empty($_params['wx_name'])&& !empty($_params['api_type'])) {
                $Where =  'za.acid = ' . $_params['acid'] . ' and za.name = "' . $_params['wx_name'] . '"  and zl.action ="'.$_params['api_type'] .'"'; 
              
            } elseif (!empty($_params['wx_name'])){
                $Where =  'za.acid = ' . $_params['acid'] . ' and za.name = "'. $_params['wx_name'] .'"  and zl.id>46800';
            }
            $Query = (new Query())->select('za.acid,za.name,zl.id,zl.app_id,zl.domain,zl.url,zl.params,zl.ip,zl.created_at,zl.action,zl.created_time')->from([
            'zl' => 'zdh_mg_api_logs' ])
        ->leftJoin(['za' => 'zdh_wx_accounts'],"za.acid = zl.app_id")
        ->where($Where)->offset($_params['offset'])->orderBy('zl.created_time DESC');
            
            $C_Query = clone $Query;
            $Raws['count'] = $C_Query->count();
           $Raws['data'] = $Query->all();
            /* $Raws['data'] = $Query->createCommand()->getRawSql();//c层DEBUG不需要改成1这里也能打印sql语句
            echo $Raws['data'];die; */        
            return $Raws;
        }
}