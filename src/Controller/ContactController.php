<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact', methods: ["GET","POST"])]
    public function index(Request $request, MailerInterface $mailer): Response
    {

        $contact = new Contact;
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $email = (new TemplatedEmail())
              ->from($contact->getEmail())
              ->to('johnhypnos@example.com')
              ->subject($contact->getSubject())
              ->htmlTemplate('emails/contact.html.twig')
              ->context([
                  'subject' => $contact->getSubject(),
                  'mail' => $contact->getEmail(),
                  'message' => $contact->getMessage()
              ]);
              $mailer->send($email);

              $this->addFlash('success', 'Votre e-mail a bien été envoyé');
              return $this->redirectToRoute('app_home');
        }
        return $this->render('emails/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
