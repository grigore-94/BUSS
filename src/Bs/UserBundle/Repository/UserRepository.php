<?php

namespace BsUserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

class UserRepository extends EntityRepository implements UserLoaderInterface
{
    public function loadUserByUsername($username)
    {
        $query = $this->createQueryBuilder('u')
            ->where('u.username = :username OR u.email = :Email')
            ->setParameter('username', $username)
            ->setParameter('Email', $username)
            ->getQuery()
            ->getOneOrNullResult();

        return $query;
    }
}
