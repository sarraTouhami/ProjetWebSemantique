<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'contenu',
        'type',
        'applicable_a', // Applicable to either donor or beneficiary
        'user_id', // Foreign key for the applicable user
    ];

    /**
     * Get the user (donor/beneficiary) associated with the recommendation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
