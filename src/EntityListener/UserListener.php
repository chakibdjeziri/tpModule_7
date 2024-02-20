<?php

namespace App\EntityListener;

use App\Entity\UserAdmin;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserListener
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function prePersist(UserAdmin $UserAdmin)
    {
        $this->encodePassword($UserAdmin);
    }

    public function preUpdate(UserAdmin $UserAdmin)
    {
        $this->encodePassword($UserAdmin);
    }

    /**
     * Encode password based on plain password
     *
     * @param Admin $admin
     * @return void
     */
    public function encodePassword(UserAdmin $UserAdmin)
    {
        if ($UserAdmin->getPlainPassword() === null) {
            return;
        }

        $UserAdmin->setPassword(
            $this->hasher->hashPassword(
                $UserAdmin,
                $UserAdmin->getPlainPassword()
            )
        );

        $UserAdmin->setPlainPassword(null);
    }
}
