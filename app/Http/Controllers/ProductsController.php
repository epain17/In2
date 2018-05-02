<?php

namespace App\Http\Controllers;
use App\Product;
use App\Product_Store;
Use App\Store;
Use App\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

  $product["reviews"] = $productReviews;


  // $stores = Store::all();
  $storesWithProduct = [];


  // foreach ($stores as $s)
  // {
  //   foreach ($productInStores as $pS)
  //   {
  //     if($s->id == $pS->store_id)
  //     {
  //       $storesWithProduct[] = $s;
  //     }
  //   }
  // }

  foreach ($productInStores as $pS)
  {
    $store = Store::all()->where('id', $pS->store_id)->first();
    $storesWithProduct[] = $store;

  }

  $product["stores"] = $storesWithProduct;

  return response()->json($product);
}

public function create(Request $request)
{
  $product = new Product;
  $product->title = $request->input("title");
  $product->brand = $request->input("brand");
  $product->image = $request->input("image");
  $product->description = $request->input("description");
  $product->price = $request->input("price");
  $createdAt = Carbon::now();
  $product->created_at = $createdAt;

  $product->save();

  foreach ($request->input("stores") as $store)
  {
    $productInStock = new Product_Store;

    $productInStock->store_id = $store;
    $productInStock->product_id = $product->id;
    $productInStock->save();
  }



//  $products = Product::create($request->all());
  return response()->json([
    "success" => true
  ]);

}
public function delete($id)
{
  Product::findOrFail($id)->delete();
  return response('Deleted', 200);
}

}
