<?php

namespace App\Tests;
use App\Entity\Membres;
use PHPUnit\Framework\TestCase;

class MembresUnitTestsTest extends TestCase
{
    public function testIsTrue()
    {
        $membres = new Membres();

    // Définissez les valeurs sur l'entité membres
    $membres
        ->setNom('Nom')
        ->setPrenom('Prenom')
        ->setFonction('Fonction');

    // Vérifiez les valeurs
    $this->assertEquals('Nom', $membres->getNom());
    $this->assertEquals('Prenom', $membres->getPrenom());
    $this->assertEquals('Fonction', $membres->getFonction());
    }

    public function testIsFalse()
    {
        $membres = new Membres();

    // Définissez les valeurs sur l'entité membres
    $membres
        ->setNom('Nom')
        ->setPrenom('Prenom')
        ->setFonction('Fonction');


    // Vérifiez les valeurs incorrectes
    $this->assertNotEquals('False', $membres->getNom());
    $this->assertNotEquals('False', $membres->getPrenom());
    $this->assertNotEquals('False', $membres->getFonction());
    }

    public function testIsEmpty()
    {
        $membres = new Membres();

        $this->assertEmpty($membres->getNom());
        $this->assertEmpty($membres->getPrenom());
        $this->assertEmpty($membres->getFonction());
    }
}
