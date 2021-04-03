<?php
namespace DanAbrey\SupernovaApi\Tests\SupernovaApiClient;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class SupernovaApiClientTestCase extends TestCase
{
    protected \DanAbrey\SupernovaApi\SupernovaApiClient $client;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->client = new \DanAbrey\SupernovaApi\SupernovaApiClient('xxxxxxxxxxxxxxxx');
    }

    protected function setResponseJson(string $json)
    {
        $responses = [
            new MockResponse($json),
        ];
        $httpClient = new MockHttpClient($responses);
        $this->client->setHttpClient($httpClient);
    }
}
