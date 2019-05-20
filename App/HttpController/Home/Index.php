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
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        var_dump($this->response());
    }
    public function welcome()
    {
        echo 'sdd';
    }
}