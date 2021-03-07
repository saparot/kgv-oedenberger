<?php

namespace App\Controller\Admin;

use App\Entity\News;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class NewsCrudController extends AbstractCrudController {

    public static function getEntityFqcn (): string {
        return News::class;
    }

    public function configureFields (string $pageName): iterable {
        return [
            //IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
            DateTimeField::new('timeCreated'),
            DateTimeField::new('timeUpdated'),
        ];
    }

    public function configureCrud (Crud $crud): Crud {
        return $crud
            // set this option if you prefer the page content to span the entire
            // browser width, instead of the default design which sets a max width
            ->renderContentMaximized()
            //->setDateFormat('d.m.Y H:i:s')

            // set this option if you prefer the sidebar (which contains the main menu)
            // to be displayed as a narrow column instead of the default expanded design
            ->renderSidebarMinimized();
    }
}
