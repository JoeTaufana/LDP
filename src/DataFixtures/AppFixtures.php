<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Articles;
use App\Entity\Categories;
use App\Entity\Evenements;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture

{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
       
        // Utilisation de Faker
        $faker = Factory::create('fr_FR');

        //Création d'utilisateur
        $user = new User();

        // Génération des données pour l'utilisateur
        $user->setNom($faker->lastName)
            ->setPrenom($faker->firstName)
            ->setEmail('user@test.com');
            
            // ->setRoles(['ROLE_ADMIN']);
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                'password123'
            );
            $user->setPassword($hashedPassword);

         // Persister l'utilisateur dans l'ObjectManager
         $manager->persist($user);

        // Création de 3 catégories d'articles
        $categories = [];
        for ($i = 0; $i < 3; $i++) {
            $categorie = new Categories();
            $categorie->setNom($faker->word());
            $categories[] = $categorie;
            $manager->persist($categorie);
        }

         // Création de 10 articles
         for ($i = 0; $i < 10; $i++) {
            $article = new Articles();
            $article->setTitre($faker->sentence(3))
                ->setDescription($faker->text(200))
                ->setUser($user)
                ->setAuteur($faker->name)
                ->setPhoto('img/photos/cagou.webp')
                ->setDatePublication($faker->dateTimeBetween('-1 year', 'now'));

            // Associer l'article à une catégorie aléatoire
            $categorie = $categories[array_rand($categories)];
            $article->addCategorie($categorie);

            $manager->persist($article);
        }

        // Création de 5 événements
        for ($i = 0; $i < 5; $i++) {
            $evenement = new Evenements();
            $evenement->setNom($faker->sentence(3))
                ->setDescription($faker->text(200))
                ->setRdv($faker->dateTimeBetween('now', '+1 year'))
                ->setPrix($faker->randomFloat(2, 10, 100))
                ->setAdresse($faker->address)
                ->setImage('img/photos/pirogue.webp')
                ->setCreateur($user);

            $manager->persist($evenement);
            $evenements[] = $evenement; // Stocker les événements créés
        }

        // Associer des participants aux événements
        foreach ($evenements as $evenement) {
            // Ajouter l'utilisateur comme participant à chaque événement
            $evenement->addParticipant($user);
            $manager->persist($evenement);

        // Finaliser les changements en base de données
        $manager->flush();
        }

    }
}
