<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $order = $request->input('order', "name");
        $sort = $request->input('sort',"asc"); // Nilai default adalah 'asc' jika tidak ada parameter sort atau nilai sort tidak valid

        $products = Product::where($order, 'like', '%'.$query.'%')
                        ->orderBy($order, $sort)
                        ->paginate(5);

        return view('products.index', compact('products'));
    }

    public function search(Request $request)
    {
    $query = $request->input('query'); // Mendapatkan kata kunci pencarian dari input form

    $products = Product::where('name', 'like', '%'.$query.'%')->paginate(10); // Menampilkan 10 produk per halaman

    return view('products.index', compact('products'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        Product::find($id)->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::find($id)->delete();
        return redirect()->route('products.index')->with('success', 'Product delete successfully');
    }

        /**
     * Display the specified resource.
     */
    public function showApi(string $id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    public function indexApi(Request $request)
    {
        $total = $request->input('limit',5);
        $query = $request->input('search', "");
        $order = $request->input('order', "name");
        $sort = $request->input('sort',"asc"); // Nilai default adalah 'asc' jika tidak ada parameter sort atau nilai sort tidak valid

        $products = Product::where($order, 'like', '%'.$query.'%')
                        ->orderBy($order, $sort)
                        ->paginate($total);

        return response()->json($products);
    }

    public function storeApi(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        Product::create($request->all());
        return response()->json(['message' => 'Product created successfully'], 201);
    }

    public function updateApi(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        Product::find($id)->update($request->all());

        return response()->json(['message' => 'Product Updated successfully'], 200);
    }

    public function destroyApi(string $id)
    {
        Product::find($id)->delete();
        return response()->json(['message' => 'Product Deleted successfully'], 200);
    }

}
