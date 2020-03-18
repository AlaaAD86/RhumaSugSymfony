<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\CommProd;
use App\Entity\Panier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    /**
     * @Route("/payment", name="payment")
     */
    public function index()
    {

        // GET USER ID, DATE THEN SEND TO DATABASE
        $time = new \DateTime("now");
        $commande = new Commande();
        $manager = $this->getDoctrine()->getManager();
     
        $commande->setClient($this->getUser())
                 ->setDate($time);

        $manager->persist($commande);
        
        
        $repo = $this->getDoctrine()->getRepository(Panier::class);
        $paniers = $repo->findBy(['user'=>$this->getUser()]);
        // dd($panier);
        
        foreach ($paniers as $panier){
            $commProd = new CommProd();
            $commProd->setComm($commande)
                     ->setProd($panier->getProduit())
                     ->setPrix($panier->getProduit()->getPrice())
                     ->setQuantity($panier->getQte());
            
            $manager->persist($commProd);
            
        }
        
        
        $manager->flush();
        
        return $this->render('payment/payment.html.twig', [
            'controller_name' => 'PaymentController',
        ]);
    }

    /**
     * @Route("/remove{id}", name="remove")
     */


    public function removeItems($id)
    {
        // dd($request);

        $repo = $this->getDoctrine()->getRepository(Panier::class);
        $panier = $repo->find($id);

                      
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($panier);
        $manager->flush();
                
        return $this->redirectToRoute('commande');
    }

    
}
