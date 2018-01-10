<?php
/**
 * Http 验证及设置操作类
 * @description Restful认证
 * @access public
 * @author www.zdhzdl.com 2015/11/17 <service@zdhzdl.com> 
 * @package common\libs\auth
 * @license http://www.zdhzdl.com/license.html
 * @since void
 * @version v1.0
 * @copyright (c) 2015-2020, www.zdhzdl.com
 */

namespace common\components\auth;

class HttpAuth {

    private $user, $password, $auth_type, $realm = 'cngrows.com123456';

    /**
     * 构造方法,设置认证类型
     * @param string $_auth_type 认证类型Basic|Digest
     */
    public function __construct($_auth_type = 'Basic') {
        if (!in_array($_auth_type, array('Basic', 'Digest'))) {
            $_auth_type = 'Basic';
        }
        $this->auth_type = trim($_auth_type);
    }

    /**
     * 更改认证方式
     * @param string $_auth_type 认证类型Basic|Digest
     */
    public function setAuthType($_auth_type = 'Basic') {
        if (!in_array($_auth_type, array('Basic', 'Digest'))) {
            $_auth_type = 'Basic';
        }
        $this->auth_type = trim($_auth_type);
    }

    /**
     * 设置验证账号和密码
     * @author Kelvin.H 2016/01/15
     * @access public
     * @param string $_user 账号
     * @param string $_password 密码
     */
    public function setAuthParams($_params = []) {
        isset($_params['user']) && $this->user = trim($_params['user']);
        isset($_params['password']) && $this->password = trim($_params['password']);
    }

    /**
     * 获取认证信息
     * @param string $uri 路由地址
     */
    public function setAuth($_method = 'GET', $_url = '') {
        if ($this->auth_type = 'Basic') {
            return array(
                'Authorization' => 'Basic ' . base64_encode($this->user . ':' . $this->password)
            );
        } else {
            $Uri = $this->_getUri($_url);
            $HA1 = md5($_user . ':' . $this->realm . ':' . $this->password);
            $HA2 = md5($_method . ':' . $Uri);
            $Nonce = tepRandom('alnum', 32);
            $CNonce = tepRandom('alnum', 16);
            $NC = '00000001';
            return array(
                'Authorization' => 'Digest '
                . 'username="' . $_user . '",'
                . 'realm="' . $this->realm . '",'
                . 'nonce="' . $Nonce . '",'
                . 'uri="' . $Uri . '",'
                . 'qop=auth,'
                . 'nc = $NC,' //请求1次
                . 'cnonce = "' . $CNonce . '",'
                . 'response = "' . md5($HA1 . ':' . $Nonce . ':' . $NC . ':' . $CNonce . ':auth:' . $HA2) . '"'
            );
        }
    }

    /**
     * 检测认证
     * @param type $_params
     */
    public function checkAuth($_params = []) {
        if ($this->auth_type = 'Basic') {
            //判断参数是否存在
            if (!isset($_params['user']) || !isset($_params['password'])) {
                header('WWW-Authenticate: Basic realm="My Realm"');
                header('HTTP/1.0 401 Unauthorized');
                echo 'Text to send if user hits Cancel button';
                exit;
            }
            $this->_checkBasic($_params['user'], $_params['password']);
        } else {
            $this->_checkDigest();
        }
    }

    /**
     * Http Basic认证验证
     */
    private function _checkBasic($_user = '', $_pass = '') {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Text to send if user hits Cancel button';
            exit;
        } else {
            if ($_SERVER['PHP_AUTH_USER'] != $_user || $_SERVER['PHP_AUTH_PW'] != $_pass) {
                header('WWW-Authenticate: Basic realm="My Realm"');
                header('HTTP/1.0 401 Unauthorized');
                echo 'Text to send if user hits Cancel button';
                exit;
            }
        }
    }

    /**
     * Http Digest认证验证
     */
    private function _checkDigest() {
        
    }

    /**
     * 获取uri
     * @author Kelvin.H 2016/01/15
     * @access private
     * @param string $url 一个带有http的地址
     * @return string 返回一个uri
     */
    private function _getUri($url = '') {
        $Uri = '/';
        $Url = trim($url);
        if (empty($Url) || $Url == '/')
            return $Uri;

        if (strstr($Url, '//')) {
            $Arr = explode('//', $Url);
            $Url = trim($Arr[1]);
            if (empty($Url) || $Url == '/')
                return $Uri;
        }

        $Arr = explode('/', $Url);
        for ($i = 1; $i < count($Arr); $i++) {
            $Uri .= $Arr[$i] . '/';
        }
        $Uri = substr($Uri, 0, -1);
        return $Uri;
    }

}

?> 