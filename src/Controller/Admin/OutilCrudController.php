<?php

namespace App\Controller\Admin;

use App\Entity\Outil;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use App\Field\VichImageField;

class OutilCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Outil::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new(propertyName:'id')->hideOnForm(),
            TextField::new(propertyName: 'nom'),
            TextField::new(propertyName: 'slug'),
            UrlField::new(propertyName: 'url'),
            TextEditorField::new(propertyName: 'descriptif'),
            ChoiceField::new(propertyName: 'statut')->setChoices([
                'Publié' => 'Publié',
                'Brouillon' => 'Brouillon',
            ]),
            VichImageField::new('file'),
           AssociationField::new(propertyName: 'tags'),
        ];
    }
    
}
