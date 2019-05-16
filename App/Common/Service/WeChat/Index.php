<?php


namespace App\Common\Service\WeChat;


use EasySwoole\Component\Di;
use EasySwoole\WeChat\Bean\OfficialAccount\AccessCheck;
use EasySwoole\WeChat\WeChat;

class Index
{
    private $client;
    public function __construct()
    {

    }

    public function index($params, $raw) :string
    {
        $wechat = new WeChat();
        if(is_array($params['echostr'])) {
            if($this->accessCheck($params, $wechat)) {
                return is_string($params['echostr']) ? $params['echostr'] : '';
            }
        } else if(!empty($raw)) {
            $message = $wechat->officialAccount()->server()->onMessage();
            $message->set('测试', '测试成功');
            return $wechat->officialAccount()->server()->parserRequest($raw);
        }
        return 'ss';
    }

    /**
     * 接入验证
     * @param $params
     * @return bool
     */
    public function accessCheck($params,WeChat $wechat)
    {

        $accessCheck = new AccessCheck();
        $accessCheck->setEchostr($params['echostr']);
        $accessCheck->setNonce($params['nonce']);
        $accessCheck->setTimestamp($params['timestamp']);
        return $wechat->officialAccount()->server()->accessCheck($accessCheck);
    }
}