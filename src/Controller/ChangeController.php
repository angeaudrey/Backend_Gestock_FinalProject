<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChangeController extends AbstractController
{
    #[Route('/change', name: 'app_change')]
    public function index(): Response
    {
        return $this->render('change/index.html.twig', [
            'controller_name' => 'ChangeController',
        ]);
    }
}
