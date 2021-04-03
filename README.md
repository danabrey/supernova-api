# Supernova API

PHP library for interacting with the read-only [Supernova Fantasy Football API](https://www.supernovafantasyfootball.com).

![PHP Composer](https://github.com/danabrey/supernova-api/workflows/PHPUnit/badge.svg)

## Installation

`composer require danabrey/supernova-api`

## Usage

Create an instance of the client

`$client = new DanAbrey\SupernovaApi\SupernovaApiClient('api_key_here');`

An API key is required to interact with the Supernova API. This must be passed into the client as the only argument.

`$client->leagues('xxxxx')` where xxxxx is the user's email address for list of user's leagues basic info

All methods return either a single instance, or an array of, objects that represent the data returned. e.g. `SupernovaLeagueBasic`

## Note

It is your responsibility to abide by the [terms of the Supernova API](https://www.supernovafantasyfootball.com).

### Running tests

`./vendor/bin/phpunit`
