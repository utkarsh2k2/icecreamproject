<?php

namespace Tests\AppBundle\Service;

use AppBundle\Entity\Order;
use AppBundle\Entity\IcecreamItem;
use AppBundle\Constants\Flavour;
use AppBundle\Constants\Topping;
use AppBundle\Service\TotalCostUtility;
use PHPUnit\Framework\TestCase;

class GetTotalcostTest extends TestCase {
    
    protected $testTotalCost;
    
    //one icecream flavour(one scoop) and one topping    
    public function testGetOrderCostCaseOne() {
        $this->testTotalCost = new TotalCostUtility();
        
        $order = new Order();
        $icecream = new IcecreamItem();
        $icecream->setFlavour(Flavour::FLAVOURS['Vanilla']);
        $icecream->setNumofscoops(1);
        $order->addIcecreamitem($icecream);
        $icecream->setOrder($order);
        
        $topping = array(Topping::TOPPINGS['Nuts']);
        $order->setToppingItems($topping);
        
        $totalcost = $this->testTotalCost->getOrderCost($order);
        $order->setCost($totalcost);
        
        // assert that the totalcost is added correctly!
        $this->assertEquals(70, $order->getCost());
    }
    
    //all icecream flavours(one scoop each) and all toppings    
    public function testGetOrderCostCaseTwo() {
        $this->testTotalCost = new TotalCostUtility();
        
        $order = new Order();
        
        $icecream1 = new IcecreamItem();
        $icecream1->setFlavour(Flavour::FLAVOURS['Vanilla']);
        $icecream1->setNumofscoops(1);
        $order->addIcecreamitem($icecream1);
        $icecream1->setOrder($order);

        $icecream2 = new IcecreamItem();
        $icecream2->setFlavour(Flavour::FLAVOURS['Butterscotch']);
        $icecream2->setNumofscoops(1);
        $order->addIcecreamitem($icecream2);
        $icecream2->setOrder($order);

        $icecream3 = new IcecreamItem();
        $icecream3->setFlavour(Flavour::FLAVOURS['Chocolate']);
        $icecream3->setNumofscoops(1);
        $order->addIcecreamitem($icecream3);
        $icecream3->setOrder($order);

        $icecream4 = new IcecreamItem();
        $icecream4->setFlavour(Flavour::FLAVOURS['Pista']);
        $icecream4->setNumofscoops(1);
        $order->addIcecreamitem($icecream4);
        $icecream4->setOrder($order);
        
        $toppings = array(Topping::TOPPINGS['Nuts'],
            Topping::TOPPINGS['Candy'],
            Topping::TOPPINGS['Spinkles']);
        
        $order->setToppingItems($toppings);
        
        $totalcost = $this->testTotalCost->getOrderCost($order);
        $order->setCost($totalcost);
        
        // assert that the totalcost is added correctly!
        $this->assertEquals(470, $order->getCost());
    }
    
    //one icecream flavour(two scoop) and all toppings    
    public function testGetOrderCostCaseThree() {
        $this->testTotalCost = new TotalCostUtility();
        
        $order = new Order();
        $icecream = new IcecreamItem();
        $icecream->setFlavour(Flavour::FLAVOURS['Vanilla']);
        $icecream->setNumofscoops(2);
        $order->addIcecreamitem($icecream);
        $icecream->setOrder($order);
        
        $toppings = array(Topping::TOPPINGS['Nuts'],
            Topping::TOPPINGS['Candy'],
            Topping::TOPPINGS['Spinkles']);
        
        $order->setToppingItems($toppings);
        
        $totalcost = $this->testTotalCost->getOrderCost($order);
        $order->setCost($totalcost);
        
        // assert that the totalcost is added correctly!
        $this->assertEquals(220, $order->getCost());
    }
    
    //all icecream flavours(one scoop each) and no topping    
    public function testGetOrderCostCaseFour() {
        $this->testTotalCost = new TotalCostUtility();
        
        $order = new Order();
        
        $icecream1 = new IcecreamItem();
        $icecream1->setFlavour(Flavour::FLAVOURS['Vanilla']);
        $icecream1->setNumofscoops(1);
        $order->addIcecreamitem($icecream1);
        $icecream1->setOrder($order);

        $icecream2 = new IcecreamItem();
        $icecream2->setFlavour(Flavour::FLAVOURS['Butterscotch']);
        $icecream2->setNumofscoops(1);
        $order->addIcecreamitem($icecream2);
        $icecream2->setOrder($order);

        $icecream3 = new IcecreamItem();
        $icecream3->setFlavour(Flavour::FLAVOURS['Chocolate']);
        $icecream3->setNumofscoops(1);
        $order->addIcecreamitem($icecream3);
        $icecream3->setOrder($order);

        $icecream4 = new IcecreamItem();
        $icecream4->setFlavour(Flavour::FLAVOURS['Pista']);
        $icecream4->setNumofscoops(1);
        $order->addIcecreamitem($icecream4);
        $icecream4->setOrder($order);
        
        $toppings = array();
        
        $order->setToppingItems($toppings);
        
        $totalcost = $this->testTotalCost->getOrderCost($order);
        $order->setCost($totalcost);
        
        // assert that the totalcost is added correctly!
        $this->assertEquals(350, $order->getCost());
    }
}