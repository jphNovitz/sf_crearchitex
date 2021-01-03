<?php

namespace App\Controller\Twitter;

use App\Model\TwitterGetterInterface;
use App\Model\TwitterPresenterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TwitterController
 *
 * get the last x tweets (formated) and send it to the template
 *
 * @author novitz Jean-Philiipe <novitz@gmail.com>
 * @package App\Controller\Twitter
 */
class TwitterController extends AbstractController
{
    private $content;

    public function __construct(TwitterGetterInterface $twitterGetter)
    {

        $this->content = $twitterGetter->getDatas();

    }

    public function getLatestTweets(TwitterPresenterInterface $presenter)
    {
            return $this->render('_partials/home/latest_tweets.html.twig', [
                'tweets' => $presenter->prepareDatas($this->content)
            ]);
    }

}
