<?php

namespace App\Controller;


use App\Entity\Projection;
use App\Form\AddProjectionType;
use App\Form\ArticleType;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectionController extends AbstractController
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    #[Route('/addprojection', name: 'app_projection')]
    public function index(Request $request): Response
    {
        $projection = new Projection();

        $form = $this->createForm(AddProjectionType::class, $projection);

        if ($request->isMethod('POST')) {$form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $projection = $form->getData();
                $entityManager = $this->manager;
                $entityManager->persist($projection);
                $entityManager->flush();
                return $this->redirectToRoute('app_home');
            }}

        return $this->render('projection/index.html.twig', [
            'controller_name' => 'ProjectionController',
            'form' => $form->createView(),
        ]);
    }
}
