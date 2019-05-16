<?php


namespace Halo\Data\Remote;

use \EasySwoole\EasySwoole\Config;
use easySwoole\Cache\Cache;
use easySwoole\Cache\Connector\Redis;
class Remote
{
    public static function init()
    {
        $CacheOptions = Config::getInstance()->getConf('cache');
        Cache::init($CacheOptions);
    }
    public function getInstance($key)
    {
        if(!Cache::get($key)) {
            $instance = Config::getInstance();
            if($key == 'redis') {
                $redisOptions = $instance->getConf('REDIS');
                $redisConnector = new Redis($redisOptions);
                Cache::init($redisConnector);
            }
            Cache::set($key, true);
        }
        return true;
    }
}