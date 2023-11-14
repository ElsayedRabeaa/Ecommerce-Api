<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductTrending extends Model
{
    use HasFactory;
    protected $guarded=[];

     protected $table="product_trendings";
     protected $with=['product'];

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
