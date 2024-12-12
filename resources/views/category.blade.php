@extends('layouts.app')

@section('title', 'Home page')

@section('content')
   <h1 class="text-center">Selamat datang di Resto Amba</h1>
   <p class="text-muted">Ini adalah halaman kategori</p>

   @if(auth()->check() && auth()->user()->role === 'admin')
       <a href="{{ route('categories.create') }}" class="btn btn-primary">Create Category</a>
   @endif

   
   <div class="table-responsive mt-4">
       <table class="table table-bordered">
           <thead>
               <tr>
                   <th>No</th>
                   <th>Category Name</th>
                   @if(auth()->check() && auth()->user()->role === 'admin')
                   <th>Actions</th>
                   @endif
               </tr>
           </thead>
           <tbody>
               @foreach ($categories as $key => $category)
                   <tr>
                       <td>{{ $key + 1 }}</td>
                       <td>{{ $category->category_name }}</td>
                       @if(auth()->check() && auth()->user()->role === 'admin')
                       <td>
                           
                           <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                               @csrf
                               @method('DELETE')
                               <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                           </form>
                       </td>
                       @endif
                   </tr>
               @endforeach
           </tbody>
       </table>
   </div>
@endsection
