<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           ->add('fullName', TextType::class, [
               'attr' => [
                   'minlenght' => '2',
                   'maxlenght' => '50'
               ],
               'label' => 'Nom / Prénom'
           ])
            ->add('email', EmailType::class,  [
               'attr' => [
                   'minlenght' => '2',
                   'maxlenght' => '50'
                ]
               ])
            ->add('subject', ChoiceType::class, [
            'choices' => [
                'Je souhaite poser une réclamation' => 'Je souhaite poser une réclamation',
                'Je souhaite commander un service suplémentaire' => 'Je souhaite commander un service suplémentaire',
                'Je souhaite en savoir plus sur un suite' => 'Je souhaite en savoir plus sur un suite',
                'J\'ai un souci avec cette application' => 'J\'ai un souci avec cette application']    
             ])
            ->add('message', TextEditorType::class,  [
               'attr' => [
                   'minlenght' => '20',
                ]
               ])

            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class' => Contact::class
        ]);
    }
}
