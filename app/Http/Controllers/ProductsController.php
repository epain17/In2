<?php

namespace App\Http\Controllers;
use App\Product;
use App\Product_Store;
Use App\Store;
Use App\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
  public function index()
  {
    $products = Product::all();

    return response()->json($products);
  }
  public function show($id){

    $products = Product::find($id);
    return response()->json($products);
}



public function listReviews()
{
  $reviews = Review::all()->first();
  return response()->json($reviews);
}

public function inStore($id)
{
  $product = Product::where('id', $id)->first();
  $product = $product->toArray();

  $productInStores =Product_Store::all()->where('product_id', $id);
  $productReviews = Review::all()->where('product_id', $id);

  $stores = Store::all();
  $storesWithProduct = [];

  $product["reviews"] = $productReviews;

  foreach ($stores as $s)
  {
    foreach ($productInStores as $pS)
    {
      if($s->id == $pS->store_id)
      {
        $storesWithProduct[] = $s;
      }
    }
  }

  $product["stores"] = $storesWithProduct;

  return response()->json($product);
}

public function create(Request $request)
{

  $products = Product::create($request->all());
  return response()->json($products, 201);

}
public function delete($id)
{
  Product::findOrFail($id)->delete();
  return response('Deleted', 200);
}

}
