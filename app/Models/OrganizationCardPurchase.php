<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganizationCardPurchase extends Model
{
    use SoftDeletes;

    protected $table = 'organization_card_purchases';

    protected $fillable = [
        'organization_id',
        'card_package_id',
        'total_cards',
        'used_cards',
        'price_per_card',
        'total_amount',
        'validity_days',
        'start_date',
        'expiry_date',
        'payment_status',
        'payment_method',
        'payment_proof',
        'payment_type',

        'is_free_card',
        'subtotal',
        'discount_amount',
        'taxable_amount',
        'gst_percentage',
        'gst_amount',
        'grand_total',

        'coupon_code',
        'coupon_type',
        'coupon_value',
        'nfc_price_per_card',
        'is_nfc_card',

    ];

    /* Relationships */

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function digitalCards()
    {
        return $this->hasMany(DigitalCard::class, 'purchase_id');
    }
    
    
    public function nfcRequest()
{
    return $this->hasOne(NfcCardRequest::class, 'purchase_id');
}

    protected $casts = [
        'is_free_card'    => 'boolean',
        'subtotal'        => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'taxable_amount'  => 'decimal:2',
        'gst_percentage'  => 'decimal:2',
        'gst_amount'      => 'decimal:2',
        'grand_total'     => 'decimal:2',
        'expiry_date'     => 'date',
    ];
}
