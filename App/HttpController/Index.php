<?php


namespace App\HttpController;


use App\Common\Service\WeChat\Index as IndexService;
use EasySwoole\Http\AbstractInterface\Controller;

class Index extends Controller
{

    function index()
    {
        $request = $this->request();
        print_r($request->getRequestParam());
        $params = $this->getParams([], ['echostr', 'nonce', 'timestamp']);
        $raw = $request->getMethod() == 'POST' ? $this->request()->getBody()->__toString() : [];
        $index = new IndexService();
        $result = $index->index($params, $raw);
        $this->response()->write($result);
    }
}