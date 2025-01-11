<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Note in: ') . $folder->name }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8" x-data="{
        title: '',
        visibility: 'private',
        type: 'text'
    }">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <form action="{{ route('notes.store', $folder) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                @csrf

                <div>
                    <label for="title" class="block font-medium text-gray-700">Title</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        x-model="title"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                               focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Note title"
                        required
                    >
                    @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="visibility" class="block font-medium text-gray-700">Visibility</label>
                    <select
                        id="visibility"
                        name="visibility"
                        x-model="visibility"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                               focus:border-indigo-500 focus:ring-indigo-500"
                    >
                        <option value="private">Private</option>
                        <option value="shared">Shared</option>
                    </select>
                    @error('visibility')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="type" class="block font-medium text-gray-700">Type</label>
                    <select
                        id="type"
                        name="type"
                        x-model="type"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                               focus:border-indigo-500 focus:ring-indigo-500"
                    >
                        <option value="text">Text</option>
                        <option value="pdf">PDF</option>
                    </select>
                    @error('type')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- For text notes -->
                <div x-show="type === 'text'">
                    <label for="text_body" class="block font-medium text-gray-700">Text Body</label>
                    <textarea
                        id="text_body"
                        name="text_body"
                        rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                               focus:border-indigo-500 focus:ring-indigo-500"
                    ></textarea>
                    @error('text_body')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- For pdf notes (example placeholder) -->
                <div x-show="type === 'pdf'">
                    <label for="pdf_path" class="block font-medium text-gray-700">PDF Path (or upload)</label>
                    <input
                        type="file"
                        id="pdf_path"
                        name="pdf_path"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                               focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Path to PDF or handle file upload"
                    >
                    @error('pdf_path')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end">
                    <x-danger-button href="{{ route('notes.index',$folder) }}" >{{ __('Cancel') }}</x-danger-button>

                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
