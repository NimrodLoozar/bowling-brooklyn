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
        <label>Besteldatum:</label>
        <input type="date" name="besteldatum" value="{{ $order->besteldatum }}" required><br>
        <label>Status:</label>
        <input type="text" name="status" value="{{ $order->status }}" required><br>
        <label>Totaalbedrag:</label>
        <input type="number" step="0.01" name="totaalbedrag" value="{{ $order->totaalbedrag }}" required><br>
        <label>Betaalmethode:</label>
        <input type="text" name="betaalmethode" value="{{ $order->betaalmethode }}"><br>
        <label>Betaalstatus:</label>
        <input type="text" name="betaalstatus" value="{{ $order->betaalstatus }}" required><br>
        <label>Aantal:</label>
        <input type="number" name="aantal" value="{{ $order->aantal }}" required><br>
        <label>Opmerking:</label>
        <textarea name="opmerking">{{ $order->opmerking }}</textarea><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
