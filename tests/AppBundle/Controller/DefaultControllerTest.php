<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Entity\Order;
use AppBundle\Entity\IcecreamItem;
use AppBundle\Constants\Flavour;
use AppBundle\Constants\Topping;
use AppBundle\Service\TotalCostUtility;

class DefaultControllerTest extends BaseTestCase {
    
    protected $testTotalCost;

    /**
     * Test Homepage and createorder pages are loading 
     * 
     * @dataProvider provideUrls
     */
    public function testPageIsSuccessful($url) {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function provideUrls() {
        return [
            
            ['/'],
            ['/createorder'],
        ];
    }

    /*
     * Test order summary page is loading 
     */
    public function testSummaryAction() {
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
        $this->entityManager->persist($order);
        $this->entityManager->flush();
        
        $client = static::createClient();

        $client->request('GET', '/summary/'.$order->getId());

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

}
