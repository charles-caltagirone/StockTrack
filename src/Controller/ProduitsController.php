<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Form\AjoutProduitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitsController extends AbstractController
{    
    private $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/produits', name: 'app_produits')]

    public function new(Request $request): Response
    {
        $produit = new Produits();
        $form = $this->createForm(AjoutProduitType::class, $produit, ["required" => false]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { // vérification du form, comme isset en natif
            $produit = $form->getData(); //récupère la saisie
           
            $this->entityManager->persist($produit); // équivalent du prepare PDO
            $this->entityManager->flush(); // équivalent du execute PDO
            
            return $this->redirectToRoute('app_homepage');
            // return $this->redirect($request->getUri());
        }

        return $this->render('produits/index.html.twig', [
            'formProduit' => $form->createView()
        ]);
    }
}
