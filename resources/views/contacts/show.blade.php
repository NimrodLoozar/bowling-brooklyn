{{-- resources/views/contacts/show.blade.php --}}
<x-layouts.app>
    <x-slot name="title">Contact Details</x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Contact Details</h1>
                <div class="flex space-x-2">
                    <a href="{{ route('contacts.edit', $contact) }}" 
                       class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors dark:bg-indigo-500 dark:hover:bg-indigo-600">
                        Edit Contact
                    </a>
                    <a href="{{ route('contacts.index') }}" 
                       class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors dark:text-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600">
                        Back to Contacts
                    </a>
                </div>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg dark:bg-gray-800">
                <div class="px-6 py-6">
                    <div class="flex items-start space-x-6">
                        <!-- User Avatar/Initials -->
                        <div class="flex-shrink-0">
                            <div class="h-16 w-16 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center">
                                <span class="text-2xl font-medium text-indigo-600 dark:text-indigo-300">
                                    {{ substr($contact->user->name, 0, 1) }}
                                </span>
                            </div>
                        </div>

                        <!-- Main Contact Details -->
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $contact->user->name }}</h2>
                            <p class="text-indigo-600 dark:text-indigo-400">{{ $contact->user->email }}</p>
                            
                            <!-- Contact Info Grid -->
                            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Mobile -->
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Mobile</h3>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                        {{ $contact->mobile ?? 'Not specified' }}
                                    </p>
                                </div>

                                <!-- Address -->
                                <div class="md:col-span-2">
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Address</h3>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                        @if($contact->address)
                                            {{ $contact->address }}<br>
                                            {{ $contact->postal_code }} {{ $contact->city }}<br>
                                            {{ $contact->country }}
                                        @else
                                            Not specified
                                        @endif
                                    </p>
                                </div>

                                <!-- Created/Updated -->
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Created</h3>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                        {{ $contact->created_at->format('M d, Y H:i') }}
                                    </p>
                                </div>

                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</h3>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                        {{ $contact->updated_at->format('M d, Y H:i') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Notes Section -->
                            @if($contact->notes)
                                <div class="mt-6">
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Notes</h3>
                                    <div class="mt-1 p-4 bg-gray-50 rounded-md dark:bg-gray-700">
                                        <p class="text-sm text-gray-900 dark:text-gray-100 whitespace-pre-line">{{ $contact->notes }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 dark:bg-gray-700 dark:border-gray-600 flex justify-between">
                    <form action="{{ route('contacts.destroy', $contact) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                onclick="return confirm('Are you sure you want to delete this contact?')">
                            Delete Contact
                        </button>
                    </form>
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        ID: {{ $contact->id }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>