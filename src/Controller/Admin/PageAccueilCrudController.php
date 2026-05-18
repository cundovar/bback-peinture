<?php

namespace App\Controller\Admin;

use App\Entity\PageAccueil;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PageAccueilCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PageAccueil::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextareaField::new('texte')->hideOnIndex();
        yield TextField::new('img1', 'Image 1');
        yield TextField::new('img2', 'Image 2');
        yield TextField::new('img3', 'Image 3');
        yield TextField::new('img4', 'Image 4');
        yield TextField::new('img5', 'Image 5');
    }
}
