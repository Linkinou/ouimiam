<?php

namespace AppBundle\Repository;

use AppBundle\Entity\HungryUser;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

class HungryUserRepository implements UserLoaderInterface
{
    private $repository;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->repository = $entityManager->getRepository(HungryUser::class);
    }

    /**
     * This method will retrieve user based on
     * the username or the email.
     *
     * @param string $username
     * @return HungryUser|null
     */
    public function loadUserByUsername($username)
    {
        return $this->repository->createQueryBuilder('u')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}