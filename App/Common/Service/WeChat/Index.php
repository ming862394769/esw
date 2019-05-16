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
        $wechat->officialAccount()->getConfig()
            ->setAppId('wxb7533d90d0055543')
            ->setAppSecret('cf72d03538c1713562e2b75823eac2b4')
            ->setToken('EasySwoole');
        $wechat->config()->setTempDir(EASYSWOOLE_ROOT.'/Log/');
        if(isset($params['echostr'])) {
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