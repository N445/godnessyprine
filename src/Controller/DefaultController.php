<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'HOMEPAGE')]
    public function index(): Response
    {
        return $this->render('default/homepage.html.twig', [
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
        ]);
    }

    #[Route('/quelques-idees-partagees', name: 'IDEAS')]
    public function ideas(): Response
    {
        return $this->render('default/ideas.html.twig', [
        ]);
    }
}
