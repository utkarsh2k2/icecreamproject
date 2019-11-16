<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\IcecreamItem;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Order
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrderRepository")
 */
class Order {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var decimal
     *
     * @ORM\Column(name="cost", type="decimal", scale=2, precision=10, nullable=true)
     */
    protected $cost;

    /**
     * @var string
     * @Assert\NotBlank(message="Customername cannot be blank", groups={"createorder"})
     * @Assert\Length(min=2,max=100,minMessage="Customername should be minimum {{ limit }} characters", maxMessage="Your Customername cannot be longer than {{ limit }} characters",groups={"createorder"}
     * )
     * @ORM\Column(name="customername", type="string", length=255, nullable=true)
     */
    protected $customername;

    /**
     * @Assert\Valid
     * @ORM\OneToMany(targetEntity="IcecreamItem", mappedBy="order", cascade={"persist"})
     */
    protected $icecreamitems;
        
    /**
     * @var array
     *
     * @ORM\Column(name="toppingitems", type="array", nullable=true)
     */
    protected $toppingitems;

    public function __construct() {
        $this->icecreamitems = new ArrayCollection();
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
     * Set cost
     *
     * @param float $cost
     *
     * @return Order
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set customername
     *
     * @param string $customername
     *
     * @return Order
     */
    public function setCustomername($customername)
    {
        $this->customername = $customername;

        return $this;
    }

    /**
     * Get customername
     *
     * @return string
     */
    public function getCustomername()
    {
        return $this->customername;
    }

    /**
     * Add icecreamitem
     *
     * @param \AppBundle\Entity\IcecreamItem $icecreamitem
     *
     * @return Order
     */
    public function addIcecreamitem(\AppBundle\Entity\IcecreamItem $icecreamitem)
    {
        $this->icecreamitems[] = $icecreamitem;
        
        $icecreamitem->setOrder($this);

        return $this;
    }

    /**
     * Remove icecreamitem
     *
     * @param \AppBundle\Entity\IcecreamItem $icecreamitem
     */
    public function removeIcecreamitem(\AppBundle\Entity\IcecreamItem $icecreamitem)
    {
        $this->icecreamitems->removeElement($icecreamitem);
    }

    /**
     * Get icecreamitems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIcecreamitems()
    {
        return $this->icecreamitems;
    }


    /**
     * Set toppingitems
     *
     * @param array $toppingitems
     *
     * @return Order
     */
    public function setToppingitems($toppingitems)
    {
        $this->toppingitems = $toppingitems;

        return $this;
    }

    /**
     * Get toppingitems
     *
     * @return array
     */
    public function getToppingitems()
    {
        return $this->toppingitems;
    }
    
    /**
     * @Assert\IsTrue(message="Oops! you added same flavor more than once", groups={"createorder"})
     */
    public function isValidateFlavour()
    {
        $icecreams = [];
        foreach ($this->icecreamitems as $icecreamitem) {
            $flavour = $icecreamitem->getFlavour();
                $icecreams[] = $flavour;
        }

        if($this->has_dupes($icecreams)){
            return false;
        }
        return true;
    }

    function has_dupes($array) {
        return count($array) !== count(array_unique($array));
    }

}
