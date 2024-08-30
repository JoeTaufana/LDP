<?php

namespace App\Tests;

use App\Entity\Categories;
use PHPUnit\Framework\TestCase;

class CategoriesUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $categories = new Categories();

    // Définissez les valeurs sur l'entité categories
    $categories
        ->setNom('Nom');

    // Vérifiez les valeurs
    $this->assertEquals('Nom', $categories->getNom());
    }

    public function testIsFalse()
    {
        $categories = new Categories();

    // Définissez les valeurs sur l'entité categories
    $categories
        ->setNom('Nom');


    // Vérifiez les valeurs incorrectes
    $this->assertNotEquals('False', $categories->getNom());
    }

    public function testIsEmpty()
    {
        $categories = new Categories();

        $this->assertEmpty($categories->getNom());
    }
}
