<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Entity\Like;
use App\Entity\Oeuvre;
use App\Entity\PageAccueil;
use App\Entity\Theme;
use App\Entity\User;
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
            ->setTitle('Back-office peinture');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::linkToCrud('Oeuvres', 'fa fa-palette', Oeuvre::class);
        yield MenuItem::linkToCrud('Categories', 'fa fa-folder', Categorie::class);
        yield MenuItem::linkToCrud('Themes', 'fa fa-tags', Theme::class);
        yield MenuItem::linkToCrud('Accueil', 'fa fa-image', PageAccueil::class);
        yield MenuItem::linkToCrud('Likes', 'fa fa-heart', Like::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class);
        yield MenuItem::linkToLogout('Deconnexion', 'fa fa-sign-out');
    }
}
