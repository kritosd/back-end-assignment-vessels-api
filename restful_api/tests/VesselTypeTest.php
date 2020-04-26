<?php

namespace App\Test\Controller;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use GuzzleHttp\Client;

class VesselTypeTest extends ApiTestCase
{
    public function getAuthenticationToken()
    {
        $client = new Client(['base_uri' => 'http://localhost:8000/']);
        $response = $client->request('POST', 'authentication_token', ['json' => ['password' => 'testtest', 'email' => 'test@test.com']]);
        $body = json_decode($response->getBody(), true);
        $token = $body['token'];
        return $token;
    }

    public function testGetVesselTypes()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
        $token = $this->getAuthenticationToken();
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];

        $response = $client->request('GET', 'vessel_types', [
            'headers' => $headers
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['application/json; charset=utf-8'], $response->getHeader('Content-Type'));
        $data = json_decode($response->getBody(), true);
        $this->assertEquals(30, count($data));

    }


    public function testGetVesselTypesWithPagination()
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
        $response = $client->request('GET', 'vessel_types', [
            'headers' => $headers,
            'query' => $params
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['application/json; charset=utf-8'], $response->getHeader('Content-Type'));
        $data = json_decode($response->getBody(), true);
        $this->assertEquals(7, count($data));

    }

    public function testGetVesselTypesWithFilters()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
        $token = $this->getAuthenticationToken();
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ];
        $params = [
            'name' => 'Hopper Dredger'
        ];
        $response = $client->request('GET', 'vessel_types', [
            'headers' => $headers,
            'query' => $params
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['application/json; charset=utf-8'], $response->getHeader('Content-Type'));
        $data = json_decode($response->getBody(), true);
        $this->assertEquals('Hopper Dredger', $data[0]['name']);

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

        $response = $client->request('GET', 'vessel_types/3', [
            'headers' => $headers
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['application/json; charset=utf-8'], $response->getHeader('Content-Type'));
    }
}