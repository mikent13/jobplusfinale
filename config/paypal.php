<?php

return array(

    /**
     * Set our Sandbox and Live credentials
     */
    'client_id' => env('PAYPAL_SANDBOX_CLIENT_ID', 'AdltHbOdYxipmAPM-FU2eh8wX1_q-C5lyAfGpMHg2fTK9z_Z195wsKagYiDzkGfNLY9Ezm4wGcLz8iRA'),
    'secret' => env('PAYPAL_SANDBOX_SECRET', 'EKjL_JDL8T0w6Mm3YprKAIKQGRdSrNSQuhek62ettWbSnropjzaiuFe70XTnr93Ht7_2f26hwAa1hmIT'),

    
    /**
     * SDK configuration settings
     */
    'settings' => array(

        /** 
         * Payment Mode
         *
         * Available options are 'sandbox' or 'live'
         */
        'mode' => env('PAYPAL_MODE', 'sandbox'),
        
        // Specify the max connection attempt (3000 = 3 seconds)
        'http.ConnectionTimeOut' => 3000,
       
        // Specify whether or not we want to store logs
        'log.LogEnabled' => true,
        
        // Specigy the location for our paypal logs
        'log.FileName' => storage_path() . '/logs/paypal.log',
        
        /** 
         * Log Level
         *
         * Available options: 'DEBUG', 'INFO', 'WARN' or 'ERROR'
         * 
         * Logging is most verbose in the DEBUG level and decreases 
         * as you proceed towards ERROR. WARN or ERROR would be a 
         * recommended option for live environments.
         * 
         */
        'log.LogLevel' => 'DEBUG'
    ),
);

