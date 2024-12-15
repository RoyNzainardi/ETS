<!DOCTYPE html>
<html>
<head>
    <title>Form Pemesanan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
            color: #333;
        }
        h2 {
            text-align: center;
            color: #ff6600;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .kue-option {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 8px;
            transition: border-color 0.3s;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }
        .kue-option img {
            width: 80px;
            height: auto;
            margin-right: 15px;
            border-radius: 5px;
            transition: transform 0.3s ease, border-color 0.3s ease;
            border: 2px solid transparent;
            cursor: pointer;
        }
        .kue-option img.selected {
            border-color: #ff6600;
            transform: scale(1.1);
        }
        label {
            flex: 1;
            font-size: 1.1em;
        }
        input[type="number"] {
            width: 60px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
            margin-left: 10px;
        }
        .table-select {
            margin: 20px 0;
            text-align: center;
        }
        .table-select select {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 1em;
        }
        .input-field {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
            font-size: 1em;
        }
        button {
            display: block;
            width: 100%;
            background-color: #ff6600;
            color: #fff;
            border: none;
            padding: 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            margin-top: 20px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #cc5200;
        }
        .total-price {
            text-align: center;
            font-weight: bold;
            font-size: 1.2em;
            margin-top: 20px;
        }
        .back-button {
            display: block;
            width: 100%;
            text-align: center;
            background-color: #ff6600;
            color: #fff;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #cc5200;
        }
    </style>
    <script>
        function toggleSelection(kue) {
            const img = document.getElementById(`img_${kue}`);
            const qtyInput = document.getElementById(`jumlah_${kue}`);
            const isSelected = img.classList.toggle('selected');

            // Set quantity to 1 if selected, otherwise reset to 0
            qtyInput.value = isSelected ? 1 : 0;
            qtyInput.disabled = !isSelected;

            updateTotal();
        }

        function updateTotal() {
            const prices = {
                pancake: 10000,
                donat: 5000,
                pizza: 8000
            };
            let total = 0;

            document.querySelectorAll('.kue-option img.selected').forEach((img) => {
                const kue = img.dataset.kue;
                const qty = parseInt(document.getElementById(`jumlah_${kue}`).value) || 0;
                total += prices[kue] * qty;
            });
            document.getElementById("totalPrice").innerText = `Total Harga: Rp ${total.toLocaleString("id-ID")}`;
            document.getElementById("total_harga").value = total;
        }

        function submitOrder() {
            document.getElementById('orderForm').submit();
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Form Pemesanan</h2>

        <form id="orderForm" method="post" action="process_order.php">
            <input type="text" name="nama_pelanggan" class="input-field" placeholder="Nama Pelanggan" required>

            <div class="kue-option">
                <img src="pancake.jpg" alt="Pancake" id="img_pancake" data-kue="pancake" onclick="toggleSelection('pancake')">
                <label>Pancake - Rp 10.000,00</label>
                <input type="number" id="jumlah_pancake" name="daftar_kue[pancake]" min="1" value="0" onchange="updateTotal()" disabled>
            </div>

            <div class="kue-option">
                <img src="donat.jpg" alt="Donat" id="img_donat" data-kue="donat" onclick="toggleSelection('donat')">
                <label>Donat - Rp 5.000,00</label>
                <input type="number" id="jumlah_donat" name="daftar_kue[donat]" min="1" value="0" onchange="updateTotal()" disabled>
            </div>

            <div class="kue-option">
                <img src="pizza.jpg" alt="Pizza" id="img_pizza" data-kue="pizza" onclick="toggleSelection('pizza')">
                <label>Pizza - Rp 8.000,00</label>
                <input type="number" id="jumlah_pizza" name="daftar_kue[pizza]" min="1" value="0" onchange="updateTotal()" disabled>
            </div>

            <div class="table-select">
                <label for="tableSelect">Pilih Nomor Meja:</label>
                <select id="tableSelect" name="nomor_meja" required>
                    <option value="">Pilih Nomor Meja</option>
                    <option value="1">Meja 1</option>
                    <option value="2">Meja 2</option>
                    <option value="3">Meja 3</option>
                    <option value="4">Meja 4</option>
                    <option value="5">Meja 5</option>
                    <option value="6">Meja 6</option>
                    <option value="7">Meja 7</option>
                    <option value="8">Meja 8</option>
                    <option value="9">Meja 9</option>
                </select>
            </div>

            <input type="hidden" id="total_harga" name="total_harga" value="0">

            <p id="totalPrice" class="total-price">Total Harga: Rp 0</p>
            <button type="button" onclick="submitOrder()">Pesan</button>
        </form>

        <a href="home.html" class="back-button">Kembali ke Beranda</a>
    </div>
</body>
</html>
