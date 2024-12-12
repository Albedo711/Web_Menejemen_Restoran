<?php

// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Order;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil jumlah pengguna, menu, kategori, dan pesanan
        $userCount = User::count();
        $menuCount = Menu::count();
        $categoryCount = Category::count();
        $orderCount = Order::count();

        // Mengirim data ke view home
        return view('home', compact('userCount', 'menuCount', 'categoryCount', 'orderCount'));
    }
}
 