@extends('layouts.app')

@section('title', 'Home Product')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Product</h1>
        <a href="{{route('products.create')}}" class="btn btn-primary">Add Product</a>
    </div>
    <hr />
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{Session::get('success')}}
    </div>
    @endif
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Price</th>
                <th>Product Code</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($product->count()>0)
                @foreach($product as $rs)
                <tr>
                    <td class="align-middle">{{$loop->iteration}}</td>
                    <td class="align-middle">{{$rs->title}}</td>
                    @if ($rs->price <= '1000')
                    <td class="align-middle text-danger">{{$rs->price}}</td>
                    @else
                    <td class="align-middle">{{$rs->price}}</td>
                    @endif
                    <td class="align-middle">{{$rs->product_code}}</td>
                    <td class="align-middle">{{$rs->description}}</td>
                    <td class="align-middle">
                        <div class="btn-group" role="group" aria-lable="Basic example">
                            <a href="{{route('products.show', Crypt::encryptString($rs->id))}}" type="button" class="btn btn-secondary">Detail</a>
                            <a href="{{route('products.edit', $rs->id)}}" type="button" class="btn btn-warning">Edit</a>
                            <!-- <a href="{{route('products.destroy', $rs->id)}}" type="button" class="btn btn-danger">Hapus</a> -->
                            <form action="{{route('products.destroy', $rs->id)}}" method="POST" type="button" class="btn btn-danger">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger m-0">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td class="text-center" colspan="5">Product not found</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
