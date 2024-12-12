@extends('layouts.app')

@section('title', 'Home page')

@section('content')
   <h1 class="text-center">Selamat datang di Resto Amba</h1>
   <p class="text-muted">Ini adalah halaman utama</p>

   <div class="row">
      
      <div class="col-md-3">
         <div class="card text-white bg-primary mb-3">
            <div class="card-body">
               <h5 class="card-title">Jumlah Pengguna</h5>
               <p class="card-text">{{ $userCount }}</p>
            </div>
         </div>
      </div>

     
      <div class="col-md-3">
         <div class="card text-white bg-success mb-3">
            <div class="card-body">
               <h5 class="card-title">Jumlah Menu</h5>
               <p class="card-text">{{ $menuCount }}</p>
            </div>
         </div>
      </div>

    
      <div class="col-md-3">
         <div class="card text-white bg-warning mb-3">
            <div class="card-body">
               <h5 class="card-title">Jumlah Kategori</h5>
               <p class="card-text">{{ $categoryCount }}</p>
            </div>
         </div>
      </div>

      
      <div class="col-md-3">
         <div class="card text-white bg-danger mb-3">
            <div class="card-body">
               <h5 class="card-title">Jumlah Pesanan</h5>
               <p class="card-text">{{ $orderCount }}</p>
            </div>
         </div>
      </div>
   </div>
@endsection
