<?php


namespace App\Common\Service\WeChat;


use EasySwoole\Component\Di;
use EasySwoole\WeChat\OfficialAccount\OfficialAccount;
use EasySwoole\WeChat\Bean\OfficialAccount\AccessCheck;
use EasySwoole\WeChat\Bean\OfficialAccount\RequestConst;
use EasySwoole\WeChat\WeChat;
use EasySwoole\WeChat\Bean\OfficialAccount\RequestMsg;
use EasySwoole\WeChat\Bean\OfficialAccount\RequestedReplyMsg;

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


        $wechat->officialAccount()->server()->onMessage()->set('test',function (RequestMsg $msg){
            $reply = new RequestedReplyMsg();
            $reply->setMsgType(RequestConst::MSG_TYPE_TEXT);
            $reply->setContent('hello from server');
            return $reply;
        });

        if(isset($params['echostr']) && $params['echostr']) {
            if($this->accessCheck($params, $wechat)) {
                return is_string($params['echostr']) ? $params['echostr'] : '';
            }
        } else if(!empty($raw)) {
            $res = $wechat->officialAccount()->server()->parserRequest($raw);
            var_dump($res);
            if(is_string($res)){
                return $res;
            }

            /*$message = $wechat->officialAccount()->server()->onMessage();
            $message->set('测试', '测试成功');
            $wechat->officialAccount()->server()->preCall(function (RequestMsg $request,OfficialAccount $official){
                if($request->getMsgType() == RequestConst::MSG_TYPE_TEXT){
                    $official->server()->onMessage()->set('测试', '测试成功');
                   $msg = new  RequestedReplyMsg();
                   $msg->setCreateTime($request->getCreateTime());
                   $msg->setMsgType($request->getMsgType());
                   $msg->setContent('success');
                    return $msg;
                }
            });
            $response = $wechat->officialAccount()->server()->parserRequest($raw);*/

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
        $accessCheck->setSignature($params['signature']);
        return $wechat->officialAccount()->server()->accessCheck($accessCheck);
    }
}