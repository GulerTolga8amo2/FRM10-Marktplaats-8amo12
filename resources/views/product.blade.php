@extends('layouts.app')

@section('content')
    <div class="col-md-8 m-auto">
        <div class="card mt-3">
            <div class="card-header">
                <h1 class="font-weight-bold">{{$product->title}}</h1>
                <div class="col-12"><img src="{{asset('storage/' . $product->image) }}" class="img-thumbnail"></div>
            </div>
            <div class="card-body">
                <div class="mb-3">€ {{$product->price}}</div>
                <div>{{$product->description}}</div>
                <a href="{{url('/edit-product', [$product->id, $product->user_id])}}"><button class="btn btn-primary mt-4">Edit</button></a>
                <a href="{{url('/delete-product', [$product->id])}}"><button class="btn btn-danger mt-4">Delete</button></a>
            </div>
        </div>
    </div>
@endsection
