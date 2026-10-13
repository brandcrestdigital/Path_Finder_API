<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardPricingSetting extends Model
{
    protected $fillable = [
        'price_per_card',
        'minimum_cards',
    ];
}
