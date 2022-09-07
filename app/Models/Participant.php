<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Participant extends Model
{
    use HasFactory;

    /**
     * Get the information associated with the Participant
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function information(): HasOne
    {
        return $this->hasOne(Information::class);
    }
}
