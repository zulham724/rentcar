<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

  protected $guarded = ['id'];

  public function detail(){
    return $this->hasOne('App\Models\ProductDetail');
  }

  public function rents(){
    return $this->belongsToMany('App\Models\Rent','rent_products');
  }
}
