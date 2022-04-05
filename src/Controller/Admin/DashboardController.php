<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Product;
use App\Entity\Category;
use App\Controller\Admin\UserCrudController;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\ProductCrudController;
use App\Entity\Establishement;
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
        
        // generation de la route pour afficher Product
        $url = $this->adminUrlGenerator
              ->setController(UserCrudController::class)
              ->generateUrl();

        return $this->redirect($url);
    }

    

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Hypnos Hotel');
    }

    public function configureMenuItems(): iterable
    {
        
        
        yield MenuItem::section('Users')
        ->setCssClass('text-warning');
        yield MenuItem::subMenu('Actions','fas fa-bar')
        ->setSubItems([
            MenuItem::linkToCrud('Add User', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Users','fas fa-eye', User::class)
        ]);

        yield MenuItem::section('Etablishement');
        yield MenuItem::subMenu('Actions', 'fas fa-bar')
          ->setSubItems([
              MenuItem::linkToCrud('Add Establishement', 'fas fa-plus', Establishement::class)->setAction(Crud::PAGE_NEW),
              MenuItem::linkToCrud('Show Establishements', 'fas fa-eye', Establishement::class)
          ]);

        yield MenuItem::section('');
        yield MenuItem::linkToRoute('Go home site', 'fas fa-undo', 'app_home');
    }

}