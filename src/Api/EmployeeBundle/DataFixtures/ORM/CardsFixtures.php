<?php

namespace Api\EmployeeBundle\DataFixtures\ORM;


use Api\EmployeeBundle\Entity\Card;
use Api\EmployeeBundle\Entity\Establishment;
use Api\EmployeeBundle\Entity\Special;
use Api\EmployeeBundle\Entity\User;
use Api\EmployeeBundle\Entity\Worker;
use DateTime;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CardsFixtures implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = $this->createUser('Jeff Verdinski', 'jeff1', 'qwertyui', ['ROLE_CUSTOMER']);
        $manager->persist($user);
        $manager->flush();

        $owner = $this->createUser('Марина Чудо', 'marina', 'qwertyui', ['ROLE_CUSTOMER', 'ROLE_EMPLOYER', 'ROLE_EMPLOYEE']);
        $manager->persist($owner);
        $manager->flush();

        $establishment = new Establishment();
        $establishment->setTitle('Maryland');
        $establishment->setDescription('Biggest coffee network in the world.');
        $establishment->setOwner($owner);
        $establishment->setStatus('approved');
        $manager->persist($establishment);
        $manager->flush();

        $worker = new Worker();
        $worker->setUser($owner);
        $worker->setEstablishment($establishment);
        $worker->setStatus('worked');
        $manager->persist($worker);
        $manager->flush();

        $special = new Special();
        $special->setTitle('Бесплатный кофе');
        $special->setDescription('Купи 5 чашек кофе и получи 1 бесплатно.');
        $special->setType('quest');
        $special->setStartDate(new DateTime('now'));
        $special->setEndDate(new DateTime('+20 week'));
        $special->setStatus('approved');
        $special->setCount(5);
        $special->setEstablishment($establishment);
        $manager->persist($special);
        $manager->flush();

        $card = new Card();
        $card->setCustomer($user);
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