<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\UrlHelper;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

class SitemapController extends AbstractController
{

    private $urlHelper;

    public function __construct(UrlHelper $urlHelper)
    {
        $this->urlHelper = $urlHelper;
    }

    /**
     * @Route("/sitemap", name="sitemap")
     */
    public function index(RouterInterface $router): Response
    {


        $exceptions = ['news' => 'news'];
        $routes_collection = $router->getRouteCollection()->all();
        dump($routes_collection);
        $routes = [];
        foreach ($routes_collection as $name => $route) {
            $current_route = $route->getPath();

            if ('_' !== substr($name, 0, 1) && strpos($name, 'sitemap') === false) {
                if (strpos($name, 'index')) array_push($routes, $this->urlHelper->getAbsoluteUrl($current_route));
                elseif (strpos($name, 'list')) {
                    array_push($routes, $this->urlHelper->getAbsoluteUrl($current_route));
                } else {
                    $objects = $this->getDoctrine()->getManager()
                        ->getRepository('App:' . ucfirst(explode('_', $name)[0]))
                        ->findAll();
                    foreach ($objects as $object) {
                        array_push($routes,$this->urlHelper->getAbsoluteUrl( rtrim($current_route, '{id}') . $object->getId()));
                    }
                }
            }
        }


        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml; charset=utf-8');
        return $this->render('sitemap/index.xml.twig', ['routes' => $routes],$response);

//
//        $response = new Response($this->render('sitemap/index.xml.twig', ['routes' => $routes]));
//        $response->headers->set('Content-Type', 'application/xml; charset=utf-8');
//        return $response;
    }
}
