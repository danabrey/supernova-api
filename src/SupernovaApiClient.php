<?php
namespace DanAbrey\SupernovaApi;

use DanAbrey\SupernovaApi\Exception\InvalidApiKeyException;
use DanAbrey\SupernovaApi\Exception\LeagueNotFoundException;
use DanAbrey\SupernovaApi\Exception\SupernovaApiException;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpClient\Exception\RedirectionException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
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
     * @throws LeagueNotFoundException
     * @throws SupernovaApiException
     */
    protected function get(string $path): array
    {
        $response = $this->httpClient->request('GET', self::API_BASE . $path, [
            'headers' => [
                'User-Agent' => 'danabrey/supernova-api',
                'x-api-key'  => $this->apiKey,
            ],
        ]);

        $json = json_decode($response->getContent(), true);

        if ($json['statusCode'] !== 200) {
            switch ($json['errorMsg']) {
                case 'Invalid API Key was provided':
                    throw new InvalidApiKeyException();
                case 'League not found':
                    throw new LeagueNotFoundException();
                default:
                    throw new SupernovaApiException($json['errorMsg']);
            }
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
        return new SupernovaLeague($response['data']);
    }
}
