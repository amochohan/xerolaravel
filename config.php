<?php

return [

    'oauth' => [

        /*
        |--------------------------------------------------------------------------
        | OAuth Callback
        |--------------------------------------------------------------------------
        |
        | Provide a callback URL, or use 'oob' if one isn't required.
        |
        */

        'callback'          => 'oob',

        /*
        |--------------------------------------------------------------------------
        | Xero application authentication
        |--------------------------------------------------------------------------
        |
        | Before using this service, you'll need to register an applicatin via
        | the Xero developer website. When setting up your application, take
        | note of the consumer key and shared secret, as well as the
        | application type (private, public or partner).
        |
        */

        'consumer_key'      => 'YOURCONSUMERKEY',
        'consumer_secret'   => 'YOURSECRETKEY',

        /*
        |--------------------------------------------------------------------------
        | RSA keys
        |--------------------------------------------------------------------------
        |
        | Ensure that you have generated the required private and public rsa keys
        | using the guide provided: http://bit.ly/1dIn55j.
        |
        | openssl genrsa -out privatekey.pem 1024
        | openssl req -new -x509 -key privatekey.pem -out publickey.cer -days 1825
        | openssl pkcs12 -export -out public_privatekey.pfx -inkey privatekey.pem -in publickey.cer
        |
        | The path must follow the format file:// and then the absolute path of the
        | keys on the server.
        |
        | Note: do not omit the first '/'  if using a UNIX based filesystem when
        | setting the absolute path (so the path should begin with 'file:///'.
        |
        */

        'rsa_private_key'  => 'file:///home/absolutepath/vendor/src/drawmyattention/xerolaravel/Certificates/privatekey.pem',
        'rsa_public_key'   => 'file:///home/absolutepath/vendor/src/drawmyattention/xerolaravel/Certificates/publickey.cer'
    ]

];
