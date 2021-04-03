<?php

namespace DanAbrey\SupernovaApi;

use Spatie\DataTransferObject\DataTransferObject;

class SupernovaFranchise extends DataTransferObject
{
    public int $id;
    public string $franchise_name;
    /** @var \DanAbrey\SupernovaApi\SupernovaRosterPlayer[] */
    public array $roster;
}
