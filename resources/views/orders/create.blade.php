<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order</title>
</head>
<body>
    <h1>Create Order</h1>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <label>Product (Eten):</label>
        <select id="product" name="product" required>
            <option value="" disabled selected>Selecteer een product</option>
            <option value="Pizza">Pizza</option>
            <option value="Hamburger">Hamburger</option>
            <option value="Friet">Friet</option>
        </select><br>

        <label>Subproduct (Drinken):</label>
        <select id="sub-product" name="sub_product">
            <option value="" disabled selected>Selecteer een subproduct</option>
            <option value="Cola">Cola</option>
            <option value="Fanta">Fanta</option>
            <option value="Water">Water</option>
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
