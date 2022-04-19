<?php

namespace App\Controller\Admin;

use App\Entity\Establishement;
use App\Entity\User;
use App\Entity\Suite;
use Doctrine\ORM\QueryBuilder;
use App\Repository\SuiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EstablishementRepository;
use Symfony\Component\Security\Core\Security;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SuiteCrudController extends AbstractCrudController
{ public function __construct(private Security $security, private EntityRepository $entityRepo){}
 
    public const SUITES_BASE_PATH = 'uploads/images/suites';
    public const SUITES_UPLOAD_DIR = 'public/uploads/images/suites';

  
     public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        if($this->security->isGranted('ROLE_ADMIN')) {
            $response = $this->entityRepo->createQueryBuilder($searchDto, $entityDto, $fields, $filters);
           
            return $response;
        }
        else {
            $userId = $this->getUser()->getId();

            $response = $this->entityRepo->createQueryBuilder($searchDto, $entityDto, $fields, $filters);
            $response->andWhere('entity.user = :userId')->setParameter('userId', $userId);

            return $response;
        }
       
    }
 
 
    public static function getEntityFqcn(): string
    {
        return Suite::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
      yield AssociationField::new('establishement')
      ->setPermission('ROLE_ADMIN');
      yield TextField::new('name');
          
      yield TextEditorField::new('description');
         
      yield MoneyField::new('price')->setCurrency('EUR');
           
      yield ImageField::new('illustration')
            ->setBasePath(self::SUITES_BASE_PATH)
            ->setUploadDir(self::SUITES_UPLOAD_DIR)
            ->setRequired(false);
         
      yield TextEditorField::new('description');
         
      yield DateTimeField::new('created_at')->hideOnForm();
          
      yield DateTimeField::new('updated_at')->hideOnForm();
    }
    
}
