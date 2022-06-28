<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Route prefix for accessing the admin panel for dlegont cms -- default dashboard
    |--------------------------------------------------------------------------
    */
    'route_prefix' => 'dashboard',

     /*
    |--------------------------------------------------------------------------
    | The middlewares that protect access to the CMS dashboard.
    | By default it uses web, and auth
    |
    | 'middlewares' => ['web', 'auth'],
    |--------------------------------------------------------------------------
    */
    'middlewares' => ['web', 'auth'],

];