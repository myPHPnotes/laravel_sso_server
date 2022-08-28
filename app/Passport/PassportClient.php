<?php

namespace App\Passport;
use Laravel\Passport\Client;

class PassportClient extends Client
{
    /**
     * Determine if the client should skip the authorization prompt.
     *
     * @return bool
     */
    public function skipsAuthorization()
    {
        // todo: add some checks, e.g. $this->name === 'spa-client'
        return false;
    }
}
