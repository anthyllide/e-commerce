<?php

namespace sil11\VitrineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Product
 */
class Product
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
    private $item;

    /**
     * @var integer
     */
    private $reference;

    /**
     * @var string
     */
    private $price;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $quantity;


    /**
     * @Assert\File(maxSize="5000000")
     */
    private $file;

    /**
     * @var string
     */
    private $manyToOne;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $orders;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orders = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set item
     *
     * @param string $item
     * @return Product
     */
    public function setItem($item)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return string 
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set reference
     *
     * @param integer $reference
     * @return Product
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return integer 
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return Product
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set manyToOne
     *
     * @param string $manyToOne
     * @return Product
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
     * Add orders
     *
     * @param \sil11\VitrineBundle\Entity\Order_line $orders
     * @return Product
     */
    public function addOrder(\sil11\VitrineBundle\Entity\Order_line $orders)
    {
        $this->orders[] = $orders;

        return $this;
    }

    /**
     * Remove orders
     *
     * @param \sil11\VitrineBundle\Entity\Order_line $orders
     */
    public function removeOrder(\sil11\VitrineBundle\Entity\Order_line $orders)
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
    /**
     * @var \sil11\VitrineBundle\Entity\Category
     */
    private $category;


    /**
     * Set category
     *
     * @param \sil11\VitrineBundle\Entity\Category $category
     * @return Product
     */
    public function setCategory(\sil11\VitrineBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \sil11\VitrineBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
    
    public function __toString()
    {
    // renvoyer une chaîne qui identifie de manière unique l’entité 
       return $this->getItem();
    }

    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

}
