<?php


namespace App\HttpController;


use App\Common\Adapter\DAOAdapter;
use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Http\Message\Status;
use EasySwoole\Validate\Validate;

class Base extends Controller
{
    public function index()
    {

    }
    public function getParams(array $required, array $optional = [], DAOAdapter $adapter = null) :array
    {
        $param = [];
        $paramRules = $adapter ? $adapter->paramRules() : [];
        $validate = $this->getRules($required, $optional, $paramRules);
        if($this->validate($validate)) {
            $param = $validate->getVerifiedData();
        } else {
            $this->writeJson(Status::CODE_BAD_REQUEST, $validate->getError()->__toString(), 'fail');
        }
        return $param;
    }

    private function getRules(array $required, array $optional, array $paramRules)
    {
        $validate = new Validate();
        $paramNames = array_merge($required, $optional);
        foreach ($paramNames as $r) {
            $rule = $validate->addColumn($r);
            if(in_array($r, $required)) {
                $rule->required();
            }
            if(in_array($r, $optional)) {
                $rule->optional();
            }
            if (isset($paramRules[$r]) && is_array($paramRules[$r])) {
                foreach ($paramRules[$r] as $k => $v) {
                    switch ($k) {
                        case 'len':
                            $rule->lengthMax($v);
                            break;
                        case 'min':
                            $rule->min($v);
                            break;
                        case 'max':
                            $rule->max($v);
                            break;
                    }
                }
            }
        }
        return $validate;
    }

    public function inputResult($result = null, $code = Status::CODE_OK, $msg = 'success')
    {
        $this->writeJson($code, $result, $msg);
    }
}