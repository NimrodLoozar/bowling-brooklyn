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
            const products = Array.from(document.getElementById('product').selectedOptions).map(option => option.value);
            const subProducts = Array.from(document.getElementById('sub-product').selectedOptions).map(option => option.value);
            const quantity = parseInt(document.getElementById('quantity').value) || 0;

            let total = 0;

            // Add product prices
            products.forEach(product => {
                if (product && prices.products[product]) {
                    total += prices.products[product] * quantity;
                }
            });

            // Add subproduct prices
            subProducts.forEach(subProduct => {
                if (subProduct && prices.subProducts[subProduct]) {
                    total += prices.subProducts[subProduct] * quantity;
                }
            });

            // Update the total price field
            document.getElementById('totaalbedrag').value = total.toFixed(2);
        }
    </script>
</head>
<body>
    <x-layouts.app :title="__('Create Order')">
        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4">Create Order</h1>
            <form action="{{ route('orders.store') }}" method="POST" class="bg-gray-100 dark:bg-gray-800 p-4 rounded shadow">
                @csrf

                <div class="mb-4">
                    <label for="product" class="block font-medium">Product (Eten):</label>
                    <select id="product" name="product[]" multiple onchange="calculateTotal()" required class="w-full p-2 border rounded">
                        <option value="Pizza">Pizza (€10.00)</option>
                        <option value="Hamburger">Hamburger (€8.50)</option>
                        <option value="Friet">Friet (€5.00)</option>
                    </select>
                    <small class="text-gray-500">Houd Ctrl of Cmd ingedrukt om meerdere opties te selecteren.</small>
                </div>

                <div class="mb-4">
                    <label for="sub-product" class="block font-medium">Subproduct (Drinken):</label>
                    <select id="sub-product" name="sub_product[]" multiple onchange="calculateTotal()" class="w-full p-2 border rounded">
                        <option value="Cola">Cola (€2.50)</option>
                        <option value="Fanta">Fanta (€2.50)</option>
                        <option value="Water">Water (€1.50)</option>
                    </select>
                    <small class="text-gray-500">Houd Ctrl of Cmd ingedrukt om meerdere opties te selecteren.</small>
                </div>

                <div class="mb-4">
                    <label for="quantity" class="block font-medium">Aantal:</label>
                    <input type="number" id="quantity" name="aantal" min="1" value="1" onchange="calculateTotal()" required class="w-full p-2 border rounded">
                </div>

                <div class="mb-4">
                    <label for="totaalbedrag" class="block font-medium">Totaalbedrag:</label>
                    <input type="number" id="totaalbedrag" name="totaalbedrag" step="0.01" required class="w-full p-2 border rounded" onkeydown="return false;">
                </div>

                <div class="mb-4">
                    <label for="status" class="block font-medium">Status:</label>
                    <select name="status" required class="w-full p-2 border rounded">
                        <option value="Nieuw">Nieuw</option>
                        <option value="Verzonden">Verzonden</option>
                        <option value="Geannuleerd">Geannuleerd</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="betaalmethode" class="block font-medium">Betaalmethode:</label>
                    <select name="betaalmethode" class="w-full p-2 border rounded">
                        <option value="Creditcard">Creditcard</option>
                        <option value="PayPal">PayPal</option>
                        <option value="iDEAL">iDEAL</option>
                        <option value="Contant">Contant</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="betaalstatus" class="block font-medium">Betaalstatus:</label>
                    <select name="betaalstatus" required class="w-full p-2 border rounded">
                        <option value="Niet betaald">Niet betaald</option>
                        <option value="Betaald">Betaald</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="opmerking" class="block font-medium">Opmerking:</label>
                    <textarea name="opmerking" class="w-full p-2 border rounded"></textarea>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create</button>
            </form>
            <!-- Back to Overview Button -->
            <div class="mt-6">
                <a href="{{ route('orders.index') }}" class="inline-block bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Back to Overview
                </a>
            </div>
        </div>
    </x-layouts.app>
</body>
</html>
