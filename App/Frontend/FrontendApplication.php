<?php

namespace App\Frontend;

use OCForm\Application;

class FrontendApplication extends Application{


    public function __construct(){
        parent::__construct();

        $this->name = 'frontend';
    }

    public function run(){
        $controller = $this->getController();
        $controller->execute();

        $controller->httpResponse->setPage($controller->page());
        $controller->httpResponse->send();
    }
}

?>