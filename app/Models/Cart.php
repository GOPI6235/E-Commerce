<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
        'user_id',
        'prod_id',
        'prod_qty',
    ];
   
    public function product()
    {
        return $this->belongsTo(Product::class, 'prod_id');
    }
    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class)->where('user_id', auth()->id());
    }
    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'prod_id');
    }
}
