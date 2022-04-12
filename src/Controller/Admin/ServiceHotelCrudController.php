<?php

namespace App\Controller\Admin;

use App\Entity\ServiceHotel;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ServiceHotelCrudController extends AbstractCrudController
{
    public const SERVICES_BASE_PATH = 'uploads/images/services';
    public const SERVICES_UPLOAD_DIR = 'public/uploads/images/services';
    
    public static function getEntityFqcn(): string
    {
        return ServiceHotel::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud    
            ->setEntityPermission('ROLE_ADMIN');
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title');

        yield TextEditorField::new('description');

        yield ImageField::new('illustration')
        ->setBasePath(self::SERVICES_BASE_PATH)
            ->setUploadDir(self::SERVICES_UPLOAD_DIR)
            ->setRequired(false);

        yield TextEditorField::new('description');

        yield DateTimeField::new('created_at')->hideOnForm();

        yield DateTimeField::new('updated_at')->hideOnForm();
    }
    
}
