<?php

namespace AppBundle\Service;

use AppBundle\Constants\Flavour;
use AppBundle\Constants\Topping;

class TotalCostUtility {

    /**
     * Returns the total cost for the order
     * @param Object $order
     * @return number
     */
    public function getOrderCost($order) {
        $icecreamscost = 0;
        $toppingscost = 0;
        $totalcost = 0;
        foreach ($order->getIcecreamItems() as $icecream) {
            $flavour = $icecream->getFlavour();
            $flavourcost = Flavour::FLAVOURCOST[$flavour];
            $numofscoops = $icecream->getNumofscoops();
            $icecreamscost += $flavourcost * $numofscoops;
        }
        foreach ($order->getToppingItems() as $topping) {
            $toppingscost += Topping::TOPPINGCOST[$topping];
        }
        // find totalcost using icecream cost and topping cost
        $totalcost = bcadd($icecreamscost,$toppingscost);
        // return totalcost
        return $totalcost;
    }

}    