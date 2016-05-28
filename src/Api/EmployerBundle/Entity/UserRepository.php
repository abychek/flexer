<?php

namespace Api\EmployerBundle\Entity;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query\ResultSetMapping;

class UserRepository extends EntityRepository
{
    /**
     * @param $id
     * @return array
     */
    public function findByNotEstablishmentId($id)
    {
        $rsm = new ResultSetMapping;
        $rsm->addEntityResult('Api\EmployerBundle\Entity\User', 'u');
        $rsm->addFieldResult('u', 'id', 'id'); // ($alias, $columnName, $fieldName)
        $rsm->addFieldResult('u', 'name', 'name'); // // ($alias, $columnName, $fieldName)
        $rsm->addFieldResult('u', 'username', 'username'); // // ($alias, $columnName, $fieldName)
        $rsm->addFieldResult('u', 'password', 'password'); // // ($alias, $columnName, $fieldName)
        $rsm->addFieldResult('u', 'role', 'role'); // // ($alias, $columnName, $fieldName)
        $query = $this->getEntityManager()->createNativeQuery(
            "SELECT u.name, 
                    u.username, 
                    u.password, 
                    u.role, 
                    u.id 
               FROM users u 
              WHERE u.id IN 
                      (SELECT w.user_id 
                         FROM workers w 
                        WHERE w.user_id = u.id 
                          AND (w.establishment_id <> :id OR w.status LIKE '%fired%')) 
                 OR u.role NOT LIKE '%ROLE_EMPLOYEE%'",
            $rsm
        )->setParameter('id', $id);
        try {
            return $query->getResult();
        } catch (NoResultException $e) {
            return [];
        }
    }
}