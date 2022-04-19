<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mime\Email;
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

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();
            $email = (new TemplatedEmail())
              ->from($contactFormData['email'])
              ->to('theoxav971@outlook.fr@')
              ->subject($contactFormData['subject'])
              ->htmlTemplate('emails/contact.html.twig')
              ->context([
                  'subject' => $contactFormData['subject'],
                  'mail' => $contactFormData['email'],
                  'message' => $contactFormData['message']
              ]);
              $mailer->send($email);

              $this->addFlash('success', 'Votre e-mai a bien été envoyé');
              return $this->redirectToRoute('app_home');
        }
        return $this->render('emails/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
