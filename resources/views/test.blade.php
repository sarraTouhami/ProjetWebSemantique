<!-- resources/views/addproduct.blade.php -->
@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 100px;">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4 text-center">Add New Product</h2>
        </div>
    </div>
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf <!-- Laravel CSRF protection -->
        
        <div class="form-group mb-3">
            <label for="productName">Product Name</label>
            <input type="text" name="name" id="productName" class="form-control" placeholder="Enter product name" required>
        </div>

        <div class="form-group mb-3">
            <label for="productDescription">Description</label>
            <textarea name="description" id="productDescription" class="form-control" rows="4" placeholder="Enter product description" required></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="productPrice">Price</label>
            <input type="number" name="price" id="productPrice" class="form-control" placeholder="Enter product price" required>
        </div>

        <div class="form-group mb-3">
            <label for="productImage">Product Image</label>
            <input type="file" name="image" id="productImage" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Add Product</button>
    </form>
</div>
@endsection
