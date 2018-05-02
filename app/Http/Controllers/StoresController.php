<?php
namespace App\Http\Controllers;
Use App\Store;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class StoresController extends Controller
{
  public function index()
  {
    $stores = Store::all();
    return response()->json($stores);
  }

}

 ?>
