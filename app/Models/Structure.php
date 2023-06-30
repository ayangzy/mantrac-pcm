<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = ['pivot'];

    public function organisations()
    {
        return $this->belongsToMany(Organisation::class, 'organisation_structure')
            ->withTimestamps();
    }
}
