<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FacebookEvent;


class EventController extends AbstractController
{
    /**
     * @Route("/
     */

    /**
     * @Route("/events", name="event")
     */
    public function list(FacebookEvent $fbEvent)
    {
        return $this->render('event/index.html.twig');
    }
}
