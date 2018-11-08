<?php

namespace App\Controller;

use App\Entity\Survey;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SurveyController extends Controller
{

    /**
     * @Route("/begin-survey/{eventId}/{type}", name="beginSurvey")
     * @param $eventId
     * @param $type
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function beginSurvey($eventId, $type, EntityManagerInterface $em)
    {
        /** @var User $user */
        $user = $em->getRepository('App:User')->find($this->getUser()->getId());
        $survey = new Survey();
        $survey->setEvent($eventId);
        $survey->setUser($user);
        $survey->setCreatedAt(new \DateTime('now'));
        $em->persist($survey);
        $em->flush();

        $questions = $em->getRepository('App:Question')->findBy([
            'type' => $type
        ]);

        return new JsonResponse($questions);
    }

    /**
     * @Route("/surveys", name="surveys")
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function showQuestionnaires(EntityManagerInterface $em)
    {
        $surveys = $em->getRepository('App:Survey')->findBy([
            'user' => $this->getUser()->getId()
        ]);

        return new JsonResponse($surveys);
    }
}