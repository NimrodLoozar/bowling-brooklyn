<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Overview</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 py-8">

    <div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-semibold mb-4">Reservations Overview</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full table-auto border-collapse">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 border">ID</th>
                    <th class="py-2 px-4 border">User</th>
                    <th class="py-2 px-4 border">Lane</th>
                    <th class="py-2 px-4 border">Date</th>
                    <th class="py-2 px-4 border">Start Time</th>
                    <th class="py-2 px-4 border">End Time</th>
                    <th class="py-2 px-4 border">Status</th>
                    <th class="py-2 px-4 border">Cost</th>
                    <th class="py-2 px-4 border">Paid</th>
                    <th class="py-2 px-4 border">Note</th>
                    <th class="py-2 px-4 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td class="py-2 px-4 border">{{ $reservation->id }}</td>
                        <td class="py-2 px-4 border">{{ $reservation->user->name ?? 'N/A' }}</td>
                        <td class="py-2 px-4 border">{{ $reservation->lane->name ?? 'N/A' }}</td>
                        <td class="py-2 px-4 border">{{ $reservation->date }}</td>
                        <td class="py-2 px-4 border">{{ $reservation->start_time }}</td>
                        <td class="py-2 px-4 border">{{ $reservation->end_time }}</td>
                        <td class="py-2 px-4 border">{{ ucfirst($reservation->status) }}</td>
                        <td class="py-2 px-4 border">{{ $reservation->cost ?? 'N/A' }}</td>
                        <td class="py-2 px-4 border">{{ $reservation->paid ? 'Yes' : 'No' }}</td>
                        <td class="py-2 px-4 border">{{ $reservation->note ?? 'No notes' }}</td>
                        <td class="py-2 px-4 border">
                            <a href="{{ route('reservations.edit', $reservation->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a> |
                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            <a href="{{ route('reservations.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">Create New Reservation</a>
        </div>
    </div>

</body>
</html>
