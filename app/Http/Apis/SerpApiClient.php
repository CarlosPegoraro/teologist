<?php

namespace App\Http\Apis;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class SerpApiClient
{
    private Client $client;
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://serpapi.com/',
        ]);
    }

    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function searchByGoogle($query)
    {
        $apiKey = config('services.serpapi.key');
        $search = $this->client->get('search?engine=google', [
            'query' => ['q' => $query, 'api_key' => $apiKey, 'tbm' => 'nws']
        ]);

        $decoded = json_decode($search->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);

        return $decoded->news_results;
    }
}
