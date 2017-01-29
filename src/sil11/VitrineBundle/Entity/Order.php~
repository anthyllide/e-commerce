<?php

namespace sil11\VitrineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Order
 */
class Order
{
    /**
     * @var integer
     */
    private $id;


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
     * @var string
     */
    private $manyToOne;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $submited;


    /**
     * Set manyToOne
     *
     * @param string $manyToOne
     * @return Order
     */
    public function setManyToOne($manyToOne)
    {
        $this->manyToOne = $manyToOne;

        return $this;
    }

    /**
     * Get manyToOne
     *
     * @return string 
     */
    public function getManyToOne()
    {
        return $this->manyToOne;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Order
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set submited
     *
     * @param string $submited
     * @return Order
     */
    public function setSubmited($submited)
    {
        $this->submited = $submited;

        return $this;
    }

    /**
     * Get submited
     *
     * @return string 
     */
    public function getSubmited()
    {
        return $this->submited;
    }
    /**
     * @var \sil11\VitrineBundle\Entity\Customer
     */
    private $customer;


    /**
     * Set customer
     *
     * @param \sil11\VitrineBundle\Entity\Customer $customer
     * @return Order
     */
    public function setCustomer(\sil11\VitrineBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \sil11\VitrineBundle\Entity\Customer 
     */
    public function getCustomer()
    {
        return $this->customer;
    }
    
    public function __toString()
    {
    // renvoyer une chaîne qui identifie de manière unique l’entité 
       return 'id :'.$this->getId();
    }
}
