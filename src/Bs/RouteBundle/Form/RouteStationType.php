<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/11/2017
 * Time: 11:27 PM
 */

namespace Bs\RouteBundle\Form;


use Bs\RouteBundle\Entity\RouteStation;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RouteStationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('station',
                EntityType::class,
                [
                    'class' => 'BsStationBundle:Station',
                    'choice_label' => 'name'
                ]
            )

            ->add('timeFromBackStation', TimeType::class)
            ->add('position', NumberType::class,
                [
                    'scale' => 2,
                ])
            ->add('canBeStart',ChoiceType::class,
            [
                'choices'  => [
                    'Yes' => true,
                    'No' => false
                ]
            ]
            );

    }

    private function getWeekDays()
    {
        return array('Saturday' => 1, 'Sunday' => 2, 'Monday' => 3, 'Tuesday' => 4, 'Wendnesday' => 5, 'Thursday' => 6, 'Friday' => 7);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => RouteStation::class,
            )
        );
    }


}