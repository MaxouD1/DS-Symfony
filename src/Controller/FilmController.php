<?php

namespace App\Controller;

use App\Entity\Film;
use App\Form\ArticleType;
use App\Form\FilmType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController

{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    #[Route('/film/{id}', name: 'app_film_desc')]
    public function index(Film $film): Response
    {
        return $this->render('film/index.html.twig', [
            'controller_name' => 'FilmController',
            'film' => $film,

        ]);
    }

    #[Route('/addfilm', name: 'app_film_add')]
    public function addFilm(Request $request): Response
    {
        $film = new Film();

        $form = $this->createForm(FilmType::class, $film);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $film = $form->getData();
                $entityManager = $this->manager;
                $entityManager->persist($film);
                $entityManager->flush();
                return $this->redirectToRoute('app_home');
            }
        }
        return $this->render('film/add.html.twig', [
            'controller_name' => 'FilmController',
            'form' => $form->createView(),
        ]);
    }
}
