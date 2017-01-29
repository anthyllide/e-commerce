<?php

namespace sil11\VitrineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Order_line
 * @ORM\Entity(repositoryClass="sil11\VitrineBundle\Entity\Order_lineRepository")
 */
class Order_line
{

    /**
     * @var string
     */
    private $manyToOne;

    /**
     * @var \sil11\VitrineBundle\Entity\Order
     */
    private $order;

    /**
     * @var \sil11\VitrineBundle\Entity\Product
     */
    private $product;


    /**
     * Set manyToOne
     *
     * @param string $manyToOne
     * @return Order_line
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
     * Set order
     *
     * @param \sil11\VitrineBundle\Entity\Order $order
     * @return Order_line
     */
    public function setOrder(\sil11\VitrineBundle\Entity\Order $order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \sil11\VitrineBundle\Entity\Order 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set product
     *
     * @param \sil11\VitrineBundle\Entity\Product $product
     * @return Order_line
     */
    public function setProduct(\sil11\VitrineBundle\Entity\Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \sil11\VitrineBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
    /**
     * @var integer
     */
    private $order_quantity;


    /**
     * Set order_quantity
     *
     * @param integer $orderQuantity
     * @return Order_line
     */
    public function setOrderQuantity($orderQuantity)
    {
        $this->order_quantity = $orderQuantity;

        return $this;
    }

    /**
     * Get order_quantity
     *
     * @return integer 
     */
    public function getOrderQuantity()
    {
        return $this->order_quantity;
    }
    /**
     * @var string
     */
    private $price;


    /**
     * Set price
     *
     * @param string $price
     * @return Order_line
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

}
