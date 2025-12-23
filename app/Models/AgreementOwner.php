<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgreementOwner extends Model
{
    use HasFactory;

     protected $fillable = [
        'agreement_type',
        'profit_percentage',
        'payment_mode',
        'penalty_percentage',
        'status','agreements_notes','agreement_number','owner_number'
    ];
}
