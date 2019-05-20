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
    public function index()
    {
        $this->fetch('index');
    }
    public function welcome()
    {
        echo 'sdd';
    }
}