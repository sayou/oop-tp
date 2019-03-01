<?php

class Managers{

    private $api;
    private $dao;
    private $managers = [];

    public function __construct($api, $dao){
        $this->api = $api;
        $this->dao = $dao;
    }

    public function getManagerOf($module){
        if(!is_string($module) || empty($module)){
            throw new \InvalidArgumentException('Not found !!');
        }
        if(!isset($this->managers[$module])){
            $manager = '\\Model\\'.$module.'Manager'.$this->api;
            $this->managers[$module] = new $manager($this->dap);
        }

        return $this->managers[$module];
    }
}

?>