<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');          // Nama menu, contoh: Nasi Goreng, Teh Manis
            $table->decimal('price', 10, 2); // Harga menu
            $table->text('description');    // Deskripsi singkat tentang menu
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Kategori menu, relasi dengan tabel categories
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
