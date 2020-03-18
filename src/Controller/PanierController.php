<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Entity\Produits;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */


    public function index(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Panier::class);
        $panier = $repo->findBy(['user'=>$this->getUser()]);
      
        // dd($panier);
        if($panier){
             return $this->render('panier/panier.html.twig', [
            'paniers' => $panier
        ]);
        } else {
            return $this->redirectToRoute('home');
        }

       
    }


    /**
     * @Route("/add{id}", name="add")
     */


    public function addToPanier(Request $request, $id)
    {
        // dd($request);
        $manager = $this->getDoctrine()->getManager();

        $repo = $this->getDoctrine()->getRepository(Produits::class);
        $produit = $repo->find($id);

        $qte = $request->get('qte');

        $repoPanier = $this->getDoctrine()->getRepository(Panier::class);
        $findPanier = $repoPanier->findOneBy(['produit'=>$produit, 'user'=>$this->getUser()]);

        // dd($findPanier);
        if ($findPanier)
        {
            $findPanier->setQte($qte + $findPanier->getQte());
        } 
        else 
        {
           
            $panier = new Panier();
            
            // dd($qte);
            $panier->setQte($qte)
            ->setUser($this->getUser())
            ->setProduit($produit);
      
            $manager->persist($panier);
            
        }
        $manager->flush();
        return $this->redirectToRoute('produits');
    }


    /**
     * @Route("/remove{id}", name="remove")
     */


    public function removeItems(Request $request, $id)
    {
        // dd($request);

        $repo = $this->getDoctrine()->getRepository(Panier::class);
        $panier = $repo->find($id);

                      
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($panier);
        $manager->flush();
                
        return $this->redirectToRoute('panier');
    }

    

}
