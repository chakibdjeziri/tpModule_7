<?php

namespace App\Controller;

use App\Form\AdminType;
use App\Entity\UserAdmin;
use App\Form\AdminPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserAdminController extends AbstractController
{
    /**
     * Ce contrôleur nous permet de modifier le profil de l'administrateur connecter
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param UserAdmin $user
     * @param UserPasswordHasherInterface $hasher
     * @return Response
     */

    #[Route('/utilisateur/edition/{id}', name: 'user.edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        EntityManagerInterface $manager,
        UserAdmin $user,
        UserPasswordHasherInterface $hasher
    ): Response {
        if (!$this->getUser()) {
            return $this->redirectToRoute('security.login');
        }
        if (!$this->getUser() === $user) {
            return $this->redirectToRoute('app_home');
        }

        $form = $this->createForm(AdminType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($hasher->isPasswordValid($user, $form->getData()->getPlainPassword())) {
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

    /**
     * Ce contrôleur nous permet de modifier le mot de passe de l'adminitrateur connecter
     *
     * @param UserAdmin $user
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param UserPasswordHasherInterface $hasher
     * @return Response
     */

    #[Route('/utilisateur/edition-mot-de-passe/{id}', 'user.edit.password', methods: ['GET', 'POST'])]
    public function editPassword(
        UserAdmin $user,
        Request $request,
        EntityManagerInterface $manager,
        UserPasswordHasherInterface $hasher
    ): Response {
        $form = $this->createForm(AdminPasswordType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($hasher->isPasswordValid($user, $form->getData()['plainPassword'])) {
                $user->setDateCreation(new \DateTimeImmutable());
                $user->setPlainPassword(
                    $form->getData()['newPassword']
                );

                $this->addFlash(
                    'success',
                    'Le mot de passe a été modifié.'
                );

                $manager->persist($user);
                $manager->flush();

                return $this->redirectToRoute('app_admin');
            } else {
                $this->addFlash(
                    'warning',
                    'Le mot de passe renseigné est incorrect.'
                );
            }
        }

        return $this->render('/user_admin/edit_password.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Ce contrôleur nous permet de supprimer le compte de l'administrateur connecter
     *
     * @param EntityManagerInterface $manager
     * @param UserAdmin $user
     * @return Response
     */

    #[Route('/utilisateur/suppression/{id}', 'user.delete', methods: ['GET'])]
    public function delete(
        EntityManagerInterface $manager,
        UserAdmin $user
    ): Response {
        $manager->remove($user);
        $manager->flush();

        $this->addFlash(
            'success',
            'Votre compte a été supprimé avec succès !'
        );

        return $this->redirectToRoute('security.login');
    }

}
