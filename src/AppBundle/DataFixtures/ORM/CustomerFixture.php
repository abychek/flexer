<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CustomerFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setName('alexey');
        $user->setUsername('vivaldiy');
        $user->setPassword('q12we34r');
        $user->setRoles(['ROLE_CUSTOMER']);

        $manager->persist($user);
        $manager->flush();
    }
}