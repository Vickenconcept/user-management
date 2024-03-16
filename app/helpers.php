<?php

use Laravel\Passport\ClientRepository;


function createClientAccessToken()
{
    $clientRepository = app(ClientRepository::class);

    $client = $clientRepository->createPersonalAccessClient(
        null, 
        'Anything', 
        'http://localhost'
    );
}
