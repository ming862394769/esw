<?php


namespace App\HttpController\Home;


use EasySwoole\Http\AbstractInterface\Controller;

class Login extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    public function index()
    {

    }
    public function init()
    {
        echo 'sddsss';
    }
}