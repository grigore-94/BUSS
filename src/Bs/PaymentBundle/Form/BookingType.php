<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/24/2017
 * Time: 11:13 AM
 */
namespace Bs\PaymentBundle\Form;

use Bs\PaymentBundle\Model\Booking;
use Bs\RouteBundle\Entity\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
$nrPlaces=$options['data']->getNrPlaces();
        $places=$options['data']->getPlaces();
        $builder
            ->add('fromStation',
                ChoiceType::class,
                [
                    'label'=>false,
                    'choice_label' => 'name',
                    'choices' => $options['data']->getFromStation(),

                ]
            )
            ->add('toStation',
                ChoiceType::class,
                [
                    'label'=>false,
                    'choices' => $options['data']->getToStation(),
                    'choice_label' => 'name'
                ]
            )
            ->add('places', ChoiceType::class,
                [
                    'choices' => $this->getPlaces($nrPlaces,$places),
                    'multiple' => true,
                    'expanded' => true,
'label'=>false,
                    'choice_attr' => function($value, $key, $index) {

                        if ($value == 100) {
                             return ['disabled' => 'disabled','style'=>'  background: #d72526!important;'];
                        }
                        else
                        return ['class'=>'place-selector-red'];
                    },

                    'choice_label' => function ($value, $key, $index) {
                        if ($key == 100) {
                            return 'x';
                        } else
                        if ($value == 100) {
                            return 'x';
                        }
                        return strtoupper($key);

                        // or if you want to translate some key
                        //return 'form.choice.'.$key;
                    }
                ]
            );


    }
    private function getPlaces($nrPlaces,$places)
    {
        /*if (!empty($places)) {
            return $places;
        }*/
        $aray= [];
        for($i=1; $i<$nrPlaces+1;$i++) {
            if(is_array($places)&& in_array($i,$places))  {
                $aray[$i]=100;
            }
            else
            $aray[$i]=$i;
        }
        return $aray;// array('Saturday'=>1, 'Sunday'=>2, 'Monday'=>3, 'Tuesday'=>4, 'Wendnesday'=>5, 'Thursday'=>6, 'Friday'=>7);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => Booking::class,
            )
        );
    }


}
