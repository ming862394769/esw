<?php


namespace App\Common\Service\WeChat;


use EasySwoole\Component\Di;
use EasySwoole\Spl\SplArray;
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
        $wechat->officialAccount()->server()->preCall(function (RequestMsg $msg){
            switch ($msg->getMsgType()) {
                case RequestConst::MSG_TYPE_TEXT:
                    $reply = Message::text($msg);
                    break;
                case RequestConst::MSG_TYPE_EVENT:
                    $reply = Message::event($msg);
                    break;
                case RequestConst::MSG_TYPE_IMAGE:
                    break;
                case RequestConst::MSG_TYPE_VOICE:
                    break;
                case RequestConst::MSG_TYPE_VIDEO:
                    break;
                case RequestConst::MSG_TYPE_SHORT_VIDEO:
                    break;
                case RequestConst::MSG_TYPE_LOCATION:
                    break;
                case RequestConst::MSG_TYPE_LINK:
                    break;
                default:
                    $reply = new RequestedReplyMsg();
                    $reply->setMsgType(RequestConst::MSG_TYPE_TEXT);
                    $reply->setContent('生活愉快！');
            }
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
    public function menu()
    {
        $wechat = new WeChat();
        $wechat->officialAccount()->getConfig()
            ->setAppId('wxb7533d90d0055543')
            ->setAppSecret('cf72d03538c1713562e2b75823eac2b4')
            ->setToken('EasySwoole');
        $buttons = [
            [
                "type" => "click",
                "name" => "今日歌曲",
                "key"  => "V1001_TODAY_MUSIC"
            ],
            [
                "name"       => "菜单",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "搜索",
                        "url"  => "http://www.soso.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "视频",
                        "url"  => "http://v.qq.com/"
                    ],
                    [
                        "type" => "click",
                        "name" => "赞一下我们",
                        "key" => "V1001_GOOD"
                    ],
                ],
            ],
        ];

        $matchRule = [
            "tag_id" => "2",
            "sex" => "1",
            "country" => "中国",
            "province" => "广东",
            "city" => "广州",
            "client_platform_type" => "2",
            "language" => "zh_CN"
        ];

        // create menu
        //$wechat->officialAccount()->menu()->create($buttons);
        // create conditional menu
        $menuId = $wechat->officialAccount()->menu()->create($buttons, $matchRule);
    }
}