<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\CoordonneeRepository;
use App\Form\ContactType;
use App\Service\ContactService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(
        Request $request, 
        ContactService $contactService,
        CoordonneeRepository $coordonneeRepository
        ): Response {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();

            $contactService->persistContact($contact);

            return $this->redirectToRoute('contact');
        }

        

        return $this->render('contact/index.html.twig', [
            'formContact' => $form->createView(),
            'coordonnee' => $coordonneeRepository->findAll(),
        ]);
    }
}
