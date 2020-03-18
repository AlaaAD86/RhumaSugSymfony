<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="client")
     */
    public function index(Request $request)
    {
        
        // $form = $this->createForm(RegistrationFormType::class);
        
        // $form->handleRequest($request);
        
        $client = $this->getUser();
        
        if ($request->getMethod() == ('POST')){
           
            $client->setName($request->get('name'))
                    ->setLastName($request->get('lastName'))
                    ->setTelephone($request->get('telephone'))
                    ->setAdress($request->get('adress'))
                    ->setPostalCode($request->get('postalCode'))
                    ->setCity($request->get('city'))
                    ->setCountry($request->get('country'));

            $client = $this->getDoctrine()->getManager();
            $client->flush();
        }

        return $this->render('client/client.html.twig', [
            'controller_name' => 'ClientController',
            // 'ModificationForm' => $form->createView()
        ]);
    }
}
