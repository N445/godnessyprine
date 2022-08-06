<?php

namespace App\Controller;

use App\Repository\SiropRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    private SiropRepository $siropRepository;

    public function __construct(
        SiropRepository $siropRepository
    )
    {
        $this->siropRepository = $siropRepository;
    }

    #[Route('/', name: 'HOMEPAGE')]
    public function index(): Response
    {
        return $this->render('default/homepage.html.twig', [
            'sirops' => $this->siropRepository->allByDisplayOrder(),
        ]);
    }

    #[Route('/viens-je-te-dis-tout', name: 'ABOUT')]
    public function about(): Response
    {
        return $this->render('default/about.html.twig', [
        ]);
    }

    #[Route('/contacte-les-deesses', name: 'CONTACT')]
    public function contact(): Response
    {
        return $this->render('default/contact.html.twig', [
        ]);
    }

    #[Route('/boutique', name: 'SHOP')]
    public function shop(): Response
    {
        return $this->render('default/shop.html.twig', [
            'sirops' => $this->siropRepository->allByDisplayOrder(),
        ]);
    }

    #[Route('/sirop/{slug}', name: 'SIROP_SHOW')]
    public function siropShow(string $slug): Response
    {
        if (!$sirop = $this->siropRepository->getOneBySlug($slug)) {
            return $this->redirectToRoute('SHOP');
        }
        return $this->render('default/sirop-show.html.twig', [
            'sirop' => $sirop,
        ]);
    }

    #[Route('/quelques-idees-partagees', name: 'IDEAS')]
    public function ideas(): Response
    {
        return $this->render('default/ideas.html.twig', [
        ]);
    }
}
