<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/22/2017
 * Time: 5:19 PM
 */

namespace Bs\AppBundle\Models\ModelTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class SearchRouteModelTransformer  implements DataTransformerInterface
{


    private $entityManager;

    public function __construct(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function transform($location)
    {
        if (null === $location) {
            return '';
        }

        return null;
    }

    public function reverseTransform($id)
    {
        if (!$id) {
            return;
        }

        $location = $this->entityManager
            ->getRepository('BsCityBundle:Location')->find($id);

        if (null === $location) {
            throw new TransformationFailedException(sprintf('There is no "%s" exists',
                $id
            ));
        }

        return $location;
    }
}