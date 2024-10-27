<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class sparqlServiceUpdate
{
    protected $client;
    protected $endpoint;

    public function __construct()
    {
        $this->client = new Client();
        $this->endpoint = 'http://localhost:3030/RescueFood/update';
    }

   // Changez le nom de la méthode ici
public function update($query)
{
    try {
        Log::info('Sending request to SPARQL endpoint:', ['endpoint' => $this->endpoint, 'query' => $query]);

        // Utiliser POST au lieu de GET
        $response = $this->client->request('POST', $this->endpoint, [
            'form_params' => [
                'update' => $query, // Envoi de la requête SPARQL dans le corps
                'format' => 'application/sparql-results+json',
            ],
        ]);

        Log::info('Received response from SPARQL endpoint:', [
            'status' => $response->getStatusCode(),
            'body' => (string) $response->getBody()
        ]);

        if ($response->getStatusCode() !== 200) {
            Log::error('SPARQL query failed with status:', ['status' => $response->getStatusCode()]);
            return []; // ou gérer l'erreur comme nécessaire
        }

        return json_decode($response->getBody(), true);
    } catch (\Exception $e) {
        // Log any exceptions that occur during the request
        Log::error('SPARQL query error:', ['error' => $e->getMessage()]);
        return [];
    }
}
}
