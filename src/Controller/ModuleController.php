<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ModuleController extends AbstractController
{
    #[Route('/niveau/{niveau}/module/{module}', name: 'app_module')]
    public function index(int $niveau, int $module): Response
    {
        return $this->render('module/index.html.twig', [
            'niveau' => $niveau,
            'module' => $module
        ]);
    }
}