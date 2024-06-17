<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Traits\UploadFile;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
	use UploadFile;

	public function home(Request $request)
	{
		$products = Product::with('category','file')
			->whereHas('category')
			->where('stock', '>', 0)
			->get();
		return view('index', compact('products'));
		if (!$request->ajax()) return view();
		return response()->json(['products' => $products], 200);
	}

	public function index()
	{
		$products = Product::with('category', 'file')->get(); 
		$categories = Category::all();

		return view('products.index', compact('products','categories'));
	}

	public function create()
	{
		return view('products.create');
	}

	public function store(ProductRequest $request)
	{

		try {
			DB::beginTransaction();
			$product = new Product($request->all());
            $product->save();
            $this->uploadFile($product, $request);
            DB::commit();
            if (!$request->ajax()) return back()->with("success", 'Product created');
            return response()->json(['status' => 'Product created'], 201);

        } catch (\Throwable $th) {
            DB::rollback();
        }
	}

	public function show($id)
	{
		$product = Product::findOrFail($id);

		return view('products.show', compact('product'));
	}

	public function edit($id)
	{
		$product = Product::findOrFail($id);

		//$categories = Category::all();

		return view('products.edit', compact('product'));
	}

	public function update(ProductUpdateRequest $request, Product $product)
	{
		try {
            DB::beginTransaction();
            $product->update($request->all());
            if ($request->hasFile('file')) {
                $this->uploadFile($product, $request);
            }
            DB::commit();
            if (!$request->ajax()) return back()->with("success", 'Product updated');
            return response()->json([], 204);
        } catch (\Throwable $th) {
            DB::rollback();
        }
	}

	public function destroy(Request $request, Product $product)
    {
        $product->delete();
        if (!$request->ajax()) return back()->with("success", 'Product deleted');
        return response()->json([], 204);
    }
}
