<?php

namespace Api\EmployeeBundle\Entity;


class Worker
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $user;

    /**
     * @var int
     */
    private $establishment;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param \Api\EmployeeBundle\Entity\User $user
     *
     * @return Worker
     */
    public function setUser(\Api\EmployeeBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Api\EmployeeBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set establishment
     *
     * @param \Api\EmployeeBundle\Entity\Establishment $establishment
     *
     * @return Worker
     */
    public function setEstablishment(\Api\EmployeeBundle\Entity\Establishment $establishment = null)
    {
        $this->establishment = $establishment;

        return $this;
    }

    /**
     * Get establishment
     *
     * @return \Api\EmployeeBundle\Entity\Establishment
     */
    public function getEstablishment()
    {
        return $this->establishment;
    }
}
