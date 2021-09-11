<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all(); 
         return response()->json([
         "success" => true,
         "message" => "Product List",
         "data" => $products
         ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $input = $request->all();
             $validator = Validator::make($input, [
             'name' => 'required',
             'description' => 'required',
             'image_url' => 'required',
             'price' => 'required'
             ]);             
             $products = Product::create($input);
             return response()->json([
             "success" => true,
             "message" => "Product created successfully.",
             "data" => $products
             ]);
        }catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product,$id)
    {
        $products = Product::find($id);
         return response()->json([
         "success" => true,
         "message" => "Product retrieved successfully.",
         "data" => $products
         ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $input = $request->all();
         $validator = Validator::make($input, [
         'name' => 'required',
         'description' => 'required',
         'image_url' => 'required',
         'price' => 'required',
         ]);         
         $product->name = $input['name'];
         $product->description = $input['description'];
         $product->image_url = $input['image_url'];
         $product->price = $input['price'];
         $product->save();
         
         return response()->json([
         "success" => true,
         "message" => "Product updated successfully.",
         "data" => $product
         ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
         return response()->json([
         "success" => true,
         "message" => "Product deleted successfully.",
         "data" => $product
         ]);
    }
}
