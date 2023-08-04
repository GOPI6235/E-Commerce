<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;



class category extends Model
{
    use HasFactory;


    protected $table = 'categories';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'papular',
        'image',
        'meta_title',
        'meta_description',
        'meta_keyword',


    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'cate_id');
    }
    

    public static function getTrendingCategory(): ?Category
    {
        return self::withCount('products')
            ->orderByDesc('products_count')
            ->first();
    }

}
