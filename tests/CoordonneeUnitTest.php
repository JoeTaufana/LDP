<?php

namespace App\Tests;

use App\Entity\Coordonnee;
use PHPUnit\Framework\TestCase;

class CoordonneeUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $coordonnee = new Coordonnee();

    // Définissez les valeurs sur l'entité coordonnee
    $coordonnee
        ->setNom('Nom')
        ->setPrenom('Prenom')
        ->setTelephone('+33625658419')
        ->setDescription('Une description')
        ->setEmail('test@test.com');

    // Vérifiez les valeurs
    $this->assertEquals('Nom', $coordonnee->getNom());
    $this->assertEquals('Prenom', $coordonnee->getPrenom());
    $this->assertEquals('+33625658419', $coordonnee->getTelephone());
    $this->assertEquals('Une description', $coordonnee->getDescription());
    $this->assertEquals('test@test.com', $coordonnee->getEmail());
    }

    public function testIsFalse()
    {
        $coordonnee = new Coordonnee();

    // Définissez les valeurs sur l'entité coordonnee
    $coordonnee
        ->setNom('Nom')
        ->setPrenom('Prenom')
        ->setTelephone('+33625658419')
        ->setDescription('Une description')
        ->setEmail('test@test.com');


    // Vérifiez les valeurs incorrectes
    $this->assertNotEquals('False', $coordonnee->getNom());
    $this->assertNotEquals('False', $coordonnee->getPrenom());
    $this->assertNotEquals('+33625658417', $coordonnee->getTelephone());
    $this->assertNotEquals('False', $coordonnee->getDescription());
    $this->assertNotEquals('testFalse@example.com', $coordonnee->getEmail());
    }

    public function testIsEmpty()
    {
        $coordonnee = new Coordonnee();

        $this->assertEmpty($coordonnee->getNom());
        $this->assertEmpty($coordonnee->getPrenom());
        $this->assertEmpty($coordonnee->getTelephone());
        $this->assertEmpty($coordonnee->getDescription());
        $this->assertEmpty($coordonnee->getEmail());
    }
}
