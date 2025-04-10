<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <script>
        function updateSubProduct() {
            const product = document.getElementById('product').value;
            const subProduct = document.getElementById('sub-product');
            subProduct.innerHTML = ''; // Clear existing options

            if (product === 'Eten') {
                const options = ['Pizza', 'Hamburger', 'Friet'];
                options.forEach(option => {
                    const opt = document.createElement('option');
                    opt.value = option;
                    opt.textContent = option;
                    subProduct.appendChild(opt);
                });
            } else if (product === 'Drinken') {
                const options = ['Cola', 'Fanta', 'Water'];
                options.forEach(option => {
                    const opt = document.createElement('option');
                    opt.value = option;
                    opt.textContent = option;
                    subProduct.appendChild(opt);
                });
            }
        }

        // Pre-fill sub-product options on page load
        window.onload = function() {
            updateSubProduct();
            document.getElementById('sub-product').value = "{{ $order->sub_product }}";
        };
    </script>
</head>
<body>
    <h1>Edit Order</h1>
    <form action="{{ route('orders.update', $order) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Product:</label>
        <select id="product" name="product" onchange="updateSubProduct()" required>
            <option value="Eten" {{ $order->product == 'Eten' ? 'selected' : '' }}>Eten</option>
            <option value="Drinken" {{ $order->product == 'Drinken' ? 'selected' : '' }}>Drinken</option>
        </select><br>

        <label>Subproduct:</label>
        <select id="sub-product" name="sub_product" required>
            <option value="">Selecteer een subproduct</option>
        </select><br>

        <label>Besteldatum:</label>
        <input type="date" name="besteldatum" value="{{ $order->besteldatum->format('Y-m-d') }}" required><br>

        <label>Status:</label>
        <select name="status" required>
            <option value="Nieuw" {{ $order->status == 'Nieuw' ? 'selected' : '' }}>Nieuw</option>
            <option value="Verzonden" {{ $order->status == 'Verzonden' ? 'selected' : '' }}>Verzonden</option>
            <option value="Geannuleerd" {{ $order->status == 'Geannuleerd' ? 'selected' : '' }}>Geannuleerd</option>
        </select><br>

        <label>Totaalbedrag:</label>
        <input type="number" step="0.01" name="totaalbedrag" value="{{ $order->totaalbedrag }}" required><br>

        <label>Betaalmethode:</label>
        <select name="betaalmethode">
            <option value="Creditcard" {{ $order->betaalmethode == 'Creditcard' ? 'selected' : '' }}>Creditcard</option>
            <option value="PayPal" {{ $order->betaalmethode == 'PayPal' ? 'selected' : '' }}>PayPal</option>
            <option value="iDEAL" {{ $order->betaalmethode == 'iDEAL' ? 'selected' : '' }}>iDEAL</option>
        </select><br>

        <label>Betaalstatus:</label>
        <select name="betaalstatus" required>
            <option value="Niet betaald" {{ $order->betaalstatus == 'Niet betaald' ? 'selected' : '' }}>Niet betaald</option>
            <option value="Betaald" {{ $order->betaalstatus == 'Betaald' ? 'selected' : '' }}>Betaald</option>
        </select><br>

        <label>Aantal:</label>
        <input type="number" name="aantal" value="{{ $order->aantal }}" required><br>

        <label>Opmerking:</label>
        <textarea name="opmerking">{{ $order->opmerking }}</textarea><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
