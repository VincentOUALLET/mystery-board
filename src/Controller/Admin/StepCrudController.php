<?php

namespace App\Controller\Admin;

use App\Entity\Step;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class StepCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Step::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id', 'Identifiant')->onlyOnIndex(),
            AssociationField::new('story', 'Nom de l\'histoire'),
            TextField::new('custom_id', 'Identifiant customisé de l\'étape'),
            TextEditorField::new('description', 'Description'),
            TextEditorField::new('label_choice_1', 'Choix 1'),
            TextField::new('choice_1', 'Choix 1 redirige vers étape'),
            TextEditorField::new('label_choice_2', 'Choix 2'),
            TextField::new('choice_2', 'Choix 2 redirige vers étape'),
            ImageField::new('imageFile')
            ->setFormType(VichImageType::class)
            ->setLabel('Image'),
        ];
    }
}
