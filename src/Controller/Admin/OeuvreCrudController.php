<?php

namespace App\Controller\Admin;

use App\Entity\Oeuvre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OeuvreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Oeuvre::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('name', 'Nom');
        yield ImageField::new('image', 'Image')
            ->setBasePath('/images/oeuvre')
            ->setUploadDir('public/images/oeuvre')
            ->setUploadedFileNamePattern('[slug]-[contenthash].[extension]');
        yield TextareaField::new('description')->hideOnIndex();
        yield AssociationField::new('categorie', 'Categorie');
        yield AssociationField::new('theme', 'Theme');
        yield IntegerField::new('likesCount', 'Likes')->onlyOnIndex();
    }
}
