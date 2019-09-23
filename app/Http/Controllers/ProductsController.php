<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;

class ProductsController extends Controller
{
    public function __contruct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $cantidad = $request->per_page;
        return Products::orderBy('updated_at', 'asc')->paginate($cantidad);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $product = new Products();
        $product->nombreProducto = $request->nombreProducto;
        $product->sku            = $request->sku;
        $product->stock          = $request->stock;
        $product->precio         = $request->precio;
        $product->user_id        = auth()->id();
        $product->save();
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Products::find($id);
        $product->nombreProducto = $request->nombreProducto;
        $product->sku            = $request->sku;
        $product->stock          = $request->stock;
        $product->precio         = $request->precio;
        $product->save();
    }
}
