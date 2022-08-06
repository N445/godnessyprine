<?php

namespace App\Controller\Admin;

use App\Entity\Sirop;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class SiropCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Sirop::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
        ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Nom du sirop'),
            IntegerField::new('displayOrder', 'Ordre d\'affichage'),
            SlugField::new('urlSlug', 'Texte dans l\'URL')->setTargetFieldName('title')->setHelp('Sans accent ou caractères spécials'),
            MoneyField::new('price', 'Prix')->setCurrency('EUR'),
            TextEditorField::new('description', 'Description'),
            //            TextEditorField::new('description')->setFormType(CKEditorType::class),
            TextEditorField::new('ingredients', 'Ingrédients'),
            CollectionField::new('images', 'Images')->useEntryCrudForm(),
        ];
    }
}
