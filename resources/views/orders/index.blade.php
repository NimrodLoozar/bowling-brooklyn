<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Overview</title>
</head>
<body>
    <h1>Order Overview</h1>
    <a href="{{ route('orders.create') }}" style="margin-bottom: 20px; display: inline-block;">Create Order</a>
    <table border="1">
        <thead>
            <tr>
                <th>Besteldatum</th>
                <th>Product</th>
                <th>Subproduct</th>
                <th>Status</th>
                <th>Totaalbedrag</th>
                <th>Betaalmethode</th>
                <th>Betaalstatus</th>
                <th>Aantal</th>
                <th>Opmerking</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->besteldatum }}</td>
                    <td>{{ $order->product }}</td>
                    <td>{{ $order->sub_product }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->totaalbedrag }}</td>
                    <td>{{ $order->betaalmethode }}</td>
                    <td>{{ $order->betaalstatus }}</td>
                    <td>{{ $order->aantal }}</td>
                    <td>{{ $order->opmerking }}</td>
                    <td>
                        <a href="{{ route('orders.edit', $order->id) }}">Edit</a> |
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
