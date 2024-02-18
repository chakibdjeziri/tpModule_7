<?php

namespace App\DataFixtures;

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
        for ($i = 1; $i < 51; $i++) {
            $vehicule = new Vehicule();
            $vehicule->setNom($this->faker->word())
                ->setModele($this->faker->word(2, true))
                ->setDescription($this->faker->text(300))
                ->setDateCreation(DateTime::createFromFormat('d/m/Y', $this->faker->date('d/m/Y')))
                ->setImage($this->faker->imageUrl(360, 360, 'car', true, 'citadine', true, 'jpg'))
                ->setEnVente($this->faker->boolean());

            $manager->persist($vehicule);
        }

        $manager->flush();
    }
}
