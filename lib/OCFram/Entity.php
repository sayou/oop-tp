<?php

namespace OCFram;

abstract class Entity implements \ArrayAccess{

    protected $erreurs = [],
                $id;

    public function __construct(array $donnes = []){
        if(!empty($donnes)){
            $this->hydrate($donnes);
        }
    }

    public function isNew(){return empty($this->id);}
    public function erreurs(){return $this->erreurs;}
    public function id(){return $this->id;}
    
    public function setId($id){$this->id = (int)$id;}
    public function hydrate(array $donnes){
        foreach($donnes as $attribut => $valeur){
            $methode = 'set'.ucfirst($attribut);
            if(is_callable([$this, $methode])){
                $this->$methode($valeur);
            }
        }
    }
    public function offsetGet($var){
        if(isset($this->$var) && \is_callable([$this, $var])){
            return $this->$var();
        }
    }
    public function offsetSet($var, $value){
        $method = 'set'.ucfirst($var);

        if(isset($this->$var) && is_callable([$this, $method])){
            $this->$method($value);
        }
    }
    public function offsetExists($var){
        return isset($this->$var) && is_callable([$this, $var]);
    }
    public function offsetUnset($var){
        throw new \Exception('Sorry, you can\'t delete the value');
    }
}

?>