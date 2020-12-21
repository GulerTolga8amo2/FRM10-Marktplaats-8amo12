@extends('layouts.app')

@section('content')
    <section class="container">
        <section class="w-50 m-auto">
            <form method="POST" class="form" enctype="multipart/form-data" action="/add-product/confirm/">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Description</label>
                        <textarea  class="form-control" name="description"></textarea>
                    </div>
                    <div class="form-group col-12">
                        <label>Price</label>
                        <input type="number" class="form-control" name="price">
                    </div>
                    <div class="form-group col-12">
                        <div class="custom-file">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                            <input type="file" class="custom-file-input" name="image">
                            <input type="hidden" name="user_id" value="{{auth::id()}}">
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </section>
    </section>
@endsection
