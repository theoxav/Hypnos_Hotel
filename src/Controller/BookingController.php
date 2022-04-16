<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/booking')]
class BookingController extends AbstractController
{
    
    #[Route('', name: 'app_account_password')]
    public function index(): Response
    {
        return $this->render('booking/index.html.twig', [
            'controller_name' => 'BookingController',
        ]);
    }

    #[Route('/create', name: 'app_booking_create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $user = $this->getUser();
        $booking = new Booking;

        $form = $this->createForm(BookingType::class,$booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $booking->setUser($user);

            $em->persist($booking);
            $em->flush();

            $this->addFlash('success', 'Réservation effectuée');

            return $this->redirectToRoute('app_home');
        }
        return $this->render('booking/create.html.twig', [
            'form' => $form->createView()
        ]);

  
    }
}
