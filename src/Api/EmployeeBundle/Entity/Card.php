<?php

namespace Api\EmployeeBundle\Entity;


class Card
{
    /**
     * @var
     */
    private $id;

    /**
     * @var int
     */
    private $customer;

    /**
     * @var int
     */
    private $special;

    /**
     * @var int
     */
    private $usesCount;

    /**
     * Set count
     *
     * @param integer $usesCount
     *
     * @return Card
     */
    public function setUsesCount($usesCount)
    {
        $this->usesCount = $usesCount;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer
     */
    public function getUsesCount()
    {
        return $this->usesCount;
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
     * Set customerId
     *
     * @param User $user
     *
     * @return Card
     */
    public function setCustomer(User $user = null)
    {
        $this->customer = $user;

        return $this;
    }

    /**
     * Get customerId
     *
     * @return User
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set specialId
     *
     * @param Special $special
     *
     * @return Card
     */
    public function setSpecial(Special $special = null)
    {
        $this->special = $special;

        return $this;
    }

    /**
     * Get specialId
     *
     * @return Special
     */
    public function getSpecial()
    {
        return $this->special;
    }
}
