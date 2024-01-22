<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TagCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tag::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new(propertyName: 'id')->hideOnForm(),
            TextField::new(propertyName: 'nom'),
            ColorField::new(propertyName: 'couleur'),
            AssociationField::new(propertyName: 'outils')
        ];
    }
    
}
