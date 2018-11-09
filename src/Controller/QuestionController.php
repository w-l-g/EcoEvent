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


    /**
     * @param $userId
     * @param EntityManagerInterface $em
     * @return JsonResponse
     * @Route("/surveys/{userId}")
     */
    public function giveSurveys($userId, EntityManagerInterface $em)
    {
        $surveys = $em->getRepository('App:Survey')->findBy([
            'user' => $userId
        ]);
        return new JsonResponse($surveys);
    }

}
