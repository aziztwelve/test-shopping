<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use Notifiable;

    protected $fillable = ['email', 'phone', 'shipping_address_1', 'shipping_address_2', 'shipping_address_3', 'city', 'country_code', 'zip_postal_code'];
    public $timestamps = true;

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id' )->withPivot('quantity');
    }
}
