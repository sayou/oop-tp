<?php

namespace OCForm;

class HTTPResponse extends ApplicationComponent{
    
    public function addHeader($header){
        header($header);
    }

    public function redirect($location){
        header('Location: '.$location);
        exit();
    }

    public function redirect404(){
        $this->page = new Page($this->app);
        $this->page->setContentFile(__DIR__.'/../../Errors/404.html');
        $this->addHeader('HTTP/1.0 404 Not Found.');

        $this->send();
    }

    public function send(){
        exit($this->page->getGeneratedPage());
    }
    
    public function setCookie($name, $value = '', $expire = 0, $path = null,
        $domain = null, $secure = false, $httpOnly = true){
            setCookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
        }

    public function setPage(Page $page){
        $this->page = $page;
    }
}


?>