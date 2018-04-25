<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $table = 'products';

    public function stores(){
      return $table->belongsToMany('App/Store');
    }

    public function reviews(){
      return $table->hasMany('App/Review');
    }

    public function getProducts(){
      return $table->products;
    }

    protected $fillable = [
      'title', 'brand', 'price', 'image', 'description', 'stores'
    ];
}
