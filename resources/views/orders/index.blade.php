<x-layouts.app :title="__('Orders Overview')">
    <div class="container mx-auto p-4">
        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Create Order Button -->
        <div class="mb-4">
            <a href="{{ route('orders.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Create Order
            </a>
        </div>

        <!-- Orders Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($orders as $order)
                <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded shadow border-b border-gray-300 dark:border-gray-700">
                    <div class="flex justify-between items-center mb-2">
                        <h2 class="text-lg font-bold">Order ID: {{ $order->id }}</h2>
                        <span class="text-sm text-gray-500">{{ $order->besteldatum }}</span>
                    </div>
                    <div class="mb-2">
                        <p><strong>Product:</strong> {{ $order->product }}</p>
                        <p><strong>Subproduct:</strong> {{ $order->sub_product }}</p>
                        <p><strong>Status:</strong> {{ $order->status }}</p>
                        <p><strong>Totaalbedrag:</strong> €{{ number_format($order->totaalbedrag, 2) }}</p>
                        <p><strong>Betaalmethode:</strong> {{ $order->betaalmethode }}</p>
                        <p><strong>Betaalstatus:</strong> {{ $order->betaalstatus }}</p>
                        <p><strong>Aantal:</strong> {{ $order->aantal }}</p>
                        <p><strong>Opmerking:</strong> {{ $order->opmerking }}</p>
                    </div>
                    <div class="flex space-x-2">
                        @if (!in_array($order->status, ['In behandeling', 'Verzonden']))
                            <a href="{{ route('orders.edit', $order->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                                Edit
                            </a>
                        @endif
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze bestelling wilt verwijderen?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>
