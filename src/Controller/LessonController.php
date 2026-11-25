<?php

namespace App\Controller;

use App\Entity\Assignment;
use App\Entity\Lesson;
use App\Entity\Studentprogress;
use App\Entity\Submission;
use App\Entity\User;
use App\Form\SubmissionJType;
use App\Form\SubmissionOType;
use App\Form\SubmissionType;
use App\Repository\LessonRepository;
use App\Repository\StudentprogressRepository;
use App\Repository\SubmissionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class LessonController extends AbstractController
{
    #[Route('/lesson/{id}', name: 'app_lesson')]
    public function index(int $id, LessonRepository $lessonRepository, EntityManagerInterface $entityManager): Response
    {
        $lesson = $lessonRepository->find($id);
        if (!$lesson) {
            throw $this->createNotFoundException('Lesson not found');
        }

        return $this->render('lesson/index.html.twig', [
            'lesson' => $lesson,
            'submissions' => $entityManager->getRepository(Submission::class)->findAll(),
        ]);
    }

    #[Route('/lesson/opdracht/{id}', name: 'app_opdracht')]
    public function opdracht(
        EntityManagerInterface $entityManager,
        StudentprogressRepository $studentprogressRepository,
        SubmissionRepository $submissionRepository,
        int $id,
        Request $request
    ): Response {
        $assignment = $entityManager->getRepository(Assignment::class)->find($id);
        if (!$assignment instanceof Assignment || !$assignment->getLesson() instanceof Lesson) {
            throw $this->createNotFoundException('Assignment not found');
        }

        $user = $this->getUser();
        if (!$user instanceof User) {
            return $this->redirectToRoute('app_login');
        }

        $lesson = $assignment->getLesson();
        if ($submissionRepository->findOneBy(['user' => $user, 'assignment' => $assignment])) {
            $this->addFlash('info', 'You have already completed this assignment.');

            return $this->redirectToRoute('app_lesson', ['id' => $lesson->getId()]);
        }

        $submission = (new Submission())->setAssignment($assignment);
        $formType = match ($assignment->getQuestionType()) {
            'Meerkeuze vraag' => SubmissionType::class,
            'Juist onjuist vraag' => SubmissionJType::class,
            'Open vraag' => SubmissionOType::class,
            default => throw $this->createNotFoundException('Unsupported assignment type'),
        };
        $form = $this->createForm($formType, $submission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $submission = $form->getData();
            $submission
                ->setUser($user)
                ->setAssignment($assignment)
                ->setLesson($lesson)
                ->setSubmittedAt(new \DateTimeImmutable());

            $module = $lesson->getModule();
            if (
                $module
                && $user->getNiveau()
                && $module->getNiveau()?->getId() === $user->getNiveau()->getId()
                && in_array('ROLE_STUDENT', $user->getRoles(), true)
            ) {
                $completedLessons = $submissionRepository->countCompletedLessonsForUserAndModule($user, $module);
                if ($submissionRepository->countForUserAndLesson($user, $lesson) === 0) {
                    ++$completedLessons;
                }

                foreach ($user->getNiveau()->getModules() as $progressModule) {
                    $progress = $studentprogressRepository->findOneBy([
                        'user' => $user,
                        'module' => $progressModule,
                    ]);

                    if (!$progress) {
                        $progress = (new Studentprogress())
                            ->setUser($user)
                            ->setModule($progressModule)
                            ->setLesson(null)
                            ->setCompletedLesson(0)
                            ->setTotalLessons($progressModule->getLessons()->count())
                            ->setStatus('Nog niet gestart');
                    }

                    $totalLessons = $progressModule->getLessons()->count();
                    $wasApproved = $progress->getStatus() === 'Goedgekeurd';
                    $progress->setTotalLessons($totalLessons);

                    if ($progressModule->getId() === $module->getId()) {
                        $progress
                            ->setLesson($lesson)
                            ->setCompletedLesson(min($completedLessons, $totalLessons));

                        if (!$wasApproved) {
                            $progress->setStatus(
                                $totalLessons > 0 && $completedLessons >= $totalLessons
                                    ? 'Voltooid'
                                    : 'Bezig'
                            );
                        }
                    }

                    $entityManager->persist($progress);
                }
            }

            $entityManager->persist($submission);
            $entityManager->flush();

            $this->addFlash('success', 'Opdracht verstuurd.');

            return $this->redirectToRoute('app_lesson', ['id' => $lesson->getId()]);
        }

        return $this->render('lesson/opdracht.html.twig', [
            'form' => $form,
            'assignment' => $assignment,
            'lesson' => $lesson,
        ]);
    }
    #[Route('/lesson/feedback/{id}', name: 'app_lesson_feedback')]
    public function feedback(int $id, EntityManagerInterface $entityManager, Request $request): Response
    {

        $submissions = $entityManager->getRepository(Submission::class)->find($id);
        $assignment = $submissions->getAssignment();
//        $user = $this->getUser();
//        $submitted = $entityManager->getRepository(Submission::class)->findOneBy(['user' => $user, 'assignment' => $assignment]);

//        if (!$submitted) {
//            $this->addFlash('info', 'Je moet eerst deze vraag nog maken.');
//            return $this->redirectToRoute('app_lesson', ['id' => $assignment->getLesson()->getId()]);
//        }

        return $this->render('lesson/feedback.html.twig', [
            'assignments' => $assignment,
            'submissions' => $submissions,

        ]);
    }
}
