<?php

namespace App\Controller;

use App\Entity\Produits;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProduitsController extends AbstractController
{
    /**
     * @Route("/produits", name="produits")
     */
    public function index()
    {

        $repo = $this->getDoctrine()->getRepository(Produits::class);
        $produit = $repo->findAll();
      

        return $this->render('produits/produits.html.twig', [
            // 'controller_name' => 'ProduitsController',
            // WE ADD THE KEY 'PRODUITS' with the value $produit to render it in For Loop in twig
            'produits' => $produit
        ]);
    }
}
