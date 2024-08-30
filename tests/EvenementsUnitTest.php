<?php

namespace App\Tests;

use App\Entity\Evenements;
use PHPUnit\Framework\TestCase;

class EvenementsUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $evenements = new Evenements();

    // Créez un objet \DateTime pour la date 
    $rdv = new \DateTime('2024-01-25');


    // Définissez les valeurs sur l'entité evenements
    $evenements
        ->setRdv($rdv)
        ->setNom('Nom')
        ->setDescription('Evenements')
        ->setPrix('10,90')
        ->setAdresse('123 Rue des Martyrs');

    // Vérifiez les valeurs
    $this->assertEquals($rdv, $evenements->getrdv());
    $this->assertEquals('Nom', $evenements->getNom());
    $this->assertEquals('Evenements', $evenements->getDescription());
    $this->assertEquals('10,90', $evenements->getPrix());
    $this->assertEquals('123 Rue des Martyrs', $evenements->getAdresse());
    }

    public function testIsFalse()
    {
        $evenements = new Evenements();

    // Créez un objet \DateTime pour la date de publication
    $rdv = new \DateTime('2024-01-25');

    // Définissez les valeurs sur l'entité evenements
    $evenements
        ->setRdv($rdv)
        ->setNom('Nom')
        ->setDescription('Evenements')
        ->setPrix('10,90')
        ->setAdresse('123 Rue des Martyrs');
    // Créez une date incorrecte pour la comparaison
    $falseRdv = new \DateTime('2023-01-25');

    // Vérifiez les valeurs incorrectes
    $this->assertNotEquals($falseRdv, $evenements->getRdv());
    $this->assertNotEquals('False', $evenements->getNom());
    $this->assertNotEquals('False', $evenements->getDescription());
    $this->assertNotEquals('11.25', $evenements->getPrix());
    $this->assertNotEquals('False', $evenements->getAdresse());
    }

    public function testIsEmpty()
    {
        $evenements = new evenements();

        $this->assertEmpty($evenements->getrdv());
        $this->assertEmpty($evenements->getNom());
        $this->assertEmpty($evenements->getDescription());
        $this->assertEmpty($evenements->getPrix());
        $this->assertEmpty($evenements->getAdresse());
    }
}
