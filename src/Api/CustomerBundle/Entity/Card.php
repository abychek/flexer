<?php

namespace Api\CustomerBundle\Entity;


class Card
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var User
     */
    private $customer;

    /**
     * @var Special
     */
    private $special;

    /**
     * @var int
     */
    private $usesCount;

    /**
     * Set usesCount
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
     * Get usesCount
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
     * Set customer
     *
     * @param \Api\CustomerBundle\Entity\User $customer
     *
     * @return Card
     */
    public function setCustomer(\Api\CustomerBundle\Entity\User $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \Api\CustomerBundle\Entity\User
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set special
     *
     * @param \Api\CustomerBundle\Entity\Special $special
     *
     * @return Card
     */
    public function setSpecial(\Api\CustomerBundle\Entity\Special $special = null)
    {
        $this->special = $special;

        return $this;
    }

    /**
     * Get special
     *
     * @return \Api\CustomerBundle\Entity\Special
     */
    public function getSpecial()
    {
        return $this->special;
    }
}
