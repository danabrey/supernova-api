<?php

namespace DanAbrey\SupernovaApi;

use Spatie\DataTransferObject\DataTransferObject;

class SupernovaPlayer extends DataTransferObject
{
    public int $id;
    public ?int $mfl_id;
    public ?int $sleeper_id;
    public string $first_name;
    public string $last_name;
    public string $position;
    public string $team_abbreviation;
}
