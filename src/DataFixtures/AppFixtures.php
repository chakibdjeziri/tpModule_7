<?php

namespace App\DataFixtures;

use App\Entity\UserAdmin;
use DateTime;
use App\Entity\Vehicule;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    private Generator $faker;
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        // UsersAdmin
        $users = [];

        $admin = new UserAdmin();
        $admin->setPseudo('Administrateur de MalikAuto')
            ->SetEmail('admin@malikauto.fr')
            ->setRoles(['ROLE_ADMIN'])
            ->setPlainPassword('admin');

        $users[] = $admin;
        $manager->persist($admin);

        // Véhicules
        for ($i = 1; $i < 31; $i++) {
            $vehicule = new Vehicule();
            $vehicule->setNom('BMW')
                ->setModele('M3')
                ->setDescription($this->faker->text(1000))
                ->setDateCreation(DateTime::createFromFormat('d/m/Y', $this->faker->date('d/m/Y')))
                ->setImage('https://media.istockphoto.com/id/1401806376/fr/photo/bmw-m3-bleue.jpg?s=1024x1024&w=is&k=20&c=CXODJ2HijBGGPmAem7S4FUpiQzi8E61vXbd8QRo9hgs=')
                ->setEnVente($this->faker->boolean());

            $manager->persist($vehicule);
        }


        $manager->flush();
    }
}
