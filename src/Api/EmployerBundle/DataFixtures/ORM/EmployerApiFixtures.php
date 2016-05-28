<?php

namespace Api\EmployerBundle\DataFixtures\ORM;


use Api\EmployerBundle\Entity\Establishment;
use Api\EmployerBundle\Entity\Special;
use Api\EmployerBundle\Entity\User;
use Api\EmployerBundle\Entity\Worker;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class EmployerApiFixtures implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $owner = new User();
        $owner->setName('owner');
        $owner->setUsername('employer-owner');
        $owner->setPassword('qwertyui');
        $owner->setRole(['ROLE_CUSTOMER', 'ROLE_EMPLOYER']);
        $manager->persist($owner);
        $manager->flush();

        $establishment = new Establishment();
        $establishment->setTitle('employer-establishment-title');
        $establishment->setDescription('employer-establishment-description');
        $establishment->setStatus('approved');
        $establishment->setOwner($owner);
        $manager->persist($establishment);
        $manager->flush();

        $user = new User();
        $user->setName('user');
        $user->setUsername('employer-user');
        $user->setPassword('qwertyui');
        $user->setRole(['ROLE_CUSTOMER', 'ROLE_EMPLOYEE']);
        $manager->persist($user);
        $manager->flush();

        $worker = new Worker();
        $worker->setUser($user);
        $worker->setEstablishment($establishment);
        $worker->setStatus('worked');
        $manager->persist($worker);
        $manager->flush();

        $special = new Special();
        $special->setTitle('employer-special-title');
        $special->setDescription('employer-special-description');
        $special->setStartDate(new \DateTime('now'));
        $special->setEndDate(new \DateTime('+1 week'));
        $special->setStatus('approved');
        $special->setType('quest');
        $special->setCount(10);
        $special->setEstablishment($establishment);
        $manager->persist($special);
        $manager->flush();

        $user = new User();
        $user->setName('user1');
        $user->setUsername('employer-user1');
        $user->setPassword('qwertyui');
        $user->setRole(['ROLE_CUSTOMER']);
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setName('user2');
        $user->setUsername('employer-user2');
        $user->setPassword('qwertyui');
        $user->setRole(['ROLE_CUSTOMER']);
        $manager->persist($user);
        $manager->flush();
    }
}