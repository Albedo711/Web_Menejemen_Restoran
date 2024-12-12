@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Daftar Pesanan</h1>
    <p class="text-muted">ini adalah halaman order</p>
    
    @if(auth()->check() && auth()->user()->role === 'staff')
       <a href="{{ route('orders.create') }}" class="btn btn-primary">Create Order</a>
   @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal Pesanan</th>
                <th>Total Harga</th>
                @if(auth()->check() && auth()->user()->role === 'staff')
                   <th>Actions</th>
                   @endif
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $index => $order)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y') }}</td>
                    <td>{{ number_format($order->total_price, 0,',','.',) }}</td>
                    @if(auth()->check() && auth()->user()->role === 'staff')
                    <td>
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
