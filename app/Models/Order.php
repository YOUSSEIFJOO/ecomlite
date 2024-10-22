<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends BaseModel
{
    use SoftDeletes;

    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'total_price'
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_product')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
