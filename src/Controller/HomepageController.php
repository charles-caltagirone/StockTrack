<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index( ProduitsRepository $produitsRepository, CategoriesRepository $categoriesRepository): Response
    {
        $produits = $produitsRepository->findAll();
        $categories = $categoriesRepository->findAll();        

        return $this->render('base.html.twig', [
            'controller_name' => 'HomepageController',
            'produits' => $produits,
            'categories' => $categories
        ]);
    }
}
