@extends('layouts.app')

@section('title', 'Home page')

@section('content')
   <h1 class="text-center">Selamat datang di Resto Amba</h1>
   <p class="text-muted">Ini adalah halaman menu</p>

   @if(auth()->check() && auth()->user()->role === 'admin')
       <a href="{{ route('menus.create') }}" class="btn btn-primary">Create Menu</a>
   @endif

 
   <div class="table-responsive mt-4">
       <table class="table table-bordered">
           <thead>
               <tr>
                   <th>No</th>
                   <th>Menu Name</th>
                   <th>Image</th>
                   <th>Description</th>
                   <th>Price</th>
                   <th>Category</th>
                   @if(auth()->check() && auth()->user()->role === 'admin')
                   <th>Actions</th>
                   @endif
               </tr>
           </thead>
           <tbody>
               @foreach ($menus as $key => $menu)
                   <tr>
                       <td>{{ $key + 1 }}</td>
                       <td>{{ $menu->name }}</td>
                       <td>
                           
                           @if($menu->image)
                               <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" width="100">
                           @else
                               <span>No image</span>
                           @endif
                       </td>
                       <td>{!! strip_tags($menu->description) !!}</td> 
                       <td>{{ number_format($menu->price, 0,',','.',) }}</td>
                       <td>{{ $menu->category->category_name }}</td>
                       @if(auth()->check() && auth()->user()->role === 'admin')
                       <td>
                           <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-warning btn-sm">Edit</a>
                           <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
                               @csrf
                               @method('DELETE')
                               <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                           </form>
                       </td>
                       @endif
                   </tr>
               @endforeach
           </tbody>
       </table>
   </div>
@endsection
