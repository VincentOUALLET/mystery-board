<?php

namespace App\Controller\Admin;

use App\Entity\Step;
use App\Entity\Story;
use App\Entity\User;
use App\Entity\UserLastSteps;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Mystery Board');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'icon class', User::class);
        yield MenuItem::linkToCrud('Etapes', 'icon class', Step::class);
        yield MenuItem::linkToCrud('Histoires', 'icon class', Story::class);
        yield MenuItem::linkToCrud('Sauvegardes utilisateurs', 'icon class', UserLastSteps::class);
    }
}
