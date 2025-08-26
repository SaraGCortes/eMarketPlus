<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductWithoutHighCohesionController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        Log::info("Notification: Product {$product->name} was created");
        Log::info("Invoice generated for product {$product->name} with value {$product->price}");

        return response()->json($product, 201);
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->only('name', 'price'));

        Log::info("Notification: Product {$product->name} was updated");
        Log::info("Invoice updated for product {$product->name} with value {$product->price}");

        return response()->json($product, 200);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        Log::info(" Noification: Product {$product->name} was deleted");

        return response()->json(null, 204);
    }
}
