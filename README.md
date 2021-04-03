# Supernova API

PHP library for interacting with the read-only [Supernova Fantasy Football API](https://www.supernovafantasyfootball.com).

![PHP Composer](https://github.com/danabrey/supernova-api/workflows/PHPUnit/badge.svg)

## Installation

`composer require danabrey/supernova-api`

## Usage

Create an instance of the client

`$client = new DanAbrey\SupernovaApi\SupernovaApiClient('xxxxxxxxxxxxxxx');`

An API key is required to interact with the Supernova API. This must be passed into the client as the only argument.

`$client->league('xxxxx')` where xxxxx is the league ID, for basic league info
`$client->rosters('xxxxx')` where xxxxx is the league ID, for all rosters
`$client->users('xxxxx')` where xxxxx is the league ID, for all users in a league

All methods return either a single instance, or an array of, objects that represent the data returned. e.g. `SupernovaLeague`

## Note

It is your responsibility to abide by the [terms of the Supernova API](https://www.supernovafantasyfootball.com).

### Running tests

`./vendor/bin/phpunit`
