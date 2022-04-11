<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Product;
use App\Entity\Category;
use App\Controller\Admin\UserCrudController;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\ProductCrudController;
use App\Entity\Establishement;
use App\Entity\Suite;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {    
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        
    
    
        $controller = $this->isGranted('ROLE_ADMIN') ? UserCrudController::class : SuiteCrudController::class;
        $url = $this->adminUrlGenerator
            ->setController($controller)
            ->generateUrl();

        return $this->redirect($url);
    }

    

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Hypnos Hotel')
            ;
            
    }

    public function configureMenuItems(): iterable
    {
       if($this->isGranted('ROLE_ADMIN')) {
       
        yield MenuItem::section('Users','fas fa_user')
        ->setCssClass('text-warning');
    
        yield MenuItem::subMenu('Actions','fas fa-bar')
        ->setSubItems([
            MenuItem::linkToCrud('Add User', 'fas fa-plus', User::class)
            ->setPermission('ROLE_ADMIN')
            ->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Users','fas fa-eye', User::class)
        ]);

            
        yield MenuItem::section('Etablishement');
        yield MenuItem::subMenu('Actions', 'fas fa-bar')
          ->setSubItems([
              MenuItem::linkToCrud('Add Establishement', 'fas fa-plus', Establishement::class)
              ->setAction(Crud::PAGE_NEW),
              
              MenuItem::linkToCrud('Show Establishements', 'fas fa-eye', Establishement::class)
          ]);
       

        } 

        if ($this->isGranted('ROLE_MANAGER')) {
            yield MenuItem::section('Suites');
            yield MenuItem::subMenu('Actions', 'fas fa-bar')
                ->setSubItems([
                    MenuItem::linkToCrud('Add Suite', 'fas fa-plus', Suite::class)
                        ->setAction(Crud::PAGE_NEW),
                    
                    MenuItem::linkToCrud('Show suites', 'fas fa-eye', Suite::class)
        
                ]);
        }
        yield MenuItem::section('');
        yield MenuItem::linkToRoute('Go home site', 'fas fa-undo', 'app_home');
    }
   

}