<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS Configuración
    |--------------------------------------------------------------------------
    |
    | Aquí puedes configurar los ajustes de CORS para tu aplicación. Esto
    | determina qué origenes pueden acceder a tu API y con qué métodos y headers.
    |
    */

    'paths' => ['api/*', 'docs', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];
