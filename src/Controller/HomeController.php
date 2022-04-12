<?php

namespace App\Controller;

use App\Repository\EstablishementRepository;
use App\Repository\ServiceHotelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EstablishementRepository $establishementRepo, ServiceHotelRepository $servicesRepo): Response
    {
        $establishements = $establishementRepo->findByIsBest(1);
        $services = $servicesRepo->findAll();
       
        return $this->render('home/index.html.twig', [
            'establishements' => $establishements,
            'services' => $services
        ]);
    }
}
