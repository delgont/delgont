<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Page Keys
    |--------------------------------------------------------------------------
    | Each page must have a unique key eg home, about-us, services, contact-us
    | These page keys may used as labels on the navigation menu, but can be edited later
    */
    'pages' => [
        'home', 'about-us', 'services', 'contact-us', 'gallery'
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Post types
    |--------------------------------------------------------------------------
    | Even though posts may be categorized futher, each post must belong to a specific type
    | Post types can also be entered manually via the cms keeping in mind that they must belong to epecific pages or categories
    */
    'posts' => [
        'news', 'service', 'main-slider', 'testimonial'
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Post types
    |--------------------------------------------------------------------------
    | Even though posts may be categorized futher, each post must belong to a specific type
    | Post types can also be entered manually via the cms keeping in mind that they must belong to epecific pages or categories
    */
    'categories' => [
        'latest news', 'sports', ''
    ]

];