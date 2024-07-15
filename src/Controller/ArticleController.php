<?php

namespace App\Controller;

use App\Entity\Article;
use App\Service\ArticleService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\EventDispatcher\Event;
use Twig\Environment;

class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'liste_article')]
    #[Route('/article')]
    public function index(Environment $twig,ArticleService $articleService,ManagerRegistry $doctrine ): Response
    {
        $article=$doctrine->getRepository(Article::class)->findAll();
        dump($article);
        return $this->render('article/index.html.twig',[
            'articles'=>$article,
        ]);
    }
    
    #[Route('/articles/{id}', name: 'show_article',requirements:['id'=>'\d+'])]
    public function show(ArticleService $articleService,ManagerRegistry $doctrine,Article $article): Response
    {
       dump($article);
        return $this->render('article/show.html.twig',[
            'article'=>$article,
        ]);
    }

    #[Route('/articles/creer',name :'article_creer')]
    public function create(ManagerRegistry $doctrine):Response{
        $em=$doctrine->getManager();
        $article = new Article();
        $article->setTitle('title');
        $article->setContent('content');
        $article->setCreatedAt(new \DateTime('2024-07-14'));
        $em->persist($article);
        $em->flush();
        return $this->redirectToRoute('liste_article');
    }

}
