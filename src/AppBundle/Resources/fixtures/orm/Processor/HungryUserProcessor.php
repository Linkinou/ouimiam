<?php

namespace AppBundle\Resources\fixtures\orm\Processor;

use Fidry\AliceDataFixtures\ProcessorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use AppBundle\Entity\HungryUser;

class HungryUserProcessor implements ProcessorInterface
{

    /** @var UserPasswordEncoderInterface $passwordEncoder */
    private $passwordEncoder;

    /**
     * HungryUserProcessor constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @inheritDoc
     */
    public function preProcess(string $id, $object): void
    {
        if (!$object instanceof HungryUser) {
            return;
        }

        $this->encodePassword($object);
    }

    /**
     * @inheritDoc
     */
    public function postProcess(string $id, $object): void
    {
        if (!$object instanceof HungryUser) {
            return;
        }

        $this->encodePassword($object);
    }

    /**
     * @param HungryUser $user
     */
    private function encodePassword(HungryUser $user)
    {
        if (!$user->getPlainPassword()) {
            return;
        }

        $encoded = $this->passwordEncoder->encodePassword(
            $user,
            $user->getPlainPassword()
        );

        $user->setPassword($encoded);
    }

}