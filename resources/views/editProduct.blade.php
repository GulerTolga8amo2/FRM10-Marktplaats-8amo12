@extends('layouts.app')

@section('content')
    @if ($product->user_id == Auth::id())

    <section class="container">
        <section class="w-50 m-auto">
            <form method="POST" class="form" enctype="multipart/form-data" action="/edit-product/confirm/">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" value="{{$product->title}}">
                        <div>{{ $errors->first('title') }}</div>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Description</label>
                        <textarea  class="form-control" name="description">{{$product->description}}</textarea>
                        <div>{{ $errors->first('description') }}</div>
                    </div>
                    <div class="form-group col-12">
                        <label>Price</label>
                        <input type="number" class="form-control" name="price" value="{{$product->price}}">
                        <div>{{ $errors->first('price') }}</div>
                    </div>
                    <div class="form-group col-12">
                        <div class="custom-file">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                            <input type="file" class="custom-file-input" name="image">
                            <input type="hidden" name="user_id" value="{{$product->user_id}}">
                            <input type="hidden" name="id" value="{{$product->id}}">

                            <div>{{ $errors->first('image') }}</div>
                        </div>
                    </div>
                    @if($product->image)
                        <div class="col-12"><img src="{{asset('storage/' . $product->image) }}" class="img-thumbnail"></div>
                    @endif
                    <div class="form-group col-12">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </section>
    </section>
    @else
        <div class="col-md-3 m-auto">
            <div class="card mt-3">
                <div class="card-header">
                    Something went wrong. Go <a href="{{url('/')}}">Home</a>
                </div>
            </div>
        </div>
    @endif
@endsection
