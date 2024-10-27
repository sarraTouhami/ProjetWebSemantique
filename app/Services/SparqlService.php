<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class SparqlService
{
    protected $client;
    protected $endpoint;

    public function __construct()
    {
        $this->client = new Client();
        $this->endpoint = 'http://localhost:3030/RescueFood/sparql';
    }

    public function query($query)
    {
        try {
            Log::info('Sending request to SPARQL endpoint:', ['endpoint' => $this->endpoint, 'query' => $query]);

            $response = $this->client->request('GET', $this->endpoint, [
                'query' => ['query' => $query, 'format' => 'application/sparql-results+json'],
            ]);

            Log::info('Received response from SPARQL endpoint:', [
                'status' => $response->getStatusCode(),
                'body' => (string) $response->getBody()
            ]);

            if ($response->getStatusCode() !== 200) {
                Log::error('SPARQL query failed with status:', ['status' => $response->getStatusCode()]);
                return []; // or handle error as needed
            }

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            // Log any exceptions that occur during the request
            Log::error('SPARQL query error:', ['error' => $e->getMessage()]);
            return [];
        }
    }
}
