<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/4/2017
 * Time: 9:58 PM
 */
namespace Bs\RouteBundle\Form;


use Bs\RouteBundle\Entity\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RouteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('from',
                EntityType::class,
                [
                    'class' => 'BsCityBundle:Location',
                    'choice_label' => 'uniqueName'
                ]
            )
            ->add('to',
                EntityType::class,
                [
                    'class' => 'BsCityBundle:Location',
                    'choice_label' => 'uniqueName'
                ]
            )
            ->add('activeDays', ChoiceType::class,
            [
                'choices' => $this->getWeekDays(),
            'multiple' => true,
            'expanded' => true
                ]
            )
            ->add('hourDeparture',TimeType::class)
            ->add('road',HiddenType::class);
        ;

    }

    private function getWeekDays()
    {
        return array('Sunday'=>1, 'Monday'=>2, 'Tuesday'=>3, 'Wendnesday'=>4, 'Thursday'=>5, 'Friday'=>6 ,'Saturday'=>7,);

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