<?php

namespace App\Controller\Twitter;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TwitterController extends AbstractController
{
    private $client;
    private $bearer;
    private $screenName;
    private $count;


    public function __construct(HttpClientInterface $client, ContainerInterface $container)
    {
        $this->client = $client;

        $this->screenName = $container->getParameter('screen_name');
        $this->count = $container->getParameter('count');
        $this->bearer = $container->getParameter('bearer');

    }

    /**
     * @Route("/twitter/twitter", name="twitter_twitter")
     */
    public function index(): Response
    {
        return $this->render('twitter/twitter/index.html.twig', [
            'controller_name' => 'TwitterController',
        ]);
    }

    public function getLatestTweets()
    {
        $response = $this->client->request(
            'GET',
            'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=' . $this->screenName . '&count=' . $this->count,
            ['headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->bearer
            ]]
        );

        $content = $response->getContent();
        $tweets = $this->twitterFilter($content);

        return $this->render('_partials/home/latest_tweets.html.twig', ['tweets'=>$tweets]);
    }

    public function twitterFilter($content)
    {   $tweets = [];
        $raw_tweets = json_decode($content);
        foreach ($raw_tweets as $raw_tweet){
            $tweet['date'] = date('d/m/y', strtotime($raw_tweet->created_at));
            $tweet['text'] = $raw_tweet->text;
            $tweet['hashtags'] = [];
            foreach ($raw_tweet->entities->hashtags as $tag):
                array_push($tweet['hashtags'], $tag->text);
                endforeach;
            array_push($tweets, $tweet);

        }
        return $tweets;
    }
}
