<?php
/**
 * Created by PhpStorm.
 * User: gbrodicico
 * Date: 2/23/2017
 * Time: 9:55 AM
 */

namespace Bs\UserBundle\Form;

use Bs\UserBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => false])
            ->add('email', EmailType::class, ['label' => false])
            ->add('username', null, ['label' => false])
            ->add(
                'plainPassword',
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'first_options' => array('label' => false),
                    'second_options' => array('label' => false),
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'label' => false,
                'data_class' => User::class,
            )
        );
    }
}
