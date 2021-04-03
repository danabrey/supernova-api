<?php

namespace DanAbrey\SupernovaApi;

use Spatie\DataTransferObject\DataTransferObject;

class SupernovaLeague extends DataTransferObject
{
    public string $league_name;
    public int $roster_size;
    public int $ir_size;
    public int $practice_size;
    public bool $isContract;
    public bool $isSalaryCap;
    public bool $isPPR;
    public bool $isSuperFlex;
    public array $positions;
    /** @var \DanAbrey\SupernovaApi\SupernovaFranchise[] */
    public array $franchises;
}
