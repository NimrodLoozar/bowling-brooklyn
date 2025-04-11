<x-layouts.app :title="__('Edit Scores for Reservation: ') . $reservation->reservation_id">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-xl font-bold mb-4">{{ __('Edit Scores for Reservation: ') . $reservation->reservation_id }}</h1>
        <p class="mb-4">{{ __('Reservation Owner: ') . $reservation->user_name }}</p>

        @foreach ($scores as $score)
        <form method="POST" action="{{ route('scores.update', $score->score_id) }}" class="mb-6">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="participant_id_{{ $score->score_id }}" class="block text-sm font-medium text-gray-700">{{ __('Participant') }}</label>
                <select id="participant_id_{{ $score->score_id }}" name="participant_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    @foreach ($participants as $participant)
                        <option value="{{ $participant->id }}" {{ $participant->id == $score->participant_id ? 'selected' : '' }}>
                            {{ $participant->name }}
                        </option>
                    @endforeach
                </select>
                @error('participant_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="score_{{ $score->score_id }}" class="block text-sm font-medium text-gray-700">{{ __('Score') }}</label>
                <input type="number" id="score_{{ $score->score_id }}" name="score" value="{{ $score->score }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                @error('score')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="date_{{ $score->score_id }}" class="block text-sm font-medium text-gray-700">{{ __('Date') }}</label>
                <input type="date" id="date_{{ $score->score_id }}" name="date" value="{{ $score->date }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                @error('date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600">{{ __('Update') }}</button>
            </div>
        </form>
        @endforeach

        <div class="flex justify-end">
            <a href="{{ route('scores.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">{{ __('Back to Scores') }}</a>
        </div>
    </div>
</x-layouts.app>