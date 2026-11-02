<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OverviewController extends AbstractController
{
    #[Route('/overzicht', name: 'app_overview')]
    public function index(UserRepository $userRepository): Response
    {
        $students = array_filter(
            $userRepository->findAll(),
            fn($user) => in_array('ROLE_STUDENT', $user->getRoles())
        );

        return $this->render('overview/index.html.twig', [
            'students' => $students
        ]);
    }
}