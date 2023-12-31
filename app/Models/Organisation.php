<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function structures()
    {
        return $this->belongsToMany(Structure::class, 'organisation_structure')
            ->withTimestamps();
    }

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }
}
