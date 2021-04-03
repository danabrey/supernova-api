<?php

namespace DanAbrey\SupernovaApi;

use Spatie\DataTransferObject\DataTransferObjectCollection;

class SupernovaUserLeaguesCollection extends DataTransferObjectCollection
{
    public static function create(array $data): SupernovaUserLeaguesCollection
    {
        return new static(SupernovaUserLeague::arrayOf($data));
    }
}
