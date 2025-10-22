<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Candidate extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'birth_date' => 'date',
    ];

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

    // Relacionamentos One-to-One
    // (Assumindo que um candidato tem APENAS UM registro de contato, documento e endereço)

    public function contact(): HasOne
    {
        return $this->hasOne(CandidateContact::class);
    }

    public function document(): HasOne
    {
        return $this->hasOne(CandidateDocument::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(CandidateAddress::class);
    }
}
