<?php

namespace Api\EmployeeBundle\Entity;


class Worker
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $status;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Establishment
     */
    private $establishment;

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Worker
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

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
