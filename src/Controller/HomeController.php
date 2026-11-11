<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Vak;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

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
    #[Route('/Profiel', name: 'app_profile')]
    public function profiel(): Response
    {
        return $this->render('home/profile.html.twig');
    }
    #[Route('/Profiel/Update/{id}', name: 'app_profile_update')]
    public function update(EntityManagerInterface $entityManager, Request $request, int $id ): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Je gegevens zijn bijgewerkt');
            return $this->redirectToRoute('app_profile');
        }
        return $this->render('home/profileupdate.html.twig',[
            'form' => $form
        ]);
    }
}
