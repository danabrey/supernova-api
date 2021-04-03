<?php
namespace DanAbrey\SupernovaApi\Tests\SupernovaApiClient;

use DanAbrey\SupernovaApi\Exception\InvalidApiKeyException;

class InvalidApiKeyTest extends SupernovaApiClientTestCase
{
    public function test_invalid_api_key_exception_is_thrown_when_response_is_401()
    {
        $this->setResponseJson(file_get_contents(__DIR__ . '/../_data/invalid_api_key.json'));

        $this->expectException(InvalidApiKeyException::class);

        // Make any request using any method
        $this->client->leagues('test@email.com');
    }
}
