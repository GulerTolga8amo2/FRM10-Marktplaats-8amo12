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

    private function validateRequest() {
     return tap(request()->validate([
         'title' => 'min:3|required',
         'description' => 'min:3|required',
         "price" => 'integer|required',
         "user_id" => 'integer|required'
     ]), function () {
         if (request()->hasFile('image')) {
             request()->validate([
                 'image' => 'nullable|file|image|max:5000'
             ]);
         }
     });
    }

    private function storeImage($product) {
        if (request()->has('image')) {
            $product->update([
                'image' => request()->image->store('uploads', 'public'),
            ]);
        }
    }
}
