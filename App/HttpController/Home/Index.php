<?php


namespace App\HttpController\Home;


use App\Base\BaseController;
use App\Utility\Pool\RedisPool;
use App\Utility\Pool\RedisObject;
use EasySwoole\Component\Pool\PoolManager;
use EasySwoole\Http\Message\Status;
use easySwoole\Cache\Cache;

class Index extends BaseController
{
    function onRequest(?string $action): ?bool
    {
        if (parent::onRequest($action)) {
            //判断是否登录
            $redis = RedisPool::defer();
            if ($redis->get('isLogin')) {
                $this->response()->redirect("/home/login");
                //$this->writeJson(Status::CODE_UNAUTHORIZED, '', '登入已过期');
                return false;
            }
            return true;
        }
        return false;
    }
    public function index()
    {
        $this->fetch('index');
    }
}