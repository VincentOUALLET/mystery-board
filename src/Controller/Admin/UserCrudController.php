<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
// use EasyCorp\Bundle\EasyAdminBundle\Field\PasswordField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id', 'Identifiant')->onlyOnIndex(),
            TextField::new('email', 'Email'),
            TextField::new('password', 'Mot de passe'),
            ArrayField::new('roles'),
        ];
    }
}
            