<?php


namespace App\HttpController\WeChat;

use App\Base\BaseController;
use App\Common\Service\WeChat\Index as IndexService;

class Index  extends BaseController
{
    public function index()
    {
        $request = $this->request();
        $params = $request->getRequestParam();
        $raw = $request->getMethod() == 'POST' ? $this->request()->getBody()->__toString() : [];
        print_r($raw);
        $index = new IndexService();
        $result = $index->index($params, $raw);
        $this->response()->write($result);
    }
    public function menu()
    {
        $index = new IndexService();
        $index->menu();
    }
}