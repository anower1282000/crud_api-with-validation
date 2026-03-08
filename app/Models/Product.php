<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable =
    [
        'name',
        'category',
        'sub_category',
        'price',
        'brand',
        'image',
        'description',
        'status',
    ];
    public static function getImageUrl($request)
    {
        $image = $request->file('image');
        $imageName = time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
        $directory = "uploads/api-image/";
        $image->move($directory, $imageName);
        $imageUrl = $directory.$imageName;
        return $imageUrl;
    }

    public static function saveBasicInfo($request, Product $product) //type hinting
    {
        $product->name = $request->name;
        $product->category = $request->category;
        $product->sub_category = $request->sub_category;
        $product->price = $request->price;
        $product->brand = $request->brand;
        $product->description = $request->description;
        $product->status = $request->status ?? 'active';
        return $product;
    }

    public static function storeProduct($request)
    {
        $product = new Product();
        self::saveBasicInfo($request,$product);

        if($request->hasFile('image'))
        {
            $product->image = self::getImageUrl($request);
        }

        $product->save();
        return $product;
    }

    public static function updateProduct($request,$id)
    {
        $product = Product::findOrFail($id);

        if($request->file('image'))
        {
            if($product->image && file_exists($product->image))
            {
                unlink($product->image);
            }

            if($request->hasFile('image'))
            {
                $product->image = self::getImageUrl($request);
            }  
        }
        
        self::saveBasicInfo($request,$product);
        $product->save();
        return $product;
    }

    public static function deleteProduct($id)
    {
        $product = Product::find($id);

        if($product)
        {
            if($product->image && file_exists($product->image))
            {
                unlink($product->image);
            }
            $product->delete();
            return true;
        }
        return false;   
    }
}
