<?php

namespace App\Controller;

use App\Repository\NiveauRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NiveauController extends AbstractController
{
    #[Route('/niveaus', name: 'app_niveaus')]
    public function index(NiveauRepository $niveauRepository): Response
    {
        $niveaus = $niveauRepository->findAll();

        return $this->render('niveau/index.html.twig', [
            'niveaus' => $niveaus,
        ]);
    }
}