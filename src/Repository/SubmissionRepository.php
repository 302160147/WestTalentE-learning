<?php

namespace App\Repository;

use App\Entity\Lesson;
use App\Entity\Module;
use App\Entity\Niveau;
use App\Entity\Submission;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Submission>
 */
class SubmissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Submission::class);
    }

    public function countCompletedLessonsForUserAndModule(User $user, Module $module): int
    {
        return (int) $this->createQueryBuilder('submission')
            ->select('COUNT(DISTINCT lesson.id)')
            ->innerJoin('submission.lesson', 'lesson')
            ->andWhere('submission.user = :user')
            ->andWhere('lesson.module = :module')
            ->setParameter('user', $user)
            ->setParameter('module', $module)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countForUserAndLesson(User $user, Lesson $lesson): int
    {
        return (int) $this->count(['user' => $user, 'lesson' => $lesson]);
    }

    /**
     * @return list<string>
     */
    public function findCompletedAssignmentIdsForUserAndModule(User $user, Module $module): array
    {
        $rows = $this->createQueryBuilder('submission')
            ->select('DISTINCT assignment.id AS assignmentId')
            ->innerJoin('submission.assignment', 'assignment')
            ->innerJoin('assignment.lesson', 'lesson')
            ->andWhere('submission.user = :user')
            ->andWhere('lesson.module = :module')
            ->setParameter('user', $user)
            ->setParameter('module', $module)
            ->getQuery()
            ->getScalarResult();

        return array_map(
            static fn (array $row): string => (string) $row['assignmentId'],
            $rows
        );
    }

    /**
     * @return list<string>
     */
    public function findCompletedAssignmentIdsForUserAndNiveau(User $user, Niveau $niveau): array
    {
        $rows = $this->createQueryBuilder('submission')
            ->select('DISTINCT assignment.id AS assignmentId')
            ->innerJoin('submission.assignment', 'assignment')
            ->innerJoin('assignment.lesson', 'lesson')
            ->innerJoin('lesson.module', 'module')
            ->andWhere('submission.user = :user')
            ->andWhere('module.niveau = :niveau')
            ->setParameter('user', $user)
            ->setParameter('niveau', $niveau)
            ->getQuery()
            ->getScalarResult();

        return array_map(
            static fn (array $row): string => (string) $row['assignmentId'],
            $rows
        );
    }

//    /**
//     * @return Submission[] Returns an array of Submission objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Submission
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
