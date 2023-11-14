<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTrending extends Model
{
    use HasFactory;


     protected $with=['product'];

    public function product(){
        return $this->belongsTo(App\Models\Product::class,'product_id','id');
    }
}
