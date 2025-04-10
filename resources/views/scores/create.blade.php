<x-layout.app :title="__('Scores create')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-scores.form :action="route('scores.store')" />
            </div>
        </div>
    </div>
</x-layout.app>