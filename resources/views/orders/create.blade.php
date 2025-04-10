<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order</title>
    <script>
        // Define prices for products and subproducts
        const prices = {
            products: {
                Pizza: 10.00,
                Hamburger: 8.50,
                Friet: 5.00
            },
            subProducts: {
                Cola: 2.50,
                Fanta: 2.50,
                Water: 1.50
            }
        };

        function calculateTotal() {
            const product = document.getElementById('product').value;
            const subProduct = document.getElementById('sub-product').value;
            const quantity = parseInt(document.getElementById('quantity').value) || 0;

            let total = 0;

            // Add product price
            if (product && prices.products[product]) {
                total += prices.products[product] * quantity;
            }

            // Add subproduct price
            if (subProduct && prices.subProducts[subProduct]) {
                total += prices.subProducts[subProduct] * quantity;
            }

            // Update the total price field
            document.getElementById('totaalbedrag').value = total.toFixed(2);
        }
    </script>
</head>
<body>
    <h1>Create Order</h1>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <label>Product (Eten):</label>
        <select id="product" name="product" onchange="calculateTotal()" required>
            <option value="" disabled selected>Selecteer een product</option>
            <option value="Pizza">Pizza</option>
            <option value="Hamburger">Hamburger</option>
            <option value="Friet">Friet</option>
        </select><br>

        <label>Subproduct (Drinken):</label>
        <select id="sub-product" name="sub_product" onchange="calculateTotal()">
            <option value="" disabled selected>Selecteer een subproduct</option>
            <option value="Cola">Cola</option>
            <option value="Fanta">Fanta</option>
            <option value="Water">Water</option>
        </select><br>

        <label>Aantal:</label>
        <input type="number" id="quantity" name="aantal" min="1" value="1" onchange="calculateTotal()" required><br>

        <label>Totaalbedrag:</label>
        <input type="number" id="totaalbedrag" name="totaalbedrag" step="0.01" readonly required><br>

        <label>Status:</label>
        <select name="status" required>
            <option value="Nieuw">Nieuw</option>
            <option value="Verzonden">Verzonden</option>
            <option value="Geannuleerd">Geannuleerd</option>
        </select><br>

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

        <label>Opmerking:</label>
        <textarea name="opmerking"></textarea><br>

        <button type="submit">Create</button>
    </form>
</body>
</html>
