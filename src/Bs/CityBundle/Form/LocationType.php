<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/3/2017
 * Time: 8:44 PM
 */

namespace Bs\CityBundle\Form;

use Bs\CityBundle\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city')
        ->add('region')
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => Location::class,
            )
        );
    }
}