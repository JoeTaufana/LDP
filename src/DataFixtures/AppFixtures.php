<?php

namespace App\DataFixtures;

use App\Entity\Membre;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Evenement;
use App\Entity\Coordonnee;

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
            ->setEmail('user@test.com')            
            ->setRoles(['ROLE_GESTIONNAIRE']);
            
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                'password123'
            );
            $user->setPassword($hashedPassword);

         // Persister l'utilisateur dans l'ObjectManager
         $manager->persist($user);

        // Création de 3 catégories d'article
        $categories = [];
        for ($i = 0; $i < 3; $i++) {
            $categorie = new Categorie();
            $categorie->setNom($faker->word())
                    ->setDescription($faker->text(150))
                    ->setSlug($faker->slug);
            $categories[] = $categorie;
            $manager->persist($categorie);
        }

         // Création de 15 articles
         for ($i = 0; $i < 15; $i++) {
            $article = new Article();
            $article->setTitre($faker->sentence(3))
                ->setDescription($faker->text(2500))
                ->setUser($user)
                ->setAuteur($faker->name)                
                ->setSlug($faker->slug)
                ->setFile('img/photos/pirogue.webp')
                ->setDatePublication($faker->dateTimeBetween('-1 year', 'now'));

            // Associer l'article à une catégorie aléatoire
            $categorie = $categories[array_rand($categories)];
            $article->addCategorie($categorie);

            $manager->persist($article);
        }

        // Création de 5 événements
        for ($i = 0; $i < 5; $i++) {
            $evenement = new Evenement();
            $evenement->setNom($faker->sentence(3))
                ->setDescription($faker->text(200))
                ->setRdv($faker->dateTimeBetween('now', '+1 year'))
                ->setPrix($faker->randomFloat(2, 10, 100))
                ->setAdresse($faker->address)
                ->setFile('img/photos/pirogue.webp')
                ->setSlug($faker->slug)
                ->setCreateur($user);

            $manager->persist($evenement);
            $evenements[] = $evenement; // Stocker les événements créés
        }

        // Associer des participants aux événements
        foreach ($evenements as $evenement) {
            // Ajouter l'utilisateur comme participant à chaque événement
            $evenement->addParticipant($user);
            $manager->persist($evenement);
        }

        // Créations de 6 membres
        for ($i = 0; $i < 6; $i++){
            $membre = new Membre();
            $membre->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
                ->setFonction($faker->jobTitle)
                ->setFile('img/photos/portrait.png')
                ->setCreateur($user);

            $manager->persist($membre);
        
        // Créations de 5 coordonnees
        for ($i = 0; $i < 5; $i++){
            $coordonnee = new Coordonnee();
            $coordonnee->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
                ->setTelephone($faker->phoneNumber)
                ->setDescription($faker->text(100))
                ->setEmail($faker->email)
                ->setCreateur($user);

            $manager->persist($coordonnee);

        // Finaliser les changements en base de données
        $manager->flush();
        }

    }
}
}