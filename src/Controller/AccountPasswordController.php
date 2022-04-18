<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/account')]
#[IsGranted("ROLE_USER")]
class AccountPasswordController extends AbstractController
{
    #[Route('/password-update', name: 'app_account_password')]
    public function index(Request $request, UserPasswordHasherInterface $encoder, EntityManagerInterface $em): Response
    {
        
        // On recupère l'utilisateur courant
        $user = $this->getUser();

        // Remplissage du form avec les données de l'user
        $form = $this->createForm( ChangePasswordType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
           
            // On recupere l'ancien mots de passe 
            $old_password = $form->get('old_password')->getData();
            
            //comparaison ancien / nouveau mot de passe
            if($encoder->isPasswordValid($user,$old_password)) {
              
                $new_pwd = $form->get('new_password')->getData();
              
                //Hash nouveau mot de passe
                $password = $encoder->hashPassword($user, $new_pwd);

                $user->setPassword($password);
            
                $em->flush();
                $this->addFlash('success', "Votre password a été modifié avec succés");
            } else {
                $this->addFlash('error', "Le mot de passe actuel n'est pas correct ");
            }
        }

        return $this->render('account/password.html.twig', [
            'form' => $form->createView(),
        
        ]);
    }
}