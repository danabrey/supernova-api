<?php
namespace DanAbrey\SupernovaApi\Tests\SupernovaApiClient;

use DanAbrey\SupernovaApi\SupernovaLeagueBasic;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class UserLeaguesTest extends TestCase
{
    private \DanAbrey\SupernovaApi\SupernovaApiClient $client;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->client = new \DanAbrey\SupernovaApi\SupernovaApiClient('xxxxxxxxxxxxxxxx');
    }

    public function test_get_leagues_for_user_success()
    {
        $data = file_get_contents(__DIR__ . '/../_data/leagues_success.json');
        $responses = [
            new MockResponse($data),
        ];
        $httpClient = new MockHttpClient($responses);
        $this->client->setHttpClient($httpClient);

        $leagues = $this->client->leagues('test@email.com');

        $this->assertIsArray($leagues);
        $this->assertCount(2, $leagues);

        $this->assertInstanceOf(SupernovaLeagueBasic::class, $leagues[0]);
        $this->assertEquals(10001, $leagues[0]->league_id);
        $this->assertEquals('Test Franchise Name 1', $leagues[0]->franchise_name);
        $this->assertEquals('Test League 1', $leagues[0]->league_name);

        $this->assertInstanceOf(SupernovaLeagueBasic::class, $leagues[1]);
        $this->assertEquals(10002, $leagues[1]->league_id);
        $this->assertEquals('Test Franchise Name 2', $leagues[1]->franchise_name);
        $this->assertEquals('Test League 2', $leagues[1]->league_name);
    }
}
