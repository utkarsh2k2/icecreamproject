<?php

namespace AppBundle\Constants;

class Topping {
    // keys
    const TOPPING_KEY_NUTS = 1;
    const TOPPING_KEY_CANDY = 2;
    const TOPPING_KEY_SPINKLES = 3;
    
    // names
    const TOPPING_NAME_NUTS = 'Nuts';
    const TOPPING_NAME_CANDY = 'Candy';
    const TOPPING_NAME_SPINKLES = 'Spinkles';
    
    // costs
    const TOPPING_COST_NUTS = 20;
    const TOPPING_COST_CANDY = 40;
    const FTOPPING_COST_SPINKLES = 60;
    
    // toppings array toppingname => toppingkeys
    const TOPPINGS = array(
        self::TOPPING_NAME_NUTS => self::TOPPING_KEY_NUTS,
        self::TOPPING_NAME_CANDY => self::TOPPING_KEY_CANDY,
        self::TOPPING_NAME_SPINKLES => self::TOPPING_KEY_SPINKLES,
    );
    
    // toppingcost array toppingkey => toppingcost
    const TOPPINGCOST = array(
        self::TOPPING_KEY_NUTS => self::TOPPING_COST_NUTS,
        self::TOPPING_KEY_CANDY => self::TOPPING_COST_CANDY,
        self::TOPPING_KEY_SPINKLES => self::FTOPPING_COST_SPINKLES,
    );
}  