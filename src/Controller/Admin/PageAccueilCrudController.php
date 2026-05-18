<?php

namespace App\Controller\Admin;

use App\Entity\PageAccueil;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

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
        yield $this->imageField('img1', 'Image 1');
        yield $this->imageField('img2', 'Image 2');
        yield $this->imageField('img3', 'Image 3');
        yield $this->imageField('img4', 'Image 4');
        yield $this->imageField('img5', 'Image 5');
    }

    private function imageField(string $property, string $label): ImageField
    {
        return ImageField::new($property, $label)
            ->setBasePath('/images/Accueil')
            ->setUploadDir('public/images/Accueil')
            ->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
            ->setRequired(false);
    }
}
