<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/18/2017
 * Time: 10:52 PM
 */

namespace Bs\RouteBundle\Form;


use Bs\DriverBundle\Entity\Driver;
use Bs\RouteBundle\Entity\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RouteDriverType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('driver',
                EntityType::class,
                [
                    'class' => 'BsDriverBundle:Driver',
                    'choice_label' => 'uniqueName'
                ]
            );

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => Route::class,
            )
        );
    }
}