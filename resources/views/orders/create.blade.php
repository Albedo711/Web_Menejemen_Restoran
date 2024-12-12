@extends('layouts.app')

@section('content')
    <h1>Buat Pesanan</h1>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="customer_name">Nama Pelanggan</label>
            <input type="text" id="customer_name" name="customer_name" class="form-control" value="{{ old('customer_name') }}" required>
        </div>

        <div class="form-group">
            <label for="order_date">Tanggal Pesanan</label>
            <input type="date" id="order_date" name="order_date" class="form-control" value="{{ old('order_date', \Carbon\Carbon::now()->format('Y-m-d')) }}" required>
        </div>

        <h3>Items Pesanan</h3>
        <div id="order-items">
            <div class="order-item">
                <div class="form-group">
                    <label for="menu_id">Menu</label>
                    <select name="items[0][menu_id]" class="form-control menu-select" required>
                        <option value="">Pilih Menu</option>
                        @foreach($menus as $menu)
                            <option value="{{ $menu->id }}" data-price="{{ $menu->price }}">{{ $menu->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantity">Jumlah</label>
                    <input type="number" name="items[0][quantity]" class="form-control quantity" value="1" min="1" required>
                </div>
                <div class="form-group">
                    <label for="price">Harga</label>
                    <input type="number" name="items[0][price]" class="form-control price" value="0" min="0" readonly required>
                </div>
                <div class="form-group">
                    <label for="subtotal">Subtotal</label>
                    <input type="number" name="items[0][subtotal]" class="form-control subtotal" value="0" readonly required>
                </div>
                <br>
                <button type="button" class="btn btn-danger remove-item">Hapus Item</button>
                <hr>
            </div>
        </div>

        <h4>Total: <span id="total-price">0</span></h4>

        <button type="button" id="add-item" class="btn btn-secondary">Tambah Item</button>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Simpan Pesanan</button>
        </div>
    </form>

    <script>
        let itemCount = 1;

        
        function updatePriceAndTotal(itemIndex) {
            const menuSelect = document.querySelector(`select[name="items[${itemIndex}][menu_id]"]`);
            const quantityInput = document.querySelector(`input[name="items[${itemIndex}][quantity]"]`);
            const priceInput = document.querySelector(`input[name="items[${itemIndex}][price]"]`);
            const subtotalInput = document.querySelector(`input[name="items[${itemIndex}][subtotal]"]`);
            const totalPriceElement = document.getElementById('total-price');

           
            const selectedOption = menuSelect.options[menuSelect.selectedIndex];
            const price = selectedOption ? parseFloat(selectedOption.getAttribute('data-price')) : 0;
            const quantity = parseInt(quantityInput.value) || 1;

           
            priceInput.value = price;
            subtotalInput.value = price * quantity;

            
            const allSubtotals = document.querySelectorAll('.subtotal');
            const total = Array.from(allSubtotals).reduce((sum, el) => sum + (parseFloat(el.value) || 0), 0);
            totalPriceElement.textContent = total.toFixed(2);  
        }

      
        document.querySelectorAll('.menu-select').forEach((select, index) => {
            select.addEventListener('change', () => updatePriceAndTotal(index));
        });
        document.querySelectorAll('.quantity').forEach((input, index) => {
            input.addEventListener('input', () => updatePriceAndTotal(index));
        });

        document.getElementById('add-item').addEventListener('click', function () {
            const itemHtml = `
                <div class="order-item">
                    <div class="form-group">
                        <label for="menu_id">Menu</label>
                        <select name="items[${itemCount}][menu_id]" class="form-control menu-select" required>
                            <option value="">Pilih Menu</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}" data-price="{{ $menu->price }}">{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Jumlah</label>
                        <input type="number" name="items[${itemCount}][quantity]" class="form-control quantity" value="1" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="number" name="items[${itemCount}][price]" class="form-control price" value="0" min="0" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="subtotal">Subtotal</label>
                        <input type="number" name="items[${itemCount}][subtotal]" class="form-control subtotal" value="0" readonly required>
                    </div>
                    <button type="button" class="btn btn-danger remove-item">Hapus Item</button>
                    <hr>
                </div>
            `;
            document.getElementById('order-items').insertAdjacentHTML('beforeend', itemHtml);
            updatePriceAndTotal(itemCount); 
            itemCount++;

            
            const newSelect = document.querySelectorAll('.menu-select')[itemCount - 1];
            newSelect.addEventListener('change', () => updatePriceAndTotal(itemCount - 1));
            const newQuantity = document.querySelectorAll('.quantity')[itemCount - 1];
            newQuantity.addEventListener('input', () => updatePriceAndTotal(itemCount - 1));
            const newRemoveButton = document.querySelectorAll('.remove-item')[itemCount - 1];
            newRemoveButton.addEventListener('click', () => removeItem(itemCount - 1));
        });

        
        function removeItem(index) {
            const itemToRemove = document.querySelectorAll('.order-item')[index];
            itemToRemove.remove();
            updatePriceAndTotalAfterRemoval();
        }

      
        function updatePriceAndTotalAfterRemoval() {
            const allSubtotals = document.querySelectorAll('.subtotal');
            const total = Array.from(allSubtotals).reduce((sum, el) => sum + (parseFloat(el.value) || 0), 0);
            document.getElementById('total-price').textContent = total.toFixed(2);
        }

        
        updatePriceAndTotal(0);
    </script>
@endsection
