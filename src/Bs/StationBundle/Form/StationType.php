<?php

namespace Bs\StationBundle\Form;

use Bs\StationBundle\Entity\Station;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('location',
                EntityType::class,
                array(
                    'class' => 'BsCityBundle:Location',
                    'choice_label' => 'uniqueName',
                    'multiple'=>true,
                    'expanded' => true,

                )
            );

    }
    private function getUniqueName()
    {
        return sprintf('%s - %s', $this->name, $this->value);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => Station::class,
            )
        );
    }
}