<?php

namespace Bs\UserBundle\Repository;

use Bs\UserBundle\Entity\User;
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

    /**
     * @param $filter
     * @return User[]
     */
    public function findFilter($filter)
    {
        $stations = $this->createQueryBuilder('u')
            ->where('u.name LIKE :filter')
            ->orWhere('u.email LIKE :filter')
            ->orWhere('u.username LIKE :filter')
            ->setParameter('filter', '%' . $filter . '%')
            ->getQuery()
            ->getResult();

        return $stations;
    }
}
