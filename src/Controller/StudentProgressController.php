<?php

namespace App\Controller;

use App\Repository\StudentprogressRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StudentProgressController extends AbstractController
{
    #[Route('/student/progress', name: 'app_student_progress')]
    public function index(StudentprogressRepository $studentprogressRepository): Response
    {
        $studentProgresses = $studentprogressRepository->findAll();

        return $this->render('student_progress/index.html.twig', [
            'studentProgresses' => $studentProgresses,
        ]);
    }
}