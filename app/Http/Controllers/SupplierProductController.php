<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class SupplierProductController extends Controller
{

    public function index()
    {
        // Mengambil semua data produk dari tabel supplier_produks dan kategori produk dari tabel product_categories
        $products = Product::join('product_categories', 'product_categories.id', '=', 'products.product_category_id')
            ->where('products.product_supplier_id', auth()->user()->id)
            ->get();

        // Mengambil semua data kategori produk
        $categories = ProductCategory::all();

        // Menampilkan halaman index dengan data produk dan kategori
        return view('supplier.product.index', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari permintaan
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_category_id' => 'required|integer',
            'product_quantity' => 'required|integer',
            'product_normal_price' => 'required|numeric',
            'product_member_price' => 'required|numeric',
            'product_photo' => 'sometimes|file|image|max:5000',
        ]);

        // Membuat objek SupplierProduk baru
        $product = new Product;

        // Mengisi atribut-atribut produk dari data permintaan
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->product_category_id = $request->product_category_id;
        $product->product_quantity = $request->product_quantity;
        $product->product_normal_price = $request->product_normal_price;
        $product->product_member_price = $request->product_member_price;
        $product->product_supplier_id = auth()->user()->id;

        // Menyimpan foto produk jika ada
        if ($request->hasFile('product_photo')) {
            $imageName = time() . '.' . $request->product_photo->extension();
            $request->product_photo->move(public_path('images'), $imageName);
            $product->product_photo = $imageName;
        }

        // Menyimpan produk
        $product->save();

        // Mengarahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('supplier.product.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function update(Request $request, string $id)
    {
        // Menemukan produk yang akan diperbarui
        $product = Product::where('product_id', $id);

        // Validasi data yang diterima dari permintaan
        $data = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_category_id' => 'required|integer',
            'product_quantity' => 'required|integer',
            'product_normal_price' => 'required|numeric',
            'product_member_price' => 'required|numeric',
            'product_photo' => 'sometimes|file|image|max:5000',
        ]);

        // Menyimpan foto produk jika ada
        if ($request->hasFile('product_photo')) {
            $photo = $request->file('product_photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $photo->move($destinationPath, $filename);
            $data['product_photo'] = $filename;
        }

        // Memperbarui produk dengan data yang baru
        $product->update($data);

        // Mengarahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('supplier.product.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        // Menemukan produk yang akan dihapus
        $product = Product::where('product_id', $id);

        // Menghapus produk
        $product->delete();

        // Mengarahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('supplier.product.index')->with('success', 'Produk berhasil dihapus');
    }

    public function stock()
    {
        $products = Product::join('product_categories', 'product_categories.id', '=', 'products.product_category_id')
            ->select('*', 'products.updated_at as last_update')
            ->where('products.product_supplier_id', auth()->user()->id)
            ->get();

        $product_ready = Product::where('product_quantity', '>', 10)->where('products.product_supplier_id', auth()->user()->id)->count();
        $product_low = Product::where('product_quantity', '<=', 10)->where('products.product_supplier_id', auth()->user()->id)->count();
        $product_empty = Product::where('product_quantity', 0)->where('products.product_supplier_id', auth()->user()->id)->count();

        // Menampilkan halaman index dengan data produk dan kategori
        return view('supplier.product.stock', compact('products', 'product_ready', 'product_low', 'product_empty'));
    }

}
