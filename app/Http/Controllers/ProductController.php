<?php

namespace App\Http\Controllers;


use App\Product;
use App\User;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller {

    public function create() {
        $product = Product::create($this->validateRequest());

        $this->storeImage($product);
        return redirect('/');
    }

    public function read() {
        $admin = User::select("adminLvl")->firstWhere("id", auth::id());
        if ($admin->adminLvl == 2) {

            $product = Product::all();
        } else {
            $product = Product::all()->where('user_id', auth::id())->sortByDesc('updated_at');
        }
        return  view('/home', ['products' => $product]);
    }

    public function show() {
        $product = Product::firstWhere('id', request('id'));
        if (!empty($product))
            return view('/product', ['product' => $product]);
        else
            return view('/');
    }

    public function edit() {
        $product = Product::firstWhere('id', request('id'));
        return view('/editProduct', ['product' => $product]);
    }

    public function update() {
        $product = Product::find(request('id'));

        $product->update($this->validateRequest());
        $this->storeImage($product);
        return redirect('/');
    }

    public function delete() {
        $product = Product::where("id", request('id'))->delete();
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

            $image = Image::make(public_path('storage/' . $product->image))->fit(400,400, null, 'left');
            $image->save();
        }
    }
}
