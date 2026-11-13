<?php

namespace App\Controller;

use App\Entity\Submission;
use App\Form\SubmissionType;
use App\Repository\LessonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class LessonController extends AbstractController
{
    #[Route('/lesson/{id}', name: 'app_lesson')]
    public function index(int $id, LessonRepository $lessonRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        $lesson = $lessonRepository->find($id);
        $submission = new Submission();
        $form = $this->createForm(SubmissionType::class, $submission);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()->$form->isSubmitted())   {
            $submission = $form->getData();
            $entityManager->persist($submission);
            $entityManager->flush();
        }
        if (!$lesson) {
            throw $this->createNotFoundException('Lesson not found');
        }

        return $this->render('lesson/index.html.twig', [
            'lesson' => $lesson,
            'form' => $form
        ]);
    }
}
