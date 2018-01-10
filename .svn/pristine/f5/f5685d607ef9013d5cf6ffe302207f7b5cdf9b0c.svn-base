<?php
/**
 * Restful Api操作类
 * @description 用于数据及文件的CURD操作
 * @access public
 * @author www.zdhzdl.com 2015/11/17 <service@zdhzdl.com> 
 * @package common\libs\auth
 * @license http://www.zdhzdl.com/license.html
 * @since void
 * @version v1.0
 * @copyright (c) 2015-2020, www.zdhzdl.com
 */

namespace common\libs\auth;

use common\libs\auth\HttpAuth;

class Api {

    private $time_out = 10;
    private $conn_time_out = 120;
    private $header = null;
    private $http_auth_obj = null;

    /**
     * 构造方法
     * @author Kelvin.H 2016/01/15
     * @param string $_auth_type Basic|Digest
     */
    public function __construct() {
        $this->header = array(
            //"Content-Type" => "application/x-www-form-urlencoded",
            "content-encoding" => 'gzip',
                //'Accept' => 'application/json',
        );
    }

    /**
     * 发起连接前等待时间
     * @author Kelvin.H 2016/01/15
     * @access public
     * @param int $_time_out 毫秒
     */
    public function setConnTimeOut($_time_out = 120) {
        $this->conn_time_out = (int) $_time_out;
    }

    /**
     * 超时设置
     * @author Kelvin.H 2016/01/15
     * @access public
     * @param int 秒
     * @return void
     */
    public function setTimeOut($_time_out = 10) {
        $this->time_out = (int) $_time_out;
    }

    /**
     * 当用到Degist认证的时候设置认证,需要识别get/post方法
     * @param array $_params 
     * [
     *      user //账号
     *      password //密码
     * ]
     */
    public function setAuthParams($_params = array()) {
        $Params = array();
        isset($_params['user']) && $Params['user'] = trim($_params['user']);
        isset($_params['password']) && $Params['password'] = trim($_params['password']);
        
        $AuthType = 'Basic';
        isset($_params['auth_type']) && $AuthType = trim($_params['auth_type']);
        
        $this->http_auth_obj = new HttpAuth($AuthType);
        $this->http_auth_obj->setAuthParams($Params);
    }

    /**
     * curl get 方法
     * @author Kelvin.H 2016/01/15
     * @access public
     * @param type $_url
     * @return array code :1|0 成功或失败 content:响应的内容
     */
    public function get($_url = '') {
        $Result = '';
        is_object($this->http_auth_obj) && $this->_setHeader($this->http_auth_obj->setAuth('GET', $_url));

        //初始化
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, FALSE); //不启用强制新连接
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->time_out);
        curl_setopt($ch, CURLOPT_URL, trim($_url));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_NOSIGNAL, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->_getHeaderParam());
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->conn_time_out); //连接前等待时间120毫秒
        //curl_setopt($ch, CURLOPT_REFERER, "http://www.idcicp.com");
        //执行并获取HTML文档内容
        $JsonCon = curl_exec($ch);
        if ($JsonCon === false)
            $JsonCon = '';
        $HttpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        //释放curl句柄
        curl_close($ch);
        if ($HttpCode == 200) {
            $Result = $this->_decode($JsonCon);
        }
        return $Result;
    }

    /**
     * curl post 方法
     * @author Kelvin.H 2016/01/15
     * @access public
     * @param string $_url 请求的地址
     * @param array $_params 传递的参数
     * @return array code :1|0 成功或失败 content:响应的内容
     */
    public function post($_url = '', $_params = array()) {
        $Result = '';
        is_object($this->http_auth_obj) && $this->_setHeader($this->http_auth_obj->setAuth('POST', $_url));

        //初始化
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, FALSE); //不启用强制新连接
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->time_out);
        curl_setopt($ch, CURLOPT_URL, trim($_url));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_NOSIGNAL, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->_getHeaderParam());
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->conn_time_out); //连接前等待时间120毫秒    
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $_params);
        //执行并获取HTML文档内容
        $JsonCon = curl_exec($ch);
        if ($JsonCon === false)
            $JsonCon = '';
        $HttpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        //释放curl句柄
        curl_close($ch);
        if ($HttpCode == 200) {
            $Result = $this->_decode($JsonCon);
        }
        return $Result;
    }

    /**
     * curl put 方法
     * @author Kelvin.H 2016/01/15
     * @access public
     * @param string $_url 请求的地址
     * @param array $_params 传递的参数
     * @return array code :1|0 成功或失败 content:响应的内容
     */
    public function put($_url = '', $_params = array()) {
        
    }

    public function delete($_url = '', $_params = array()) {
        
    }

    /**
     * 设置头部信息
     * @author Kelvin.H 2016/01/15
     * @access private
     * @param array 头部验证信息及请求方式
     */
    private function _setHeader($_header_arr = array()) {
        if ($_header_arr && is_array($_header_arr)) {
            if (!$this->header)
                $this->header = $_header_arr;
            else
                $this->header = array_merge($this->header, $_header_arr);
        }
    }

    /**
     * 组织curl header 信息
     * @author Kelvin.H 2016/01/15
     * @access private
     * @return array|boolean
     */
    private function _getHeaderParam() {
        $Header = false;
        foreach ($this->header as $Key => $Value) {
            $Header[] = $Key . ':' . $Value;
        }
        return $Header;
    }

    /**
     * 解析json并返回
     * @param string $_contents json值
     * @return array
     */
    private function _decode($_contents = '') {
        return json_decode($_contents, TRUE);
    }

}

?> 