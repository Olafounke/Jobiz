<?php

namespace App\Controller\Admin;

use App\Entity\Application;
use App\Entity\Category;
use App\Entity\Company;
use App\Entity\Job;
use App\Entity\Type;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        
        return $this->render('admin/dashboard.html.twig');
    
        
    
       
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Jobiz');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Jobs', 'fa fa-briefcase', Job::class);
        yield MenuItem::linkToCrud('Companies', 'fa fa-building', Company::class);
        yield MenuItem::linkToCrud('Applications', 'fa fa-envelope', Application::class);
        yield MenuItem::linkToCrud('Type', 'fa fa-envelope', Type::class);
        yield MenuItem::linkToCrud('Category', 'fa fa-envelope', Category::class);

    }
}
