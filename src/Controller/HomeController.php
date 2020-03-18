<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {


        return $this->render('home/index.html.twig', [
            // 'controller_name' => 'HomeController',
            
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home(ProduitsRepository $produitsRepository){
        $repo = $this->getDoctrine()->getRepository(Produits::class);
        $produit = $produitsRepository->maxAffiche();
        // dd($produit);
        return $this->render('home/home.html.twig', [
             // WE ADD THE KEY 'PRODUITS' with the value $produit to render it in For Loop in twig

            'produits' => $produit
        ]);
        
    }
}
