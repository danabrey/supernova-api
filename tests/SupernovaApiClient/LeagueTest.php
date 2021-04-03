<?php

namespace DanAbrey\SupernovaApi\Tests\SupernovaApiClient;

use DanAbrey\SupernovaApi\Exception\LeagueNotFoundException;
use DanAbrey\SupernovaApi\SupernovaFranchise;
use DanAbrey\SupernovaApi\SupernovaPlayer;
use DanAbrey\SupernovaApi\SupernovaRosterPlayer;

class LeagueTest extends SupernovaApiClientTestCase
{
    public function test_league_properties_are_set(): void
    {
        $this->setResponseJson(file_get_contents(__DIR__ . '/../_data/league_success.json'));
        $league = $this->client->league(10000);

        self::assertEquals('Main Test League', $league->league_name);
        self::assertEquals(25, $league->roster_size);
        self::assertEquals(3, $league->ir_size);
        self::assertEquals(5, $league->practice_size);
        self::assertEquals(true, $league->isContract);
        self::assertEquals(true, $league->isSalaryCap);
        self::assertEquals(true, $league->isPPR);
        self::assertEquals(true, $league->isSuperFlex);
        self::assertIsArray($league->positions);
        self::assertIsArray($league->franchises);
        self::assertCount(15, $league->positions);
        self::assertCount(6, $league->franchises);
    }

    public function test_franchise_properties_are_set(): void
    {
        $this->setResponseJson(file_get_contents(__DIR__ . '/../_data/league_success.json'));
        $league = $this->client->league(10000);

        $franchise1 = $league->franchises[0];

        self::assertInstanceOf(SupernovaFranchise::class, $franchise1);
        self::assertEquals(1, $franchise1->id);
        self::assertEquals('Franchise 1', $franchise1->franchise_name);
        self::assertIsArray($franchise1->roster);
    }

    public function test_roster_player_properties_are_set(): void
    {
        $this->setResponseJson(file_get_contents(__DIR__ . '/../_data/league_success.json'));
        $league = $this->client->league(10000);

        $roster = $league->franchises[0]->roster;

        self::assertInstanceOf(SupernovaRosterPlayer::class, $roster[0]);
        self::assertInstanceOf(SupernovaRosterPlayer::class, $roster[1]);

        self::assertEquals('active', $roster[0]->roster_group);
        self::assertEquals(1, $roster[0]->salary);
        self::assertEquals(1, $roster[0]->contract_years);
        self::assertEquals(1, $roster[0]->contract_extendable);
        self::assertInstanceOf(SupernovaPlayer::class, $roster[0]->player);
    }

    public function test_player_properties_are_set(): void
    {
        $this->setResponseJson(file_get_contents(__DIR__ . '/../_data/league_success.json'));
        $league = $this->client->league(10000);

        $player = $league->franchises[0]->roster[0]->player;

        self::assertInstanceOf(SupernovaPlayer::class, $player);

        self::assertEquals(100070, $player->id);
        self::assertEquals(13671, $player->mfl_id);
        self::assertEquals(5012, $player->sleeper_id);
        self::assertEquals('Mark', $player->first_name);
        self::assertEquals('Andrews', $player->last_name);
        self::assertEquals('TE', $player->position);
        self::assertEquals('BAL', $player->team_abbreviation);
    }

    public function test_league_not_found_exception_thrown(): void
    {
        $this->setResponseJson(file_get_contents(__DIR__ . '/../_data/league_not_found.json'));

        $this->expectException(LeagueNotFoundException::class);

        // Any league ID
        $this->client->league(10000);
    }
}
