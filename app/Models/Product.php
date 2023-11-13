<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $with=['Comment'];

    public function Comment(){
        return $this->belongsTo(App\Models\Comment::class,'product_id','id');
    }
}
