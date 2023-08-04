<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'cate_id',
        'sub_id',
        'name',
        'slug',
        'small_description',
        'description',
        'original_price',
        'selling_price',
        'image',
        'tax',
        'status',
        'trending',
        'meta_tilte',
        'meta_keyword',
        'meta_description',
    ];
    // public function category()
    // {
    //     return $this->belongsTo(category::class,'cate_id','id');
    // }
    public function subcategory()
    {
        return $this->belongsTo(SubCategorycategory::class,'sub_id','id');
    }
   
    // public function category(): BelongsTo
    // {
    //     return $this->belongsTo(Category::class, 'category_id');
    // }
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id'); // Assuming 'cate_id' is the foreign key in the products table
    }
    
}
