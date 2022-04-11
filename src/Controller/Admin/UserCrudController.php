<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher, private EntityRepository $entityRepo ){}
   
    
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    // Permet de ne pas afficher l'utilisateur courant 
    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $userId = $this->getUser()->getId();

        $response = $this->entityRepo->createQueryBuilder($searchDto, $entityDto, $fields, $filters);
        $response->andWhere('entity.id != :userId')->setParameter('userId', $userId);

        return $response;
    }
    
    public function configureFields(string $pageName): iterable
    {
    
           yield TextField::new('firstName');
           yield TextField::new('lastName');

           yield EmailField::new('email');

           yield TextField::new('password')->onlyOnForms()
             ->setFormType(PasswordType::class);
            
           yield ChoiceField::new('roles')
             ->allowMultipleChoices()
             ->renderAsBadges([
                 'ROLE_ADMIN' => 'success',
                 'MANAGER' => 'warning'
             ])
             ->setChoices([
                 'Administrator' => 'ROLE_ADMIN',
                 'Manager' => 'ROLE_MANAGER'
             ]) ;

            yield DateTimeField::new('created_at')->hideOnForm();
            yield DateTimeField::new('updated_at')->hideOnForm();

        
    }

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        $user = $entityInstance;

        $plainPassword = $user->getPassword();
        $hashPassword = $this->passwordHasher->hashPassword($user, $plainPassword);

        $user->setPassword($hashPassword);

        parent::persistEntity($em, $user);
    }
    
}
