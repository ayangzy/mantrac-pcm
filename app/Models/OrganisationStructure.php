<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisationStructure extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = ['pivot'];

    public function organisations()
    {
        return $this->belongsToMany(Organisation::class, 'organisation_structure_organisation', 'structure_id')
            ->withTimestamps();
    }
}
