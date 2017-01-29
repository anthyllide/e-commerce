<?php

namespace sil11\VitrineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category
 */
class Category
{
    /**
     * @var integer
     */
    private $id;


    /**
     * @Assert\File(maxSize="5000000")
     */
    private $file;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $products;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Category
     */

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add products
     *
     * @param \sil11\VitrineBundle\Entity\Product $products
     * @return Category
     */
    public function addProduct(\sil11\VitrineBundle\Entity\Product $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \sil11\VitrineBundle\Entity\Product $products
     */
    public function removeProduct(\sil11\VitrineBundle\Entity\Product $products)
    {
        $this->products->removeElement($products);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducts()
    {
        return $this->products;
    }
    
    public function __toString(){
        return $this->getName(); 
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
