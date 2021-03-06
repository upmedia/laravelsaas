<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public function scopeActive(Builder $builder)
    {
        $builder->where('active', true);
    }

    public function scopeForUsers(Builder $builder)
    {
        $builder->where('teams_enabled', false);
    }

    public function scopeForTeams(Builder $builder)
    {
        $builder->where('teams_enabled', true);
    }
}
