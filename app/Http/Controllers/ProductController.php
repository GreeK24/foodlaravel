<?php

namespace App\Http\Controllers;

use Cart;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Redirect;
use DB;
use Illuminate\Support\Facades\Input;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search()
    {
        request()->validate([
            'q' => 'required|min:3'
        ]);

        $q = request()->input('q');

        $products = Product::where('title', 'like', "%$q%")
                ->orWhere('description', 'like', "%$q%")
                ->orWhere('tags', 'like', "%$q%")
                ->paginate(6);

        return view('products.search', compact('products', 'q'));
    }

    public function Cat_products($id) 
    {
          $product = Product::where('cat_id', $id)->first();
          $category = Category::where('id', $id)->first();
          $cat_products = Product::where('cat_id', $product->cat_id ?? 'abort(404)')->get();
          $categories = Category::all();
          return view('productBycat', compact('product', 'category', 'cat_products', 'categories'));  
    }



   public function index()
    {
        $products = Product::cursor();
        $categories = Category::cursor();
        $cartItems = Cart::content();
        return view('Products.index', compact('products', 'categories', 'cartItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::cursor();
        $products = Product::cursor();
        return view('Products.create', compact('categories', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
       $p =  Product::create($request->except('tags'));
 
       $tag = json_encode($request->tags);

       $p->tags = $tag;
       $p->save();

       return redirect('products')->with('success', ['Products Adding successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $Product, $id)
    {
        //
        // $product = Product::cursor();
        // $products = Product::find($id);
        // return view('Admin.products.show', compact('product', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        //
        $categories = Category::cursor();
        $product = Product::cursor();
        $products = Product::find($id);

            return view('Admin.products.edit',compact('categories', 'product', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $products = Product::find($id);

        $products->update($request->cursor());

        $products->save();

       return redirect('products')->with('success', ['Products Adding successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //
        $products = Product::find($id);
        $products->delete();
            return redirect('products')->with('success', 'Product has been deleted Successfully');
    }




}
