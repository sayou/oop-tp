<?php

class NewsManagerMySQLI{

    protected $mysqli; 

    public function __construct(MySQLI $mysqli){
        $this->mysqli = $mysqli;
    }

    public function add(News $news){
        $query = $this->mysqli->prepare("INSERT INTO news(auteur, titre, contenu, dateAjout, dateModif) VALUES (?, ?, ?, NOW(), NOW())");
        $query->bind_param('sss', $news->auteur, $news->titre, $news->contenu);
        return $query->execute();
    }

    public function count(){
        return $query = $this->mysqli->prepare("SELECT id FROM news")->num_rows();
    }

    public function delete($id){
        $query = $this->mysqli->prepare("DELETE FROM news WHERE id = ?");

        $query->bind_param('i',$id);

        return $query->execute();
    }

    public function getList($debut = -1, $limit = -1){
        $listNews = [];
        $query = $this->mysqli->prepare("SELECT * FROM news ORDER BY id DESC");

        if($debut !== -1 && $limit !== -1){
            $query .= "LIMIT ? OFFSET ?";
            $query->bind_param('ss',$debut, $limit);
        }

        //$query = $this->mysqli->
        while($news = $query->fetch_object('News')){
            $news->setDateAjout(new DateTime($news->dateAjout()));
            $news->setDateModif(new DateTime($news->dateModif()));
            $listNews[] = $news;
        }

        return $listNews;
    }

    public function getUnique($id){
        $query = $this->mysqli->prepare("SELECT * FROM news WHERE id = ?");

        $query->bind_param('i', $id);

        $query->execute();

        $query->bind_result($id, $auteur, $titre, $contenu, $dateAjout, $dateModif);

        $query->fetch();

        return new News([
            'id' => $id,
            'auteur' => $auteur,
            'titre' => $titre,
            'contenu' => $contenu,
            'dateAjout' => new DateTime($dateAjout),
            'dateModif' => new DateTime($dateModif)
        ]);
    }

    protected function update(News $news){
        $sql = "UPDATE news SET auteur = ?, titre = ?, contenu = ?, dateModif = ? WHERE id = ?";
        $query = $this->mysqli->prepare($sql);
        $query->bind_param('sssi', $news->auteur, $news->titre, $news->contenu, $news->dateModif);
        return $query->execute();
    }
}

?>