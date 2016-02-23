<?php

namespace Giampaolo\LSRP\Auth;

use GuzzleHttp\Client as GuzzleHttp;
use Giampaolo\LSRP\Auth\Exceptions\PingException;

class Client
{
    public function __construct()
    {
        $this->http = new GuzzleHttp(['cookies' => true]);
    }

    public function ping($fetchFrom = 'http://status.ls-rp.com/status.json')
    {
        try
        {
            $response = $this->http->request('GET', $fetchFrom, [
                'timeout' => 3
            ]);

            $body = $response->getBody()->getContents();

            $body = json_decode($body, true);

            if ($body === null || is_array($body) === false)
            {
                throw new PingException("lsrp-auth-php has failed to fetch servers' status from the API (parsing error).");
            }

            if (array_key_exists('ucp', $body))
            {
                return (int) $body['ucp'] === 1;
            }

        } catch (\GuzzleHttp\Exception\ConnectException $e)
        {
            throw new PingException("lsrp-auth-php has failed to fetch servers' status from the API (connection error).");
        }
    }
}