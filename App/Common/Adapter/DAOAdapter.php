<?php


namespace App\Common\Adapter;


abstract class DAOAdapter
{
    /**
     * @return string
     */
    abstract public function table();

    public function paramRules()
    {
        $paramRules = [
            'name' => ['len' => '64']
        ];
        return [];
    }
}