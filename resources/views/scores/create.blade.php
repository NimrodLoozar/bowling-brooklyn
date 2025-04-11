<x-layouts.app :title="__('Create Score')">
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-xl font-bold mb-4">{{ __('Create a New Score') }}</h1>
        <form method="POST" action="{{ route('scores.store') }}">
            @csrf
            <div class="mb-4">
                <label for="reservation_id" class="block text-sm font-medium text-gray-700">{{ __('Reservation') }}</label>
                <select id="reservation_id" name="reservation_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    <option value="">{{ __('Select a reservation') }}</option>
                    @foreach ($reservations as $reservation)
                        <option value="{{ $reservation->id }}">{{ $reservation->id }} - {{ $reservation->user->name }}</option>
                    @endforeach
                </select>
                @error('reservation_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="participant_name" class="block text-sm font-medium text-gray-700">{{ __('Participant Name') }}</label>
                <input type="text" id="participant_name" name="participant_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                @error('participant_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-700">{{ __('Date') }}</label>
                <input type="date" id="date" name="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                @error('date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="score" class="block text-sm font-medium text-gray-700">{{ __('Score') }}</label>
                <input type="number" id="score" name="score" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                @error('score')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-end">
                <a href="{{ route('scores.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">{{ __('Cancel') }}</a>
                <button type="submit" class="ml-4 px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600">{{ __('Create') }}</button>
            </div>
        </form>
    </div>
</x-layouts.app>