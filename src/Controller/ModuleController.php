<?php

namespace App\Controller;

use App\Entity\Module;
use App\Repository\ModuleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ModuleController extends AbstractController
{
    #[Route('/niveau/{niveau}/module/{module}', name: 'app_module')]
    public function index(int $niveau, int $module, ModuleRepository $moduleRepository): Response
    {
        $moduleEntity = $moduleRepository->find($module);

        if (!$moduleEntity || $moduleEntity->getNiveau()->getId() !== $niveau) {
            throw $this->createNotFoundException('Module not found');
        }

        return $this->render('module/index.html.twig', [
            'module' => $moduleEntity,
        ]);
    }
}