<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ContactController extends AbstractController
{
    #[Route('/contact/form', name: 'app_contact_form', methods: ['GET', 'POST'])]
    public function contactForm(Request $request, EntityManagerInterface $em): Response
    {
        $newContact = new Contact();
        $form = $this->createForm(ContactType::class, $newContact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newContact->setSendAt(new \DateTimeImmutable());
            $em->persist($newContact);
            $em->flush();

            $this->addFlash('success', 'Votre message a bien été envoyé. Nous vous répondrons dans les plus brefs délais.');

            return $this->redirectToRoute('app_contact_form');
        }

        return $this->render('contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
