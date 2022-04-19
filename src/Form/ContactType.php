<?php

namespace App\Form;

use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('subject', TypeTextType::class)
            ->add('email', EmailType::class)
            ->add('subject', ChoiceType::class, [
            'choices' => [
                'Je souhaite poser une réclamation' => 'preparation',
                'Je souhaite commander un service suplémentaire' => 'started',
                'Je souhaite en savoir plus sur un suite' => 'finished',
                'J\'ai un souci avec cette application' => 'failed']    
             ])
            ->add('message', TextEditorType::class)

            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
