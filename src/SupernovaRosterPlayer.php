<?php

namespace DanAbrey\SupernovaApi;

use Spatie\DataTransferObject\DataTransferObject;

class SupernovaRosterPlayer extends DataTransferObject
{
    public string $roster_group;
    public $salary = null;
    public ?int $contract_years = null;
    public ?int $contract_extendable = null;
    public SupernovaPlayer $player;
}
