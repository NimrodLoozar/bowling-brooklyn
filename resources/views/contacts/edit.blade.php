<x-layouts.app>
    <x-slot name="title">Edit Contact</x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Edit Contact</h1>
                <a href="{{ route('contacts.index') }}" 
                   class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors dark:text-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600">
                    Back to Contacts
                </a>
            </div>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 dark:bg-red-900 dark:border-red-700 dark:text-red-100">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow overflow-hidden sm:rounded-lg dark:bg-gray-800">
                <form action="{{ route('contacts.update', $contact) }}" method="POST" class="px-6 py-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <!-- User Selection (readonly since we shouldn't change user association) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                User
                            </label>
                            <div class="block w-full p-2 rounded-md bg-gray-100 dark:bg-gray-700 dark:text-gray-100">
                                {{ $contact->user->name }} ({{ $contact->user->email }})
                            </div>
                            <input type="hidden" name="user_id" value="{{ $contact->user_id }}">
                        </div>

                        <!-- Mobile Number -->
                        <div>
                            <label for="mobile" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Mobile Number <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="mobile" name="mobile" value="{{ old('mobile', $contact->mobile) }}" required
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:border-indigo-400 dark:focus:ring-indigo-400">
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Street Address
                            </label>
                            <input type="text" id="address" name="address" value="{{ old('address', $contact->address) }}"
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:border-indigo-400 dark:focus:ring-indigo-400">
                        </div>

                        <!-- City/Postal Code/Country Row -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="postal_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Postal Code
                                </label>
                                <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code', $contact->postal_code) }}"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:border-indigo-400 dark:focus:ring-indigo-400">
                            </div>

                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    City
                                </label>
                                <input type="text" id="city" name="city" value="{{ old('city', $contact->city) }}"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:border-indigo-400 dark:focus:ring-indigo-400">
                            </div>

                            <div>
                                <label for="country" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Country
                                </label>
                                <input type="text" id="country" name="country" value="{{ old('country', $contact->country) }}"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:border-indigo-400 dark:focus:ring-indigo-400">
                            </div>
                        </div>

                        <!-- Notes -->
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Notes
                            </label>
                            <textarea id="notes" name="notes" rows="3"
                                      class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:border-indigo-400 dark:focus:ring-indigo-400">{{ old('notes', $contact->notes) }}</textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4 flex justify-between">
                            <button type="submit"
                                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors dark:bg-indigo-500 dark:hover:bg-indigo-600">
                                Update Contact
                            </button>
                            
                            <button type="button" onclick="confirm('Are you sure?') && document.getElementById('delete-form').submit()"
                                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors dark:bg-red-500 dark:hover:bg-red-600">
                                Delete Contact
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Delete Form (hidden) -->
                <form id="delete-form" action="{{ route('contacts.destroy', $contact) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>