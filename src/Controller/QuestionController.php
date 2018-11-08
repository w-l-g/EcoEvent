<?php

namespace App\Controller;

use App\Entity\Response;
use App\Entity\Survey;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{


    /**
     * @Route("/begin-survey/{eventId}/{type}", name="begin-survey")
     * @param $eventId
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index($eventId, $type, EntityManagerInterface $em)
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
     * @Route("/add-response", name="begin-survey")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function handleResponse(Request $request, EntityManagerInterface $em)
    {
        $jsonResponse = $request->request->get('response');
        $arrayResponse = json_decode($jsonResponse, true);
        $response = new Response();
        $response->setQuestion($arrayResponse['response']['questionId']);
        $response->setSurvey($arrayResponse['response']['surveyId']);
        $response->setValue($arrayResponse['response']['value']);
        $em->persist($response);
        $em->flush();
        return new JsonResponse(['valid' => true]);
    }


}
