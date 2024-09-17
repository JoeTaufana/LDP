<?php

namespace App\Tests;
use App\Entity\Membre;
use PHPUnit\Framework\TestCase;

class MembreUnitTestsTest extends TestCase
{
    public function testIsTrue()
    {
        $membre = new Membre();

    // Définissez les valeurs sur l'entité membres
    $membre
        ->setNom('Nom')
        ->setPrenom('Prenom')
        ->setFonction('Fonction');

    // Vérifiez les valeurs
    $this->assertEquals('Nom', $membre->getNom());
    $this->assertEquals('Prenom', $membre->getPrenom());
    $this->assertEquals('Fonction', $membre->getFonction());
    }

    public function testIsFalse()
    {
        $membre = new Membre();

    // Définissez les valeurs sur l'entité membre
    $membre
        ->setNom('Nom')
        ->setPrenom('Prenom')
        ->setFonction('Fonction');


    // Vérifiez les valeurs incorrectes
    $this->assertNotEquals('False', $membre->getNom());
    $this->assertNotEquals('False', $membre->getPrenom());
    $this->assertNotEquals('False', $membre->getFonction());
    }

    public function testIsEmpty()
    {
        $membre = new Membre();

        $this->assertEmpty($membre->getNom());
        $this->assertEmpty($membre->getPrenom());
        $this->assertEmpty($membre->getFonction());
    }
}
