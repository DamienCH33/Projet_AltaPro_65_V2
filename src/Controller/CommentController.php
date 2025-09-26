<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

final class CommentController extends AbstractController
{

    #[Route('/comment/form', name: 'app_comment_form', methods: ['GET','POST'])]
    /**
     * commentForm formulaire pour mettre un commentaire
     *
     * @param  mixed $request
     * @param  mixed $em
     * @return Response
     */
    public function commentForm(Request $request, EntityManagerInterface $em): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setSendAt(new \DateTimeImmutable());
            $em->persist($comment);
            $em->flush();

            $this->addFlash('success', 'Votre avis a bien été envoyé.');
        } else {
            $this->addFlash('error', 'Erreur lors de l’envoi de votre avis.');
        }

        return $this->redirectToRoute('app_realisations');
    }
}
