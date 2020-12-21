@extends('layouts.app')

@section('content')
<section class="container-fluid">
    <div class="row justify-content-center mx-5">
    @foreach($products as $product)
        <div class="col-md-3">
            <div class="card mt-3">
                <div class="card-header">
                    <h1 class="font-weight-bold">{{$product->title}}</h1>
                    <div class="col-12">
                        <a href="{{url('product', [$product->id, $product->user_id])}}"><img src="{{asset('storage/' . $product->image) }}" class="img-thumbnail"></a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>

</section>
@endsection
