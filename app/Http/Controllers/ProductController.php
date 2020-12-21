<?php

namespace App\Http\Controllers;


use App\Product;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller {

    public function create() {
        $product = Product::create($this->validateRequest());

        $this->storeImage($product);
        return redirect('/');
    }

    public function read() {
        return  view('/home', ['products' => Product::all()->where('user_id', auth::id())->sortByDesc('updated_at')]);
    }

    public function show() {
        $product = Product::firstWhere('id', request('id'));
        return view('/product', ['product' => $product]);
    }

    public function edit() {
        $product = Product::firstWhere('id', request('id'));
        return view('/editProduct', ['product' => $product]);
    }

    public function update() {
        $product = Product::find( request('id'));

        $product->update($this->validateRequest());
        $this->storeImage($product);
        return redirect('/');
    }

    private function validateRequest() {
     return request()->validate([
         'title' => 'min:3|required',
         'description' => 'min:3|required',
         "price" => 'integer|required',
         "user_id" => 'integer|required',
         'image' => 'file|image|max:5000|required'
     ]);
    }

    private function storeImage($product) {
        if (request()->has('image')) {

            $product->update([
                'image' => request()->image->store('uploads', 'public'),
            ]);
        }
    }
}
