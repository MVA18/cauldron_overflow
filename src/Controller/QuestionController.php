<?php

namespace App\Controller;

use App\Services\CacheHelper;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class QuestionController extends AbstractController
{
    private $logger;
    private $isDebug;

    public function __construct(LoggerInterface $logger, bool $isDebug)
    {
        $this->logger = $logger;
        $this->isDebug = $isDebug;
    }

    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(Environment $twigEnvironment): Response
    {
        // example of twig service directly
        // $html = $twigEnvironment->render('questions/homepage.html.twig');
        // return new Response($html);

        return $this->render('questions/homepage.html.twig');
    }

    /**
     * @Route("questions/{slug}", name="app_question_show")
     */
    public function show($slug, CacheHelper $cacheHelper): Response
    {
        $answers = [
            'Make sure your cat is sitting `purrrfectly` still',
            'Honestly, I like furry shoes better than MY cat',
            'Maybe... Try saying whe spell backwards?'
        ];

        $questionText = 'I\'ve been turned into a cat, any *thoughts* on how to turn back? While I\'m **adorable**, I don\'t really care for cat food.';

        return $this->render('questions/show.html.twig', [
            'question' => ucwords(str_replace('-', ' ', $slug)),
            'questionText' => $cacheHelper->cache($questionText),
            'answers' => $answers
        ]);
    }
}