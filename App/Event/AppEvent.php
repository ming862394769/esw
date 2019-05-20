<?php


namespace App\Event;


use EasySwoole\EasySwoole\Config;
use EasySwoole\Component\Singleton;
use EasySwoole\Utility\File;
use Think\Db;

class AppEvent
{
    use Singleton;
    public static function frameInitialize(): void
    {
        // 载入项目 Conf 文件夹中所有的配置文件
        self::loadConf(EASYSWOOLE_ROOT . '/Config');
        self::loadConf(EASYSWOOLE_ROOT . '/App/Config');
        self::loadDB();
        include_once EASYSWOOLE_ROOT . "/App/Base/function.php";//通用函数库
        define('HTTP_ROOT', Config::getInstance()->getConf('web.WEB_URL'));
    }

    public static function loadDB()
    {
        // 获得数据库配置
        $dbConf = Config::getInstance()->getConf('database');
        // 全局初始化
        $db = new Db();
        $db->setConfig($dbConf);
    }
    public static function loadConf($ConfPath)
    {
        $Conf  = Config::getInstance();
        $files = File::scanDirectory($ConfPath);
        if (!is_array($files)) {
            return;
        }
        foreach ($files as $file) {
            $data = require_once $file;
            $Conf->setConf(strtolower(basename($file, '.php')), (array)$data);
        }
    }
}