<?php

namespace DanAbrey\SupernovaApi;

use Spatie\DataTransferObject\DataTransferObject;

class SupernovaUserLeague extends DataTransferObject
{
    public int $league_id;
    public string $league_name;
    public string $franchise_name;
}
