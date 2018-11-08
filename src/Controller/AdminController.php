<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin-dashboard", name="admin")
     */
    public function dashboard()
    {
        return $this->render('admin/index.html.twig', [

        ]);
    }
}
