<?php

namespace App\Controller;

use DateTime;
use App\Entity\Suite;
use App\Entity\Booking;
use App\Entity\Establishement;
use App\Form\BookingType;
use App\Repository\SuiteRepository;
use App\Repository\BookingRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EstablishementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/booking')]
#[IsGranted("ROLE_USER")]
class BookingController extends AbstractController
{
    
    #[Route('', name: 'app_booking')]
    public function index(BookingRepository $bookingRepo): Response
    {
        $user = $this->getUser();
        $bookings = $bookingRepo->findBy(['user' => $user]);
        

        return $this->render('booking/index.html.twig', [
            'bookings' => $bookings
        ]);
    }

    #[Route('/{id<[0-9]+>}', name: 'app_booking_show', methods: 'get')]
    public function show(Booking $booking): Response
    {

        return $this->render('booking/show.html.twig', [
            'booking' => $booking
        ]);
    }

    #[Route('/create', name: 'app_booking_create')]
    public function create(Request $request, EntityManagerInterface $em,  EstablishementRepository $establishementRepo, SuiteRepository $suiteRepo): Response
    {
        
        $user = $this->getUser();

        $booking = new Booking;
        $booking->setUser($user);
    
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
            'form' => $form->createView(),
        
        ]);
    }



    #[Route('delete/{id<[0-9]+>}', name: 'app_booking_delete', methods: 'DELETE')]
    public function delete(Request $request, Booking $booking, EntityManagerInterface $em): RedirectResponse
    { 
                
        $submittedToken = $request->request->get('csrf_token');
        if ($this->isCsrfTokenValid('booking_delete_', $submittedToken)) {

           $em->remove($booking);
            
            $em->flush();

            $this->addFlash('success', 'Votre réservation a bien été annulée');

            return $this->redirectToRoute('app_booking');
        }
    }
    }
    

