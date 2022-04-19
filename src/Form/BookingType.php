<?php

namespace App\Form;

use App\Entity\Suite;
use App\Entity\Booking;
use App\Entity\Establishement;
use App\Repository\SuiteRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use App\Repository\EstablishementRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('establishement', EntityType::class, [
                'class' => Establishement::class,
                'label' => 'Etablissement',
                'choice_label' => function($establishement) {
                    return $establishement->getCity().'- '.$establishement->getName();
                },
                'placeholder' => 'choisissez un etablissement',
                'query_builder' => function(EstablishementRepository $establishementRepo) {
                    return $establishementRepo->createQueryBuilder('e')->orderBy('e.name', 'ASC');
                },
                'constraints' => new NotBlank(['message' => 'Choisissez un etablissement'])
            ])
            ->add('suite', EntityType::class, [
                'class' => Suite::class,
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'bg-light'
                ],
                'disabled' => true,
                'placeholder' => 'Choisissez une suite',
            'query_builder' => function (SuiteRepository $suiteRepo) {
                return $suiteRepo->createQueryBuilder('s')->orderBy('s.name', 'ASC');
            },
            'constraints' => new NotBlank(['message' => 'Choisissez une suite'])
        
            ])
            ->add('start', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de début'
                
            ])
            ->add('end', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de Fin'
            ])

         ;

         $formModifier = function(FormInterface $form, Establishement $establishement = null) {
            $suite = (null === $establishement) ? [] : $establishement->getSuites();

            $form->add('suite', EntityType::class, [
                'class' => Suite::class,
                'choices' => $suite,
                'choice_label' => 'name',
                'placeholder' => 'Suite(Choisissez un etablissement )',
                'label' => 'Suite'
            ]);
         };

         // Listener Establishement
         $builder->get('establishement')->addEventListener(
             FormEvents::POST_SUBMIT,
             function(FormEvent $event) use($formModifier) {
                $establishement = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $establishement);
              }
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
