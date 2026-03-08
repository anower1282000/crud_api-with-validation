<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ProductStoreValidation;
use App\Http\Requests\ProductUpdateValidation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return response()->json([
            'success'=>true,
            'message'=>'product retrived successfully',
            'data'=>$products,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreValidation $request)
    {
       $product =  Product::storeProduct($request);

        return response()->json([
            'success'=> true,
            'message'=>'product store successfull',
            'data'=>  $product,
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        
        return response()->json([
            'success'=>true,
            'message'=>'product details retrived successfully',
            'data'=>$product,
        ],200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateValidation $request, string $id)
    {
       $product = Product::updateProduct($request,$id);
        return response()->json([
            'success'=>true,
            'message'=>'product update successfully',
            'data'=>$product,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $productDelete = Product::deleteProduct($id);
       
        if($productDelete)
        {
            return response()->json([
                'success'=>true,
                'message'=>'delete successful',
            ],200);

        }
        else{
            return response()->json([
                'success'=>false,
                'message'=>'product not found',
            ],404);
        }
    }
}