<?php

return [

    'dealstage' => [
        'seller_lead' => env('HUBSPOT_DEALSTAGE_SELLER_LEAD', '7a90a5fe-ea83-4856-8e1e-0542b2d7f3f8'),
        'valuation' => env('HUBSPOT_DEALSTAGE_VALUATION', 'appointmentscheduled'),
        'mandate' => env('HUBSPOT_DEALSTAGE_MANDATE', 'qualifiedtobuy'),
        'deed_of_sale' => env('HUBSPOT_DEALSTAGE_DEED_OF_SALE', 'decisionmakerboughtin'),
        'cancelled' => env('HUBSPOT_DEALSTAGE_CANCELLED', 'contractsent'),
        'transfer' => env('HUBSPOT_DEALSTAGE_TRANSFER', 'closedwon'),
    ],

];
