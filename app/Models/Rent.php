<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rent extends Model
{
  use HasFactory, SoftDeletes;

  protected $guarded = ['id'];

  public function products(){
    return $this->belongsToMany('App\Models\Product','rent_products')->withPivot('cost_per_day','product_name','product_brand','product_model','product_plat_number');
  }

  public function rent_products(){
    return $this->hasMany('App\Models\RentProduct');
  }

  public function user(){
    return $this->belongsTo('App\Models\User');
  }
}
