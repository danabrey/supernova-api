<?php
namespace DanAbrey\SupernovaApi;

use DanAbrey\SupernovaApi\Exception\InvalidApiKeyException;
use DanAbrey\SupernovaApi\Exception\LeagueNotFoundException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SupernovaApiClient
{
    private HttpClientInterface $httpClient;

    private string $apiKey;

    private const API_BASE = "http://www.supernovafantasyfootball.com/api";

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->httpClient = HttpClient::create();
    }

    public function setHttpClient(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param string $path
     * @return array
     * @throws InvalidApiKeyException
     */
    protected function get(string $path): array
    {
        $response = $this->httpClient->request('GET', self::API_BASE . $path, [
            'headers' => [
                'User-Agent' => 'danabrey/supernova-api',
                'x-api-key' => $this->apiKey,
            ],
        ]);

        $json = json_decode($response->getContent(), true);

        if ($json['statusCode'] === 401 && $json['errorMsg'] === 'Invalid API Key was provided') {
            throw new InvalidApiKeyException();
        }

        return $json;
    }

    public function leagues(string $userEmail): SupernovaUserLeaguesCollection
    {
        $response = $this->get('/getuserleagues?user=' . urlencode($userEmail));
        return SupernovaUserLeaguesCollection::create($response['data']['leagues']);
    }

    public function league(int $leagueId): SupernovaLeague
    {
        $response = $this->get('/getfranchises?league=' . $leagueId);

        if ($response['statusCode'] === 401 && $response['errorMsg'] === 'League not found') {
            throw new LeagueNotFoundException();
        }

        return new SupernovaLeague($response['data']);
    }
}
