<?php


namespace App\HttpController\WeChat;

use App\HttpController\Base;
use App\Common\Service\WeChat\Index as IndexService;
use EasySwoole\Validate\Validate;

class Index  extends Base
{
    public function index()
    {
        $request = $this->request();
        $params = $this->getParams([], ['echostr', 'nonce', 'timestamp']);
        $raw = $request->getMethod() == 'POST' ? $this->request()->getBody()->__toString() : [];
        $index = new IndexService();
        $result = $index->index($params, $raw);
        $this->response()->write($result);
    }
}