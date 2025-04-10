<x-layouts.app :title="__('Edit Order')">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Order</h1>
        <form action="{{ route('orders.update', $order) }}" method="POST" class="bg-gray-100 dark:bg-gray-800 p-4 rounded shadow">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="product" class="block font-medium">Product (Eten):</label>
                <select id="product" name="product[]" multiple required class="w-full p-2 border rounded">
                    <option value="Pizza" {{ is_array($order->product) && in_array('Pizza', $order->product) ? 'selected' : '' }}>Pizza (€10.00)</option>
                    <option value="Hamburger" {{ is_array($order->product) && in_array('Hamburger', $order->product) ? 'selected' : '' }}>Hamburger (€8.50)</option>
                    <option value="Friet" {{ is_array($order->product) && in_array('Friet', $order->product) ? 'selected' : '' }}>Friet (€5.00)</option>
                </select>
                <small class="text-gray-500">Houd Ctrl of Cmd ingedrukt om meerdere opties te selecteren.</small>
            </div>

            <div class="mb-4">
                <label for="sub-product" class="block font-medium">Subproduct (Drinken):</label>
                <select id="sub-product" name="sub_product[]" multiple class="w-full p-2 border rounded">
                    <option value="Cola" {{ is_array($order->sub_product) && in_array('Cola', $order->sub_product) ? 'selected' : '' }}>Cola (€2.50)</option>
                    <option value="Fanta" {{ is_array($order->sub_product) && in_array('Fanta', $order->sub_product) ? 'selected' : '' }}>Fanta (€2.50)</option>
                    <option value="Water" {{ is_array($order->sub_product) && in_array('Water', $order->sub_product) ? 'selected' : '' }}>Water (€1.50)</option>
                </select>
                <small class="text-gray-500">Houd Ctrl of Cmd ingedrukt om meerdere opties te selecteren.</small>
            </div>

            <div class="mb-4">
                <label for="besteldatum" class="block font-medium">Besteldatum:</label>
                <input type="date" name="besteldatum" value="{{ $order->besteldatum->format('Y-m-d') }}" required class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="status" class="block font-medium">Status:</label>
                <select name="status" required class="w-full p-2 border rounded">
                    <option value="Nieuw" {{ $order->status == 'Nieuw' ? 'selected' : '' }}>Nieuw</option>
                    <option value="Verzonden" {{ $order->status == 'Verzonden' ? 'selected' : '' }}>Verzonden</option>
                    <option value="Geannuleerd" {{ $order->status == 'Geannuleerd' ? 'selected' : '' }}>Geannuleerd</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="totaalbedrag" class="block font-medium">Totaalbedrag:</label>
                <input type="number" step="0.01" name="totaalbedrag" value="{{ $order->totaalbedrag }}" required class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="betaalmethode" class="block font-medium">Betaalmethode:</label>
                <select name="betaalmethode" class="w-full p-2 border rounded">
                    <option value="Creditcard" {{ $order->betaalmethode == 'Creditcard' ? 'selected' : '' }}>Creditcard</option>
                    <option value="PayPal" {{ $order->betaalmethode == 'PayPal' ? 'selected' : '' }}>PayPal</option>
                    <option value="iDEAL" {{ $order->betaalmethode == 'iDEAL' ? 'selected' : '' }}>iDEAL</option>
                    <option value="Contant" {{ $order->betaalmethode == 'Contant' ? 'selected' : '' }}>Contant</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="betaalstatus" class="block font-medium">Betaalstatus:</label>
                <select name="betaalstatus" required class="w-full p-2 border rounded">
                    <option value="Niet betaald" {{ $order->betaalstatus == 'Niet betaald' ? 'selected' : '' }}>Niet betaald</option>
                    <option value="Betaald" {{ $order->betaalstatus == 'Betaald' ? 'selected' : '' }}>Betaald</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="aantal" class="block font-medium">Aantal:</label>
                <input type="number" name="aantal" value="{{ $order->aantal }}" required class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="opmerking" class="block font-medium">Opmerking:</label>
                <textarea name="opmerking" class="w-full p-2 border rounded">{{ $order->opmerking }}</textarea>
            </div>

            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update</button>
        </form>
        <!-- Back to Overview Button -->
        <div class="mt-6">
            <a href="{{ route('orders.index') }}" class="inline-block bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Back to Overview
            </a>
        </div>
    </div>
</x-layouts.app>
