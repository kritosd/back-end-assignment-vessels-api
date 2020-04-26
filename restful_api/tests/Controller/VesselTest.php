<?php

namespace App\Test\Controller;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use GuzzleHttp\Client;

class VesselTest extends ApiTestCase
{
    public function getAuthenticationToken()
    {
        $client = new Client(['base_uri' => 'http://localhost:8000/']);
        $response = $client->request('POST', 'authentication_token', ['json' => ['password' => 'testtest', 'email' => 'test@test.com']]);
        $body = json_decode($response->getBody(),  true);
        $token = $body['token'];
        return $token;
    }
    public function testGetVessels()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
        $token = $this->getAuthenticationToken();
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json',
        ];

        $response = $client->request('GET', 'vessels', [
            'headers' => $headers
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['application/json; charset=utf-8'], $response->getHeader('Content-Type'));
        $data = json_decode($response->getBody(), true);
        $this->assertEquals(30, count($data));

    }

    public function testGetVesselsXml()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
        $token = $this->getAuthenticationToken();
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/xml',
        ];

        $response = $client->request('GET', 'vessels', [
            'headers' => $headers
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['application/xml; charset=utf-8'], $response->getHeader('Content-Type'));

    }

    public function testGetVesselsWithPagination()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
        $token = $this->getAuthenticationToken();
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json'
        ];
        $params = [
            'page' => 2
        ];
        $response = $client->request('GET', 'vessels', [
            'headers' => $headers,
            'query' => $params
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['application/json; charset=utf-8'], $response->getHeader('Content-Type'));
        $data = json_decode($response->getBody(), true);
        $this->assertEquals(30, count($data));

    }

    public function testGetVesselsWithFilters()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
        $token = $this->getAuthenticationToken();
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json'
        ];
        $params = [
            'mmsi' => ['228259600', '228296800'],
            'position.lat[gte]' => 44.88810000,
            'position.lat[lte]' => 44.88810000,
            'position.lon[gte]' => -0.53266170,
            'position.lon[lte]' => -0.53266170,
            //'width' => 7,
            'length' => 24.99
        ];
        $response = $client->request('GET', 'vessels', [
            'headers' => $headers,
            'query' => $params
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['application/json; charset=utf-8'], $response->getHeader('Content-Type'));
        $data = json_decode($response->getBody(), true);
        $this->assertEquals(1, count($data));

    }

    public function testGetVesselById()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
        $token = $this->getAuthenticationToken();
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json',
        ];

        $response = $client->request('GET', 'vessels/33', [
            'headers' => $headers
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['application/json; charset=utf-8'], $response->getHeader('Content-Type'));

    }

    public function testGetVesselpositions()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
        $token = $this->getAuthenticationToken();
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json',
        ];
        $response = $client->request('GET', 'vessels/33/positions', [
            'headers' => $headers
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['application/json; charset=utf-8'], $response->getHeader('Content-Type'));
        $data = json_decode($response->getBody(), true);
        $this->assertEquals(28, count($data));

    }

    public function testGetVesselstatus()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
        $token = $this->getAuthenticationToken();
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json',
        ];
        $response = $client->request('GET', 'vessels/33/status', [
            'headers' => $headers
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['application/json; charset=utf-8'], $response->getHeader('Content-Type'));
        $data = json_decode($response->getBody(), true);
        $this->assertEquals('Underway using Engine', $data['name']);

    }

    public function testGetVesseltype()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
        $token = $this->getAuthenticationToken();
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json',
        ];
        $response = $client->request('GET', 'vessels/33/type', [
            'headers' => $headers
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['application/json; charset=utf-8'], $response->getHeader('Content-Type'));
        $data = json_decode($response->getBody(), true);
        $this->assertEquals('Trawler', $data['name']);

    }
}