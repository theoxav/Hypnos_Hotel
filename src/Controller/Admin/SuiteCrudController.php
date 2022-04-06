<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Suite;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SuiteCrudController extends AbstractCrudController
{
 
    public const SUITES_BASE_PATH = 'uploads/images/suites';
    public const SUITES_UPLOAD_DIR = 'public/uploads/images/suites';

    public static function getEntityFqcn(): string
    {
        return Suite::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        
          yield AssociationField::new('establishement', 'Name of the establishment');
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
