<?php

namespace App\Test\Controller;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use GuzzleHttp\Client;

class VesselPositionTest extends ApiTestCase
{
    public function getAuthenticationToken()
    {
        $client = new Client(['base_uri' => 'http://localhost:8000/']);
        $response = $client->request('POST', 'authentication_token', ['json' => ['password' => 'testtest', 'email' => 'test@test.com']]);
        $body = json_decode($response->getBody(), true);
        $token = $body['token'];
        return $token;
    }

    public function testGetPositions()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
        $token = $this->getAuthenticationToken();
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];

        $response = $client->request('GET', 'positions', [
            'headers' => $headers
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['application/json; charset=utf-8'], $response->getHeader('Content-Type'));
        $data = json_decode($response->getBody(), true);
        $this->assertEquals(30, count($data));

    }


    public function testGetPositionsWithPagination()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
        $token = $this->getAuthenticationToken();
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ];
        $params = [
            'page' => 2
        ];
        $response = $client->request('GET', 'positions', [
            'headers' => $headers,
            'query' => $params
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['application/json; charset=utf-8'], $response->getHeader('Content-Type'));
        $data = json_decode($response->getBody(), true);
        $this->assertEquals(30, count($data));

    }

    public function testGetPositionsWithFilters()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
        $token = $this->getAuthenticationToken();
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ];
        $params = [
            'lat' => 49.88358000,
            'lon' => -5.63347300
        ];
        $response = $client->request('GET', 'positions', [
            'headers' => $headers,
            'query' => $params
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['application/json; charset=utf-8'], $response->getHeader('Content-Type'));
        $data = json_decode($response->getBody(), true);
        $this->assertEquals(2, count($data));

    }

    public function testGetVesselById()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
        $token = $this->getAuthenticationToken();
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];

        $response = $client->request('GET', 'positions/1', [
            'headers' => $headers
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['application/json; charset=utf-8'], $response->getHeader('Content-Type'));

    }
}