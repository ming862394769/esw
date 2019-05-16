<?php


namespace App\HttpController\WeChat;

use EasySwoole\WeChat\WeChat;
class Factory
{
    private $_wechat = null;
    public function __construct()
    {
        $this->_wechat = new WeChat();
    }

}