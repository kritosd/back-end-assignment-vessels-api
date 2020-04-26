<?php

namespace App\Test\Controller;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use GuzzleHttp\Client;

class VesselStatusTest extends ApiTestCase
{
    public function getAuthenticationToken()
    {
        $client = new Client(['base_uri' => 'http://localhost:8000/']);
        $response = $client->request('POST', 'authentication_token', ['json' => ['password' => 'testtest', 'email' => 'test@test.com']]);
        $body = json_decode($response->getBody(), true);
        $token = $body['token'];
        return $token;
    }

    public function testGetVesselStatuses()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
        $token = $this->getAuthenticationToken();
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];

        $response = $client->request('GET', 'vessel_statuses', [
            'headers' => $headers
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['application/json; charset=utf-8'], $response->getHeader('Content-Type'));
        $data = json_decode($response->getBody(), true);
        $this->assertEquals(7, count($data));

    }


    public function testGetVesselStatusesWithPagination()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
        $token = $this->getAuthenticationToken();
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ];
        $params = [
            'page' => 1
        ];
        $response = $client->request('GET', 'vessel_statuses', [
            'headers' => $headers,
            'query' => $params
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['application/json; charset=utf-8'], $response->getHeader('Content-Type'));
        $data = json_decode($response->getBody(), true);
        $this->assertEquals(7, count($data));

    }

    public function testGetVesselStatusesWithFilters()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
        $token = $this->getAuthenticationToken();
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ];
        $params = [
            'name' => 'Underway using Engine'
        ];
        $response = $client->request('GET', 'vessel_statuses', [
            'headers' => $headers,
            'query' => $params
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['application/json; charset=utf-8'], $response->getHeader('Content-Type'));
        $data = json_decode($response->getBody(), true);
        $this->assertEquals('Underway using Engine', $data[0]['name']);

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

        $response = $client->request('GET', 'vessel_statuses/3', [
            'headers' => $headers
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['application/json; charset=utf-8'], $response->getHeader('Content-Type'));
        $data = json_decode($response->getBody(), true);
        $this->assertEquals('Restricted Manoeuvrability', $data['name']);

    }
}