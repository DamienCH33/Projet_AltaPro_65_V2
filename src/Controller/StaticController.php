<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

final class StaticController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    /**
     * index: affiche la page d'accueil
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('index.html.twig', [
            'controller_name' => 'TemplatesController',
        ]);
    }

    #[Route('/services', name: 'app_services')]
    /**
     * services: affiche la page des services
     *
     * @return Response
     */
    public function services(): Response
    {
        return $this->render('/services.html.twig');
    }

    #[Route('/realisations', name: 'app_realisations')]    
    /**
     * realisations:  affiche la page des réalisations
     *
     * @param  mixed $em
     * @return Response
     */
    public function realisations(EntityManagerInterface $em): Response
    {
        $comments = $em->getRepository(Comment::class)->findAll();

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        return $this->render('realisations.html.twig', [
            'comments' => $comments,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/about', name: 'app_about')]
    /**
     * about : affiche la page à propos
     *
     * @return Response
     */
    public function about(): Response
    {
        return $this->render('/about.html.twig');
    }

    #[Route('/contact', name: 'app_contact')]
    /**
     * contact : affiche la page de contact
     *
     * @return Response
     */
    public function contact(): Response
    {
        return $this->render('/contact.html.twig');
    }
    #[Route('/contact', name: 'app_contact')]
    public function contactRedirect(): Response
    {
        return $this->redirectToRoute('app_contact_form');
    }
}
