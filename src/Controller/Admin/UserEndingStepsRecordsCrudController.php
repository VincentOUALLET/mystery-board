<?php

namespace App\Controller\Admin;

use App\Entity\UserEndingStepsRecords;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserEndingStepsRecordsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserEndingStepsRecords::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id', 'Identifiant')->onlyOnIndex(),
            AssociationField::new('user', 'Utilisateur'),
            AssociationField::new('story', 'Histoire'),
            AssociationField::new('step', 'Etape finale concernée'),
        ];
    }
}
