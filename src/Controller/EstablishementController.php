<?php

namespace App\Controller;

use App\Entity\Establishement;
use App\Repository\SuiteRepository;
use App\Repository\EstablishementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    #[Route('/establishement/{id<[0-9]+>}', name: 'app_establishement_show')]
    public function show(Establishement $establishement ,SuiteRepository $suiteRepo): Response
    {
        $suites = $suiteRepo->findByEstablishement('id');
        
        return $this->render('establishement/show.html.twig', [
            'establishement' => $establishement,
            
        ]);
    }

    #[Route('/establishement/manager', name: 'app_establishement_manager')]
    #[IsGranted("ROLE_MANAGER")]
    public function establishementManager(EstablishementRepository $establishementRepo): Response
    {
        $user = $this->getUser();
        $establishement = $establishementRepo->findBy(['user' => $user]);


        return $this->render('establishement/manager/index.html.twig', [
            'establishement' => $establishement
        ]);
    }
}
