<?php


namespace App\HttpController\WeChat;

use App\HttpController\Base;
use App\Common\Service\WeChat\Index as IndexService;

class Index  extends Base
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
}