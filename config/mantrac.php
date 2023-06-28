<?php

return [

    // Status codes for responses in the application
    'status_codes' => [
        'success' => 200,
        'created' => 201,
        'server_error' => 500,
        'validation_failed' => 422,
        'bad_request' => 400,
        'forbidden' => 403,
        'unauthorised' => 401,
        'not_found' => 404,
        'no_content' => 204,
        'un_authenticated' => 401,
        'bad_gateway' => 502
    ],

    // Status text for responses in the application
    'status_texts' => [
        'success' => 'success',
        'created' => 'created',
        'server_error' => 'server_error',
        'validation_failed' => 'validation_failed',
        'bad_request' => 'bad_request',
        'forbidden' => 'forbidden',
        'not_found' => 'not_found',
        'unauthorised' => 'unauthorised',
        'bad_gateway' => 'bad_gateway',
        'un_authenticated' => 'un_authenticated'
    ],

];
