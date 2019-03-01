<?php

namespace OCFram;

abstract class BackController extends ApplicationComponent{

    protected $action = '';
    protected $module = '';
    protected $page = null;
    protected $view = '';
    protected $managers = null;

    public function __construct(Application $app, $module, $action){
        parent::__construct($app);

        $this->managers = new Managers('PDO', PDOFactory::getMysqlConnexion());
        $this->page = new Page($app);

        $this->setModule($module);
        $this->setAction($action);
        $this->setView($action);
    }

    public function execute(){
        $method = 'execute'.ucfirs($this->action);

        if(!is_callable([$this, $method])){
            throw new \RuntimeException("No action named '$this->action' found !!");
        }

        $this->$method($this->app->httpRequest());
    }

    public function page(){
        return $this->page;
    }

    public function setModule($module){
        if(!is_string($module) || empty($module)){
            throw new \InvalidArgumentException('Ooops please add a correct module');
        }

        $this->module = $module;
    }

    public function setAction($action){
        if(!is_string($module) || empty($module)){
            throw new \InvalidArgumentException('Ooops please add a valid actopn');
        }
        $this->action = $action;
    }

    public function setView($view){
        if(!is_string($view) || empty($view)){
            throw new \InvalidArgumentException('Ooops please add a valid view');
        }
        $this->view = $view;
        $this->page->setContentFile(__DIR__.'/../../App/'.$this->app->name().'/Modules/'.$this->module.'/views/'.$this->view.'.php');
    }
}