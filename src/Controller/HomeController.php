<?php

namespace App\Controller;

use App\Repository\VehiculeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(VehiculeRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $vehicules = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            9
        );
        return $this->render('home/index.html.twig', [
            'vehicules' => $vehicules,
        ]);
    }
}
