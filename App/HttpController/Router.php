<?php


namespace App\HttpController;

use EasySwoole\Http\AbstractInterface\AbstractRouter;
use FastRoute\RouteCollector;

class Router extends AbstractRouter
{
    public function initialize(RouteCollector $routeCollector)
    {
        /*$routeCollector->addGroup('/WeChat', function (RouteCollector $routeCollector) {
            $routeCollector->get('/index', '/WeChat/index');
        });*/

    }
}