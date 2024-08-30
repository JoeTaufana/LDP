<?php

namespace App\Tests;

use App\Entity\Contacts;
use PHPUnit\Framework\TestCase;

class ContactsUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $contacts = new Contacts();

    // Définissez les valeurs sur l'entité contacts
    $contacts
        ->setNom('Nom')
        ->setPrenom('Prenom')
        ->setTelephone('+33625658419')
        ->setDescription('Une description')
        ->setEmail('test@test.com');

    // Vérifiez les valeurs
    $this->assertEquals('Nom', $contacts->getNom());
    $this->assertEquals('Prenom', $contacts->getPrenom());
    $this->assertEquals('+33625658419', $contacts->getTelephone());
    $this->assertEquals('Une description', $contacts->getDescription());
    $this->assertEquals('test@test.com', $contacts->getEmail());
    }

    public function testIsFalse()
    {
        $contacts = new Contacts();

    // Définissez les valeurs sur l'entité contacts
    $contacts
        ->setNom('Nom')
        ->setPrenom('Prenom')
        ->setTelephone('+33625658419')
        ->setDescription('Une description')
        ->setEmail('test@test.com');


    // Vérifiez les valeurs incorrectes
    $this->assertNotEquals('False', $contacts->getNom());
    $this->assertNotEquals('False', $contacts->getPrenom());
    $this->assertNotEquals('+33625658417', $contacts->getTelephone());
    $this->assertNotEquals('False', $contacts->getDescription());
    $this->assertNotEquals('testFalse@example.com', $contacts->getEmail());
    }

    public function testIsEmpty()
    {
        $contacts = new Contacts();

        $this->assertEmpty($contacts->getNom());
        $this->assertEmpty($contacts->getPrenom());
        $this->assertEmpty($contacts->getTelephone());
        $this->assertEmpty($contacts->getDescription());
        $this->assertEmpty($contacts->getEmail());
    }
}
