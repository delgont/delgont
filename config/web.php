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
    | Post types can also be entered manually via the cms keeping in mind that they must belong to specific pages or categories
    */
    'post_types' => [
        'news', 'service', 'main-slider', 'testimonial'
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Categories -- used to categorise posts and any model that uses the Categorable trait
    |--------------------------------------------------------------------------
    */
    'categories' => [
        'latest news', 'sports', 'team member'
    ],

    'options' => [
        'option_key' => 'default-value-here'
    ],

    'option_sidebar_link_routes' => [
        'web.settings'
    ]

];