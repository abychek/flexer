<?php

namespace Api\CustomerBundle\DataFixtures\ORM;


use Api\CustomerBundle\Entity\Card;
use Api\CustomerBundle\Entity\Establishment;
use Api\CustomerBundle\Entity\Special;
use Api\CustomerBundle\Entity\User;
use DateTime;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CustomerFixtures implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $customer = $this->createUser('alex', 'xualex', 'qwertyui', ['ROLE_CUSTOMER']);
        $manager->persist($customer);
        $manager->flush();
        $owner = $this->createUser('marina', 'xmarina', 'qwertyui', ['ROLE_CUSTOMER', 'ROLE_EMPLOYER']);
        $manager->persist($owner);
        $manager->flush();

        $establishment = new Establishment();
        $establishment->setTitle('mak');
        $establishment->setDescription('donalds');
        $establishment->setOwner($owner);
        $establishment->setStatus('approved');
        $manager->persist($establishment);
        $manager->flush();

        $special = new Special();
        $special->setTitle('kupi 2 poluchi 1');
        $special->setDescription('bla bla');
        $special->setType('quest');
        $special->setStartDate(new DateTime('now'));
        $special->setEndDate(new DateTime('+1 week'));
        $special->setStatus('approved');
        $special->setCount(5);
        $special->setEstablishment($establishment);
        $manager->persist($special);
        $manager->flush();

        $card = new Card();
        $card->setCustomer($customer);
        $card->setSpecial($special);
        $card->setUsesCount(0);
        $manager->persist($card);
        $manager->flush();

    }

    private function createUser(string $name, string $username, string $password, array $roles)
    {
        $user = new User();
        $user->setName($name);
        $user->setUsername($username);
        $user->setPassword($password);
        $user->setRole($roles);
        return $user;
    }
}