<?php

namespace DanAbrey\SupernovaApi;

use Spatie\DataTransferObject\DataTransferObject;

class SupernovaPlayer extends DataTransferObject
{
    public int $id;
    public ?int $gs_id = null;
    public ?int $ffn_id = null;
    public ?int $mfl_id = null;
    public ?int $sleeper_id = null;
    public ?int $fleaflicker_id = null;
    public ?int $espn_id = null;
    public ?int $fantasypros_id = null;
    public ?string $pfr_id = null;
    public ?int $age = null;
    public ?int $draft_year = null;
    public ?int $dp_1qb_value = null;
    public ?int $dp_2qb_value = null;
    public string $first_name;
    public string $last_name;
    public string $position;
    public string $team_abbreviation;
    public ?int $team_id = null;
    public ?string $date_of_birth = null;
    public int $rookie;
    public ?string $injury_status = null;
    public int $drafts;
    public int $standard_rank;
    public int $ppr_rank;
    public int $ffn_standard_rank;
    public int $ffn_ppr_rank;
    public string $created_at;
    public string $updated_at;
    public ?int $fantasydata_id = null;
    public int $active;
}
