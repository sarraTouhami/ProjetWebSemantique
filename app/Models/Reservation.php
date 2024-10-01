<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'beneficiare_id',
        'don_id',
        'date_reservation',
        'statut_reservation',
    ];

    protected $casts = [
        'date_reservation' => 'datetime',
    ];

    // Mutator to set default values
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Set the default date to today's date if not provided
            if (is_null($model->date_reservation)) {
                $model->date_reservation = now();
            }

            // Set the default status if not provided
            if (is_null($model->statut_reservation)) {
                $model->statut_reservation = 'en_attente';
            }
        });
    }
}
