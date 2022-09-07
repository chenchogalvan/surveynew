<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Evaluation extends Model
{
    use HasFactory;


    /**
     * Get the company that owns the Evaluation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get all of the quizzes for the Evaluation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }
}
