<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Studentprogress;
use App\Repository\StudentprogressRepository;
use App\Repository\SubmissionRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StudentProgressController extends AbstractController
{
    #[Route('/student/progress', name: 'app_student_progress')]
    public function index(UserRepository $userRepository): Response
    {
        $this->denyUnlessTeacherOrAdmin();

        $studentRows = array_map(
            static fn (User $student): array => [
                'student' => $student,
                'niveau' => $student->getNiveau(),
            ],
            array_values(array_filter(
                $userRepository->findAll(),
                static fn (User $user): bool => in_array('ROLE_STUDENT', $user->getRoles(), true)
            ))
        );

        return $this->render('student_progress/index.html.twig', [
            'studentRows' => $studentRows,
        ]);
    }

    #[Route('/student/progress/{studentId}', name: 'app_student_progress_detail', methods: ['GET'])]
    public function detail(
        int $studentId,
        UserRepository $userRepository,
        StudentprogressRepository $studentprogressRepository,
        SubmissionRepository $submissionRepository
    ): Response {
        $this->denyUnlessTeacherOrAdmin();

        $student = $userRepository->find($studentId);
        if (!$student || !in_array('ROLE_STUDENT', $student->getRoles(), true)) {
            throw $this->createNotFoundException('Student not found.');
        }

        $niveau = $student->getNiveau();
        $progressByModule = [];
        foreach ($studentprogressRepository->findBy(['user' => $student]) as $progress) {
            if ($progress->getModule()) {
                $progressByModule[$progress->getModule()->getId()] = $progress;
            }
        }

        $studentModules = [];
        foreach ($niveau?->getModules() ?? [] as $module) {
            $completedAssignmentIds = array_fill_keys(
                $submissionRepository->findCompletedAssignmentIdsForUserAndModule($student, $module),
                true
            );
            $moduleLessons = [];
            $completedLessonCount = 0;

            foreach ($module->getLessons() as $lesson) {
                $lessonAssignments = [];
                foreach ($lesson->getAssignments() as $assignment) {
                    $isCompleted = isset($completedAssignmentIds[(string) $assignment->getId()]);
                    if ($isCompleted) {
                        $lessonAssignments[] = [
                            'question' => $assignment->getQuestion(),
                            'completed' => true,
                        ];
                    } else {
                        $lessonAssignments[] = [
                            'question' => $assignment->getQuestion(),
                            'completed' => false,
                        ];
                    }
                }

                $lessonCompleted = $submissionRepository->countForUserAndLesson($student, $lesson) > 0;
                if ($lessonCompleted) {
                    ++$completedLessonCount;
                }

                $moduleLessons[] = [
                    'lesson' => $lesson,
                    'completed' => $lessonCompleted,
                    'assignments' => $lessonAssignments,
                    'completedAssignments' => count(array_filter(
                        $lessonAssignments,
                        static fn (array $assignment): bool => $assignment['completed']
                    )),
                ];
            }

            $totalLessons = count($moduleLessons);
            $progress = $progressByModule[$module->getId()] ?? null;
            $studentModules[] = [
                'module' => $module,
                'lessons' => $moduleLessons,
                'completed' => $completedLessonCount,
                'total' => $totalLessons,
                'percentage' => $totalLessons > 0 ? (int) round($completedLessonCount / $totalLessons * 100) : 0,
                'status' => $progress?->getStatus() ?? 'Nog niet gestart',
                'completedAssignments' => count($completedAssignmentIds),
                'totalAssignments' => array_sum(array_map(
                    static fn (array $item): int => count($item['assignments']),
                    $moduleLessons
                )),
            ];
        }

        return $this->render('student_progress/detail.html.twig', [
            'student' => $student,
            'studentModules' => $studentModules,
        ]);
    }

    #[Route('/student/progress/{studentId}/status', name: 'app_student_progress_status', methods: ['POST'])]
    public function updateStatus(
        int $studentId,
        Request $request,
        UserRepository $userRepository,
        ModuleRepository $moduleRepository,
        StudentprogressRepository $studentprogressRepository,
        EntityManagerInterface $entityManager
    ): Response {
        $this->denyUnlessTeacherOrAdmin();

        $student = $userRepository->find($studentId);
        $module = $moduleRepository->find($request->request->getInt('moduleId'));
        $status = $request->request->get('status');
        $token = $request->request->get('_token');

        if (
            !$student
            || !in_array('ROLE_STUDENT', $student->getRoles(), true)
            || !$module
            || $student->getNiveau()?->getId() !== $module->getNiveau()?->getId()
        ) {
            throw $this->createNotFoundException('Student or module not found.');
        }

        if (!$this->isCsrfTokenValid('progress-status-' . $studentId, is_string($token) ? $token : '')) {
            throw $this->createAccessDeniedException('Invalid CSRF token.');
        }

        $allowedStatuses = ['Nog niet gestart', 'Bezig', 'Voltooid', 'Goedgekeurd'];
        if (!is_string($status) || !in_array($status, $allowedStatuses, true)) {
            throw new BadRequestHttpException('Invalid progress status.');
        }

        $progress = $studentprogressRepository->findOneBy([
            'user' => $student,
            'module' => $module,
        ]);

        if (!$progress) {
            $progress = (new Studentprogress())
                ->setUser($student)
                ->setModule($module)
                ->setCompletedLesson(0)
                ->setTotalLessons($module->getLessons()->count());
        }

        $progress->setStatus($status);
        $entityManager->persist($progress);
        $entityManager->flush();

        $this->addFlash('success', 'Voortgangsstatus bijgewerkt.');

        return $this->redirectToRoute('app_student_progress_detail', ['studentId' => $studentId]);
    }

    private function denyUnlessTeacherOrAdmin(): void
    {
        if (!$this->isGranted('ROLE_TEACHER') && !$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException();
        }
    }
}
