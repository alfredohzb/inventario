<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function index()
    {
        return Product();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $product = new Product();
        $product->nombreProducto = $request->nombreProducto;
        $product->sku            = $request->sku;
        $product->stock          = $request->stock;
        $product->precio         = $request->precio;
        $product->user_id        = auth()->id();
        $product->save();
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
        $product = new Product($id);
        $product->nombreProducto = $request->nombreProducto;
        $product->sku            = $request->sku;
        $product->stock          = $request->stock;
        $product->precio         = $request->precio;
        $product->save();
    }
}
