<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/3/2017
 * Time: 8:44 PM
 */

namespace Bs\PaymentBundle\Form;

use Bs\CityBundle\Entity\Location;
use Bs\PaymentBundle\Entity\Price;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PriceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price',NumberType::class,
            [
                'scale'=>2
                ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => Price::class,
            )
        );
    }
}