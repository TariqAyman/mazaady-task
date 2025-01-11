<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Folders') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ open: false }">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-700">Your Folders</h3>
                <a href="{{ route('folders.create') }}">
                    + New Folder
                </a>
            </div>

            @if($folders->count() > 0)
                <table class="min-w-full divide-y divide-gray-200 border">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Folder Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($folders as $folder)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                <a href="{{ route('notes.index', $folder) }}" class="text-blue-600 hover:underline">
                                    {{ $folder->name }}
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('notes.index', $folder) }}">
                                    Add Notes
                                </a>
                                <br>

                                <a href="{{ route('folders.edit', $folder) }}"
                                   class="text-indigo-600 hover:text-indigo-900 mr-2"
                                >
                                    Edit
                                </a>
                                <form
                                    action="{{ route('folders.destroy', $folder) }}"
                                    method="POST"
                                    class="inline"
                                    onsubmit="return confirm('Delete this folder?');"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-600 mt-4">No folders found. Create one!</p>
            @endif
        </div>
    </div>
</x-app-layout>
