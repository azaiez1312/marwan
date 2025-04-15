<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    // Route for the homepage (index.html.twig)
    #[Route('/', name: 'index')]
    public function index()
    {
        return $this->render('index.html.twig');
    }
    #[Route('/resident', name: 'resident')]
    public function resident()
    {
        return $this->render('resident.html.twig');
    }
    

}
