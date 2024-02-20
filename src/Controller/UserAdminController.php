<?php

namespace App\Controller;

use App\Form\AdminType;
use App\Entity\UserAdmin;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserAdminController extends AbstractController
{
    #[Security("is_granted('ROLE_ADMIN') and user === choosenUser")]
    #[Route('/utilisateur/edition/{id}', name: 'app_user_admin', methods: ['GET', 'POST'])]
    public function edit(
        UserAdmin $choosenUser,
        Request $request,
        EntityManagerInterface $manager,
        UserPasswordHasherInterface $hasher
    ): Response {
        $form = $this->createForm(AdminType::class, $choosenUser);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($hasher->isPasswordValid($choosenUser, $form->getData()->getPlainPassword())) {
                $user = $form->getData();
                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success',
                    'Les informations de votre compte ont bien été modifiées.'
                );

                return $this->redirectToRoute('app_admin');
            } else {
                $this->addFlash(
                    'warning',
                    'Le mot de passe renseigné est incorrect.'
                );
            }
        }

        return $this->render('/user_admin/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
