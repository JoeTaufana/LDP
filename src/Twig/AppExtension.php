<?php

namespace App\Twig;

use App\Repository\CategoriesRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    private $categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('categorieNavbar', [$this, 'categorie']),
        ];
    }

    public function categorie(): array
    {
        return $this->categoriesRepository->findAll();
    }

}