<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Salary') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="bg-white shadow sm:rounded-lg p-6">
            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('salaries.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="amount" class="block font-medium text-gray-700">Amount</label>
                    <input
                        type="number"
                        step="0.01"
                        name="amount"
                        id="amount"
                        value="{{ old('amount') }}"
                        required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                               focus:border-indigo-500 focus:ring-indigo-500"
                    >
                    @error('amount')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <x-danger-button href="{{ route('salaries.index') }}" >{{ __('Cancel') }}</x-danger-button>

                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
