<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $user = new User();

        $user   ->setEmail('test@example.com')
                ->setPassword('password')
                ->setPrenom('prenom')
                ->setNom('nom')
                ->setTelephone('+687567262');

        $this->assertTrue($user->getEmail() === 'test@example.com');
        $this->assertTrue($user->getPassword() === 'password');
        $this->assertTrue($user->getPrenom() === 'prenom');
        $this->assertTrue($user->getNom() === 'nom');
        $this->assertTrue($user->getTelephone() === '+687567262');
    }

    public function testIsFalse()
    {
        $user = new User();

        $user   ->setEmail('test@example.com')
                ->setPassword('password')
                ->setPrenom('prenom')
                ->setNom('nom')
                ->setTelephone('+687567262');

        $this->assertFalse($user->getEmail() === 'testFalse@example.com');
        $this->assertFalse($user->getPassword() === 'False');
        $this->assertFalse($user->getPrenom() === 'False');
        $this->assertFalse($user->getNom() === 'False');
        $this->assertFalse($user->getTelephone() === 'False');
    }

    public function testIsEmpty()
    {
        $user = new User();

        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getPrenom());
        $this->assertEmpty($user->getNom());
        $this->assertEmpty($user->getTelephone());

        // Le mot de passe n'est pas testé ici car il ne peut pas être null ou vide
    }
}
