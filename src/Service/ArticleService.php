<?php
namespace App\Service;
class ArticleService{
    private $articles =[];
    public function __construct()
    {
        $this->articles=[];
    }

    public function all(){
        return $this->articles;
    }

    public function find($id){
        foreach($this->articles as $article){
            if($article['id']==$id){
                return $article;
            }
        }
    }
}