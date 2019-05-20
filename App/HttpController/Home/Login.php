<?php


namespace App\HttpController\Home;


use App\Base\BaseController;
use EasySwoole\Http\AbstractInterface\Controller;

class Login extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo 'sddsd';
    }
    public function init()
    {
        echo 'sddsss';
    }
}