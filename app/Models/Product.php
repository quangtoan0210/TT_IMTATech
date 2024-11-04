<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'name', 'sku', 'img_thumb','price_regular','price_sale','quantity','overview','content'];
    public function category(){
        return $this->belongsTo(Category::class);  // belongsTo method is used to establish a one-to-many relationship with the Category model. The Category model has a 'products' relationship.  // The foreign key in the 'products' table is 'category_id' and the local key in the 'categories' table is 'id'. 
    }
    
}
