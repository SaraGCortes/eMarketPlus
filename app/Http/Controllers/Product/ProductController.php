<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Services\NotifyService;
use App\Services\InvoiceServices;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $notify;
    protected $invoice;

    public function __construct(NotifyService $notify, InvoiceServices $invoice)
    {
        $this->notify = $notify;
        $this->invoice = $invoice;
    }

    public function index()
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        $product = Product::create([
            'nombre' => $request->name,
            'precio' => $request->price,
        ]);

        $this->notify->send("Se creó el producto: {$product->nombre}");
        $this->invoice->invoiceGenerate($product);

        return response()->json($product, 201);
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->only('nombre', 'precio'));

        $this->notify->send("Se actualizó el producto: {$product->name}");
        $this->invoice->invoiceGenerate($product);

        return response()->json($product, 200);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        $this->notify->send("Se eliminó el producto: {$product->name}");

        return response()->json(null, 204);
    }
}
