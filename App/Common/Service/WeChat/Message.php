<?php


namespace App\Common\Service\WeChat;


use EasySwoole\WeChat\Bean\OfficialAccount\RequestConst;
use EasySwoole\WeChat\Bean\OfficialAccount\RequestedReplyMsg;
use EasySwoole\WeChat\Bean\OfficialAccount\RequestMsg;

class Message
{
    public static function event(RequestMsg $msg)
    {
        $reply = new RequestedReplyMsg();
        if($msg->getEvent() == 'subscribe') { //订阅
            $reply->setMsgType(RequestConst::MSG_TYPE_TEXT);
            $reply->setContent('欢迎关注本测试订阅号');
        } else if($msg->getEvent() == 'unsubscribe') { //取消订阅
            $reply->setMsgType(RequestConst::MSG_TYPE_TEXT);
            $reply->setContent('哈哈哈');
        }
        return $reply;
    }
    public static function text(RequestMsg $msg)
    {
        $reply = new RequestedReplyMsg();
        $reply->setMsgType(RequestConst::MSG_TYPE_TEXT);
        $reply->setContent('hello from server');
        return $reply;
    }
    public static function image()
    {

    }
    public static function voice()
    {

    }
    public static function video()
    {

    }
    public static function shortVideo()
    {

    }
    public static function location()
    {

    }
    public static function link()
    {

    }
}