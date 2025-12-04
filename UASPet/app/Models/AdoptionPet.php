<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class AdoptionPet extends Model
{
    protected $table = 'adoption_pets';

    protected $fillable = [
        'name',
        'species',
        'breed',
        'age',
        'gender',
        'weight',
        'color',
        'description',
        'vaccinated',
        'sterilized',
        'dewormed',
        'adoption_fee',
        'status',
        'images',
        'special_notes',
        'entry_date',
    ];

    protected $casts = [
        'images' => 'array',
    ];

}
