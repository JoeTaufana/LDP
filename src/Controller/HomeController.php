<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\EvenementRepository;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Service\ContactService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ArticleRepository $articleRepository, 
                        EvenementRepository $evenementRepository,
                        Request $request,
                        ContactService $contactService
        ): Response {

            $contact = new Contact();
            $form = $this->createForm(ContactType::class, $contact);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $contact = $form->getData();

                $contactService->persistContact($contact);

                return $this->redirectToRoute('home');
        }

        return $this->render('home/index.html.twig', [
            'article' => $articleRepository ->troisDerniers(),
            'evenement' => $evenementRepository ->derniers(),
            'formContact' => $form->createView(),
        ]);
    }
}
