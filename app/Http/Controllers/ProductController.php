<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('master-data.product.create', compact('categories'));
    }
 
    public function store(StoreProductRequest $request)
    {
        Product::create($request->validated());
    
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    

public function index(Request $request)
{
    $stockStatus = $request->query('stock_status', 'semua');
    $perPage = (int) $request->query('per_page', 10);
    if (!in_array($perPage, [10, 25, 50])) {
        $perPage = 10;
    }

    $query = Product::query();
    if ($stockStatus === 'menipis') {
        $query->where('stock', '>', 0)
              ->where('stock', '<=', 5);
    } elseif ($stockStatus === 'habis') {
        $query->where('stock', '<=', 0);
    }

    $products = $query->latest()
        ->paginate($perPage)
        ->withQueryString();

    // Mengambil data kategori
    $categories = Category::orderBy('name')->get();

    return view('master-data.product.index', compact(
        'products',
        'categories',
        'stockStatus',
        'perPage'
    ));
}


//========Praktikum 9=======//
public function edit(Product $product)
{
    $categories = Category::orderBy('name')->get();
    return view('master-data.product.edit', compact('product', 'categories'));
}

public function update(UpdateProductRequest $request, Product $product)
{
    $product->update($request->validated());
 
    return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
}


public function destroy(Product $product)
{
    $product->delete();
 
    return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
}


public function show(Product $product)
{
    // Memuat relasi produk
    $product->load(['transactionDetails.transaction', 'category']);

    // Menghitung total produk yang terjual
    $totalTerjual = $product->transactionDetails->sum('qty');

    // Mengambil 10 riwayat penjualan terakhir
    $riwayat = $product->transactionDetails()
        ->with('transaction')
        ->latest()
        ->take(10)
        ->get();

    // Mengambil 5 hari dengan penjualan tertinggi
    $topSalesDays = DB::table('transaction_details')
        ->join(
            'transactions',
            'transaction_details.transaction_id',
            '=',
            'transactions.id'
        )
        ->where('transaction_details.product_id', $product->id)
        ->selectRaw('
            DATE(transactions.created_at) as tanggal,
            SUM(transaction_details.qty) as total_terjual
        ')
        ->groupByRaw('DATE(transactions.created_at)')
        ->orderByDesc('total_terjual')
        ->limit(5)
        ->get();

    return view('master-data.product.show', compact(
        'product',
        'totalTerjual',
        'riwayat',
        'topSalesDays'
    ));
}

}