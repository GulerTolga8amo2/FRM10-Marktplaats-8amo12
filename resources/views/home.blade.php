@extends('layouts.app')

@section('content')
<section class="container">
{{--    @for($i = 1; $i < count();)--}}
    <div class="row justify-content-center">
    @foreach($products as $product)
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-header">
                    <h1 class="font-weight-bold">{{$product->title}}</h1>
                    @if($product->image)
                        <div class="col-12"><img src="{{asset('storage/' . $product->image) }}" class="img-thumbnail"></div>
                    @endif
                </div>
                <div class="card-body">
                    <div>€ {{$product->price}}</div>
                    <div>{{$product->description}}</div>
                </div>
            </div>
        </div>
    @endforeach
    </div>

</section>
@endsection
