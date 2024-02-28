<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MentionController extends AbstractController
{
    /**
     * Ce controller affiche la page mention légales 
     *
     * @return Response
     */
    
    #[Route('/mention', name: 'app_mention')]
    public function index(): Response
    {
        return $this->render('mention/index.html.twig', [
            'controller_name' => 'MentionController',
        ]);
    }
}
