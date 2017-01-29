<?php

namespace sil11\VitrineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Customer
 */
class Customer implements UserInterface, \Serializable
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
    private $last_name;

    /**
     * @var string
     */
    private $first_name;

    /**
     * @var string
     */
    private $mail;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $orders;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $administrator;

    private $roles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orders = new \Doctrine\Common\Collections\ArrayCollection();
        $this->roles = array('ROLE_USER');

    }

    /**
     * Set last_name
     *
     * @param string $lastName
     * @return Customer
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;

        return $this;
    }

    /**
     * Get last_name
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set first_name
     *
     * @param string $firstName
     * @return Customer
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;

        return $this;
    }

    /**
     * Get first_name
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Customer
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Add orders
     *
     * @param \sil11\VitrineBundle\Entity\Order $orders
     * @return Customer
     */
    public function addOrder(\sil11\VitrineBundle\Entity\Order $orders)
    {
        $this->orders[] = $orders;

        return $this;
    }

    /**
     * Remove orders
     *
     * @param \sil11\VitrineBundle\Entity\Order $orders
     */
    public function removeOrder(\sil11\VitrineBundle\Entity\Order $orders)
    {
        $this->orders->removeElement($orders);
    }

    /**
     * Get orders
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrders()
    {
        return $this->orders;
    }
    
    public function __toString()
    {

       return $this->getMail();
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Customer
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set administrator
     *
     * @param string $administrator
     * @return Customer
     */
    public function setAdministrator($administrator)
    {
        $this->administrator = $administrator;

        return $this;
    }

    /**
     * Get administrator
     *
     * @return string 
     */
    public function getAdministrator()
    {
        return $this->administrator;
    }

    public function isAdministrator(){
        if($this->getAdministrator() == "y"){
            return true;
        }
    }

    public function isUser(){
        if($this->getAdministrator() == "n"){
            return true;
        }
    }

    /**
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize(array($this->id));
    }

    public function unserialize($serialized)
    {
        list ($this->id) = unserialize($serialized);
    }

    public function getRoles()
    {

        if ($this->isAdministrator()) {
            return array('ROLE_ADMIN');
        } elseif ($this->isUser())  {
            return array('ROLE_USER');
        }
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->mail;
    }

    public function eraseCredentials()
    {

    }
}
