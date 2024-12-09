<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiDataFetcher
{
    private string $apiKey;
    private string $baseUrl;
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        $this->apiKey = 'BhLQGUXN245UtV3';
        $this->baseUrl = 'http://159.65.123.24/data/export';
    }

    public function fetchData(string $lastDate, int $page = 1): array
    {
        $url = sprintf('%s/%s/%d?api-key=%s', $this->baseUrl, $lastDate, $page, $this->apiKey);

        $response = $this->client->request('GET', $url);
        return $response->toArray();
    }
}