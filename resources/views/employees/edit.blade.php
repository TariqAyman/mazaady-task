<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Employee') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="bg-white shadow sm:rounded-lg p-6">
            <form action="{{ route('employees.update', $employee) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block font-medium text-gray-700">Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name', $employee->name) }}"
                        required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500
                               focus:ring-indigo-500"
                    >
                    @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Departments -->
                <div>
                    <label for="departments" class="block font-medium text-gray-700">Select Departments</label>
                    <select
                        name="departments[]"
                        id="departments"
                        multiple
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >
                        @foreach($departments as $dep)
                            <option
                                value="{{ $dep->id }}"
                                {{ in_array($dep->id, old('departments', $employee->departments->pluck('id')->toArray())) ? 'selected' : '' }}
                            >
                                {{ $dep->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('departments')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    @error('departments.*')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <p class="text-gray-500 text-sm mt-2">
                        Hold Ctrl (Windows) or Command (Mac) to select multiple departments.
                    </p>
                </div>

                <div class="flex justify-end">
                    <x-danger-button href="{{ route('employees.index') }}" >{{ __('Cancel') }}</x-danger-button>

                    <x-primary-button>{{ __('Update') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
