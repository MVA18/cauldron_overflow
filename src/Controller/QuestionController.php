<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage(): Response
    {
        return new Response('Some Text');
    }

    /**
     * @Route("questions/{slug}")
     */
    public function show($slug): Response
    {
        $answers = [
            'Make sure your cat is sitting purrrfectly still',
            'Honestly, I like furry shoes better than MY cat',
            'Maybe... Try saying whe spell backwards?'
        ];

        return $this->render('questions/show.html.twig', [
            'question' => ucwords(str_replace('-', ' ', $slug)),
            'answers' => $answers
        ]);
    }
}