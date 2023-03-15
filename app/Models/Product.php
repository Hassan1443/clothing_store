<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $date = ["deleted_at"];
    protected $table='products';
    protected $fillable = ['product_name', 'category', 'brand','description', 'unit_price', 'image_1', 'image_2', 'image_3' ];



    public function view_single_product($id)
    {
       $products = Product::find($id);
       return $products;
    }
    
    public function images()
    {
     return $this->morphMany("App\Models\Image", 'imageable');
    }
    
    public function colors()
    {
      return $this->morphMany("App\Models\Color","colorable");
    }
    
    /*protected static function newFactory()
    {
         return   ProductFactory::new();
    }*/
}
