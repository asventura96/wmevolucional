<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateCity extends Model
{
    use HasFactory;

    protected $table = 'state_cities'; 
    protected $guarded = [];

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
