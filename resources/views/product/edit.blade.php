@extends('layouts.app')

@section('content')
<section class="vh-100">
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="col-md-6">
            <div class="card shadow p-3 bg-body rounded">
                <div class="card-body">
                    <h1 class="card-title text-center">Edit Product</h1>
                    <form method="POST" action="{{ route('products.update',$product->id)}}">
                        @method('PUT')
                        @csrf
                        <div class="form-floating mb-3">
                            <input required type="text" class="form-control" id="floatingInput" placeholder="Product Name" name="name" value="{{ $product->name }}">
                            <label for="floatingInput">Product Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input required type="number" class="form-control" id="floatingInput" placeholder="Product Price" name="price" value="{{ $product->price}}">
                            <label for="floatingInput">Product Price</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select name="category_id" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                <option disabled>Select a category</option>
                                @foreach ($categories as $category)
                                    <option @if ($category->id == $product->category_id)
                                        selected
                                    @endif value="{{ $category->id}}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Product Category</label>
                        </div>

                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" class="btn btn-lg btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection