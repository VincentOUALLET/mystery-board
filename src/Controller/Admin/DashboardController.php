<?php

namespace App\Controller\Admin;

use App\Entity\Step;
use App\Entity\Story;
use App\Entity\User;
use App\Entity\UserLastSteps;
use App\Entity\UserEndingStepsRecords;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

class DashboardController extends AbstractDashboardController
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $usersCount = $this->userRepo->countAllUsers()[0]['value'];
        
        return $this->render('bundles/EasyAdminBundle/welcome.html.twig',
            [
                'usersCount' => $usersCount,
            ]
            );
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('DRAWER');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Histoires', 'fas fa-book', Story::class);
        yield MenuItem::linkToCrud('Etapes', 'far fa-object-ungroup', Step::class);
        yield MenuItem::linkToCrud('Sauvegardes utilisateur', 'fas fa-save', UserLastSteps::class);
        yield MenuItem::linkToCrud('Etapes finales effectuées', 'far fa-save', UserEndingStepsRecords::class);
    }
}
