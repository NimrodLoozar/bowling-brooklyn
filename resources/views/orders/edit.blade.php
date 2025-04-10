<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
</head>
<body>
    <h1>Edit Order</h1>
    <form action="{{ route('orders.update', $order) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Product (Eten):</label>
        <select id="product" name="product" required>
            <option value="Pizza" {{ $order->product == 'Pizza' ? 'selected' : '' }}>Pizza</option>
            <option value="Hamburger" {{ $order->product == 'Hamburger' ? 'selected' : '' }}>Hamburger</option>
            <option value="Friet" {{ $order->product == 'Friet' ? 'selected' : '' }}>Friet</option>
        </select><br>

        <label>Subproduct (Drinken):</label>
        <select id="sub-product" name="sub_product">
            <option value="" disabled>Selecteer een subproduct</option>
            <option value="Cola" {{ $order->sub_product == 'Cola' ? 'selected' : '' }}>Cola</option>
            <option value="Fanta" {{ $order->sub_product == 'Fanta' ? 'selected' : '' }}>Fanta</option>
            <option value="Water" {{ $order->sub_product == 'Water' ? 'selected' : '' }}>Water</option>
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
