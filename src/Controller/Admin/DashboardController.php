<?php

namespace App\Controller\Admin;

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
        yield MenuItem::linkTo(OeuvreCrudController::class, 'Oeuvres', 'fa fa-palette');
        yield MenuItem::linkTo(CategorieCrudController::class, 'Categories', 'fa fa-folder');
        yield MenuItem::linkTo(ThemeCrudController::class, 'Themes', 'fa fa-tags');
        yield MenuItem::linkTo(PageAccueilCrudController::class, 'Accueil', 'fa fa-image');
        yield MenuItem::linkTo(LikeCrudController::class, 'Likes', 'fa fa-heart');
        yield MenuItem::linkTo(UserCrudController::class, 'Utilisateurs', 'fa fa-user');
        yield MenuItem::linkToLogout('Deconnexion', 'fa fa-sign-out');
    }
}
