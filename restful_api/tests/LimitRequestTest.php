<?php

namespace App\Test\Controller;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use GuzzleHttp\Client;

class LimitRequestTest extends ApiTestCase
{
    public function getAuthenticationToken($password, $email)
    {
        $client = new Client(['base_uri' => 'http://localhost:8000/']);
        $response = $client->request('POST', 'authentication_token', ['json' => ['password' => $password, 'email' => $email]]);
        $body = json_decode($response->getBody(),  true);
        $token = $body['token'];
        return $token;
    }
    public function testLimitRequest()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
        $token = $this->getAuthenticationToken('adminadmin', 'admin@admin.com');
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];
        for ($i = 1; $i <= 11; $i++) {

            $response = $client->request('GET', 'vessels', [
                'headers' => $headers
            ]);

            if($i == 11)
                $this->assertEquals(429, $response->getStatusCode());
            else
                $this->assertEquals(200, $response->getStatusCode());
        }
    }

}