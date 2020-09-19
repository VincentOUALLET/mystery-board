<?php

namespace App\Controller\Admin;

use App\Entity\UserLastSteps;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserLastStepsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserLastSteps::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
