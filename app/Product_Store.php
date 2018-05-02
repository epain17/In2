<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Store extends Model {

    protected $table = 'product_store';

    public function stores()
    {
      return $table->hasOne('App/Stores');
    }

    public function products()
    {
      return $table->hasOne('App/Product');
    }

    protected $fillable = [
      'store_id', 'product_id'
    ];
}
