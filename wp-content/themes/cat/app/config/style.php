<?php

return [

    'set' => [
        'custom-twentytwenty' => [
            'src' => 'style/twentytwenty.css',
            'dependence' => '',
            'version' => null,
            'media' => 'all',

            //'inline' => '.body {color: red;}'
        ],
        'custom-bootstrap' => [
            'src' => 'style/bootstrap.css',
            'dependence' => '',
            'version' => null,
            'media' => 'all',
        ],
        'custom-selectize' => [
            'src' => 'style/selectize.default.css',
            'dependence' => '',
            'version' => null,
            'media' => 'all',
        ],
        'custom-owl-carousel' => [
            'src' => 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css',
            'dependence' => '',
            'version' => null,
            'media' => 'all',
        ],
        'custom-main' => [
            'src' => 'style/main.css',
            'dependence' => '',
            'version' => null,
            'media' => 'all',
        ],

    ],

    'unset' => [
        'wp-block-library',
    ]

];