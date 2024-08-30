<?php

namespace App\Tests;

use App\Entity\Articles;
use PHPUnit\Framework\TestCase;

class ArticlesUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $articles = new Articles();

    // Créez un objet \DateTime pour la date de publication
    $datePublication = new \DateTime('2024-01-25');

    // Créez un objet \DateTime pour la date de modification
    $dateModification = new \DateTime('2024-08-14');

    // Définissez les valeurs sur l'entité Articles
    $articles
        ->setDatePublication($datePublication)
        ->setTitre('Mon titre')
        ->setDescription('Mon article')
        ->setAuteur('Auteur')
        ->setPhoto('photo.jpg')
        ->setDateModification($dateModification);

    // Vérifiez les valeurs
    $this->assertEquals($datePublication, $articles->getDatePublication());
    $this->assertEquals('Mon titre', $articles->getTitre());
    $this->assertEquals('Mon article', $articles->getDescription());
    $this->assertEquals('Auteur', $articles->getAuteur());
    $this->assertEquals('photo.jpg', $articles->getPhoto());
    $this->assertEquals($dateModification, $articles->getDateModification());
    }

    public function testIsFalse()
    {
        $articles = new Articles();

    // Créez un objet \DateTime pour la date de publication
    $datePublication = new \DateTime('2024-01-25');
    $dateModification = new \DateTime('2024-08-14');

    // Définissez les valeurs sur l'entité Articles
    $articles
        ->setDatePublication($datePublication)
        ->setTitre('Mon titre')
        ->setDescription('Mon article')
        ->setAuteur('Auteur')
        ->setPhoto('photo.jpg')
        ->setDateModification($dateModification);

    // Créez une date incorrecte pour la comparaison
    $falseDatePublication = new \DateTime('2023-01-25');
    $falseDateModification = new \DateTime('2023-02-25');

    // Vérifiez les valeurs incorrectes
    $this->assertNotEquals($falseDatePublication, $articles->getDatePublication());
    $this->assertNotEquals('False', $articles->getTitre());
    $this->assertNotEquals('False', $articles->getDescription());
    $this->assertNotEquals('False', $articles->getAuteur());
    $this->assertNotEquals('False', $articles->getPhoto());
    $this->assertNotEquals($falseDateModification, $articles->getDateModification());
    }

    public function testIsEmpty()
    {
        $articles = new Articles();

        $this->assertEmpty($articles->getDatePublication());
        $this->assertEmpty($articles->getTitre());
        $this->assertEmpty($articles->getDescription());
        $this->assertEmpty($articles->getAuteur());
        $this->assertEmpty($articles->getPhoto());
        $this->assertEmpty($articles->getDateModification());
    }
}
