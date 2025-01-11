<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Salaries') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="bg-white shadow sm:rounded-lg p-6">
            @if(session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-700">All Salaries</h3>
                <a href="{{ route('salaries.create') }}"
                >
                    + New Salary
                </a>
            </div>

            @if($salaries->count() > 0)
                <table class="min-w-full divide-y divide-gray-200 border">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($salaries as $salary)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $salary->id }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $salary->amount }}
                            </td>
                            <td class="px-6 py-4 text-sm text-right">
                                <a href="{{ route('salaries.edit', $salary) }}"
                                   class="text-indigo-600 hover:text-indigo-900 mr-2"
                                >
                                    Edit
                                </a>
                                <form
                                    action="{{ route('salaries.destroy', $salary) }}"
                                    method="POST"
                                    class="inline"
                                    onsubmit="return confirm('Delete this salary?');"
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

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $salaries->links() }}
                </div>
            @else
                <p class="text-gray-600 mt-4">No salaries found. Create one!</p>
            @endif
        </div>
    </div>
</x-app-layout>
