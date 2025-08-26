<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

class InvoiceServices
{
    public function invoiceGenerate(Product $product)
    {
        Log::info("Factura generada para el producto {$product->name} por valor de {$product->price}");
    }
}
