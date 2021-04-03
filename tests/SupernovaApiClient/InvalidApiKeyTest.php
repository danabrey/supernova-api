<?php
namespace DanAbrey\SupernovaApi\Tests\SupernovaApiClient;

use DanAbrey\SupernovaApi\Exception\InvalidApiKeyException;

class InvalidApiKeyTest extends SupernovaApiClientTestCase
{
    public function test_get_leagues_for_user_success()
    {
        $this->setResponseJson(file_get_contents(__DIR__ . '/../_data/invalid_api_key.json'));

        $this->expectException(InvalidApiKeyException::class);

        // Make any request using any method
        $this->client->leagues('test@email.com');
    }
}
