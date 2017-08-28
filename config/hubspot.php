<?php

return [

    'dealstage' => [
        'deed_of_sale' => env('HUBSPOT_DEALSTAGE_DEED_OF_SALE', 'decisionmakerboughtin'),
        'cancelled' => env('HUBSPOT_DEALSTAGE_CANCELLED', 'contractsent'),
        'transfer' => env('HUBSPOT_DEALSTAGE_TRANSFER', 'closedwon'),
    ],

];
