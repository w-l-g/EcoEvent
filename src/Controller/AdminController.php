<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Question;
use App\Form\EventType;
use App\Form\QuestionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/events", name="adminEvents")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function showEvents(EntityManagerInterface $em)
    {
        $events = $em->getRepository('App:Event')->findAll();

        return $this->render('admin/events.html.twig', ['events' => $events, 'menu' => 'event']);
    }

    /**
     * @Route("/questions", name="adminQuestions")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function showQuestions(EntityManagerInterface $em)
    {
        $questions = $em->getRepository('App:Question')->findAll();
        return $this->render('admin/questions.html.twig', ['questions' => $questions, 'menu' => 'question']);
    }

    /**
     * @Route("/surveys", name="adminSurveys")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function showSurveys(EntityManagerInterface $em)
    {
        $surveys = $em->getRepository('App:Survey')->findAll();
        return $this->render('admin/surveys.html.twig', ['surveys' => $surveys, 'menu' => 'survey']);
    }

    /**
     * @Route("/statistiques", name="adminStats")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function adminStats(EntityManagerInterface $em)
    {
        return $this->render('admin/stats.html.twig', ['menu' => 'stat']);
    }

    /**
     * @Route("/add-question", name="adminAddQuestion")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function addQuestion(EntityManagerInterface $em, Request $request)
    {
        $question = new Question();
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $question = $form->getData();
            $em->persist($question);
            $em->flush();
            return $this->redirectToRoute('adminQuestions');

        }
        return $this->render('admin/add-question.html.twig', ['form' => $form->createView(), 'menu' => 'question']);

    }

    /**
     * @Route("/add-event", name="adminAddEvent")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     */
    public function addEvent(EntityManagerInterface $em, Request $request)
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $event = $form->getData();
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('adminEvents');

        }
        return $this->render('admin/add-event.html.twig', ['form' => $form->createView(),  'menu' => 'event']);

    }


}
