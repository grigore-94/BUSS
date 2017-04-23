<?php
/**
 * Created by PhpStorm.
 * User: gbrodicico
 * Date: 2/23/2017
 * Time: 9:55 AM
 */

namespace Bs\AppBundle\Form;

use Bs\AppBundle\Models\ModelTransformer\SearchRouteModelTransformer;
use Bs\AppBundle\Models\SearchRoute;
use Doctrine\ORM\EntityManager;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TimeType;


class SearchType extends AbstractType
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('from',
                TextType::class,
                [
                    'required'=>false,
                    'attr'=>['style'=>'display:none;'],
                    'label' => false,
                ]
            )
            ->
            add('to', TextType::class,
                [
                    'required'=>false,
                    'attr'=>['style'=>'display:none;'],
                    'label' => false,
                ]
            )
            ->add('atDate', DateType::class,
                [
                    'label' => false,
                    'widget' => 'single_text',
                ]
            )
            ->add('atTime', TimeType::class,
                [
                    'label' => false,

                ]);
        $builder->get('from')
            ->addModelTransformer(new SearchRouteModelTransformer($this->em));
        $builder->get('to')
            ->addModelTransformer(new SearchRouteModelTransformer($this->em));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => SearchRoute::class,
            )
        );
    }

    public function getName()
    {
        return 'search_route';
    }
}
