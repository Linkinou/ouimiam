<?php

namespace AppBundle\Security\User;

use AppBundle\Entity\HungryUser;
use AppBundle\Repository\HungryUserRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class HungryUserProvider implements UserProviderInterface
{
    /**
     * @var HungryUserRepository
     */
    private $hungryUserRepository;

    /**
     * @param HungryUserRepository $hungryUserRepository
     */
    public function __construct(HungryUserRepository $hungryUserRepository)
    {
        $this->hungryUserRepository = $hungryUserRepository;
    }

    /**
     * @inheritDoc
     */
    public function loadUserByUsername($username)
    {
        $user = $this->hungryUserRepository->loadUserByUsername($username);

        if (null !== $user) {

            return $user;
        }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }

    /**
     * @inheritDoc
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof HungryUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function supportsClass($class)
    {
        return HungryUser::class === $class;
    }

}