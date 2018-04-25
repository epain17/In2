<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Store extends Model {

    protected $table = 'product_store';

    public function stores()
    {
      return $table->hasMany('App/Stores');
    }

    public function products()
    {
      return $table->hasMany('App/Product');
    }


}
