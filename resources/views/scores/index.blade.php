<x-layouts.app :title="__('Scores')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">

            {{-- @foreach ($reservations as $reservation)
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
                <div class="header">
                    <span><strong>{{ $reservation->user_name }}</strong></span> <!-- Use aliased user name -->
                    <span style="float: right;">Reservation ID: {{ $reservation->reservation_id }}</span>
                </div>
        
                <div class="participants">
                    <div class="participant-row">
                        <span>{{ $reservation->participant_name }}</span> <!-- Participant's name -->
                        <span style="float: right;">
                            {{ $reservation->participant_score ?? 'No score yet' }} <!-- Participant's score -->
                        </span>
                    </div>
                </div>
            </div>
            @endforeach --}}

            @foreach ($reservations as $reservation)
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
                <div class="flex justify-between">
                    <p class="font-bold">{{ $reservation->user_name }}</p> <!-- Reservation owner's name -->
                    <p>{{ $reservation->reservation_id }}</p> <!-- Reservation ID -->
                </div>
                <div class="mt-2">
                    <div class="flex justify-between">
                        <p>
                            {{ $reservation->participant_name }}
                            @if ($reservation->is_owner) <!-- Highlight if the participant is the owner -->
                                <span class="text-sm text-gray-500">(Owner)</span>
                            @endif
                        </p>
                        <p>{{ $reservation->participant_score }}</p> <!-- Participant's score -->
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>