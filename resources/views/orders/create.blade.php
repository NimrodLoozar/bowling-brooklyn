<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order</title>
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
    </script>
</head>
<body>
    <h1>Create Order</h1>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <label>Product:</label>
        <select id="product" name="product" onchange="updateSubProduct()" required>
            <option value="">Selecteer een product</option>
            <option value="Eten">Eten</option>
            <option value="Drinken">Drinken</option>
        </select><br>

        <label>Subproduct:</label>
        <select id="sub-product" name="sub_product" required>
            <option value="">Selecteer een subproduct</option>
        </select><br>

        <label>Status:</label>
        <select name="status" required>
            <option value="Nieuw">Nieuw</option>
            <option value="Verzonden">Verzonden</option>
            <option value="Geannuleerd">Geannuleerd</option>
        </select><br>

        <label>Totaalbedrag:</label>
        <input type="number" step="0.01" name="totaalbedrag" required><br>

        <label>Betaalmethode:</label>
        <select name="betaalmethode">
            <option value="Creditcard">Creditcard</option>
            <option value="PayPal">PayPal</option>
            <option value="iDEAL">iDEAL</option>
        </select><br>

        <label>Betaalstatus:</label>
        <select name="betaalstatus" required>
            <option value="Niet betaald">Niet betaald</option>
            <option value="Betaald">Betaald</option>
        </select><br>

        <label>Aantal:</label>
        <input type="number" name="aantal" required><br>

        <label>Opmerking:</label>
        <textarea name="opmerking"></textarea><br>

        <button type="submit">Create</button>
    </form>
</body>
</html>
