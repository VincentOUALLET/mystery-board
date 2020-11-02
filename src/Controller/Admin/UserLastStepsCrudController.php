<?php

namespace App\Controller\Admin;

use App\Entity\UserLastSteps;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class UserLastStepsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserLastSteps::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id', 'Identifiant')->onlyOnIndex(),
            AssociationField::new('last_step', 'Dernière étape'),
            IntegerField::new('restart_number', 'Nombre de redémarrages'),
            AssociationField::new('user', 'Utilisateur'),
            AssociationField::new('story', 'Histoire'),
        ];
    }
}
