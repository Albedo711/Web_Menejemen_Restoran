<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Mengambil semua pesanan beserta itemnya
        $orders = Order::with('items')->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        // Mengambil semua menu untuk ditampilkan pada form pemesanan
        $menus = Menu::all();
        return view('orders.create', compact('menus'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'items' => 'required|array',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        // Menghitung total harga dari item pesanan
        $totalPrice = array_sum(array_map(function ($item) {
            return $item['quantity'] * $item['price'];
        }, $request->items));

        // Membuat order baru
        $order = Order::create([
            'customer_name' => $request->customer_name,
            'total_price' => $totalPrice,
            'order_date' => now(),
        ]);

        // Menyimpan item pesanan
        foreach ($request->items as $item) {
            $order->items()->create([
                'menu_id' => $item['menu_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['quantity'] * $item['price'],
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat.');
    }

    public function edit($id)
    {
        // Mengambil order dan item pesanan untuk diedit
        $order = Order::with('items')->findOrFail($id);
        $menus = Menu::all(); // Ambil data menu untuk form edit
        return view('orders.edit', compact('order', 'menus'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'items' => 'required|array',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        // Mengambil order yang akan diperbarui
        $order = Order::findOrFail($id);
        $order->update([
            'customer_name' => $request->customer_name,
            'total_price' => array_sum(array_map(function ($item) {
                return $item['quantity'] * $item['price'];
            }, $request->items)),
        ]);

        // Mengupdate atau membuat item pesanan baru
        foreach ($request->items as $item) {
            $order->items()->updateOrCreate(
                ['id' => $item['id'] ?? null],  // Pastikan ID item diupdate jika ada
                [
                    'menu_id' => $item['menu_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['quantity'] * $item['price'],
                ]
            );
        }

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Menghapus order beserta itemnya
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
