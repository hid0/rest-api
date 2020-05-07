<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    function post(Request $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->active = $request->active;
        $product->desc = $request->desc;
        $product->save();
        return response()->json([
            "message" => "Success",
            "data" => $product
        ]);
    }

    function get()
    {
        $data = Product::all();
        return response()->json([
            "message" => "Success",
            "data" => $data
        ]);
    }

    function put($id, Request $request)
    {
        $product = Product::where('id', $id)->first();
        if ($product) {
            $product->name = $request->name ? $request->name : $product->name;
            $product->price = $request->price ? $request->price : $product->price;
            $product->quantity = $request->quantity ? $request->quantity : $product->quantity;
            $product->active = $request->active ? $request->active : $product->active;
            $product->desc = $request->desc ? $request->desc : $product->desc;
            // menyimpan data dari request
            $product->save();
            return response()->json([
                "message" => "PUT method success ",
                "data" => $product
            ]);
        }
        return response()->json([
            "message" => "Product id = ".$id." not found"
        ], 400);
    }

    function delete($id)
    {
        $product = Product::where('id', $id)->first();
        if ($product) {
            $product->delete();
            return response()->json([
                "message" => "Delete product ".$id." success"
            ]);
        }
        return response()->json([
            "message" => "Product not found ".$id
        ],400);
    }
}
