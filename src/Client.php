<?php

namespace Giampaolo\LSRP\Auth;

use GuzzleHttp\Client as GuzzleHttp;
use Giampaolo\LSRP\Auth\Exceptions\PingException;

class Client
{
    public function __construct()
    {
        $this->http = new GuzzleHttp;
    }

    public function ping($fetchFrom = 'http://status.ls-rp.com/status.json')
    {
        $response = $this->http->request('GET', $fetchFrom);
        $body = $response->getBody()->getContents();

        $body = json_decode($body, true);

        if ($body === null || is_array($body) === false)
        {
            throw new PingException("lsrp-auth-php has failed to fetch servers' status from the API.");
        }

        if (array_key_exists('ucp', $body))
        {
            if ((int) $body['ucp'] === 1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
}