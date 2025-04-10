<x-layouts.app :title="__('Scores')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            @foreach ($scores as $score)
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <p>{{ $score->name}}</p>
                <p>{{ $score->reservations_id }}</p>
                <p>1. {{ $score->score}}</p>
            </div>
                
            @endforeach
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                
            </div>
    </div>
</x-layouts.app>