<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class AdminController
 * @package App\Controller
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/login", name="adminLogin")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser() !== null){
            return $this->redirectToRoute('adminDashboard');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        return $this->render('login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }



    /**
     * @Route("/dashboard", name="adminDashboard")
     *
     */
    public function dashboard()
    {
        return $this->render('admin/index.html.twig', [

        ]);
    }

    /**
     * @Route("/events", name="adminEvents")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function showEvents(EntityManagerInterface $em)
    {
        $events = $em->getRepository('App:Event')->findAll();

        return $this->render('admin/events.html.twig', ['events' => $events]);
    }

    /**
     * @Route("/questions", name="adminQuestions")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function showQuestions(EntityManagerInterface $em)
    {
        $questions = $em->getRepository('App:Question')->findAll();
        return $this->render('admin/questions.html.twig', ['questions' => $questions]);
    }

    /**
     * @Route("/statistiques", name="adminStats")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function adminStats(EntityManagerInterface $em)
    {
        return $this->render('admin/stats.html.twig');
    }
}
