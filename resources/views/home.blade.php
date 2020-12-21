@extends('layouts.app')

@section('content')
<section class="container">
{{--    @for($i = 1; $i < count();)--}}
    <div class="row justify-content-center">
    @foreach($products as $product)
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$product->title}}</div>
                <div class="card-body">{{$product->description}}</div>
            </div>
        </div>
    @endforeach
    </div>

</section>
@endsection
