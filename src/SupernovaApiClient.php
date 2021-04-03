<?php
namespace DanAbrey\SupernovaApi;

use DanAbrey\SupernovaApi\Exception\InvalidApiKeyException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
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
        $response = $this->httpClient->request('GET', self::API_BASE . $path);

        $json = json_decode($response->getContent(), true);

        if ($json['statusCode'] === 401 && $json['errorMsg'] === 'Invalid API Key was provided') {
            throw new InvalidApiKeyException();
        }

        return $json['data'];
    }

    /**
     * @param string $userEmail
     * @return DanAbrey\SupernovaApi\SupernovaLeagueBasic[]|array
     */
    public function leagues(string $userEmail): array
    {
        $response = $this->get('/getuserleagues?user=%s' . urlencode($userEmail));
        $normalizers = [new ArrayDenormalizer(), new ObjectNormalizer()];
        $serializer = new Serializer($normalizers);
        return $serializer->denormalize($response['leagues'], SupernovaLeagueBasic::class . '[]');
    }
}
