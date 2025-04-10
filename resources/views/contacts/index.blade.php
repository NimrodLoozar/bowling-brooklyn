<x-layouts.app>
    <x-slot name="title">Contacts</x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Contacts</h1>
                <div class="flex items-center space-x-4">
                    <label class="inline-flex items-center text-sm text-gray-700 dark:text-gray-300">
                        <input type="checkbox" id="simulate-error" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600" 
                               wire:model="simulateError">
                        <span class="ml-2">Simulate server error (for devs)</span>
                    </label>
                    <a href="{{ route('contacts.create') }}" 
                       class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors dark:bg-indigo-500 dark:hover:bg-indigo-600">
                        Add New Contact
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 dark:bg-green-900 dark:border-green-700 dark:text-green-100">
                    {{ session('success') }}
                </div>
            @endif

            @if(request()->has('simulate_error') || (isset($simulateError) && $simulateError))
                <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 dark:bg-red-900 dark:border-red-700 dark:text-red-100">
                    Couldn't get data from server, try again later.
                </div>
            @else
                <div class="bg-white shadow overflow-hidden sm:rounded-lg dark:bg-gray-800">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                                        User
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                                        Mobile
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                                        Address
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @forelse ($contacts as $contact)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    {{ $contact->user->name }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $contact->mobile }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $contact->full_address }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('contacts.show', $contact) }}" 
                                                   class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                    View
                                                </a>
                                                <a href="{{ route('contacts.edit', $contact) }}" 
                                                   class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300">
                                                    Edit
                                                </a>
                                                <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                            onclick="return confirm('Are you sure you want to delete this contact?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                            No contacts found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 dark:bg-gray-700 dark:border-gray-700">
                        {{ $contacts->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.getElementById('simulate-error').addEventListener('change', function() {
            const url = new URL(window.location.href);
            if(this.checked) {
                url.searchParams.set('simulate_error', '1');
            } else {
                url.searchParams.delete('simulate_error');
            }
            window.location.href = url.toString();
        });

        // Set checkbox state from URL
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const simulateError = urlParams.get('simulate_error');
            if(simulateError) {
                document.getElementById('simulate-error').checked = true;
            }
        });
    </script>
</x-layouts.app>