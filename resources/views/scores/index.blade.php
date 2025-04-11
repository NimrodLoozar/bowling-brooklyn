<x-layouts.app :title="__('Scores')">
    @if (session('success'))
        <div class="alert alert-success bg-green-100 text-green-800 p-4 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger bg-red-100 text-red-800 p-4 rounded-md mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex justify-end mb-4">
        <a href="{{ route('scores.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            {{ __('Create Score') }}
        </a>
    </div>

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            @foreach ($reservations as $reservation)
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
                <div class="flex justify-between">
                    <p class="font-bold">{{ $reservation->user_name }}</p>
                    <p>{{ $reservation->reservation_id }}</p>
                </div>
                <div class="mt-2">
                    <div class="flex justify-between">
                        <p>
                            {{ $reservation->participant_name }}
                            @if ($reservation->is_owner)
                                <span class="text-sm text-gray-500">(Owner)</span>
                            @endif
                        </p>
                        <p>{{ $reservation->participant_score }}</p>
                    </div>
                </div>
                <div class="mt-4 flex justify-end gap-2">
                    <a href="{{ route('scores.edit', $reservation->reservation_id) }}" class="text-blue-500 hover:underline">
                        {{ __('Edit') }}
                    </a>
                    <button onclick="openModal({{ $reservation->reservation_id }})" class="text-red-500 hover:underline">
                        {{ __('Delete') }}
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-lg font-bold mb-4">{{ __('Confirm Deletion') }}</h2>
            <p class="mb-4">{{ __('Are you sure you want to delete this score?') }}</p>
            <form id="deleteForm" method="POST" action="" onsubmit="return validateCheckbox()">
                @csrf
                @method('DELETE')
                <div class="mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" id="confirmCheckbox" class="mr-2">
                        <span>{{ __('I confirm that I want to delete this score.') }}</span>
                    </label>
                </div>
                <div class="flex justify-end gap-4">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit" id="deleteButton" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                        {{ __('Delete') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Popup -->
    @if (session('success'))
    <div id="successPopup" class="fixed bottom-4 right-4 bg-green-500 text-white p-4 rounded-lg shadow-lg">
        {{ session('success') }}
        <button onclick="closeSuccessPopup()" class="ml-4 text-white font-bold">&times;</button>
    </div>
    @endif

    <script>
        function openModal(reservationId) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            const checkbox = document.getElementById('confirmCheckbox');
            
            form.action = `/scores/${reservationId}`;
            checkbox.checked = false; // Reset checkbox
            modal.classList.remove('hidden');
        }

        function closeModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
        }

        function validateCheckbox() {
            const checkbox = document.getElementById('confirmCheckbox');
            if (!checkbox.checked) {
                alert('{{ __('You must confirm the deletion by checking the box.') }}');
                return false;
            }
            return true;
        }

        function closeSuccessPopup() {
            const popup = document.getElementById('successPopup');
            popup.remove();
        }

        // Auto-hide success popup after 5 seconds
        window.onload = function() {
            const popup = document.getElementById('successPopup');
            if (popup) {
                setTimeout(() => popup.remove(), 5000);
            }
        };
    </script>
</x-layouts.app>