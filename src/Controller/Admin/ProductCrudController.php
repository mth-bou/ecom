<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Produit')
            ->setEntityLabelInPlural('Produits')
            ->setEntityPermission('ROLE_ADMIN')
            ->setSearchFields(['id', 'name', 'description', 'category.name'])
            ->setDefaultSort(['id' => 'ASC'])
            ->setPaginatorPageSize(10)
            ->setTimezone('Europe/Paris')
            ->setDateTimeFormat('dd/MM/yyyy HH:mm')
            ->setThousandsSeparator(' ')
            ->setDecimalSeparator('.');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->setFormTypeOptions(['disabled' => true]),
            ImageField::new('image', 'Image')->setBasePath('/uploads/images/')->setUploadDir('public/uploads/images/'),
            TextField::new('name', 'Nom'),
            TextareaField::new('description', 'Description'),
            MoneyField::new('price', 'Prix')->setCurrency('EUR'),
            NumberField::new('quantity', 'Stock'),
            AssociationField::new('category', 'Catégorie'),
            DateTimeField::new('createdAt', 'Créé le')
                ->hideOnForm()
                ->setFormTypeOptions(['disabled' => true]),
            DateTimeField::new('updatedAt', 'Modifié le')
                ->hideOnForm()
                ->setFormTypeOptions(['disabled' => true]),
        ];
    }

}
