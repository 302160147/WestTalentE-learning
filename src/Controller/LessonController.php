<?php

namespace App\Controller;

use App\Repository\LessonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LessonController extends AbstractController
{
    #[Route('/lesson/{id}', name: 'app_lesson')]
    public function index(int $id, LessonRepository $lessonRepository): Response
    {
        $lesson = $lessonRepository->find($id);

        if (!$lesson) {
            throw $this->createNotFoundException('Lesson not found');
        }

        return $this->render('lesson/index.html.twig', [
            'lesson' => $lesson,
        ]);
    }
}