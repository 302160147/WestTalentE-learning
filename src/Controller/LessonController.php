<?php

namespace App\Controller;

use App\Entity\Assignment;
use App\Entity\Submission;
use App\Form\SubmissionType;
use App\Form\SubmissionJType;
use App\Form\SubmissionOType;
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
        $submissions = $entityManager->getRepository(Submission::class)->findAll();
        if (!$lesson) {
            throw $this->createNotFoundException('Lesson not found');
        }

        return $this->render('lesson/index.html.twig', [
            'lesson' => $lesson,
            'submissions' => $submissions,

        ]);
    }
    #[Route('/lesson/opdracht/{id}', name: 'app_opdracht')]
    public function opdracht(EntityManagerInterface $entityManager, int $id, Request $request): Response
    {
        $submission = new Submission();
        $assignments = $entityManager->getRepository(Assignment::class)->find($id);
        $lesson = $assignments->getLesson();
        $submission->setAssignment($assignments);
        $user = $this->getUser(); $submittedAt = new \DateTimeImmutable();
        $form = $this->createForm(SubmissionType::class, $submission);
        $formJ = $this->createForm(SubmissionJType::class, $submission);
        $formO = $this->createForm(SubmissionOType::class, $submission);
        $form->get('submittedAt')->setData($submittedAt); $form->get('user')->setData($user); $form->get('assignment')->setData($assignments); $form->get('lesson')->setData($lesson);
        $formJ->get('submittedAt')->setData($submittedAt); $formJ->get('user')->setData($user); $formJ->get('assignment')->setData($assignments); $formJ->get('lesson')->setData($lesson);
        $formO->get('submittedAt')->setData($submittedAt); $formO->get('user')->setData($user); $formO->get('assignment')->setData($assignments); $formO->get('lesson')->setData($lesson);


        $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST') ) {
                $submission = $form->getData();
                if ($submission->getUser()->getId() == $user->getId() && $submission->getLesson()->getId() == $lesson->getId() && $submission->getAssignment()->getId() == $assignments->getId()) {
                    $entityManager->persist($submission);
                    $entityManager->flush();
                    $this->addFlash('success', 'Opdracht verstuurd.');

                    return $this->redirectToRoute('app_lesson', ['id' => $assignments->getLesson()->getId()]);
                } else {
                    $this->addFlash('danger', 'Bewerk dingen niet in inspect element!');
                    return $this->redirectToRoute('app_lesson', ['id' => $assignments->getLesson()->getId()]);
                }
            }
        $formJ->handleRequest($request);
        if ($formJ->isSubmitted() && $formJ->isValid() && $request->isMethod('POST') ) {
            $submission = $form->getData();
            if ($submission->getUser()->getId() == $user->getId() && $submission->getLesson()->getId() == $lesson->getId() && $submission->getAssignment()->getId() == $assignments->getId()) {
                $entityManager->persist($submission);
                $entityManager->flush();
                $this->addFlash('success', 'Opdracht verstuurd.');

                return $this->redirectToRoute('app_lesson', ['id' => $assignments->getLesson()->getId()]);
            } else {
                $this->addFlash('danger', 'Bewerk dingen niet in inspect element!');
                return $this->redirectToRoute('app_lesson', ['id' => $assignments->getLesson()->getId()]);
            }
        }
        $formO->handleRequest($request);
        if ($formO->isSubmitted() && $formO->isValid() && $request->isMethod('POST') ) {
            $submission = $form->getData();
            if ($submission->getUser()->getId() == $user->getId() && $submission->getLesson()->getId() == $lesson->getId() && $submission->getAssignment()->getId() == $assignments->getId()) {
                $entityManager->persist($submission);
                $entityManager->flush();
                $this->addFlash('success', 'Opdracht verstuurd.');

                return $this->redirectToRoute('app_lesson', ['id' => $assignments->getLesson()->getId()]);
            } else {
                $this->addFlash('danger', 'Bewerk dingen niet in inspect element!');
                return $this->redirectToRoute('app_lesson', ['id' => $assignments->getLesson()->getId()]);
            }
        }
        return $this->render('lesson/opdracht.html.twig',[
            'form' => $form,
            'formJ' => $formJ,
            'formO' => $formO,
            'assignment' => $assignments,
            'lesson' => $lesson
        ]);
    }
}

