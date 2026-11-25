<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Vak;
use App\Form\UserType;
use App\Repository\SubmissionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $vakken = $entityManager->getRepository(Vak::class)->findAll();
        return $this->render('home/home.html.twig',[
        'vakken' => $vakken,
    ]);
    }

    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/Profiel', name: 'app_profile')]
    public function profiel(SubmissionRepository $submissionRepository): Response
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            return $this->redirectToRoute('app_login');
        }

        $niveau = $user->getNiveau();
        $modules = $niveau?->getModules()->toArray() ?? [];
        $completedAssignmentIds = $niveau === null
            ? []
            : $submissionRepository->findCompletedAssignmentIdsForUserAndNiveau($user, $niveau);

        return $this->render('home/profile.html.twig', [
            'modules' => $modules,
            'completedAssignmentIds' => array_fill_keys($completedAssignmentIds, true),
        ]);
    }
    #[Route('/Profiel/Update/{id}', name: 'app_profile_update')]
    public function update(
        EntityManagerInterface $entityManager,
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        int $id
    ): Response
    {
        $currentUser = $this->getUser();
        if (!$currentUser instanceof User) {
            return $this->redirectToRoute('app_login');
        }

        if ($currentUser->getId() !== $id) {
            throw $this->createAccessDeniedException('You can only edit your own profile.');
        }

        $user = $entityManager->getRepository(User::class)->find($id);
        if (!$user instanceof User) {
            throw $this->createNotFoundException('User not found.');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $plainPassword = $form->get('password')->getData();
            if ($plainPassword) {
                $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));
            }
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Je gegevens zijn bijgewerkt');
            return $this->redirectToRoute('app_profile');
        }
        return $this->render('home/profileupdate.html.twig',[
            'form' => $form,
        ]);
    }
}
