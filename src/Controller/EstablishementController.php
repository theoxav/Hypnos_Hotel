<?php

namespace App\Controller;

use App\Repository\EstablishementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EstablishementController extends AbstractController
{
    #[Route('/establishement', name: 'app_establishement')]
    public function index(EstablishementRepository $establishementRepo): Response
    {
        $establishements = $establishementRepo->findAll();
        
        return $this->render('establishement/index.html.twig', [
            'establishements' => $establishements
        ]);
    }
}
