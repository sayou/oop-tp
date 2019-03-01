<?php

abstract class NewsManager{

    abstract public function add(News $news);
    abstract public function count();
    abstract public function delete($id);
    abstract public function getList($debut = -1, $limit = -1);
    abstract public function getUnique($id);

    public function save(News $news){
        if($news->isValid()){
            $news->isNew() ? $this->add($news) : $this->update($news);
        }else{
            throw new RuntimeException('Your news is not validated, please add the content, author, title at least');
        }
    }

    abstract protected function update(News $news);

}


?>