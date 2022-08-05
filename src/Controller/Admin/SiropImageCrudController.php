<?php

namespace App\Controller\Admin;

use App\Entity\SiropImage;
use App\Field\VichImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class SiropImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SiropImage::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
//            ImageField::new('imageName')
//                      ->setUploadDir('public/uploads/images/sirop')
//                      ->setBasePath('/uploads/images/sirop'),
            Field::new('imageFile')->setFormType(VichImageType::class),
        ];
    }

}
