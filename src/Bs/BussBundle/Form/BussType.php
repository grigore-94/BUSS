<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/3/2017
 * Time: 8:44 PM
 */

namespace Bs\BussBundle\Form;

use Bs\BussBundle\Entity\Buss;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BussType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('seats')
        ->add('type')
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => Buss::class,
            )
        );
    }
}