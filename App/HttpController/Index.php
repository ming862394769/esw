<?php


namespace App\HttpController;


use EasySwoole\Http\AbstractInterface\Controller;

class Index extends Controller
{

    function index()
    {
        var_dump($this->request()->getRequestParam());
        // TODO: Implement index() method.
        $this->response()->write('hello world');
    }
}