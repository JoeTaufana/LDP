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
        ->setNom('Nom')
        ->setDescription('Texte de description')
        ->setSlug('chudq-ckjfd-xs');

    // Vérifiez les valeurs
    $this->assertEquals('Nom', $categories->getNom());
    $this->assertEquals('Texte de description', $categories->getDescription());
    $this->assertEquals('chudq-ckjfd-xs', $categories->getSlug());
}

    public function testIsFalse()
    {
        $categories = new Categories();

    // Définissez les valeurs sur l'entité categories
    $categories
    ->setNom('Nom')
    ->setDescription('Texte de description')
    ->setSlug('chudq-ckjfd-xs');


    // Vérifiez les valeurs incorrectes
    $this->assertNotEquals('False', $categories->getNom());
    $this->assertNotEquals('False description', $categories->getDescription());
    $this->assertNotEquals('False-vsb-fre', $categories->getSlug());
    }

    public function testIsEmpty()
    {
        $categories = new Categories();

        $this->assertEmpty($categories->getNom());
        $this->assertEmpty($categories->getDescription());
        $this->assertEmpty($categories->getSlug());
}
}