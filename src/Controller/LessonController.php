<?php

namespace App\Controller;

use App\Entity\Page;
use App\Entity\Submission;
use App\Form\SubmissionType;
use App\Repository\LessonRepository;
use App\Repository\PageRepository;
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
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST') )  {
            $submission = $form->getData();
            $entityManager->persist($submission);
            $entityManager->flush();
        }
        if (!$lesson) {
            throw $this->createNotFoundException('Lesson not found');
        }

        return $this->render('lesson/index.html.twig', [
            'lesson' => $lesson,
            'submissionform' => $form
        ]);
    }
    #[Route('/lesson/opdracht/{id}', name: 'app_opdracht')]
    public function submission(EntityManagerInterface $entityManager, int $id): Response
    {
        $page = $entityManager->getRepository(Page::class)->find($id);
        return $this->render('lesson/opdracht.html.twig',[
            'page' => $page,
        ]);
    }
}

