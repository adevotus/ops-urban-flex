<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionAccount extends Model
{
    use HasFactory;
     protected $fillable = [
        'owner_number',
        'collection_method',
        'account_number',
        'account_name',
        'collection_day','collection_notes'
    ];

}
