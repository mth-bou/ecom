<?php


namespace App\Form;

use \Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options); // TODO: Change the autogenerated stub
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver); // TODO: Change the autogenerated stub
    }
}