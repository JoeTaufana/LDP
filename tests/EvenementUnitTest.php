<?php

namespace App\Tests;

use App\Entity\Evenement;
use PHPUnit\Framework\TestCase;

class EvenementUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $evenement = new Evenement();

    // Créez un objet \DateTime pour la date 
    $rdv = new \DateTime('2024-01-25');


    // Définissez les valeurs sur l'entité evenement
    $evenement
        ->setRdv($rdv)
        ->setNom('Nom')
        ->setDescription('Evenement')
        ->setPrix('10,90')
        ->setAdresse('123 Rue des Martyrs')
        ->setFile('photo.jpg');

    // Vérifiez les valeurs
    $this->assertEquals($rdv, $evenement->getrdv());
    $this->assertEquals('Nom', $evenement->getNom());
    $this->assertEquals('Evenement', $evenement->getDescription());
    $this->assertEquals('10,90', $evenement->getPrix());
    $this->assertEquals('123 Rue des Martyrs', $evenement->getAdresse());
    $this->assertEquals('photo.jpg', $evenement->getFile());
}

    public function testIsFalse()
    {
        $evenement = new Evenement();

    // Créez un objet \DateTime pour la date de publication
    $rdv = new \DateTime('2024-01-25');

    // Définissez les valeurs sur l'entité evenement
    $evenement
        ->setRdv($rdv)
        ->setNom('Nom')
        ->setDescription('Evenement')
        ->setPrix('10,90')
        ->setAdresse('123 Rue des Martyrs')
        ->setFile('photo.jpg');
    // Créez une date incorrecte pour la comparaison
    $falseRdv = new \DateTime('2023-01-25');

    // Vérifiez les valeurs incorrectes
    $this->assertNotEquals($falseRdv, $evenement->getRdv());
    $this->assertNotEquals('False', $evenement->getNom());
    $this->assertNotEquals('False', $evenement->getDescription());
    $this->assertNotEquals('11.25', $evenement->getPrix());
    $this->assertNotEquals('False', $evenement->getAdresse());
    $this->assertNotEquals('False', $evenement->getFile());
    }

    public function testIsEmpty()
    {
        $evenement = new evenement();

        $this->assertEmpty($evenement->getrdv());
        $this->assertEmpty($evenement->getNom());
        $this->assertEmpty($evenement->getDescription());
        $this->assertEmpty($evenement->getPrix());
        $this->assertEmpty($evenement->getAdresse());
        $this->assertEmpty($evenement->getFile());
    }
}
