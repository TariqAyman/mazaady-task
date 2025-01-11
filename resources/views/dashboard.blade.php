<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('N-th Highest Salary') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ nth: 5 }">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <form
                action="{{ route('dashboard') }}"
                method="GET"
                class="flex items-center space-x-4"
            >
                <div>
                    <label for="nth" class="block text-sm font-medium text-gray-700">
                        Enter a number (5-50)
                    </label>
                    <input
                        type="number"
                        name="nth"
                        id="nth"
                        x-model="nth"
                        min="1"
                        max="50"
                        class="mt-1 block w-32 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >
                </div>

                <x-primary-button>{{ __('Save') }}</x-primary-button>
            </form>

            @if(isset($employees))
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Employees with the {{ $nth }}-th Highest Salary
                    </h3>

                    @if($employees->count() > 0)
                        <table class="min-w-full mt-4 divide-y divide-gray-200 border">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Employee Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Employee Department
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Employee Salary
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($employees as $emp)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{ $emp->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{ $emp->departments->implode('name', ', ') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{ $emp->highest_salary }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="mt-2 text-sm text-gray-600">No employees found for the {{ $nth }}-th highest salary.</p>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
