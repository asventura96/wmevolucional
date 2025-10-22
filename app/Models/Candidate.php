<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Candidate extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function zodiacSign(): BelongsTo
    {
        return $this->belongsTo(ZodiacSign::class);
    }

    public function religion(): BelongsTo
    {
        return $this->belongsTo(Religion::class);
    }

    public function maritalStatus(): BelongsTo
    {
        return $this->belongsTo(MaritalStatus::class);
    }

    public function birthplace(): BelongsTo
    {
        return $this->belongsTo(StateCity::class, 'birthplace_id');
    }
}
