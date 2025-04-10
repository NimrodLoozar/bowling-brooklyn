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
        <label>Besteldatum:</label>
        <input type="date" name="besteldatum" required><br>
        <label>Status:</label>
        <input type="text" name="status" required><br>
        <label>Totaalbedrag:</label>
        <input type="number" step="0.01" name="totaalbedrag" required><br>
        <label>Betaalmethode:</label>
        <input type="text" name="betaalmethode"><br>
        <label>Betaalstatus:</label>
        <input type="text" name="betaalstatus" required><br>
        <label>Aantal:</label>
        <input type="number" name="aantal" required><br>
        <label>Opmerking:</label>
        <textarea name="opmerking"></textarea><br>
        <button type="submit">Create</button>
    </form>
</body>
</html>
