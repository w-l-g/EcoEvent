<?php

namespace App\Controller;

use App\Exception\EmailAlreadyExistException;
use App\Service\UserPersister;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ApiController
 * @package App\Controller
 * @Route("/api")
 */
class ApiController extends Controller
{
    /**
     * @Route("/register", name="register")
     * @param Request $request
     * @param LoggerInterface $logger
     * @param UserPersister $persister
     * @return \App\Security\UserType|JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function register(Request $request, LoggerInterface $logger, UserPersister $persister)
    {
        // Angular doit savoir si l'utilisateur est authentifié ou non
        $content = $request->getContent();
        $data = json_decode($content, true);


        try {
          $persister->persistUser($data);
        } catch (\Exception $exception){

            if ($exception instanceof  EmailAlreadyExistException){
                return new JsonResponse([
                    'valid' =>  false,
                    'error' => $exception->getMessage()
                ]);
            }

            $logger->error($exception->getMessage(), $exception->getTrace());
            return new JsonResponse(['valid' => false, 'error' => 'unknow error, log added']);
        }


        return new JsonResponse([
            'valid' => true
        ]);
    }

    /**
     * @Route("/redirectUser", name="redirectUser")
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectUser(EntityManagerInterface $em)
    {
        //!\\ TODO :  Pour se logger la requete doit contenir en json  {"username" : "ze", "password" : "mm"},
            // TODO : ou alors on change dans la config avec "password_path: email", pas testé à voir

        // Check : si le usr a des surveys -> listes des surveys Sinon -> liste des questions disponibles

        $surveys = $em->getRepository('App:Survey')->findBy([
            'user' => $this->getUser()->getId()
        ]);

        // todo : redirect to choiceevents

        if (count($surveys) == 0){
            return $this->redirectToRoute('beginSurvey');
        } else {
            return $this->redirectToRoute('surveys');
        }

    }
}