<?php 

class NewsManagerPDO extends NewsManager{

    protected $pdo;

    public function __construct(PDO $pdo){$this->pdo = $pdo;}

    public function add(News $news){
        $query = $this->pdo->prepare('INSERT INTO news(auteur, titre, contenu, dateAjout, dateModif)
                                        VALUES (:auteur, :titre, :contenu, NOW(), NOW())');
        
        $query->bindValue(':titre', $news->titre(), PDO::PARAM_STR);
        $query->bindValue(':auteur', $news->auteur(), PDO::PARAM_STR);
        $query->bindValue(':contenu', $news->contenu(), PDO::PARAM_STR);

        var_dump("saad");
        return $query->execute();
    }

    public function count(){
        return $this->pdo->query('SELECT COUNT(*) FROM news')->fetchColumn();
    }

    public function delete($id){
        $query = $this->pdo->prepare('DELETE FROM news WHERE id = :id');
        $query->bindValue(':id',$id);

        return $query->execute();
    }

    public function getList($debut = -1, $limit = -1){
        $sql = 'SELECT * FROM news ORDER BY id DESC';

        if($debut !== -1 && $limit !== -1){
            $sql .= ' LIMIT :limit OFFSET :offset';
        }
        $query = $this->pdo->prepare($sql); 
        $query->bindValue(':offset',$debut, PDO::PARAM_INT);
        $query->bindValue(':limit', $limit, PDO::PARAM_INT);

        $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'News');
        $query->execute();
        $listNews = $query->fetchAll();

        foreach($listNews as $news){
            $news->setDateAjout(new \DateTime($news->dateAjout()));
            $news->setDateModif(new \DateTime($news->dateModif()));
        }

        $query->closeCursor();

        return $listNews;
    }

    public function getUnique($id){

        $query = $this->pdo->prepare('SELECT * FROM news WHERE id = :id');
        $query->bindValue(':id',$id, PDO::PARAM_INT);

        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'News');
        $news = $query->fetch();

        $news->setDateAjout(new DateTime($news->dateAjout()));
        $news->setDateModif(new DateTime($news->dateModif()));

        return $news;
        
    }

    protected function update(News $news){
        $query = $this->pdo->prepare('UPDATE news
                        SET auteur = :auteur,
                        titre = :titre,
                        contenu = :contenu,
                        dateModif = NOW()
                        WHERE id = :id');

        $query->bindValue(':auteur', $news->auteur(), PDO::PARAM_STR);
        $query->bindValue(':titre', $news->titre(), PDO::PARAM_STR);
        $query->bindValue(':contenu', $news->contenu(), PDO::PARAM_STR);
        //$query->bindValue(':datemodif', $news->dateModif(), PDO::PARAM_STR);
        $query->bindValue(':id', $news->id(), PDO::PARAM_INT);

        return $query->execute();

    }
}

?>