<?php

namespace App\Controller\News;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Team;
use App\Entity\Role;
use Symfony\Component\Routing\Annotation\Route;

//use App\Form\EquipeType;

class NewsController extends AbstractController
{

    protected $repo;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repo = $entityManager->getRepository('App:News');
    }


    /**
     * @Route("/news", name="news_list")
     */
    public function allNews()
    {

        $news = $this->repo->findAllNews();

        return $this->render('News/news.html.twig', ['news' => $news]);
    }

    /**
     * @Route("/news/{id}", name="news_card")
     */
    public function oneNews($id = null)
    {
        $news = $this->repo->findNews($id);

        return $this->render('news/card.html.twig', ['news' => $news]);
    }

    /*
     * Rendered controllers in template
     */
    public function showNewsFront($limit = null){
        return $this->render('News/last-x-news.html.twig', ['news_list'=>$this->repo->findLastNews($limit)]);
    }
}
