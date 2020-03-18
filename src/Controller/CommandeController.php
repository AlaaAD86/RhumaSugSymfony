<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\CommProd;
use App\Entity\Panier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande", name="commande")
     */
    public function index()
    {
        
        $repo = $this->getDoctrine()->getRepository(Panier::class);
        $panier = $repo->findBy(['user'=>$this->getUser()]);

       
        return $this->render('commande/commande.html.twig', [
            'controller_name' => 'CommandeController',
            'paniers' => $panier
            
        ]);
    }
}
