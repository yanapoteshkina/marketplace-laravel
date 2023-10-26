<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    //

    public function index()
    {
        $category_tamplate = [
                'Smatphones' => 0,
                'Laptops' => 0,
                'Accessories' => 0,
                'Camera' => 0,
        ];
        $exist_categories = Product::selectRaw('category, count(category)')->groupBy('category')->get();

        foreach($exist_categories as $ex_cat){
            $category_tamplate[$ex_cat->category] = $ex_cat->count;
        }
        $products = Product::get();
        // foreach ($products as $prod) {
        //     $url = storage_path($prod->img);
        //     $prod->img= $url;
        // }

        return  view('welcome', ['products' => $products, 'categories' => $category_tamplate]);        
        
    }
    public function single($id)
    {
        
        $product = Product::find($id);
        return  view('single', ['products' => $product]);        
        
    }

    public function single1($id)
    {
        $product = Product::with('Comments.User')->get();
        // $product = Product::find($id);
        return  ['products' => $product];        
        
    }

    public function registration()
    {
        return  view('registration');        
        
    }
    public function signin()
    {
        return  view('signin');        
        
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $product->update($request->all());

        return  $product;        
        
    }

    public function incrementCount($id)
    {
        $product = Product::find($id);

        $product->increment('count');

        return   $product;        
        
    }
    public function incrementLike($id)
    {
        $product = Product::find($id);

        $product->increment('like');

        return   $product;        
        
    }
    public function decrementDisLike($id)
    {
        $product = Product::find($id);

        $product->decrement('dislike');

        return   $product;        
        
    }
    public function delete($id)
    {
        $product = Product::find($id);

        $product->delete();
        return   $product;     
        
    
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'numeric',
            'img' => 'file',
            'description' => 'nullable',
            'category' => 'required',
            'count' => 'numeric',
            'like' => 'numeric',
            'dislike' => 'numeric',
        ]);
        // dd($validated);
        $path = $request->file('img')->store('public/prodcuts_images');
        $validated['img'] = $path;
        $product = Product::create($validated);
        
        return $product;          
        
    }

    public function filtration(Request $request)
    {
        $q = $request->query('q');
        $order_column = $request->query('col') ? $request->query('col') : 'created_at';
        $order = $request->query('order') ? $request->query('order') : 'asc';
        // dd($order_column, $order);

        $product = Product::where('name', 'like', '%'.$q.'%')->orderBy($order_column, $order)
        ->get();
        // dd($product);

        return $product;          
        
    }


}
