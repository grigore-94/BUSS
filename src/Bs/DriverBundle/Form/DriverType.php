<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/3/2017
 * Time: 8:44 PM
 */

namespace Bs\DriverBundle\Form;

use Bs\BussBundle\Entity\Buss;
use Bs\DriverBundle\Entity\Driver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DriverType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
        ->add('surename')
        ->add('stage')
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => Driver::class,
            )
        );
    }
}