<?php

namespace AppBundle\Constants;

class Flavour {
    // keys
    const FLAVOUR_KEY_VANILLA = 1;
    const FLAVOUR_KEY_BUTTERSCOTCH = 2;
    const FLAVOUR_KEY_CHOCOLATE = 3;
    const FLAVOUR_KEY_PISTA = 4;
    
    // names
    const FLAVOUR_NAME_VANILLA = 'Vanilla';
    const FLAVOUR_NAME_BUTTERSCOTCH = 'Butterscotch';
    const FLAVOUR_NAME_CHOCOLATE = 'Chocolate';
    const FLAVOUR_NAME_PISTA = 'Pista';
    
    // flavour costs
    const FLAVOUR_COST_VANILLA = 50;
    const FLAVOUR_COST_BUTTERSCOTCH = 80;
    const FLAVOUR_COST_CHOCOLATE = 100;
    const FLAVOUR_COST_PISTA = 120;
    
    // flavours array flavourname => flavourkey
    const FLAVOURS = array(
        self::FLAVOUR_NAME_VANILLA => self::FLAVOUR_KEY_VANILLA,
        self::FLAVOUR_NAME_BUTTERSCOTCH => self::FLAVOUR_KEY_BUTTERSCOTCH,
        self::FLAVOUR_NAME_CHOCOLATE => self::FLAVOUR_KEY_CHOCOLATE,
        self::FLAVOUR_NAME_PISTA => self::FLAVOUR_KEY_PISTA,
    );
    
    // flavourcost array flavourkey => flavourcost
    const FLAVOURCOST = array(
        self::FLAVOUR_KEY_VANILLA => self::FLAVOUR_COST_VANILLA,
        self::FLAVOUR_KEY_BUTTERSCOTCH => self::FLAVOUR_COST_BUTTERSCOTCH,
        self::FLAVOUR_KEY_CHOCOLATE => self::FLAVOUR_COST_CHOCOLATE,
        self::FLAVOUR_KEY_PISTA => self::FLAVOUR_COST_PISTA,
    );

} 