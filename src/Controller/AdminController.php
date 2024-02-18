<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Form\VehiculeType;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * this controller display all ingredient
     *
     * @param IngredientRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */

    #[Route('/admin', name: 'app_admin', methods: ['GET'])]
    public function index(VehiculeRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $vehicules = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            6
        );
        return $this->render('admin/index.html.twig', [
            'vehicules' => $vehicules,
        ]);
    }

    /**
     * This controller show a form which create an ingredient
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */

    #[Route('/admin/creation', 'vehicule.new')]
    public function new(
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $vehicule = new Vehicule();
        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $vehicule = $form->getData();
            $manager->persist($vehicule);
            $manager->flush();
            $this->addFlash(
                'success',
                'Votre vehicule a été créé avec succès !'
            );
            return $this->redirectToRoute('app_admin');
        }
        return $this->render('admin/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * This controller allow us to edit an ingredient
     *
     * @param Ingredient $ingredient
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */

    #[Route('/admin/edition/{id}', 'vehicule.edit', methods: ['GET', 'POST'])]
    public function edit(
        Vehicule $vehicule,
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vehicule = $form->getData();

            $manager->persist($vehicule);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre vehicule a été modifié avec succès !'
            );

            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * This controller allows us to delete an ingredient
     *
     * @param EntityManagerInterface $manager
     * @param Ingredient $ingredient
     * @return Response
     */

    #[Route('/admin/suppression/{id}', 'vehicule.delete', methods: ['GET'])]
    public function delete(
        EntityManagerInterface $manager,
        Vehicule $vehicule
    ): Response {
        $manager->remove($vehicule);
        $manager->flush();

        $this->addFlash(
            'success',
            'Votre vehicule a été supprimé avec succès !'
        );

        return $this->redirectToRoute('app_admin');
    }
}
